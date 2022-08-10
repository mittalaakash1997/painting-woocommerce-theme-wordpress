//render products DOM to view
function eo_wcfw_filter_render_html(data) {			

	//Replace Result Count Status...
	if(jQuery('.woocommerce-result-count',jQuery(data)).html()!==undefined){								
		jQuery(".woocommerce-result-count").html(jQuery('.woocommerce-result-count',jQuery(data)).html());

	}
	else {
		jQuery(".woocommerce-result-count").html('');	
	}

	//Replacing Product listings....
	if(jQuery('.products,.product-listing,.row-inner>.col-lg-9:eq(0)',jQuery(data)).html()!==undefined){								
		jQuery(".products,.product-listing,.row-inner>.col-lg-9:eq(0)").html(jQuery('.products,.product-listing,.row-inner>.col-lg-9:eq(0)',jQuery(data)).html());
		
		var links=jQuery(".products a,.product-listing a");
		jQuery.each(links,function(index,element) {

			var href=jQuery(element).attr('href');
			if(href.indexOf('?')==-1) {
				jQuery(element).attr('href',jQuery(element).attr('href')+eo_wcfw_object.eo_product_url);
			}
			else {

				jQuery(element).attr('href',href.substring(0,href.indexOf('?'))+eo_wcfw_object.eo_product_url);
			}									
		});
	}
	else {
		jQuery(".products,.product-listing,.row-inner>.col-lg-9:eq(0)").html('<p class="woocommerce-info" style="width: 100%;">No products were found matching your selection.</p>');	
	}
	//Replacing Pagination details.....
	if(jQuery('.woocommerce-pagination,.pagination',jQuery(data)).html()!==undefined) {
		
		jQuery(".woocommerce-pagination,.pagination").html(jQuery('.woocommerce-pagination,.pagination',jQuery(data)).html());
	}
	else {
		jQuery(".woocommerce-pagination,.pagination").html('');	
	}

	//jQuery("body").fadeTo('fast','1')									
	jQuery("#loading").removeClass('loading');
	jQuery('.products,.product-listing,.row-inner>.col-lg-9:eq(0),.woocommerce-pagination,.pagination').css('visibility','visible');
	if(jQuery(".row-inner>.col-lg-9").length>0){
		jQuery(".row-inner>.col-lg-9 *").each(function(i,e) {		
		    if(jQuery(e).css('opacity') == '0'){
				jQuery(e).css('opacity','1');        
		    }
		});
		jQuery(".t-entry-visual-overlay").removeClass('t-entry-visual-overlay');
		jQuery(".double-gutter .tmb").css('width','50%');
		jQuery(".double-gutter .tmb").css('display','inline-flex');
	}
}

