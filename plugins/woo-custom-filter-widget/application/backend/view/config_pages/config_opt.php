<?php 
wp_enqueue_script('wp-theme-plugin-editor');
wp_enqueue_style('wp-codemirror');
?>
<script type="text/javascript">
var cm_settings=<?php echo json_encode(array('codeEditor' =>wp_enqueue_code_editor(array('type' => 'text/css')))); ?>;
</script>
<br/>
	<div class="nav-tab-wrapper">
		<a href="#" 
	        class="nav-tab config-opt-tabs nav-tab-active" data-target="#config-opt-tabs-shortcode" onclick="switch_tab(this,'#config-opt-tabs-shortcode')">
	        Create Shortcode
	    </a>
	    <a href="#" 
	        class="nav-tab config-opt-tabs" data-target="#config-opt-tabs-button" onclick="switch_tab(this,'#config-opt-tabs-button')">
	        Button
	    </a>
	    <a href="#" 
	        class="nav-tab config-opt-tabs" data-target="#config-opt-tabs-addcss" onclick="switch_tab(this,'#config-opt-tabs-addcss')">
	        Dropdown
	    </a> 
	    <a href="#" 
	        class="nav-tab config-opt-tabs" data-target="#config-opt-tabs-config" onclick="switch_tab(this,'#config-opt-tabs-config')">
	        Configuration
	    </a>		       		    
	</div>
	
	<script>
		
		function switch_tab(elem,tab){
			jQuery(".config-opt-tabs").removeClass('nav-tab-active');
			jQuery(elem).addClass('nav-tab-active');
			jQuery(".config-opt-tabs-content:not("+tab+")").hide();
			jQuery(tab).show();

			jQuery(tab).find('textarea:not([data-init="1"])').each(function(index,element){
				wp.codeEditor.initialize(jQuery(element), cm_settings);		
				jQuery(element).attr('data-init','1');
			});				
		}

		jQuery(document).ready(function($){
			jQuery(".config-opt-tabs-content:not(#config-opt-tabs-shortcode)").hide();
		});
	</script>
	<style type="text/css">
		 .CodeMirror.cm-s-default.CodeMirror-wrap{
            height: 150px !important;
        }
	</style>

	<?php 
		$config_data=unserialize(get_option('woo_custome_filter_widget_config',"a:0:{}")); 
		$config_data_available=count($config_data)>0?true:false;
	?>

	<div id="config-opt-tabs-shortcode" class="config-opt-tabs-content">
		<br/>
		<h3>Add Filter Field<!-- Shortcode Generator --></h3>
		<form name="filter_form" id="filter_form">
			<table class="form-table">
				<tbody>		
					
					<tr valign="top">
						<th scope="row" class="titledesc">
							<label for="wcfw_shortcode_opt_filter">
								Filter
							</label>
						</th>
						<td class="forminp">
							<select name="wcfw_shortcode_opt_filter" id="wcfw_shortcode_opt_filter" data-type="<?php echo strlen(__categories__())>0?'0':'1'; ?>" data-parent="0"> 
								<optgroup label="Parents - for creating dependency." id="wcfw_shortcode_opt_parent">
									
								</optgroup>
								<optgroup label="Category">
									<?php echo __categories__(); ?>
								</optgroup>
								<optgroup label="Attribute">
									<?php echo __attributes__(); ?>
								</optgroup>
							</select>
							<br/>
							<span class="wcfw_help">( Select category or attribute on which this filter field should do the searching. )</span>
						</td>
					</tr>	

					<tr>
						<th scope="row" class="titledesc">
							<label for="wcfw_shortcode_opt_label">Label</label>
						</th>
						<td class="forminp">
							<input name="wcfw_shortcode_opt_label" id="wcfw_shortcode_opt_label" type="text"> 					
							<br/>
							<span class="wcfw_help">( Label text to display on website for this filter field. )</span>	
						</td>
					</tr>	

					<tr>
						<th scope="row" class="titledesc">
							<label for="wcfw_shortcode_opt_input_type">Input Type</label>
						</th>
						<td class="forminp">
							<select id="wcfw_shortcode_opt_input_type" name="wcfw_shortcode_opt_input_type">
								<option value="icon">Icon Only</option>
			            		<option value="icon_text">Icon and Text</option>
			            		<option value="text_slider">Text slider</option>
			            		<option value="step_slider">Step slider</option>
			            		<option value="checkbox">Checkbox</option>
			                    <option value="dropdown">Dropdown</option>
							</select>
							<br/>
							<span class="wcfw_help">( Select the type of input field that you want to display for e.g. if you select dropdown, a dropdown box will appear on your website. )</span>	
						</td>
					</tr>	

					<tr>
						<th scope="row" class="titledesc">
							<label for="wcfw_shortcode_opt_name">Unique Id</label>
						</th>
						<td class="forminp">
							<input name="wcfw_shortcode_opt_name" id="wcfw_shortcode_opt_name" type="text"> 					
							<br/>
							<span class="wcfw_help">( Specify unique id, useful if you want to create dependant filters please <a href="https://sphereplugins.com/woo-custom-filter-widget/docs/shortcodes-for-filter-widgets/#parent-child-filter">visit doc</a> for more details.<!-- a unique name to form parent-child relationship. --> )</span>	
						</td>
					</tr>			
				</tbody>
			</table>
		</form>

		<input type="submit" name="submit" id="add_filter" class="button button-primary" value="Add Filter">
		<br/>
		<br/>
		<h3>Filter Fields<!-- Available Filters --></h3>
		<table id="filters" class="wp-list-table widefat fixed striped pages">
			<thead>
				<tr>
					<th class="manage-column column-cb">Filter ID</th>
					<th class="manage-column column-cb">Type</th>
					<th class="manage-column column-cb">Label</th>
					<th class="manage-column column-cb">Input</th>
					<th class="manage-column column-cb">Name</th>
					<th class="manage-column column-cb">Parent</th>
					<th class="manage-column column-cb">Remove</th>
				</tr>
			</thead>
			<tbody style="cursor: grabbing;">
				<tr id="no-filter-available">			
					<th style="text-align: center;color: black;" colspan="7">No Filter Available.</th>
				</tr>
			</tbody>	
		</table>
		<br/>
		<h3>Generate Shortcode</h3>
		<input type="submit" name="generate" id="generate_filter" class="button button-primary disabled" value="Generate Shortcode">
		<?php
			wp_enqueue_script('jquery');
			wp_enqueue_script('jquery-ui');
			wp_enqueue_script('jquery-ui-sortable');
		?>
		<script>
			    
			jQuery(document).ready(function($){

				var parents=Array();
				var filters=Array();

				//Action on reorder performed or add/deletion from list
				function reorder_filters(){
					filters=Array();
			        jQuery("#filters tbody>tr").each(function(i,e){
			        	var table_row=Array();
						jQuery(e).find('td').each(function(i,e){						
							table_row.push(jQuery(e).text());
						});					
						filters.push(table_row);
					});				
				}

				//reorderable table action.
				$("#filters tbody").sortable({
				    helper: function(e,tr){
				    	var $originals = tr.children();
					    var $helper = tr.clone();
					    $helper.children().each(function(index) {
					        $(this).width($originals.eq(index).width())
					    });
					    return $helper;
				    },
				    stop: function(e,ui){
				    	$('td.index', ui.item.parent()).each(function (i) {
				            $(this).html(i + 1);
				        });
				    	reorder_filters();
				    }
				}).disableSelection();

				//remove filter action
				$("#filters").on('click','.remove-filter',function(){
					var parent=$(this).parentsUntil('tbody').find("td:eq(4)").text();
					$(this).parentsUntil('tbody').remove();			
					if($("#filters tbody>tr").length<1){
						$("#filters tbody").html('<tr id="no-filter-available"><th style="text-align: center;background-color: #ff000073;color: white;" colspan="7">No Filter Arrayvailable.</th></tr>');	
						
						if(!$("#generate_filter").hasClass('disabled')){
							$("#generate_filter").addClass('disabled');
						}			
					}									
					if(parents.indexOf(parent)){
						parents.pop(parent);
						$("#wcfw_shortcode_opt_parent").find("[value='"+parent+"']").remove();
					}

					reorder_filters();
				});

				//add filter action
				$("#add_filter").click(function(){
					
					var filter=$("#wcfw_shortcode_opt_filter").val();
					console.log(filter);
					var type=$("#wcfw_shortcode_opt_filter").find('[value="'+filter+'"]').data('type');
					console.log(type);
					if(filter.trim().length==0){ alert("Filter field is required!"); return; }

					var label=$("#wcfw_shortcode_opt_label").val();
					if(label.trim().length==0){ alert("Label field is required!"); return; }

					var input=$("#wcfw_shortcode_opt_input_type").val();			
					var name=$("#wcfw_shortcode_opt_name").val();
					if(name.trim().length==0){ alert("Name field is required!"); return; }

					var parent=$("#wcfw_shortcode_opt_filter").find('[value="'+filter+'"]').data('parent');

					if($("#no-filter-available").length){
						$("#no-filter-available").remove();
					}			

					$("#filters tbody").append(
						'<tr>'+
							'<td class="title column-title has-row-actions column-primary">'+filter+'</td>'+
							'<td class="title column-title has-row-actions column-primary">'+(type=='0'?'Category':'Attribute')+'</td>'+
							'<td class="title column-title has-row-actions column-primary">'+label+'</td>'+
							'<td class="title column-title has-row-actions column-primary">'+input+'</td>'+
							'<td class="title column-title has-row-actions column-primary">'+name+'</td>'+
							'<td class="title column-title has-row-actions column-primary">'+(parent=='0'||parent==undefined?'Parent':'Child')+'</td>'+
							'<th><span style="font-size: 2em;cursor: pointer;" class="remove-filter">&times;</span></th>'+
						'</tr>'
					);

					if(type==0){

						if(parents.indexOf(parent)<=0){
							parents.push(parent);
							$("#wcfw_shortcode_opt_parent").append('<option value="'+name+'" data-type="'+type+'" data-parent="1">'+name+'</option>');
						}
					}

					if($("#generate_filter").hasClass('disabled')){
						$("#generate_filter").removeClass('disabled');
					}
					reorder_filters();
					document.filter_form.reset();
				});

				$("#generate_filter").click(function(){
					if(!$(this).hasClass('disabled')){

						var shortcode="[woo_custome_filter_begin]";								
						$.each(filters,function(i,e){
							shortcode+="[woo_custome_filter input='"+e[3]+"' ";
							if(!isNaN(e[0])){
								shortcode+="id='"+e[0]+"' ";
							}
							shortcode+=" label='"+e[2]+"' type='"+(e[1]=='Category'?'0':'1')+"' node_type='"+e[5]+"' "; 
							if(isNaN(e[0])){
								shortcode+="parent_node='"+e[0]+"' ";
							}
							else{
								shortcode+="parent_node='' ";					
							}	
							shortcode+=" node_name='"+e[4]+"']";	
						});				
						shortcode+="[woo_custome_filter_end filter_size='"+$("#filters").find('tbody>tr').length+"']";
						
						$(this).replaceWith("<textarea style='width: 100%;'>"+shortcode+"</textarea>");
					}
				});
			});	
		</script>
	</div>
