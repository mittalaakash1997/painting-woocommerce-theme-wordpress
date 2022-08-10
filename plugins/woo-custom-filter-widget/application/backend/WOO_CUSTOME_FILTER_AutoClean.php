<?php
if(!class_exists('WOO_CUSTOME_FILTER_AutoClean')){
	class WOO_CUSTOME_FILTER_AutoClean {
		
		function __construct() {
			//update_option( 'eo_wcfw_products','');
			$products = unserialize(get_option('eo_wcfw_products',"a:0:{}"));			
			if(is_array($products) and !empty($products)){
				foreach($products as $pid){

					$product = wc_get_product($pid);						
					if(!is_wp_error($product) and !empty($product)){
						if ($product->is_type('variable'))
				        {
				            foreach ($product->get_children() as $child_id)
				            {
				                $child = wc_get_product($child_id);
				                $child->delete(true);
				            }
				        }
				        elseif ($product->is_type('grouped'))
				        {
				            foreach ($product->get_children() as $child_id)
				            {
				                $child = wc_get_product($child_id);
				                $child->set_parent_id(0);
				                $child->save();
				            }
				        }
				        $product->delete(true);			        				     
				    }
				    set_time_limit(30);
				}
			}
			update_option('eo_wcfw_products',"a:0:{}");

			$category = unserialize(get_option('eo_wcfw_cats',"a:0:{}"));			
			if(is_array($category) and !empty($category)){
				foreach ($category as $cat) {
					
					if(is_array($cat['child']) and !empty($cat['child'])){
						foreach ($cat['child'] as $cat_child) {
							wp_delete_term(get_term_by('slug',$cat_child['slug'],'product_cat')->term_id,'product_cat');
						}
					}
					wp_delete_term(get_term_by('slug',$cat['slug'],'product_cat')->term_id,'product_cat');
				}
			}
			update_option('eo_wcfw_cats',"a:0:{}");

			set_time_limit(30);

			$attribute = unserialize(get_option('eo_wcfw_attr',"a:0:{}"));
			echo "<pre>";
			//print_r($attribute);
			if(is_array($attribute) and !empty($attribute)){
				foreach ($attribute as $attr) {					
					$a = $this->get_attribute($attr['slug']);
					if(!empty($a) and !is_wp_error($a)){
						wc_delete_attribute($a->id);	
					}					
				}
			}
			update_option('eo_wcfw_attr',"a:0:{}");			
			
			wp_redirect(admin_url('admin.php?page=woo-custome-filter-config&tab=shop_cat_opt'));
		}
		public function get_attribute( $slug ) {
            
            foreach (wc_get_attribute_taxonomies() as $attributes) {                    

                if($attributes->attribute_name==$slug){

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
	new WOO_CUSTOME_FILTER_AutoClean();	
}