if(eo_wcfw_object.disp_regular){
	
	if(typeof(jQuery.fn.eo_wcfw_filter_change)=="undefined" || jQuery.fn.eo_wcfw_filter_change==undefined){

		jQuery.fn.eo_wcfw_filter_change= function(init_call=false) {				
		//flag indicates if to show products in tabular view or woocommerce's default style.
			//console.log(jQuery("[name='_category']").val());
			//console.log(jQuery("[name='_attribute']").val());

			_category = jQuery("[name='_category']").val();
			_category = _category.split(',').filter(function(b){ return b.trim().length; });
			jQuery("#filter_chips").empty();
			jQuery.each(_category,function(i,e){
				//console.log(e);
				if(jQuery("[name='cat_filter_"+e+"']").length) {
					_cat_chunk = jQuery("[name='cat_filter_"+e+"']").val();
					_cat_chunk = _cat_chunk.split(',').filter(function(b){ return b.trim().length });
					jQuery.each(_cat_chunk,function(m,n){
						if(jQuery("[data-slug='"+n+"'][data-label]").length){							
							jQuery("#filter_chips").append("<span class='ui small tag label' data-target-slug='"+n+"'>"+jQuery("[data-slug='"+n+"'][data-label]").attr('data-label')+"&nbsp;&nbsp;&nbsp;<i class='times icon'></i></span>");
						}
					});										
				} else if(jQuery("[name='checklist_"+e+"']").length) {
					//console.log(jQuery("[name='cat_filter_"+e+"']").val());
					_cat_chunk = jQuery("[name='checklist_"+e+"']").val();
					_cat_chunk = _cat_chunk.split(',').filter(function(b){ return b.trim().length });
					jQuery.each(_cat_chunk,function(m,n) {
						if(jQuery("[data-slug='"+n+"'][data-label]").length) {
							jQuery("#filter_chips").append("<span class='ui small tag label' data-target-slug='"+n+"'>"+jQuery("[data-slug='"+n+"'][data-label]").attr('data-label')+"&nbsp;&nbsp;&nbsp;<i class='times icon'></i></span>");
						}
					});										
				}
			});

			console.log(_category);

			_attribute = jQuery("[name='_attribute']").val();
			_attribute = _attribute.split(',').filter(function(b){ return b.trim().length; });

			console.log(_attribute);

			jQuery.each(_attribute,function(i,e){
				//console.log(e);
				if(jQuery("[name='text_min_"+e+"']").length && jQuery("[name='text_max_"+e+"']").length) {

					_min_label = jQuery("[name='text_min_"+e+"']").val();
					_max_label = jQuery("[name='text_max_"+e+"']").val();			
					jQuery("#filter_chips").append("<span class='ui small tag label' data-target-slug='"+e+"'>"+_min_label+'-'+_max_label+"&nbsp;&nbsp;&nbsp;<i class='times icon'></i></span>");

				} else if(jQuery("[name='min_"+e+"']").length && jQuery("[name='max_"+e+"']").length) {

					if(jQuery("[data-slug='"+e+"'][data-labels][data-slugs]").length) {
						_att_labels = jQuery("[data-slug='"+e+"'][data-labels][data-slugs]").attr('data-labels').split(',');
						console.log(_att_labels);
						_att_slugs = jQuery("[data-slug='"+e+"'][data-labels][data-slugs]").attr('data-slugs').split(',');
						console.log(_att_slugs);
						_min_label = '';
						if(_att_slugs.indexOf(jQuery("[name='min_"+e+"']").val())!=-1) {
							_min_label = _att_labels[_att_slugs.indexOf(jQuery("[name='min_"+e+"']").val())];
						} else {
							_min_label = _att_labels[Number.parseInt(jQuery("[name='min_"+e+"']").val())];
						}

						_max_label = '';
						if(_att_slugs.indexOf(jQuery("[name='max_"+e+"']").val())!=-1) {
							_max_label = _att_labels[_att_slugs.indexOf(jQuery("[name='max_"+e+"']").val())];
						} else {
							_max_label = _att_labels[Number.parseInt(jQuery("[name='max_"+e+"']").val())];
						}		
						jQuery("#filter_chips").append("<span class='ui small tag label' data-target-slug='"+e+"'>"+_min_label+'-'+_max_label+"&nbsp;&nbsp;&nbsp;<i class='times icon'></i></span>");
					}

				} else if(jQuery("[name='checklist_"+e+"']").length) {
					//console.log(jQuery("[name='cat_filter_"+e+"']").val());
					_cat_chunk = jQuery("[name='checklist_"+e+"']").val();
					_cat_chunk = _cat_chunk.split(',').filter(function(b){ return b.trim().length });
					jQuery.each(_cat_chunk,function(m,n) {
						if(jQuery("[data-slug='"+n+"'][data-label]").length) {
							jQuery("#filter_chips").append("<span class='ui small tag label' data-target-slug='"+n+"'>"+jQuery("[data-slug='"+n+"'][data-label]").attr('data-label')+"&nbsp;<i class='times icon'></i></span>");
						}
					});										
				}
			});


			_min_label = jQuery('[name="text_min_price"]').val();
			_max_label = jQuery('[name="text_max_price"]').val();			
			jQuery("#filter_chips").append("<span class='ui small tag label' data-target-slug='price'>"+_min_label+'-'+_max_label+"&nbsp;&nbsp;&nbsp;<i class='times icon'></i></span>");

			

			var form=jQuery("form#eo_wcfw_filter");	
			var site_url=eo_wcfw_object.eo_cat_site_url;
			var ajax_url=site_url+eo_wcfw_object.eo_cat_query;	
			console.log(ajax_url);				
			jQuery.ajax({
				url:eo_wcfw_object.ajax_url,//form.attr('action'),
				data:form.serialize(), // form data
				type:form.attr('method'), // POST
				beforeSend:function(xhr){
					//jQuery("body").fadeTo('slow','0.3')	
					jQuery("#loading").addClass('loading');							
					console.log(this.url);
				},
				complete : function(){
					//console.log(this.url);
				},
				success:function(data){		
					//console.log(JSON.stringify(data));
					eo_wcfw_filter_render_html(data);
				}
			});
			return false;
		}	
	}
}