<form name="woo_custome_filter_configuration" method="post">
	<?php wp_nonce_field('woo_custom_filter-config_opt'); ?>		
	<div id="config-opt-tabs-button" class="config-opt-tabs-content">
		<br/>
		<h3>Submit Button Customization</h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_text">
							Button Text (optional)
						</label>
					</th>
					<td class="forminp">
						<input type="Text" name="wcfw_config_opt_submit_text" id="wcfw_config_opt_submit_text" required="required" value="<?php echo $config_data_available?$config_data['submit_text']:'' ?>"/>				
					</td>
				</tr>	
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_bg_color">
							Background Color
						</label>
					</th>
					<td class="forminp">
						<input type="Color" name="wcfw_config_opt_submit_bg_color" id="wcfw_config_opt_submit_bg_color" value="<?php echo $config_data_available?$config_data['submit_back_color']:'' ?>"/>				
					</td>
				</tr>	
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_border_color">
							Border Color
						</label>
					</th>
					<td class="forminp">
						<input type="Color" name="wcfw_config_opt_submit_border_color" id="wcfw_config_opt_submit_border_color" value="<?php echo $config_data_available?$config_data['submit_border_color']:'' ?>"/>				
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_font_color">
							Font Color
						</label>
					</th>
					<td class="forminp">
						<input type="Color" name="wcfw_config_opt_submit_font_color" id="wcfw_config_opt_submit_font_color" value="<?php echo $config_data_available?$config_data['submit_font_color']:'' ?>"/>				
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_font_size">
							Font Size (optional)
						</label>
					</th>
					<td class="forminp">
						<input type="number" step="1" name="wcfw_config_opt_submit_font_size" id="wcfw_config_opt_submit_font_size" required="required" value="<?php echo $config_data_available?$config_data['submit_font_size']:'14' ?>"/>px
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_padding">
							Padding (optional)
						</label>
					</th>
					<td class="forminp">
						<input type="number" step="1" name="wcfw_config_opt_submit_padding" id="wcfw_config_opt_submit_padding" required="required" value="<?php echo $config_data_available?$config_data['submit_padding']:'5' ?>"/>px
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_inline_css">
							Inline CSS (optional)
						</label>
					</th>
					<td class="forminp">														
						<textarea name="wcfw_config_opt_submit_inline_css" id="wcfw_config_opt_submit_inline_css" data-init="1" style="border: 1px solid #ddd;"><?php echo $config_data_available?$config_data['submit_inline_css']:'' ?></textarea>  
						<script>								 
							jQuery(document).ready(function($) {									
	  							wp.codeEditor.initialize($('#wcfw_config_opt_submit_inline_css'), cm_settings);	
							});
						</script>
					</td>
				</tr>			
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_submit_additional_css">
							Additional CSS (optional)
						</label>
					</th>
					<td class="forminp">														
						<textarea name="wcfw_config_opt_submit_additional_css" id="wcfw_config_opt_submit_additional_css" data-init="1" style="border: 1px solid #ddd;"><?php echo $config_data_available?$config_data['submit_inline_css']:'' ?></textarea>  
						<script>								 
							jQuery(document).ready(function($) {									
	  							wp.codeEditor.initialize($('#wcfw_config_opt_submit_additional_css'), cm_settings);	
							});
						</script>
					</td>
				</tr>					
			</tbody>
		</table>	
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<td><input type="submit" value="Save" class="button button-primary" value="Add Filter"></td>
				</tr>
			</tbody>
		</table>		
	</div>

	<div id="config-opt-tabs-addcss" class="config-opt-tabs-content">
		<br/>
		<h3>Dropdown element Customization</h3>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_dropdown_bg_color">
							Background Color
						</label>
					</th>
					<td class="forminp">
						<input type="Color" name="wcfw_config_opt_dropdown_bg_color" id="wcfw_config_opt_dropdown_bg_color" value="<?php echo $config_data_available?$config_data['dopdown_back_color']:'' ?>" />				
					</td>
				</tr>	
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_dropdown_border_color">
							Border Color
						</label>
					</th>
					<td class="forminp">
						<input type="Color" name="wcfw_config_opt_dropdown_border_color" id="wcfw_config_opt_dropdown_border_color" value="<?php echo $config_data_available?$config_data['dropdown_border_color']:'' ?>" />				
					</td>
				</tr>

				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_dropdown_font_color">
							Font Color
						</label>
					</th>
					<td class="forminp">
						<input type="Color" name="wcfw_config_opt_dropdown_font_color" id="wcfw_config_opt_dropdown_font_color" value="<?php echo $config_data_available?$config_data['dropdown_font_color']:'' ?>"/>				
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_dropdown_font_size">
							Font Size (optional)
						</label>
					</th>
					<td class="forminp">
						<input type="number" step="1" name="wcfw_config_opt_dropdown_font_size" id="wcfw_config_opt_dropdown_font_size" required="required" value="<?php echo $config_data_available?$config_data['dropdown_font_size']:'14' ?>"/>px		
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_dropdown_padding">
							Padding (optional)
						</label>
					</th>
					<td class="forminp">
						<input type="number" step="1" name="wcfw_config_opt_dropdown_padding" id="wcfw_config_opt_dropdown_padding" required="required" value="<?php echo $config_data_available?$config_data['dropdown_padding']:'5' ?>"/>px				
					</td>
				</tr>
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_dropdown_inline_css">
							Inline CSS (optional)
						</label>
					</th>
					<td class="forminp">														
						<textarea name="wcfw_config_opt_dropdown_inline_css" id="wcfw_config_opt_dropdown_inline_css" data-init="0" style="border: 1px solid #ddd;"><?php echo $config_data_available?$config_data['dropdown_inline_css']:'' ?></textarea>  
					</td>
				</tr>			
				<tr valign="top">
					<th scope="row" class="titledesc">
						<label for="wcfw_config_opt_dropdown_additional_css">
							Additional CSS (optional)
						</label>
					</th>
					<td class="forminp">														
						<textarea name="wcfw_config_opt_dropdown_additional_css" id="wcfw_config_opt_dropdown_additional_css" data-init="0" style="border: 1px solid #ddd;"><?php echo $config_data_available?$config_data['dropdown_add_css']:'' ?></textarea>
					</td>
				</tr>
			</tbody>
		</table>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<td><input type="submit" value="Save" class="button button-primary" value="Add Filter"></td>
				</tr>
			</tbody>
		</table>
	</div>				

	<div id="config-opt-tabs-config" class="config-opt-tabs-content">
		<br/>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<tr valign="top">
						<th scope="row" class="titledesc">
							<label for="wcfw_config_opt_submit_url">
								Redirect URL
							</label>
						</th>
						<td class="forminp">
							<input type="URL" name="wcfw_config_opt_submit_url" id="wcfw_config_opt_submit_url" required="required" value="<?php echo $config_data_available?$config_data['submit_url']:get_option('siteurl').'/shop/' ?>"/>
							<p style="color: grey;">( Set the redirect URL to which you want to redirect user after they hit the search button on filter. Default is set to default URL of WooCommerce shop page. )</p>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" class="titledesc">
							<label for="wcfw_config_opt_flexible_filter">
								Not All Required (optional)
							</label>
						</th>
						<td class="forminp">
							<input type="checkbox" name="wcfw_config_opt_flexible_filter" id="wcfw_config_opt_flexible_filter"<?php echo !empty($config_data['flexible_filter'])?'checked="checked"':'' ?>/>
							<p style="color: grey;">( If you want your filter to function only if all the filters are selected then please uncheck this option, by default this option is checked. )</p>
						</td>
					</tr>
				</tr>
			</tbody>
		</table>
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<td><input type="submit" value="Save" class="button button-primary" value="Add Filter"></td>
				</tr>
			</tbody>
		</table>		
	</div>
</form>