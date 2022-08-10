<?php 
class WOO_CUSTOME_FILTER_Widget {
	
	public function enque_asset()
	{		
		$site_url=site_url();

		wp_enqueue_script('jquery');		
		
		$config_data=unserialize(get_option('woo_custome_filter_widget_config',"a:0:{}")); 
		$config_data_available=count($config_data)>0?true:false;
		
		$filter_target_data=unserialize(get_option('woo_custome_filter_target',"a:0:{}"));

		$fg_color=($config_data_available&&!empty($config_data['dropdown_back_color'])?$config_data['dropdown_back_color']:'#357DFD');
		$bg_color=($config_data_available&&!empty($config_data['dropdown_font_color'])?$config_data['dropdown_font_color']:'#357DFD');

		//wp-head here....
		echo "<style>		
				.loading{												
					background-image:url(".plugin_dir_url(__FILE__)."icon/spinner.gif);
					background-color: rgba(255,255,255, 0.6);				    	
					background-position: center center;
					background-repeat: no-repeat;	    				    
				    margin: 0;
				    position:fixed;				    
				    top:0;
				    left:0;				    
				    z-index: 10000;				    				    
				    width: 100%;
				    height: 100%;				
				}			
				.ui.grid.container.mobile.only{
					padding-bottom: 0px !important;
					margin-left: 0px !important;
					margin-right: 0px !important;
					margin-top: 0px !important;
				}
				.ui.styled.fluid.accordion{
					padding:0px !important;
				}
				
				@media only screen and (max-width: 768px) {
					.ui.segments>.ui.segment{
						padding:0px !important;						
					}
				}
				.ui.slider:not(.vertical):not(.checkbox){
					width:auto !important;
					padding: 1em 1em !important;
				}
				.ui.range.slider.text_slider{
					padding-top:0px !important;
				}							
				.ui.tiny.images{
					margin-top: 1em;
				}
				.ui.header{
					z-index: 0 !important;
				}				
				.eo-wcfw-container.filters{
					text-align:left;
				}
				
				/*Modifications............................*/
				#eo_wcfw_filter_table th{
					background-color: {$fg_color} !important;
				}

				.ui.slider .inner .track-fill,.ui.slider .inner .thumb{
					background-color: {$fg_color} !important;	
				}								

				.ui-widget-header{
					border: 1px solid {$fg_color} !important;
				    background: {$bg_color} !important;
				    color: {$fg_color} !important;				    
				}				