jQuery(document).ready(function($){

	if(eo_wcfw_object.disp_regular){
	
		jQuery(".woocommerce-pagination,.pagination").html('');		

		$("#eo_wcfw_filter").on('change',"input:not(:checkbox)",function(){
			$('[name="paged"]').val('1');
			jQuery.fn.eo_wcfw_filter_change();										
		});

		jQuery.fn.eo_wcfw_filter_change(true);

		//pagination for non-table based view
		$(".woocommerce-pagination,.pagination").on('click','a',function(event){
			
			event.preventDefault();
			event.stopPropagation();								
			
			if($(this).hasClass("next") || $(this).hasClass("prev")){
			
				if($(this).hasClass("next")){
					$("[name='paged']").val(parseInt($(".page-numbers.current").text())+1);
				}
				if($(this).hasClass("prev")){
					$("[name='paged']").val(parseInt($(".page-numbers.current").text())-1);
				}	
			}		
			else {
				$("[name='paged']").val($(this).text());
			}		
			jQuery.fn.eo_wcfw_filter_change();
		});
	}
	/////////////////////////
	////////////////////////

	$( ".eo_wcfw_advance_filter" ).accordion({
	  collapsible: true,
	  active:false
	});

	//Reset form and display
	jQuery(".eo_wcfw_srch_btn:eq(2)").click(function(){					
		///////////////////////////////////////////
		document.forms.eo_wcfw_filter.reset();
		jQuery(".eo_wcfw_srch_btn:eq(2)").trigger('reset');
		jQuery("#eo_wcfw_attr_query").val("");
		jQuery('[name="paged"]').val('1');
		jQuery.fn.eo_wcfw_filter_change(true);

	});	

	jQuery("#filter_chips").on('click','.ui.tag.label',function(){
		eval(jQuery("[data-slug='"+jQuery(this).attr('data-target-slug')+"']").attr('data-reset'));		
	});
});

function reset_icon(e,selector){
	e.preventDefault();
	e.stopPropagation()
	jQuery('.eo_wcfw_filter_icon_select[data-filter="'+selector+'"]').trigger('click');
	return false;
}

function reset_single_icon(e,selector){
	e.preventDefault();
	e.stopPropagation()
	jQuery('.eo_wcfw_filter_icon_select'+selector).trigger('click');
	return false;
}

function reset_slider(e,selector,first,second){	
	e.preventDefault();
	e.stopPropagation()
	jQuery(".ui.slider[data-slug='"+selector+"']").slider('set rangeValue',first,second);
	return false;
}

function reset_price(e,min,max) {
	e.preventDefault();
	e.stopPropagation()
	jQuery(".ui.slider[data-slug='price']").slider('set rangeValue',min,max);
	return false;	
}

function reset_checkbox(e,selector){
	e.preventDefault();
	e.stopPropagation()
	jQuery(selector).filter(":not(:checked)").trigger('click');
	return false;
}

function reset_single_checkbox(e,selector){
	e.preventDefault();
	e.stopPropagation()
	jQuery(selector).filter(":checked").trigger('click');
	return false;
}