				.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
					    border: 1px solid {$fg_color} !important;
					    background: {$bg_color} !important;
				}

				.ui-widget.ui-widget-content{
					 border: 1px solid {$fg_color} !important;
					 background: {$fg_color} !important;
				}
				.eo_wcfw_filter_icon_select{
					border-bottom:2px solid {$fg_color} !important;
				}				
				.eo_wcfw_filter_icon:hover:not(.none_editable){
					border-bottom:2px solid {$fg_color} !important;						
				}
				.ui.button.primary{
					background-color:{$bg_color} !important;
				}								

				.ui.slider .inner .track-fill{
					background-color:{$bg_color} !important;
				}				
				.ui.slider .inner .thumb {
					background-color:{$bg_color} !important;
				}
				
				.eo-wcfw-container.filters .ui.styled.accordion .title,.eo-wcfw-container.filters .ui.header{
					color:{$fg_color} !important;
				}
				.eo-wcfw-container.filters .eo_wcfw_filter_icon,.eo-wcfw-container.filters .slider .label,.eo-wcfw-container.filters input{
					color:{$fg_color} !important;
				}
				.eo_wcfw_filter_icon.ui.image{
					width:fit-content"./*get_option('eo_wcfw_filter_config_icon_size','min-content').*/" !important;
					font-size:0.78571429rem !important;
					cursor:pointer;
				}
				.eo_wcfw_filter_icon.ui.image img{
					width:min-content !important;
					margin:auto auto;
				}
									
				#woo_custome_filter_table th{
					background-color: {$bg_color};
				}
				.ui-widget-header{
					border: 1px solid {$fg_color} !important;
				    background: {$fg_color} !important;
				    color: {$fg_color} !important;				    
				}

				.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default, .ui-button, html .ui-button.ui-state-disabled:hover, html .ui-button.ui-state-disabled:active{
					    border: 1px solid {$fg_color} !important;
					    background: {$fg_color} !important;
				}
				.ui-widget.ui-widget-content{
					 border: 1px solid {$fg_color} !important;
					 background: {$fg_color} !important;
				}
				.woo_custome_filter_icon_select{
					border-bottom:2px solid {$fg_color} !important;
				}
				.woo_custome_filter_icon:hover:not(.none_editable){
					border-bottom:2px solid {$fg_color};						
				}
				".($filter_target_data?$filter_target_data['add_css']:'')."
				.question.circle.outline.icon{
					cursor: pointer;
				}				
				.eo-wbc-container .toggle_sticky_mob_filter{
					margin: 0px;
					/*border: 1px solid ".$fg_color." !important;*/
					text-align: center;
					padding: 1px !important;
    				cursor: pointer;					
				}
				.eo-wbc-container .toggle_sticky_mob_filter .segment{
					border: 1px solid ".$fg_color." !important;
					padding-left: 1px !important;
					padding-right: 1px !important;
				}
				.advance_filter_mob{
					display:none;
				}
				#advance_filter_mob_alternate_container{
					width: 96% !important;
					border-top: 0px solid ".$fg_color." !important;
				}
				.eo-wbc-container .ui.steps .ui.equal.width.grid{
					padding-top:1rem;
					padding-bottom:1rem;
				}

				@media only screen and (max-width: 767.98px){
					.ui.container:not(.fluid){
						margin: auto !important;					
					}
					.ui.grid.container {
						width:100% !important;
					}
				}				
			</style>";		        
	}		

	//Returns minimum value and maximum value of range;
	public function range_min_max($id,$title='',$filter_type=0) {
		
		$field_title='';	
		$field_slug='';
		$min_value=array("id"=>'',"slug"=>'',"name"=>"0","type"=>'');
		$max_value=array("id"=>'',"slug"=>'',"name"=>"0","type"=>'');
		$seprator = '.';
		if ($filter_type) {

			$term=$this->get_attribute($id);

			if(!empty($term) && !is_wp_error($term)){

				$field_title=empty($title)?$term->name:$title;		

				$field_slug=$term->slug;			

				$taxonomies=get_terms(array('taxonomy'=>wc_attribute_taxonomy_name_by_id($term->id),'hide_empty'=>false));

				if(is_wp_error($taxonomies) or empty($taxonomies)){
					$taxonomies=get_terms(wc_attribute_taxonomy_name_by_id($term->id),array('hide_empty'=>false));
				}

				if( is_wp_error($taxonomies) or empty($taxonomies) ) return false;

				$min_value=array("id"=>$taxonomies[0]->term_id,"slug"=>$taxonomies[0]->slug,"name"=>str_replace(',','.',$taxonomies[0]->name),"type"=>'attr');
				$max_value=array("id"=>$taxonomies[0]->term_id,"slug"=>$taxonomies[0]->slug,"name"=>str_replace(',','.',$taxonomies[0]->name),"type"=>'attr');

				foreach ($taxonomies as $taxonomy){
					if(str_replace(',','.',$taxonomy->name) < str_replace(',','.',$min_value['name'])){
						$min_value=array("id"=>$taxonomy->term_id,"slug"=>$taxonomy->slug,"name"=>str_replace(',','.',$taxonomy->name),"type"=>'attr');
						//To markdown if coma is used as seperator of in numeric value.
						if(strpos($taxonomy->name,',')!==false){
							$seprator = ',';
						}
					}

					if(str_replace(',','.',$taxonomy->name) > str_replace(',','.',$max_value['name'])){
						$max_value=array("id"=>$taxonomy->term_id,"slug"=>$taxonomy->slug,"name"=>str_replace(',','.',$taxonomy->name),"type"=>'attr');
						//To markdown if coma is used as seperator of in numeric value.
						if(strpos($taxonomy->name,',')!==false){
							$seprator = ',';
						}
					}				                	  	
	        	}
		        
			} else {
				return false;
			}			
		}		
		else {

			$category=get_term_by('id',$id,'product_cat');

			if(!empty($category) && !is_wp_error($category)){

				$field_title=empty($title)?$category->name:$title;
				$field_slug=$category->slug;

				$sub_categories = get_categories(array(
		            'hierarchical' => 1,
		            'show_option_none' => '',
		            'hide_empty' => false,
		            'parent' => $id,
		            'taxonomy' => 'product_cat'
		        ));

				if( is_wp_error($sub_categories) or empty($sub_categories) ) return false;				

		        $min_value=array("id"=>$sub_categories[0]->term_id,"slug"=>$sub_categories[0]->slug,"name"=>$sub_categories[0]->name,"type"=>'cat');
				$max_value=array("id"=>$sub_categories[0]->term_id,"slug"=>$sub_categories[0]->slug,"name"=>$sub_categories[0]->name,"type"=>'cat');
				
		        foreach ($sub_categories as $sub_category) {

		        	if($sub_category->name < $min_value['name']){
						$min_value=array("id"=>$sub_category->term_id,"slug"=>$sub_category->slug,"name"=>$sub_category->name,"type"=>'cat');
					}

					if($sub_category->name > $max_value['name']){
						$max_value=array("id"=>$sub_category->term_id,"slug"=>$sub_category->slug,"name"=>$sub_category->name,"type"=>'cat');
					}
		        }			
			   
		    } else {
		    	return false;
		    }
		}		
		return array('min_value'=>$min_value,'max_value'=>$max_value,'title'=>$field_title,'slug'=>$field_slug,'seprator'=>$seprator);
	}
	
	public function get_width_class($percent_value = 50){		
		$percent_value = empty($percent_value)? 50 :$percent_value;

		if(empty($this->width_class)){
			$this->width_class = array( '1' =>'one wide column',
										'2' => 'two wide column',
										'3' => 'three wide column',
										'4' => 'four wide column',
										'5' => 'five wide column',
										'6' => 'six wide column',
										'7' => 'seven wide column',
										'8' => 'eight wide column',
										'9' => 'nine wide column',
										'10' => 'ten wide column',
										'11' => 'eleven wide column',
										'12' => 'twelve wide column',
										'13' => 'thirteen wide column',
										'14' => 'fourteen wide column',
										'15' => 'fifteen wide column',
										'16' => 'sixteen wide column',
									 );

		}
		return $this->width_class[($percent_value/(100/16))];
	}

	//Generate text slider/ non-labeled sliders
	public function input_text_slider($id,$title,$filter_type,$desktop=1,$width='50',$reset =  0,$help='',$advance = 0,$prefix='') {		
		$filter=$this->range_min_max($id,$title,$filter_type);			

		if(!$filter){
			$filter = apply_filters('custome_filter_widget_text_slider',array($id,$title,$filter_type,$desktop,$width,$reset));
		}	
		if(!$filter) return false;		

		array_push($this->__filters,array(
										"type"=>"hidden",
										"name"=>"min_".$filter['slug'],
										"id"=>"min_".$filter['slug'],
										"class"=>"text_slider_".$filter['slug'],
										"value"=>$filter['min_value']['name'],
									));

		array_push($this->__filters,array(
									"type"=>"hidden",
									"name"=>"max_".$filter['slug'],
									"id"=>"max_".$filter['slug'],
									"class"=>"text_slider_".$filter['slug'],
									"value"=>$filter['max_value']['name'],
								));
		if($desktop):
			
		?>
		<div class="<?php echo $this->get_width_class($width); ?>">
			<p>
				<span class="ui header"><?php echo $filter['title']; ?></span>
				<?php if($reset): ?>
				&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_slider(event,'<?php echo $filter['slug'] ?>','<?php echo $filter['min_value']['name']; ?>','<?php echo $filter['max_value']['name']; ?>')">&nbsp;<u>reset</u></span>
				<?php endif; ?>
			</p>

			<div class="ui tiny form">
			  <div class="three fields">
			    <div class="field">	      
			      <input value="<?php echo ($filter['seprator']=='.'?$filter['min_value']['name']:str_replace('.',',',$filter['min_value']['name'])).$prefix; ?>" type="text" class="text_slider_<?php echo $filter['slug'] ?> aligned left" name="text_min_<?php echo $filter['slug'] ?>">
			    </div>
			    <div class="field"></div>
			    <div class="field">	      
			      <input value="<?php echo ($filter['seprator']=='.'?$filter['max_value']['name']:str_replace('.',',',$filter['max_value']['name'])).$prefix; ?>" type="text" class="text_slider_<?php echo $filter['slug'] ?> aligned right" name="text_max_<?php echo $filter['slug'] ?>">
			    </div>
			  </div>	  
			</div>			
			<div class="ui range slider text_slider" id="text_slider_<?php echo $filter['slug'] ?>" data-min="<?php echo $filter['min_value']['name']; ?>" data-max="<?php echo $filter['max_value']['name']; ?>" data-slug="<?php echo $filter['slug'] ?>" data-sep="<?php echo $filter['seprator']; ?>" data-postfix="<?php echo $prefix; ?>" data-reset="reset_slider(new Event(''),'<?php echo $filter['slug'] ?>','<?php echo $filter['min_value']['name']; ?>','<?php echo $filter['max_value']['name']; ?>')"></div>
		</div>
		<?php
		elseif(get_option('eo_wbc_alternate_mobile_filters',false)):
		?>			
			<div class="ui four wide column toggle_sticky_mob_filter <?php echo $advance?'advance_filter_mob':'' ?>" style="<?php echo $advance?'display: none;':'' ?>" data-target="#sticky_mob_filter_<?php echo $filter['slug'] ?>">
				<div class="title"><div class="ui segment"><?php echo($filter['title']); ?></div></div>
			</div>
			<div class="bottom_filter_segment hidden ui segment" id="sticky_mob_filter_<?php echo $filter['slug'] ?>">
				<div class="ui equal width grid">
					<div class="column close_sticky_mob_filter" data-target="#sticky_mob_filter_<?php echo $filter['slug'] ?>">
						<i class="ui icon times" style="cursor: pointer;"></i>&nbsp;Close
					</div>
					<div class="column"></div>
					<div class="column"></div>
					<div class="column" style="text-align: right;" onclick="reset_slider(event,'<?php echo $filter['slug'] ?>','<?php echo $filter['min_value']['name']; ?>','<?php echo $filter['max_value']['name']; ?>')">
						<i class="ui icon redo" style="cursor: pointer;"></i>&nbsp;Reset
					</div>
				</div>					
				<br/>
				<div class="ui title">
					<strong><?php echo($filter['title']); ?></strong><?php if(!empty($help)): ?>&nbsp;<i class="question circle outline icon" data-help="<?php echo $help; ?>"></i><?php endif; ?>
				</div><br/>
				<div class="content">	
			  		<div class="ui tiny form">
					  <div class="two fields">
					    <div class="field" style="width: max-content !important;width:-moz-max-content !important;">	      
					      <input value="<?php echo $filter['min_value']['name'].$prefix; ?>" type="text" class="text_slider_<?php echo $filter['slug'] ?> aligned left" name="text_min_<?php echo $filter['slug'] ?>">
					    </div>			    
					    <div class="field" style="position: absolute;right: 0px;width: max-content !important;width:-moz-max-content !important;">
					      <input value="<?php echo $filter['max_value']['name'].$prefix; ?>" type="text" class="text_slider_<?php echo $filter['slug'] ?> aligned right" name="text_max_<?php echo $filter['slug'] ?>" data-reset="reset_slider(new Event('click'),'<?php echo $filter['slug'] ?>','<?php echo $filter['min_value']['name']; ?>','<?php echo $filter['max_value']['name']; ?>')">
					    </div>
					  </div>	  
					</div>	
					<div class="ui range slider text_slider" id="text_slider_<?php echo $filter['slug'] ?>" data-min="<?php echo $filter['min_value']['name']; ?>" data-max="<?php echo $filter['max_value']['name']; ?>" data-slug="<?php echo $filter['slug'] ?>" data-sep="<?php echo $filter['seprator']; ?>" data-postfix="<?php echo $prefix; ?>" data-reset="reset_slider(new Event(''),'<?php echo $filter['slug'] ?>','<?php echo $filter['min_value']['name']; ?>','<?php echo $filter['max_value']['name']; ?>')"></div>			
			  	</div>
			</div>
		<?php
		else:
		?>
		<div class="title">
		    <i class="dropdown icon"></i>		    
		    <?php echo $filter['title']; ?>
		    <?php if($reset): ?>
			&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_slider(event,'<?php echo $filter['slug'] ?>','<?php echo $filter['min_value']['name']; ?>','<?php echo $filter['max_value']['name']; ?>')">&nbsp;<u>reset</u></span>
			<?php endif; ?>
		</div>
	  	<div class="content">	
	  		<div class="ui tiny form">
			  <div class="two fields">
			    <div class="field" style="width: fit-content !important;">	      
			      <input value="<?php echo $filter['min_value']['name'].$prefix; ?>" type="text" class="text_slider_<?php echo $filter['slug'] ?> aligned left" name="text_min_<?php echo $filter['slug'] ?>">
			    </div>			    
			    <div class="field" style="position: absolute;right: 0px;width: fit-content !important;">
			      <input value="<?php echo $filter['max_value']['name'].$prefix; ?>" type="text" class="text_slider_<?php echo $filter['slug'] ?> aligned right" name="text_max_<?php echo $filter['slug'] ?>">
			    </div>
			  </div>	  
			</div>				    
	  		<div class="ui range slider text_slider" id="text_slider_<?php echo $filter['slug'] ?>" data-min="<?php echo $filter['min_value']['name']; ?>" data-max="<?php echo $filter['max_value']['name']; ?>" data-slug="<?php echo $filter['slug'] ?>" data-postfix="<?php echo $prefix; ?>" data-reset="reset_slider(new Event(''),'<?php echo $filter['slug'] ?>','<?php echo $filter['min_value']['name']; ?>','<?php echo $filter['max_value']['name']; ?>')"></div>
	  	</div>		
		<?php
		endif;
	}

	//Returns all values in range;
	//@input : filter_type - wether it is category filter or term filter;
	public function range_steps($id,$title='',$filter_type=0) {

		$list=array();		
		$field_title='';	
		$field_slug='';

		if ($filter_type) {
			
			$term=$this->get_attribute($id);			

			if(!empty($term) && !is_wp_error($term)) {

				$field_title=empty($title)?$term->name:$title;
				$field_slug=$term->slug;

				$taxonomies=get_terms(array('taxonomy'=>wc_attribute_taxonomy_name_by_id($term->id),'hide_empty'=>false));

				if(is_wp_error($taxonomies)){

					$taxonomies=get_terms(wc_attribute_taxonomy_name_by_id($term->id),array('hide_empty'=>false));
				}

				if(is_wp_error($taxonomies) or empty($taxonomies)) return false;

				foreach ($taxonomies as $taxonomy){
					
					$list[]=array("id"=>$taxonomy->term_id,"slug"=>$taxonomy->slug,"name"=>$taxonomy->name,"type"=>'attr');                	  	
	        	}

	        } else {

	        	return false;
	        }
		}		
		else {

			$category=get_term_by('id',$id,'product_cat');
			
			if(!empty($category) && !is_wp_error($category)) {

				$field_title=empty($title)?$category->name:$title;
				$field_slug=$category->slug;

				$sub_categories = get_categories(array(
		            'hierarchical' => 1,
		            'show_option_none' => '',
		            'hide_empty' => false,
		            'parent' => $id,
		            'taxonomy' => 'product_cat'
		        ));

				if(is_wp_error($sub_categories) or empty($sub_categories)) return false;

		        foreach ($sub_categories as $sub_category) {
		        	$list[]=array("id"=>$sub_category->term_id,"slug"=>$sub_category->slug,"name"=>$sub_category->name,"type"=>'cat');
		        }

		    } else {

	        	return false;
	        }	
		}		

		return array('list'=>$list,'title'=>$field_title,'slug'=>$field_slug);			
	}

	//Generate step slider;
	public function input_step_slider($id,$title,$filter_type,$desktop=1,$width='50',$reset = 0,$help='',$advance = 0) {		

		$filter=$this->range_steps($id,$title,$filter_type);
		if(empty($filter)) return false;
		
		$items_name=$this->array_column($filter['list'],'name');			
		$items_slug=$this->array_column($filter['list'],'slug');

		array_push($this->__filters,array(
										"type"=>"hidden",
										"name"=>"min_".$filter['slug'],
										"id"=>'min_'.$filter['slug'],
										"class"=>"step_slider_".$filter['slug'],
										"value"=>$items_slug[0],
									));

		array_push($this->__filters,array(
									"type"=>"hidden",
									"name"=>"max_".$filter['slug'],
									"id"=>"max_".$filter['slug'],
									"class"=>"step_slider_".$filter['slug'],
									"value"=>$items_slug[count($items_slug)-1],
								));	
		if($desktop):

			
		?>
		<div class="<?php echo $this->get_width_class($width); ?>">
			<p>
				<span class="ui header"><?php echo $filter['title']; ?></span>
				<?php if($reset): ?>
				&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_slider(event,'<?php echo $filter['slug'] ?>',0,<?php echo count(array_filter($items_slug)); ?>)">&nbsp;<u>reset</u></span>
				<?php endif; ?>
			</p>

			<div class="ui labeled ticked range slider" id="text_slider_<?php echo $filter['slug'] ?>" data-slug="<?php echo $filter['slug'] ?>" data-labels="<?php echo(implode(",", $items_name)); ?>" data-slugs="<?php echo(implode(",", $items_slug)); ?>" style="bottom: -12.5%;" data-reset="reset_slider(new Event(''),'<?php echo $filter['slug'] ?>',0,<?php echo count(array_filter($items_slug)); ?>)"></div>
		</div>
		<?php
		elseif(get_option('eo_wbc_alternate_mobile_filters',false)):
		?>			
			<div class="ui four wide column toggle_sticky_mob_filter <?php echo $advance?'advance_filter_mob':'' ?>" style="<?php echo $advance?'display: none;':'' ?>" data-target="#sticky_mob_filter_<?php echo $filter['slug'] ?>">
				<div class="title"><div class="ui segment"><?php echo($filter['title']); ?></div></div>
			</div>
			<div class="bottom_filter_segment hidden ui segment" id="sticky_mob_filter_<?php echo $filter['slug'] ?>">
				<div class="ui equal width grid">
					<div class="column close_sticky_mob_filter" data-target="#sticky_mob_filter_<?php echo $filter['slug'] ?>">
						<i class="ui icon times" style="cursor: pointer;"></i>&nbsp;Close
					</div>
					<div class="column"></div>
					<div class="column"></div>
					<div class="column" style="text-align: right;" onclick="reset_slider(event,'<?php echo $filter['slug'] ?>',0,<?php echo count(array_filter($items_slug)); ?>)">						
						<i class="ui icon redo" style="cursor: pointer;"></i>&nbsp;Reset
					</div>
				</div>					
				<br/>
				<div class="ui title">
					<strong><?php echo($filter['title']); ?></strong><?php if(!empty($help)): ?>&nbsp;<i class="question circle outline icon" data-help="<?php echo $help; ?>"></i><?php endif; ?>
				</div><br/>
				<div class="ui labeled ticked range slider" id="text_slider_<?php echo $filter['slug'] ?>" data-slug="<?php echo $filter['slug'] ?>" data-labels="<?php echo(implode(",", $items_name)); ?>" data-slugs="<?php echo(implode(",", $items_slug)); ?>" style="bottom: -12.5%;" data-reset="reset_slider(new Event('click'),'<?php echo $filter['slug'] ?>',0,<?php echo count(array_filter($items_slug)); ?>)" data-reset="reset_slider(new Event(''),'<?php echo $filter['slug'] ?>',0,<?php echo count(array_filter($items_slug)); ?>)"></div>
			</div>
		<?php
		else:
		?>
		<div class="title">
		    <i class="dropdown icon"></i>		    
		    <?php echo $filter['title']; ?>
		    <?php if($reset): ?>
			&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_slider(event,'<?php echo $filter['slug'] ?>',0,<?php echo count(array_filter($items_slug)); ?>)">&nbsp;<u>reset</u></span>
			<?php endif; ?>
		</div>
	  	<div class="content">		    
	  		<div class="ui labeled ticked range slider" id="text_slider_<?php echo $filter['slug'] ?>" data-slug="<?php echo $filter['slug'] ?>" data-labels="<?php echo(implode(",", $items_name)); ?>" data-slugs="<?php echo(implode(",", $items_slug)); ?>" style="bottom: -12.5%;" data-reset="reset_slider(new Event(''),'<?php echo $filter['slug'] ?>',0,<?php echo count(array_filter($items_slug)); ?>)"></div>
	  	</div>		
		<?php
		endif;
	}

	//Generate checkbox based filter option;
	public function input_checkbox($id,$title,$filter_type,$desktop = 1, $width = '50',$reset = 0,$help='',$advance = 0) {
		$filter=$this->range_steps($id,$title,$filter_type);
		if(empty($filter)) return false;

		array_push($this->__filters,array(
										"type"=>"hidden",
										"name"=>"checklist_".$filter['slug'],
										"id"=>"checklist_".$filter['slug'],
										"class"=>"",
									"value"=>implode(',',$this->array_column($filter['list'],'slug')),
									));
		if($desktop):					
		?>
		<div class="<?php echo $this->get_width_class($width); ?>">
			<p>
				<span class="ui header"><?php echo($filter['title']); ?></span> 
				<?php if($reset): ?>
				&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_checkbox(event,'.checklist_<?php echo $filter['slug'] ?>')">&nbsp;<u>reset</u></span>
				<?php endif; ?>
			</p>
			<div class="ui tiny form">
				<?php foreach ($filter['list'] as $term) : ?>
					<div class="ui checkbox checked">
						<input type="checkbox" checked="checked" tabindex="0" class="hidden checklist_<?php echo $filter['slug'] ?>" id='check_<?php echo $term['slug']; ?>' data-slug="<?php echo $term['slug']; ?>" data-label="<?php echo $term['name']; ?>" data-filter-slug="<?php echo $filter['slug']; ?>" data-reset="reset_single_checkbox(new Event(''),'[id=\'check_<?php echo $term['slug']; ?>\'][data-slug=\'<?php echo $term['slug']; ?>\']')">
				        <label><?php echo $term['name']; ?></label>
				    </div>&nbsp;&nbsp;						
    			<?php endforeach; ?>
    		</div>			
		</div>
		<?php
		elseif(get_option('eo_wbc_alternate_mobile_filters',false)):
		?>			
			<div class="ui four wide column toggle_sticky_mob_filter <?php echo $advance?'advance_filter_mob':'' ?>"  style="<?php echo $advance?'display: none;':'' ?>" data-target="#sticky_mob_filter_<?php echo $filter['slug']; ?>">
				<div class="title"><div class="ui segment">
					<?php echo($filter['title']); ?></div>
				</div>
			</div>
			<div class="bottom_filter_segment hidden ui segment" id="sticky_mob_filter_<?php echo $filter['slug']; ?>">
					<div class="ui equal width grid">
							<div class="column close_sticky_mob_filter" data-target="#sticky_mob_filter_<?php echo $filter['slug']; ?>">
								<i class="ui icon times" style="cursor: pointer;"></i>&nbsp;Close
							</div>
							<div class="column"></div>
							<div class="column"></div>
							<div class="column" style="text-align: right;" onclick="reset_checkbox(event,'.checklist_<?php echo $filter['slug']; ?>')">
								<i class="ui icon redo" style="cursor: pointer;"></i>&nbsp;Reset
							</div>
					</div>					
				<br/>
				<div class="ui title">
					<strong><?php echo($filter['title']); ?></strong><?php if(!empty($help)): ?>&nbsp;<i class="question circle outline icon" data-help="<?php echo $help; ?>"></i><?php endif; ?>
				</div><br/>
				<div class="content">	
			  		<div class="ui tiny form" data-reset="reset_checkbox(new Event('click'),'.checklist_<?php echo $filter['slug'] ?>')">
					  	<?php foreach ($filter['list'] as $term) : ?>
							<div class="ui checkbox checked">
								<input type="checkbox" checked="checked" tabindex="0" class="hidden checklist_<?php echo $filter['slug'] ?>" id='check_<?php echo $term['slug']; ?>' data-slug="<?php echo $term['slug']; ?>" data-label="<?php echo $term['name']; ?>" data-filter-slug="<?php echo $filter['slug']; ?>" data-reset="reset_single_checkbox(new Event(''),'[id=\'check_<?php echo $term['slug']; ?>\'][data-slug=\'<?php echo $term['slug']; ?>\']')">
						        <label><?php echo $term['name']; ?></label>
						    </div>						
		    			<?php endforeach; ?>  
					</div>				    	  	
			  	</div>	
			</div>			
		<?php
		else:
		?>
		<div class="title">
		    <i class="dropdown icon"></i>		    
		    <?php echo($filter['title']); ?>
		    <?php if($reset): ?>
			&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_checkbox(event,'.checklist_<?php echo $filter['slug'] ?>')">&nbsp;<u>reset</u></span>	
			<?php endif; ?>
		</div>
	  	<div class="content">	
	  		<div class="ui tiny form">
			  	<?php foreach ($filter['list'] as $term) : ?>
					<div class="ui checkbox checked">
						<input type="checkbox" checked="checked" tabindex="0" class="hidden checklist_<?php echo $filter['slug'] ?>" id='check_<?php echo $term['slug']; ?>' data-slug="<?php echo $term['slug']; ?>" data-label="<?php echo $term['name']; ?>" data-filter-slug="<?php echo $filter['slug']; ?>" data-reset="reset_single_checkbox(new Event(''),'[id=\'check_<?php echo $term['slug']; ?>\'][data-slug=\'<?php echo $term['slug']; ?>\']')">
				        <label><?php echo $term['name']; ?></label>
				    </div>						
    			<?php endforeach; ?>  
			</div>				    	  	
	  	</div>		
		<?php
		endif;
	}

	private function slider_price($desktop=1,$width='50', $reset = 1,$help='') {

		$prices = $this->get_filtered_price();
		$min    = floor( $prices->min_price );
		$max    = ceil( $prices->max_price );

		array_push($this->__filters,array(
										"type"=>"hidden",
										"name"=>"min_price",
										"id"=>"min_price",
										"class"=>"text_slider_price",
										"value"=>$min,
									));

		array_push($this->__filters,array(
									"type"=>"hidden",
									"name"=>"max_price",
									"id"=>"max_price",
									"class"=>"text_slider_price",
									"value"=>$max,
								));
		
		if($desktop):
			
		?>
		<div class="<?php echo $this->get_width_class($width); ?>">
			<p>
				<span class="ui header">Price</span>				
				<?php if($reset): ?>
				&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_price(event,'<?php echo $min; ?>','<?php echo $max; ?>')">&nbsp;<u>reset</u></span>
				<?php endif; ?>
			</p>			
			<div class="ui tiny form">
			  <div class="three fields">
			    <div class="field">	      
			      <input value="<?php echo $min; ?>" type="text" class="text_slider_price aligned left" name="text_min_price">
			    </div>
			    <div class="field"></div>
			    <div class="field">	      
			      <input value="<?php echo $max; ?>" type="text" class="text_slider_price aligned right" name="text_max_price">
			    </div>
			  </div>	  
			</div>			
			<div class="ui range slider text_slider" id="text_slider_price" data-min="<?php echo $min; ?>" data-max="<?php echo $max; ?>" data-slug="price" data-sep="." data-reset="reset_price(new Event(''),'<?php echo $min; ?>','<?php echo $max; ?>')"></div>
		</div>
		<?php
		elseif(get_option('eo_wbc_alternate_mobile_filters',false)):
		?>			
			<div class="ui four wide column toggle_sticky_mob_filter" style="<?php echo $advance?'display: none;':'' ?>" data-target="#sticky_mob_filter_price">
				<div class="title"><div class="ui segment">Price</div></div>
			</div>
			<div class="bottom_filter_segment hidden ui segment" id="sticky_mob_filter_price">
				<div class="ui equal width grid">
					<div class="column close_sticky_mob_filter" data-target="#sticky_mob_filter_price">
						<i class="ui icon times" style="cursor: pointer;"></i>&nbsp;Close
					</div>
					<div class="column"></div>
					<div class="column"></div>
					<div class="column" style="text-align: right;" onclick="reset_price(event,'<?php echo $min; ?>','<?php echo $max; ?>')">
						<i class="ui icon redo" style="cursor: pointer;"></i>&nbsp;Reset
					</div>
				</div>					
				<br/>
				<div class="ui title">
					<strong>Price</strong><?php if(!empty($help)): ?>&nbsp;<i class="question circle outline icon" data-help="<?php echo $help; ?>"></i><?php endif; ?>
				</div><br/>
				<div class="content">	
			  		<div class="ui tiny form">
					  <div class="two fields">
					    <div class="field" style="width: max-content !important;width:-moz-max-content !important;">
					      	<input value="<?php echo get_woocommerce_currency().get_woocommerce_currency_symbol().$min; ?>" type="text" class="text_slider_price aligned left" name="text_min_price">
					    </div>			    
					    <div class="field" style="position: absolute;right: 0px;width: max-content !important;width:-moz-max-content !important;">
					     	<input value="<?php echo get_woocommerce_currency().get_woocommerce_currency_symbol().$max; ?>" type="text" class="text_slider_price aligned right" name="text_max_price"> 
					    </div>
					  </div>	  
					</div>				    
			  		<div class="ui range slider text_slider" id="text_slider_price" data-min="<?php echo $min; ?>" data-max="<?php echo $max; ?>" data-slug="price" data-prefix="<?php echo get_woocommerce_currency().get_woocommerce_currency_symbol(); ?>" data-reset="reset_price(new Event('click'),'<?php echo $min; ?>','<?php echo $max; ?>')" data-sep="." data-reset="reset_price(new Event(''),'<?php echo $min; ?>','<?php echo $max; ?>')"></div>
			  	</div>
			</div>
		<?php
		else:
		?>
		<div class="title">
		    <i class="dropdown icon"></i>		    
		    Price		    
			<?php if($reset): ?>
			&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_price(event,'<?php echo $min; ?>','<?php echo $max; ?>')">&nbsp;<u>reset</u></span>
			<?php endif; ?>
		</div>
	  	<div class="content">	
	  		<div class="ui tiny form">
			  <div class="two fields">
			    <div class="field" style="width: fit-content !important;">
			      	<input value="<?php echo $min; ?>" type="text" class="text_slider_price aligned left" name="text_min_price">
			    </div>			    
			    <div class="field" style="position: absolute;right: 0px;width: fit-content !important;">
			     	<input value="<?php echo $max; ?>" type="text" class="text_slider_price aligned right" name="text_max_price"> 
			    </div>
			  </div>	  
			</div>				    
	  		<div class="ui range slider text_slider" id="text_slider_price" data-min="<?php echo $min; ?>" data-max="<?php echo $max; ?>" data-slug="price" data-sep="." data-reset="reset_price(new Event(''),'<?php echo $min; ?>','<?php echo $max; ?>')"></div>
	  	</div>		
		<?php
		endif;			
	}
	
	public function load_mobile($general_filters, $advance_filters) {
		
		if(get_option('eo_wbc_alternate_mobile_filters',false)){
			$this->load_grid_mobile($general_filters);
			$this->slider_price(0);
			if(!is_wp_error($advance_filters) and !empty($advance_filters)) {
				$this->load_grid_mobile($advance_filters,1);
			}
		} else {
			?><div class="ui segment"><?php
				?><div class="ui styled fluid accordion" style="border-top-left-radius: 0px !important; border-top-right-radius: 0px !important;"><?php
					$this->load_grid_mobile($general_filters);
					$this->slider_price(0);
				?></div><?php
			?></div><?php
			if(!is_wp_error($advance_filters) and !empty($advance_filters)) {
				?><div class="ui segment secondary"><?php
					?><div class="ui styled fluid accordion" style="border-top-left-radius: 0px !important; border-top-right-radius: 0px !important;"><?php
						$this->load_grid_mobile($advance_filters);					
					?></div><?php
				?></div><?php
			}
		}
	}

	public function load_grid_mobile($filter,$advance=0) {
		foreach ($filter as $key => $item) {
			if($item['type']==0 && ($item['input']=='icon' OR $item['input']=='icon_text')) {

				$this->eo_wcfw_filter_ui_icon($item['name'],$item['label'],$item['type'],$item['input'],0,$item['column_width'],(isset($item['icon_size'])?$item['icon_size']:false),(isset($item['font_size'])?$item['font_size']:false),0,(isset($item['child_label'])?$item['child_label']:false),(isset($item['popup'])?$item['popup']:false),$advance);								
				$term = @get_term_by('id',$item['name'],'product_cat');
				if(!empty($term) and !is_wp_error($term)){
					$this->___category[]=$term->slug;	
				}				
			}
			elseif ($item['type']==0 ) {

				$this->input_step_slider($item['name'],$item['label'],$item['type'],0,$item['column_width'],0,(isset($item['popup'])?$item['popup']:false),$advance);		
			}
			elseif($item['type']==1 ) {				
				switch ($item['input']) {
					case 'icon':
					case 'icon_text':												
						$this->eo_wcfw_filter_ui_icon($item['name'],$item['label'],$item['type'],$item['input'],0,$item['column_width'],(isset($item['icon_size'])?$item['icon_size']:false),(isset($item['font_size'])?$item['font_size']:false),(isset($item['child_label'])?$item['child_label']:false),0,(isset($item['popup'])?$item['popup']:false),$advance);
						break;
					case 'numeric_slider':					
						$this->input_text_slider($item['name'],$item['label'],$item['type'],0,$item['column_width'],0,(isset($item['popup'])?$item['popup']:false),$advance,(isset($item['text_slider_prefix'])?$item['text_slider_prefix']:false));
						break;
					case 'text_slider':
						$this->input_step_slider($item['name'],$item['label'],$item['type'],0,$item['column_width'],0,(isset($item['popup'])?$item['popup']:false),$advance);
						break;
					case 'checkbox':
						$this->input_checkbox($item['name'],$item['label'],$item['type'],0,$item['column_width'],0,(isset($item['popup'])?$item['popup']:false),$advance);
						break;						
					default:
						$this->input_step_slider($item['name'],$item['label'],$item['type'],0,$item['column_width'],0,(isset($item['popup'])?$item['popup']:false),$advance);
				}
				$term=$this->get_attribute($item['name']);
				if(!empty($term) and !is_wp_error( $term )){
					$_attr_list[]=$term->slug;	
				}				
			}
		}
	}

	public function load_desktop($general_filters, $advance_filters) {
		
		
			?>
			<div class="eo-wcfw-container filters container">
				<?php
					$filter_target_data=unserialize(get_option('woo_custome_filter_target',"a:0:{}"));
					if(!empty($filter_target_data) and is_array($filter_target_data) and !empty($filter_target_data['show_tab'])){
						?>
						<div class="ui tabular menu " style="margin-top: 3em;">
					      <a class="item center active" data-category="<?php echo get_term_by('id',$filter_target_data['tab_first_cat'],'product_cat')->slug; ?>" style="margin-right: 0px !important;">
					        <?php echo empty($filter_target_data['tab_first_label'])?'':$filter_target_data['tab_first_label'] ?>
					      </a>

					      <a class="center item" data-category="<?php echo get_term_by('id',$filter_target_data['tab_second_cat'],'product_cat')->slug; ?>" style="margin-left: 0px !important;">
					        <?php echo empty($filter_target_data['tab_second_label'])?'':$filter_target_data['tab_second_label'] ?>
					      </a>					      
					    </div>					   
						<?php
						$this->tab_switch_category = get_term_by('id',$filter_target_data['tab_first_cat'],'product_cat')->slug;
						$this->___category[] = 'tab_switch_category';
					}
				?>
				<div class="ui segments">
					<div class="ui segment"><?php
					?><div class="ui grid container align middle relaxed"><?php
						$this->load_grid_desktop($general_filters,0);
						$this->slider_price();
					?></div><?php
				?></div><?php
				if(!is_wp_error($advance_filters) and !empty($advance_filters)){
					?><div class="ui segment secondary"><?php
						?><div class="ui grid container align middle relaxed"><?php					
							$this->load_grid_desktop($advance_filters,1);					
						?></div><?php
					?></div><?php
				}			
			?>
				</div>
			</div>
			<?php if( !empty($advance_filters) ) { ?>
				<div class="ui grid centered">
					<div class="row">
						<div class="ui button primary" id="advance_filter" style="border-radius: 0 0 0 0;width: fit-content !important;">Advance Filter&nbsp;<i class="ui icon angle double up"></i></div>
					</div>
				</div>
			<?php			
			}		
	}

	public function load_grid_desktop($filters,$advance) {

		if(!empty($filters) && (is_array($filters) or is_object($filters) ) ){
			foreach ($filters as $key => $item) {				
				if($item['type']==0 && ($item['input']=='icon' OR $item['input']=='icon_text')) {

					$this->eo_wcfw_filter_ui_icon($item['name'],$item['label'],$item['type'],$item['input'],1,$item['column_width'],(isset($item['icon_size'])?$item['icon_size']:false),(isset($item['font_size'])?$item['font_size']:false),$reset=!empty($item['reset']),(isset($item['child_label'])?$item['child_label']:false));							
									
						$term = get_term_by('id',$item['name'],'product_cat');

						if( !empty( $term ) and !is_wp_error( $term ) ) {
							$this->___category[] = $term->slug;
						}
				} elseif ($item['type']==0 ) {

					$this->input_step_slider($item['name'],$item['label'],$item['type'],1,$item['column_width'],$reset=!empty($item['reset']));		
				}
				elseif($item['type']==1 ) {
					switch ($item['input']) {
						case 'icon':
						case 'icon_text':												
							$this->eo_wcfw_filter_ui_icon($item['name'],$item['label'],$item['type'],$item['input'],1,$item['column_width'],(isset($item['icon_size'])?$item['icon_size']:false),(isset($item['font_size'])?$item['font_size']:false),$reset=!empty($item['reset']),(isset($item['child_label'])?$item['child_label']:false));				
							break;
						case 'numeric_slider':
						
							$this->input_text_slider($item['name'],$item['label'],$item['type'],1,$item['column_width'],$reset=!empty($item['reset']),(isset($item['popup'])?$item['popup']:false),$advance,(isset($item['text_slider_prefix'])?$item['text_slider_prefix']:false));
							break;
						case 'text_slider':
							$this->input_step_slider($item['name'],$item['label'],$item['type'],1,$item['column_width'],$reset=!empty($item['reset']));
							break;
						case 'checkbox':
							$this->input_checkbox($item['name'],$item['label'],$item['type'],1,$item['column_width'],$reset=!empty($item['reset']));
							break;						
						default:
							$this->input_step_slider($item['name'],$item['label'],$item['type'],1,$item['column_width'],$reset=!empty($item['reset']));
					}		
					$term = $this->get_attribute($item['name']);		
					if(!empty($term) and !is_wp_error($term) ){
						$_attr_list[]=$term->slug;	
					}			
				}
			}
		}		
	}

	public function load_collapsable_desktop($general_filters, $advance_filters) {
		
		$filters = array_merge($general_filters,$advance_filters);

		if(!is_wp_error($filters) and !empty($filters)){
			?><div class="ui text menu"><?php	
			foreach ($filters as $item_index=>$item) {
				
 				$term = null;
				if($item['type']==0){
					$term = get_term_by('id',$item['name'],'product_cat');
				} else {
					$term = $this->get_attribute($item['name']);
				}				
				?>				
				
				<a class="ui dropdown item">
					<?php echo $term->name; ?>
					&nbsp;<i class="chevron down icon"></i>
					<div class="menu">
						<div class="item" style="width: max-content !important;min-width: 33vw;display: table-cell;">
				
				    <?php 
				      	if($item['type']==0 && ($item['input']=='icon' OR $item['input']=='icon_text')) {

							$this->eo_wcfw_filter_ui_icon($item['name'],$item['label'],$item['type'],$item['input'],1,100,(isset($item['icon_size'])?$item['icon_size']:false),(isset($item['font_size'])?$item['font_size']:false),$reset=!empty($item['reset']),(isset($item['child_label'])?$item['child_label']:false));							
											
								$term = get_term_by('id',$item['name'],'product_cat');

								if( !empty( $term ) and !is_wp_error( $term ) ) {
									$this->___category[] = $term->slug;
								}
						} elseif ($item['type']==0 ) {

							$this->input_step_slider($item['name'],$item['label'],$item['type'],1,100,$reset=!empty($item['reset']));		
						}
						elseif($item['type']==1 ) {
							switch ($item['input']) {
								case 'icon':
								case 'icon_text':												
									$this->eo_wcfw_filter_ui_icon($item['name'],$item['label'],$item['type'],$item['input'],1,100,(isset($item['icon_size'])?$item['icon_size']:false),(isset($item['font_size'])?$item['font_size']:false),$reset=!empty($item['reset']),(isset($item['child_label'])?$item['child_label']:false));				
									break;
								case 'numeric_slider':
									$this->input_text_slider($item['name'],$item['label'],$item['type'],1,100,$reset=!empty($item['reset']),(isset($item['popup'])?$item['popup']:false),0,(isset($item['text_slider_prefix'])?$item['text_slider_prefix']:false));
									break;
								case 'text_slider':
									$this->input_step_slider($item['name'],$item['label'],$item['type'],1,100,$reset=!empty($item['reset']));
									break;
								case 'checkbox':
									$this->input_checkbox($item['name'],$item['label'],$item['type'],1,100,$reset=!empty($item['reset']));
									break;						
								default:
									$this->input_step_slider($item['name'],$item['label'],$item['type'],1,100,$reset=!empty($item['reset']));
							}		
							$term = $this->get_attribute($item['name']);		
							if(!empty($term) and !is_wp_error($term) ){
								$_attr_list[]=$term->slug;	
							}			
						}
				    ?>				
						</div>
					</div>
				</a>	
				<?php				
			}
			?><a class="ui dropdown item">Price&nbsp;<i class="chevron down icon"></i>
				<div class="menu">
					<div class="item" style="width: max-content !important;min-width: 33vw;max-width: 33vw;display: table-cell;">				
						<?php $this->slider_price(); ?>
					</div>
				</div>
			</a>
			<?php
			?></div><?php			
		}
		?>
			<script type="text/javascript">
				jQuery(document).ready(function(){	
					jQuery(".dropdown").dropdown({
						keepOnScreen:true,
						on:'hover',
						onShow:function(){
							toggle_ = jQuery(this).find('.icon');
							jQuery(toggle_).removeClass('down');
							jQuery(toggle_).addClass('up');
						},
						onHide:function(){
							toggle_ = jQuery(this).find('.icon');
							jQuery(toggle_).removeClass('up');
							jQuery(toggle_).addClass('down');
						}
					});				
				});
			</script>
		<?php
		
	}

	public function get_widget() {

		
		$filter=unserialize(get_option('woo_custome_filter_widget',"a:0:{}"));
		
		//Hidden input filter lists.
		$this->__filters=array();
		//Advance filters count
		$advance_count=0;		
		//Category Filters
		$this->___category=array();
		//Attribute Filters
		$_attr_list=array();

		$non_adv_ordered_filter=array();
		$adv_ordered_filter=array();

		if(!(is_array($filter) xor is_object($filter)) or empty($filter)) return false;

		foreach ($filter as $key => $item) {

			if($item['advance']==0){
				$item['order']= ( empty($item['order'])?(-1*count($non_adv_ordered_filter)):$item['order']);
				
				$item['column_width']= ( empty($item['column_width']) ? '50' : $item['column_width'] );

				$non_adv_ordered_filter[$item['order']]=$item;				
			}
			else{
				$item['order']= ( empty($item['order'])?(-1*count($adv_ordered_filter)):$item['order']);

				$item['column_width']= ( empty($item['column_width']) ? '50' : $item['column_width'] );

				$adv_ordered_filter[$item['order']]=$item;
			}
		}		
		ksort($non_adv_ordered_filter);
		ksort($adv_ordered_filter);
		$non_adv_ordered_filter = apply_filters('custome_filter_widget_non_advance_filter',$non_adv_ordered_filter);
		/*$non_adv_ordered_filter[] =  Array
        (
            'name' => 'price_per_caret',
            'type' => 1,
            'label' => 'Price per caret',
            'advance' => 0,
            'dependent' => 0,
            'input' => 'numeric_slider',
            'column_width' => 50,
            'order' => 2,
        );*/

		?>
		<!--Primary filter button that will only be visible on desktop/tablet-->
		<!-- This widget is created with Wordpress plugin - WooCommerce Product bundle choice -->
		<div id="loading"></div>
		    							
		<?php 
			if(wp_is_mobile()) {

				if(get_option('eo_wbc_alternate_mobile_filters',false)){

					?>
						<div class="eo-wbc-container filters ui grid container">							
						<?php $this->load_mobile($non_adv_ordered_filter, $adv_ordered_filter); ?>		
						</div>						
					<?php	
					if(!is_wp_error($adv_ordered_filter) and !empty($adv_ordered_filter)) {
						?>
						<div class="ui grid centered container" id="advance_filter_mob_alternate_container">
							<div class="row" style="padding: 0px;">
								<div class="ui button primary" id="advance_filter_mob_alternate" style="border-radius: 0 0 0 0;width: fit-content !important;">Advance Filter&nbsp;<i class="ui icon angle double down"></i></div>
							</div>
						</div>
						<?php
					}			

				} else {

					
					if(!is_wp_error($non_adv_ordered_filter) and !empty($non_adv_ordered_filter)) {

					?>
						<div class="ui grid container centered" style="margin-left: 0 !important; margin-right: 0 !important">
							<div class="row">
								<div class="ui button primary fluid" id="primary_filter" style="border-radius: 0 0 0 0;margin-right: 0;">Filters&nbsp;&nbsp;<i class="ui icon angle up"></i></div>
							</div>
						</div>
					<?php

					}				
					?>
						<div class="eo-wcfw-container filters container">
							<div class="ui segments">    			
					<?php
					$this->load_mobile($non_adv_ordered_filter, $adv_ordered_filter);
					?>		</div>
						</div>
					<?php

					if( !empty($adv_ordered_filter) ) {
						?>
						<div class="ui grid centered">
							<div class="row">
								<div class="ui button primary" id="advance_filter" style="border-radius: 0 0 0 0;width: fit-content !important;">Advance Filter&nbsp;<i class="ui icon angle double up"></i></div>
							</div>
						</div>
						<?php			
					}
				}
			} else {				
				$this->load_desktop($non_adv_ordered_filter, $adv_ordered_filter);				
			}
		?>		
		<?php if(get_option('eo_wbc_preview_selected_filters', false )){ ?>
		<div class="ui tag labels" style="/*display: none;*/margin-top:0.25em;" id="filter_chips">				  
		</div>
		<?php } ?>
		<style type="text/css">
			.bottom_filter_segment{
				position: fixed !important;
			    z-index: 99999;
			    bottom: -1em;
			    width: 100vw;
			    width: -webkit-fill-available;
			    width: -moz-available;;
			    left: 0;
			    margin-bottom: 1em !important;
			    -webkit-backface-visibility: hidden;
			    display: none;
			}			
			.bottom_filter_segment .ui.tiny.form .field{
				width:-moz-fit-content !important;
				width: max-content !important;
			}	
			
		</style>
		<script>
			jQuery(document).ready(function(){
				jQuery(".toggle_sticky_mob_filter").on('click tap',function(){
					jQuery('.bottom_filter_segment.active').transition('fade up');
					jQuery('.bottom_filter_segment.active').toggleClass('active');
					jQuery(jQuery(this).data('target')).transition('fade up');
					jQuery(jQuery(this).data('target')).toggleClass('active');
				});

				jQuery(".close_sticky_mob_filter").on('click tap',function(){
					//jQuery(jQuery(this).data('target')).transition('fade up');
					jQuery('.bottom_filter_segment.active').transition('fade up');
					jQuery('.bottom_filter_segment.active').toggleClass('active');
				});
			});
		</script>
		
		<!-- Created with Wordpress plugin - WooCommerce Product bundle choice -->
		<!--WooCommerce Product Bundle Choice filter form-->
		<form method="GET" name="eo_wcfw_filter" id="eo_wcfw_filter" style="clear: both;">

			<input type="hidden" name="eo_wcfw_filter" value="1" />	
			<input type="hidden" name="paged" value="1" />	
			<input type="hidden" name="last_paged" value="1" />
			<input type="hidden" name="action" value="eo_wcfw_filter"/>
			<input type="hidden" name="cat_filter_tab_switch_category" value="<?php echo empty($this->tab_switch_category)?'':$this->tab_switch_category; ?>">
			<input type="hidden" name="_current_category" value="<?php echo (!empty($_GET['CAT_LINK'])?','.sanitize_text_field($_GET['CAT_LINK']):''); ?>" />

			<input type="hidden" name="_category_query" id="eo_wcfw_cat_query" 
				value="<?php echo (!empty($_GET['CAT_LINK'])?','.sanitize_text_field($_GET['CAT_LINK']):'')?>" />

			<input type="hidden" name="_category" value="<?php echo implode(',',$this->___category) ?>"/>
			<input type="hidden" name="_attribute" id="eo_wcfw_attr_query" value="" />			
			<?php if(isset($_GET['products_in']) AND !empty($_GET['products_in']) ): ?>
				<input type="hidden" name="products_in" value="<?php echo $_GET['products_in'] ?>" />			
			<?php endif; ?>

			<?php		
				if(!empty($this->__filters)){	

					/* This block shall be removed as its purpose is to remove duplicates as we do not know the cause of multiple instence. */
					$serialized_filter = array_map(function($e){
						return serialize($e);
					},$this->__filters);

					$serialized_filter = array_unique($serialized_filter);

					$this->__filters = array_map(function($e){
						return unserialize($e);
					},$serialized_filter);				
					/* To be removed block ends. */

					foreach ($this->__filters as $__filter) {						
						?>
							<input type="<?php echo $__filter['type'] ?>" name="<?php echo $__filter['name'] ?>" id="<?php echo $__filter['id'] ?>" class="<?php echo $__filter['class'] ?>" value="<?php echo $__filter['value'] ?>" <?php echo (isset($__filter['data-edit'])?'data-edit="'.$__filter['data-edit'].'"':'') ?>/>
						<?php
					}
				}
			?>
		</form>
		<br/><br/>
		<script type="text/javascript">		

			jQuery(document).ready(function($){			

				window.eo=new Object();
				
				//Slider creation function
				window.eo.slider=function(selector){

					$(selector).each(function(i,e){

						_min = Number($(e).attr('data-min'));						
						_max = Number($(e).attr('data-max'));												
						_labels = $(e).attr('data-labels');

						_params=new Object();												
												
						if(_labels != undefined && _labels != false){

							_labels=_labels.split(',');
							_params.interpretLabel=function(value){ 							
								if(_labels!=undefined){
									return _labels[value];
								} else {
									return value;
								}
								
							}			
							_params.step=1;

							_params.min=0;
							_params.max=_labels.length-1;
							_params.start=0;
							_params.end=_labels.length-1;

						} else {

							_params.min=_min;
							_params.max=_max;
							_params.start=_min;
							_params.end=_max;

							_params.smooth=true;
							_params.step=(_max-_min)/100;	
						}
						_params.smooth=true;
						_params.autoAdjustLabels=true;
						_params.decimalPlaces=4;
						_params.onMove=function(value, min, max) {

							__slugs = $(e).attr('data-slugs');
							
							if(typeof __slugs != typeof undefined && __slugs != false){
								//PASS
							} else {
								_sep = $(e).attr('data-sep');
								_postfix = $(e).attr('data-postfix');
								if(typeof(_postfix)==typeof(undefined)){
									_postfix='';
								}			
					        	$("input[name='text_min_"+$(e).attr('data-slug')+"']").val((_sep=='.'?Number(min).toFixed(2):(Number(min).toFixed(2)).toString().replace('.',','))+_postfix);
					        	$("input[name='text_max_"+$(e).attr('data-slug')+"']").val((_sep=='.'?Number(max).toFixed(2):(Number(max).toFixed(2)).toString().replace('.',','))+_postfix);
					        }					      	
						}

						_params.onChange=function(value, min, max) {	

							_labels = $(e).attr('data-labels');
							_min = Number ($(e).attr('data-min'));						
							_max = Number($(e).attr('data-max'));
							_sep = $(e).attr('data-sep');

							if(typeof _labels != typeof undefined && _labels != false){
								_labels=_labels.split(',');
								_min=0;
								_max=_labels.length-1;
							}

							if(
								(
									($(this).data('prev_val_min')!=min && $(this).data('prev_val_min')!=undefined)
									|| 
									($(this).data('prev_val_max')!=max && $(this).data('prev_val_max')!=undefined)
								)
								||
								( min!=_min || max!=_max )
							){

								if(typeof __slugs != typeof undefined && __slugs != false){
										
									$("input[name='min_"+$(e).attr('data-slug')+"']").val(__slugs.split(',')[min]);
						        	$("input[name='max_"+$(e).attr('data-slug')+"']").val(__slugs.split(',')[max]);

								} else {

						        	$("input[name='min_"+$(e).attr('data-slug')+"']").val(Number(min).toFixed(2));
						        	$("input[name='max_"+$(e).attr('data-slug')+"']").val(Number(max).toFixed(2));
						        }

						        if($(this).attr('data-slug')!='price'){
							    	//Action of notifying filter change when changes are done.
							    	if($(this).attr('data-min')==min && $(this).attr('data-max')==max) {

							    		if($("[name='_attribute']").val().includes($(this).attr('data-slug'))) {
							    			
							    			_values=$("[name='_attribute']").val().split(',')
							    			_index=_values.indexOf($(this).attr('data-slug'))
							    			_values.splice(_index,1)
							    			$("[name='_attribute']").val(_values.join());
							    		}
							    	}
							    	else {
							    		if(! $("[name='_attribute']").val().includes($(this).attr('data-slug'))) {
							    			_values=$("[name='_attribute']").val().split(',')
							    			_values.push($(this).attr('data-slug'))
							    			$("[name='_attribute']").val(_values.join())
							    		}
							    	}
						    	}
						    	$('[name="paged"]').val('1');
						    	jQuery.fn.eo_wcfw_filter_change();
						    }
						    
						    $(this).data('prev_val_min',min);						    
						    $(this).data('prev_val_max',max);
						}

						$("input.text_slider_"+$(e).attr('data-slug')).change(function() {				    

							$("#text_slider_"+$(e).attr('data-slug')).slider("set rangeValue",$("[name=min_"+$(e).attr('data-slug')+"]").val(),$("[name=max_"+$(e).attr('data-slug')+"]").val());
						});							
						$(e).slider(_params);
					});
				}

				var primary_filter=$(".eo-wcfw-container.filters .ui.segment:not(.secondary)");
				var primary_computer_only=$(primary_filter).find(".computer.tablet.only");
				var primary_mobile_only=$(primary_filter).find(".mobile.only");

				var secondary_filter=$(".eo-wcfw-container.filters .ui.segment.secondary");
				var secondary_computer_only=$(secondary_filter).find(".computer.tablet.only");
				var secondary_mobile_only=$(secondary_filter).find(".mobile.only");

				
				$('.ui.accordion').accordion();
				window.eo.slider($('.eo-wcfw-container.filters,.eo-wbc-container.filters').find('.ui.slider'));				
			
				/* Activate initiation of sliders at secondary segments. */
				if($(secondary_computer_only).css('display')!='none'){				

					$("#advance_filter").on('click',function(){
						$("#advance_filter").find('.ui.icon').toggleClass('up down');
						$(secondary_filter).transition('slide down');
					}).trigger('click');				

				} else if($(secondary_mobile_only).css('display')!='none') {					
					
					$("#advance_filter").on('click',function(){
						$("#advance_filter").find('.ui.icon').toggleClass('up down');
						$(secondary_filter).transition('fly right');				
					}).trigger('click');
				}

				jQuery("#advance_filter_mob_alternate").on('click',function(){
					jQuery("#advance_filter_mob_alternate").find('.ui.icon').toggleClass('up down');
					jQuery(".toggle_sticky_mob_filter.advance_filter_mob").toggle();
				});

				/*$(secondary_filter).transition('fade');*/

				if($("#primary_filter").parent().parent().css('display')!='none'){
					
					$("#primary_filter").click(function(e){
						e.preventDefault();
						e.stopPropagation();
						$("#primary_filter").find('.ui.icon').toggleClass("down up");
						$('.eo-wcfw-container.filters,#advance_filter').transition('fade');
					}).trigger('click');
				}
				
				/*----------------------------------------------------*/
				/*----------------------------------------------------*/
				$('.checkbox').checkbox({onChange:function(){

					__slug=$(this).attr('data-filter-slug');					

					_values=jQuery('[name="checklist_'+__slug+'"]').val().split(',');

					if(_values.indexOf($(this).attr('data-slug'))!=-1){

						_values=jQuery('[name="checklist_'+__slug+'"]').val().split(',');
						_index=_values.indexOf($(this).attr('data-slug'));						
						_values.splice(_index,1);						
						jQuery('[name="checklist_'+__slug+'"]').val(_values.join());

					} else {

						_values=jQuery('[name="checklist_'+__slug+'"]').val().split(',');
		    			_values.push($(this).attr('data-slug'));
		    			jQuery('[name="checklist_'+__slug+'"]').val(_values.join());
					}
					
					if( ( jQuery('.checklist_'+__slug+':checkbox').length==jQuery('.checklist_'+__slug+':checkbox:checked').length)  || (jQuery('.checklist_'+__slug+':checkbox:checked').length==0) ) {

			    		if($("[name='_attribute']").val().includes(__slug)) {
			    			
			    			_values=$("[name='_attribute']").val().split(',')
			    			_index=_values.indexOf(__slug)			    			
			    			_values.splice(_index,1)				    			
			    			$("[name='_attribute']").val(_values.join());
			    		}
			    	}
			    	else {
			    		if(! $("[name='_attribute']").val().includes(__slug)) {
			    			_values=$("[name='_attribute']").val().split(',')
			    			_values.push(__slug)
			    			$("[name='_attribute']").val(_values.join())
			    		}
			    	}
			    	$('[name="paged"]').val('1');
			    	jQuery.fn.eo_wcfw_filter_change();
				}});				
				/*----------------------------------------------------*/
				/*----------------------------------------------------*/

				jQuery(document).ready(function(){
		    		jQuery(".ui.tabular.menu>.item.center").on('click',function(){
		    			jQuery(".ui.tabular.menu>.item.center").removeClass('active');
		    			var this_tab = jQuery(this);
		    			jQuery(this).addClass('active');
		    			jQuery("[name='cat_filter_tab_switch_category']").val(this_tab.data('category'));
		    			jQuery.fn.eo_wcfw_filter_change();
		    		});
		    			    		
		    	});

			});			
		</script> 
		<?php			
	}

	public function eo_wcfw_filter_ui_icon($id,$title='',$type=0,$input='icon',$desktop=1,$width='50',$icon_width=FALSE,$label_size=FALSE,$reset = 0,$child_label=false,$hidden = false,$help='',$advance=0) {		
		global $woocommerce;
		$icon_css = '';
		if($input == 'icon'){
			$icon_css.=($icon_width?'width:'.$icon_width.' !important;':'');
		} elseif($input == 'icon_text'){
			$icon_css.=($icon_width?'width:'.$icon_width.' !important;':'').($label_size?'font-size:'.$label_size.' !important;':'');
		}

		$term = False;
		$non_edit=false;
		$list=array();
		$cat_filter_list=array();
		$term_list = array();

		if($type == 1){
			$term = $this->get_attribute($id);
			$term_list = $this->range_steps($id,$title,$type)['list'];
		} else{
			$term = get_term_by('id',$id,'product_cat');
			//$term_list = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'child_of'=>$id));
			$term_list = get_terms('product_cat', array('hide_empty' => 0, 'orderby' => 'ASC', 'parent'=>$id));
		}
		
		if( empty($term) or is_wp_error($term) ) return false;

		if(empty($term_list) or is_wp_error($term_list) or !(is_array($term_list) or is_object($term_list))) return false;
		
		foreach ($term_list  as $term_item) {
			$term_item = (object)$term_item;
			if(!empty($term_item) and is_object($term_item))
			$icon = '';
			$mark = false;

			$query_list = array();

			if(empty($term_item->term_id) and $type == 1){

				$icon = get_term_meta( $term_item->id, $term->slug . '_attachment');
				if(is_array($icon) and !empty($icon)){
					$icon = $icon[0];
				} else {
					$icon = $woocommerce->plugin_url() . '/assets/images/placeholder.png';
				}

				if(!empty($_GET['ATT_LINK'])){
					$query_list = explode(' ',$_GET['ATT_LINK']);
				}

				$mark = in_array($term_item->id,$query_list);				
				if($non_edit==false && in_array($term_item->id,$query_list)) {
					$non_edit=true;						
				}

			} else {
				$icon = wp_get_attachment_url( @get_term_meta( $term_item->term_id, 'thumbnail_id', true ));
				
				if(!empty($_GET['CAT_LINK'])){
					$query_list = explode(' ',$_GET['CAT_LINK']);
				}

				$mark = in_array($term_item->slug,$query_list);
				if($non_edit==false && in_array($term_item->slug,$query_list)) {
					$non_edit=true;						
				}
			}

			$list[]=array("icon" => $icon ,
							"name" => $term_item->name,
							"slug"=> $term_item->slug,
							"mark"=> $mark
						);					
			
			if(in_array($term_item->slug,$query_list)) {
				$cat_filter_list[]=$term_item->slug;
			}
		}

		if( empty($list) ) return false;

		$title=(!empty($title) ? $title : $term->name);
		
		if($type == 1){
			array_push($this->__filters,array(
										"type"=>"hidden",
										"name"=>"checklist_".$term->slug,
										"id"=>"checklist_".$term->slug,
										"class"=>"",
										"value"=>implode(',',$cat_filter_list),
									));
		} else {

			array_push($this->__filters,array(
										"type"=>"hidden",
										"name"=>"cat_filter_".$term->slug,
										"id"=>"cat_filter_".$term->slug,
										"class"=>"",
										"value"=>implode(',', $cat_filter_list),
										"edit"=>($non_edit?'0':'1'),
									));
		}

		if($desktop):		
			
		?>
			<div class="<?php echo $this->get_width_class($width); ?>" <?php echo $hidden?' style="display:none;" ':''; ?>>
				<p>
					<spna class="ui header"><?php echo($title); ?></spna>
					<?php if($reset): ?>
				&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_icon(event,'<?php echo $term->slug; ?>')">&nbsp;<u>reset</u></span>
				<?php endif; ?>
				</p>
				<div class="ui tiny images ui equal width center aligned grid" style="text-align: center;">				
					<?php foreach ($list as $filter_icon): ?>						
						<div title="<?php $filter_icon["name"]; ?>"
							class="eo_wcfw_filter_icon column <?php echo $non_edit ? 'none_editable':'' ?> 
								<?php echo $filter_icon['mark'] ? 'eo_wcfw_filter_icon_select':''?> ui image" 
							data-slug="<?php echo $filter_icon['slug']; ?>" data-label="<?php echo($filter_icon['name']); ?>" 
							data-filter="<?php echo $term->slug; ?>" style="border-bottom: 2px solid transparent;<?php echo $icon_css; ?>"
							data-siblings="<?php echo implode(',',array_column($list,'slug')); ?>"
							data-type="<?php echo $type; ?>" data-reset="reset_single_icon(new Event(''),'[data-slug=\'<?php echo $filter_icon['slug']; ?>\']')">
							<div>
								<img src='<?php echo $filter_icon['icon']; ?>'/>
							</div>
							<?php if($input=='icon_text'): ?>
								<div><?php echo($filter_icon['name']); ?></div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>			  	
				</div>		    		
			</div>
		<?php
		elseif(get_option('eo_wbc_alternate_mobile_filters',false)):
		?>			
			<div class="ui four wide column toggle_sticky_mob_filter <?php echo $advance?'advance_filter_mob':'' ?>" style="<?php echo $advance?'display: none;':'' ?><?php echo $hidden?'display:none;':''; ?>" data-target="#sticky_mob_filter_<?php echo $term->slug ?>">
				<div class="title"><div class="ui segment"><?php echo($title); ?></div></div>
			</div>
			<div class="bottom_filter_segment hidden ui segment" id="sticky_mob_filter_<?php echo $term->slug ?>">
					<div class="ui equal width grid">
							<div class="column close_sticky_mob_filter" data-target="#sticky_mob_filter_<?php echo $term->slug ?>">
								<i class="ui icon times" style="cursor: pointer;"></i>&nbsp;Close
							</div>
							<div class="column"></div>
							<div class="column"></div>
							<div class="column" style="text-align: right;" onclick="reset_icon(event,'<?php echo $term->slug; ?>')">
								<i class="ui icon redo" style="cursor: pointer;"></i>&nbsp;Reset
							</div>
					</div>					
				<br/>
				<div class="ui title">
					<strong><?php echo($title); ?></strong><?php if(!empty($help)): ?>&nbsp;<i class="question circle outline icon" data-help="<?php echo $help; ?>"></i><?php endif; ?>
				</div><br/>
				<div class="ui tiny images" data-reset="reset_icon(new Event('click'),'<?php echo $term->slug; ?>')" style="text-align: center;">
					<?php foreach ($list as $filter_icon): ?>
						<div title="<?php $filter_icon["name"]; ?>"
							class="eo_wbc_filter_icon <?php echo $non_edit ? 'none_editable':'' ?> 
								<?php echo $filter_icon['mark'] ? 'eo_wbc_filter_icon_select':''?> ui image" 
							data-slug="<?php echo $filter_icon['slug']; ?>" data-label="<?php echo($filter_icon['name']); ?>" 
							data-filter="<?php echo $term->slug; ?>" style="<?php echo get_option('eo_wbc_alternate_breadcrumb',false)?"border":"border-bottom"?>: 2px solid transparent;"
							data-siblings="<?php echo implode(',',array_column($list,'slug')); ?>" 
							data-type="<?php echo $type; ?>" data-reset="reset_single_icon(new Event(''),'[data-slug=\'<?php echo $filter_icon['slug']; ?>\']')">
							<div>
								<img src='<?php echo $filter_icon['icon']; ?>'/>
							</div>
							<?php if($input=='icon_text'): ?>
								<div><?php echo($filter_icon['name']); ?></div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>			  	
				</div>	
			</div>			
		<?php
		else:
		?>
			<div class="title" style="<?php echo $hidden?'display:none;':''; ?><?php echo $hidden?'display:none;':''; ?>">
			    <i class="dropdown icon"></i>		    
			    <?php echo($title); ?>
			    <?php if($reset): ?>
				&nbsp; <span class="ui grey text" style="cursor: pointer;" onclick="reset_icon(event,'<?php echo $term->slug; ?>')">&nbsp;<u>reset</u></span>
				<?php endif; ?>
			</div>
		  	<div class="content" <?php echo $hidden?' style="display:none;" ':''; ?>>	
		  		<div class="ui tiny images" style="text-align: center;">
					<?php foreach ($list as $filter_icon): ?>
						<div title="<?php $filter_icon["name"]; ?>"
							class="eo_wcfw_filter_icon <?php echo $non_edit ? 'none_editable':'' ?> 
								<?php echo $filter_icon['mark'] ? 'eo_wcfw_filter_icon_select':''?> ui image" 
							data-slug="<?php echo $filter_icon['slug']; ?>" data-label="<?php echo($filter_icon['name']); ?>" 
							data-filter="<?php echo $term->slug; ?>" style="border-bottom: 2px solid transparent;"
							 data-siblings="<?php echo implode(',',array_column($list,'slug')); ?>" 
							data-type="<?php echo $type; ?>" data-reset="reset_single_icon(new Event(''),'[data-slug=\'<?php echo $filter_icon['slug']; ?>\']')">
							<div>
								<img src='<?php echo $filter_icon['icon']; ?>'/>
							</div>
							<?php if($input=='icon_text'): ?>
								<div><?php echo($filter_icon['name']); ?></div>
							<?php endif; ?>
						</div>
					<?php endforeach; ?>			  	
				</div>
		  	</div>		
		<?php
		endif;
		?>					
		<script>
			jQuery(document).ready(function($){
				
				/*__data_filter_slug="<?php echo $term->slug; ?>";*/
				/*if(__data_filter_slug){*/
				if("<?php echo $term->slug; ?>") {
					//TO BE FIXED LATER.
					/*jQuery('[data-filter="'+__data_filter_slug+'"]:not(.none_editable)').off();
					jQuery('[data-filter="'+__data_filter_slug+'"]:not(.none_editable)').on('click',function(e){*/

					jQuery('[data-filter="'+"<?php echo $term->slug; ?>"+'"]:not(.none_editable)').off();
					jQuery('[data-filter="'+"<?php echo $term->slug; ?>"+'"]:not(.none_editable)').on('click',function(e){

						
						
						e.stopPropagation();
						e.preventDefault();

						var icon_filter_type = jQuery(this).attr('data-type');
						var filter_name = jQuery(this).attr('data-filter');

						var filter_list= undefined;
						var filter_target = undefined;

						console.log(icon_filter_type);

						if(icon_filter_type == 1) {
							/*filter_list = jQuery('[name="checklist_'+__data_filter_slug+'"]');*/
							filter_list = jQuery('[name="checklist_'+"<?php echo $term->slug; ?>"+'"]');
							filter_target = jQuery('[name="_attribute"]');

							/*console.log(jQuery('[name="checklist_'+__data_filter_slug+'"]'));*/
							console.log(jQuery('[name="checklist_'+"<?php echo $term->slug; ?>"+'"]'));
							console.log(jQuery('[name="_attribute"]'));
						} else {
							/*filter_list = jQuery('[name="cat_filter_'+__data_filter_slug+'"]');*/
							filter_list = jQuery('[name="cat_filter_'+"<?php echo $term->slug; ?>"+'"]');
							filter_target = jQuery('[name="_category"]');
							<?php if($type != 1 and !empty($term_list) and $child_label!==false){ ?>
								jQuery(filter_list).val('');
								jQuery('[data-filter="<?php echo $term->slug; ?>"]').removeClass('eo_wcfw_filter_icon_select');

								var _siblings =jQuery(this).attr('data-siblings');
								if(typeof(_siblings) !== typeof(undefined)) {
									jQuery.each(_siblings.split(','),function(index,e){
										
										jQuery(".eo_wcfw_filter_icon.column.ui.image[data-filter='"+e+"']").parent().parent().css('display','none');
										jQuery("[data-target='#sticky_mob_filter_"+e+"']").css('display','none');
										jQuery("#sticky_mob_filter_"+e).find(".eo_wcfw_filter_icon_select").removeClass('eo_wcfw_filter_icon_select');

										jQuery('[name="checklist_'+e+'"]').val('');
										jQuery('[name="cat_filter_'+e+'"]').val('');
									});
									jQuery(".eo_wcfw_filter_icon.column.ui.image[data-filter='"+jQuery(this).attr('data-slug')+"']").parent().parent().css('display','unset');
									jQuery("[data-target='#sticky_mob_filter_"+jQuery(this).attr('data-slug')+"']").css('display','unset');
								}								
							<?php } ?>
						}						
						
						if(filter_list.val().includes( jQuery(this).attr('data-slug'))){
							filter_list.val(filter_list.val().replace(','+jQuery(this).attr('data-slug'),''));
						}
						else {
							filter_list.val(filter_list.val()+','+jQuery(this).attr("data-slug"));
						}

						if(filter_target.val().includes(filter_name) && filter_list.val().length==0) {
							filter_target.val(filter_target.val().replace(','+filter_name,''));
						} else { if((!filter_target.val().includes(filter_name)) && filter_list.val().length) {
							filter_target.val(filter_target.val()+','+filter_name);	
						} }					

						var icon_val=jQuery(filter_list).val();	
						jQuery(filter_list).val(icon_val.substr(0,icon_val.length));
						
						jQuery(this).toggleClass('eo_wcfw_filter_icon_select');
						$('[name="paged"]').val('1');
						jQuery.fn.eo_wcfw_filter_change();
					});

					jQuery(".eo_wcfw_srch_btn:eq(2)").on('reset',function(){	
						var icon_filter_type = "<?php echo $type; ?>";
						var filter_list= undefined;
						if(icon_filter_type == 1) {
							/*filter_list = jQuery('[name="checklist_'+__data_filter_slug+'"]');*/
							filter_list = jQuery('[name="checklist_'+"<?php echo $term->slug; ?>"+'"]');
						} else {
							/*filter_list = jQuery('[name="cat_filter_'+__data_filter_slug+'"]');*/
							filter_list = jQuery('[name="cat_filter_'+"<?php echo $term->slug; ?>"+'"]');
						}

						if(jQuery(filter_list).attr('data-edit')=='1') {
							jQuery(filter_list).val("");

							jQuery(".eo_wcfw_filter_icon_select").each(function(index,element){
								jQuery(element).removeClass("eo_wcfw_filter_icon_select");
							});
						}				
					});
				}				
			});
		</script>
		<?php
		if($type != 1 and !empty($term_list) and $child_label!==false){
			foreach ($term_list as $term_object_index=>$term_object) {		

				$this->eo_wcfw_filter_ui_icon($term_object->term_id,$child_label,$type,$input,$desktop,$width,$icon_width,$label_size,$reset,false,$term_object_index>0);
				
			}						
		}
	}	

	//Generate dropdown based filter option;
	public function input_dropdown($slug,$items_name,$items_slug,$id,$type,$opt_title='All') {

		$list_items = array_combine($items_name,$items_slug);

		?>
		<div>
			<select style="width: 100%;" name="<?php echo $type==0?'cat_filter_'.$slug:'dropdown_'.$slug; ?>" id="dropdown_<?php echo $slug; ?>" data-slug="<?php echo $slug; ?>" data-role="dropdown" data-input="dropdown" data-filter-id="<?php echo $id; ?>" data-type="<?php echo $type; ?>" >

				<option selected="selected" value=""><?php echo $opt_title; ?></option>
				<?php foreach ($list_items as $name => $slug) : ?>
					<option value="<?php echo $slug; ?>"><?php echo $name; ?></option>
				<?php endforeach;?>
			</select>						
		</div>
		<?php
	}
	    
    //get min and max price.
	protected function get_filtered_price() {
		global $wpdb;

		$args       = wc()->query->query_vars;
		$tax_query  = isset( $args['tax_query'] ) ? $args['tax_query'] : array();
		$meta_query = isset( $args['meta_query'] ) ? $args['meta_query'] : array();

		if ( ! is_post_type_archive('product') && ! empty( $args['taxonomy'] ) && ! empty( $args['term'] ) ) {
			$tax_query[] = array(
				'taxonomy' => $args['taxonomy'],
				'terms'    => array( $args['term'] ),
				'field'    => 'slug',
			);
		}

		foreach ( $meta_query + $tax_query as $key => $query ) {
			if ( ! empty( $query['price_filter'] ) || ! empty( $query['rating_filter'] ) ) {
				unset( $meta_query[ $key ] );
			}
		}

		$meta_query = new WP_Meta_Query( $meta_query );
		$tax_query  = new WP_Tax_Query( $tax_query );

		$meta_query_sql = $meta_query->get_sql( 'post', $wpdb->posts, 'ID' );
		$tax_query_sql  = $tax_query->get_sql( $wpdb->posts, 'ID' );

		$sql  = "SELECT min( FLOOR( price_meta.meta_value ) ) as min_price, max( CEILING( price_meta.meta_value ) ) as max_price FROM {$wpdb->posts} ";
		$sql .= " LEFT JOIN {$wpdb->postmeta} as price_meta ON {$wpdb->posts}.ID = price_meta.post_id " . $tax_query_sql['join'] . $meta_query_sql['join'];
		$sql .= " 	WHERE {$wpdb->posts}.post_type IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_post_type', array( 'product' ) ) ) ) . "')
			AND {$wpdb->posts}.post_status = 'publish'
			AND price_meta.meta_key IN ('" . implode( "','", array_map( 'esc_sql', apply_filters( 'woocommerce_price_filter_meta_keys', array( '_price' ) ) ) ) . "')
			AND price_meta.meta_value > '' ";
		$sql .= $tax_query_sql['where'] . $meta_query_sql['where'];

		$search = WC_Query::get_main_search_query_sql();
		if ( $search ) {
			$sql .= ' AND ' . $search;
		}

		$sql = apply_filters( 'woocommerce_price_filter_sql', $sql, $meta_query_sql, $tax_query_sql );

		return $wpdb->get_row( $sql ); // WPCS: unprepared SQL ok.
	}

	public function array_column($input = null, $columnKey = null, $indexKey = null) { 
	    
	    $argc = func_num_args();
	    $params = func_get_args();
	    if ($argc < 2) {
	        trigger_error("array_column() expects at least 2 parameters, {$argc} given", E_USER_WARNING);
	        return null;
	    }
	    
	    if (!is_array($params[0])) {
	        trigger_error(
	            'array_column() expects parameter 1 to be array, ' . gettype($params[0]) . ' given',
	            E_USER_WARNING
	        );
	        return null;
	    }
	    
	    if (!is_int($params[1]) && !is_float($params[1]) && !is_string($params[1]) && $params[1] !== null && !(is_object($params[1]) && method_exists($params[1], '__toString'))) {
	        trigger_error('array_column(): '.__('The index key should be either a string or an integer','woo-bundle-choice') , E_USER_WARNING);
	        return false;
	    }
	    
	    if (isset($params[2]) && !is_int($params[2]) && !is_float($params[2]) && !is_string($params[2]) && !(is_object($params[2]) && method_exists($params[2], '__toString'))) {
	        trigger_error('array_column(): '.__('The index key should be either a string or an integer','woo-bundle-choice') , E_USER_WARNING);
	        return false;
	    }
	    
	    $paramsInput = $params[0];
	    $paramsColumnKey = ($params[1] !== null) ? (string) $params[1] : null;
	    $paramsIndexKey = null;
	    if (isset($params[2])) {
	        if (is_float($params[2]) || is_int($params[2])) {
	            $paramsIndexKey = (int) $params[2];
	        }
	        else {
	            $paramsIndexKey = (string) $params[2];
	        }
	    }
	    
	    $resultArray = array();
	    foreach ($paramsInput as $row) {
	        $key = $value = null;
	        $keySet = $valueSet = false;
	        if ($paramsIndexKey !== null && array_key_exists($paramsIndexKey, $row)) {
	            $keySet = true;
	            $key = (string) $row[$paramsIndexKey];
	        }
	        
	        if ($paramsColumnKey === null) {
	            $valueSet = true;
	            $value = $row;
	        }
	        elseif (is_array($row) && array_key_exists($paramsColumnKey, $row)) {
	            $valueSet = true;
	            $value = $row[$paramsColumnKey];
	        }
	        
	        if ($valueSet) {
	            if ($keySet) {
	                $resultArray[$key] = $value;
	            }
	            else {
	                $resultArray[] = $value;
	            }
	        }
	    }
	    
	    return $resultArray;
	}

	public function get_attribute( $id ) {

        if(function_exists('wc_get_attribute')){
            return wc_get_attribute($id);
        } else {

            foreach (wc_get_attribute_taxonomies() as $attributes) {                    

                if($attributes->attribute_id==$id){

                    $data                    = $attributes;
                    $attribute               = new stdClass();
                    $attribute->id           = (int) $data->attribute_id;
                    $attribute->name         = $data->attribute_label;
                    $attribute->slug         = wc_attribute_taxonomy_name( $data->attribute_name );
                    $attribute->type         = $data->attribute_type;
                    $attribute->order_by     = $data->attribute_orderby;
                    $attribute->has_archives = (bool) $data->attribute_public;
                    return $attribute;
                }                    
            }
            return null;               
        }
    } 
}	
?>
