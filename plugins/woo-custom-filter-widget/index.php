<?php

/** 
* Plugin Name: Woocommerce Custom Filter Widget
* Plugin URI: https://wordpress.org/plugins/woo-custom-filter-widget/
* Description: A powerfull and easy tool to enable horizontal product filter bar at your e-commerce website.
* Version: 0.0.10
* Author: emptyopssphere
* Author URI: https://profiles.wordpress.org/emptyopssphere
* Requires at least: 3.5
* Tested up to: 5.4.1
* License: GPLv3+
* License URI: http://www.gnu.org/licenses/gpl-3.0.txt
*/


/////////////////////////////////////////////////////////////////////////////////////
//***********************************************************************************
/////////////////////////////////////////////////////////////////////////////////////

add_action( 'activated_plugin',function(){
	if(empty(get_option('woo_custome_filter_widget_config'))) {
		$config_data = array('flexible_filter'=>1);
		update_option('woo_custome_filter_widget_config',serialize($config_data));
	}
	
	if( function_exists('get_page_by_path') && !isset(get_page_by_path('filter-widget-page')->ID)){
        
        $post_content='<!-- wp:shortcode -->
						[woo_custom_filter_widget_filters]
						<!-- /wp:shortcode -->

						<!-- wp:shortcode -->
						[products paginate=true]
						<!-- /wp:shortcode -->';

        $home_sample_post_id = wp_insert_post(array(
            'post_type' => 'page',
            'post_title' => 'Filter Widget',
            'post_name'=>'filter-widget-page',
            'post_content' =>$post_content,

            'post_status' => 'publish',
            'post_author' => get_current_user_id(),
        ));

        if(!empty($home_sample_post_id)){
            update_post_meta($home_sample_post_id, '_wp_page_template','template-fullwidth.php');
        }            
    }
}, 10, 2 );
defined('WCFW_DIR') || define('WCFW_DIR', plugin_dir_path( __FILE__ ));
function wcfw_sanitize(){
	//Sanitize $_GET global variable
	foreach ($_GET as $key => $value){

	    $_GET[$key]=sanitize_text_field($value);
	}

	//Sanitize $_POST global variable
	foreach ($_POST as $key => $value){

	    $_POST[$key]=sanitize_text_field($value);
	}

	//Sanitize $_REQUEST global variable
	foreach ($_REQUEST as $key => $value){

	    $_REQUEST[$key]=sanitize_text_field($value);
	}
}
/////////////////////////////////////////////////////////////////////////////////////
//***********************************************************************************
/////////////////////////////////////////////////////////////////////////////////////


add_action( 'wp_ajax_wcfw_add_products',function(){
    require_once 'application/backend/WOO_CUSTOME_FILTER_CatAt.php';
    $catat=new WOO_CUSTOME_FILTER_CatAt();                
    echo $catat->create_product(intval($_POST['product_index']));
    wp_die();
});


if(isset($_GET) && isset($_GET['eo_wcfw_filter']) )  {
	wcfw_sanitize();	
	/////////////////////////////////////////////////////////////////////////////////////
	//***********************************************************************************
	/////////////////////////////////////////////////////////////////////////////////////
	/*
	*	Ajax filter request handling section
	*/

	require_once apply_filters('woo_custome_filter_ajax','WOO_CUSTOME_FILTER_Ajax.php');

	if(class_exists('WOO_CUSTOME_FILTER_Ajax')){

		new WOO_CUSTOME_FILTER_Ajax();		
	}	
	/////////////////////////////////////////////////////////////////////////////////////
	//***********************************************************************************
	/////////////////////////////////////////////////////////////////////////////////////
}
else{
	
	/////////////////////////////////////////////////////////////////////////////////////
	//***********************************************************************************
	/////////////////////////////////////////////////////////////////////////////////////
	/*
	*	Plugin core section
	*/	
	add_action('plugins_loaded',function() {

		require_once apply_filters('woo_custome_filter_core','WOO_CUSTOME_FILTER_Core.php');	

		if(class_exists('WOO_CUSTOME_FILTER_Core')) {
		
			new WOO_CUSTOME_FILTER_Core();
		}
	},20);
	/////////////////////////////////////////////////////////////////////////////////////
	//***********************************************************************************
	/////////////////////////////////////////////////////////////////////////////////////
}

 add_action('wp_ajax_eo_custom_filter','get_controls'); 
 add_action('wp_ajax_nopriv_eo_custom_filter','get_controls');

 function get_controls(){

 	wcfw_sanitize();

 	require_once apply_filters('woo_custome_filter_widget','application/frontend/WOO_CUSTOME_FILTER_Widget.php',30);

    if (class_exists('WOO_CUSTOME_FILTER_Widget') && isset($_POST['slug']) && isset($_POST['type']) ) {                        
        
        $widget=new WOO_CUSTOME_FILTER_Widget(); 
        
        $slug = sanitize_text_field($_POST['slug']);

        $term=get_term_by('slug',$slug,'product_cat');

        $id=$term->term_id;
        $label=sanitize_text_field($_POST['title']);
        $type=sanitize_text_field($_POST['type']);        

        $filter=$widget->range_steps($id,$label,$type);                                                     
        $widget->input_dropdown($filter['slug'],
                array_column($filter['list'],'name'),
                array_column($filter['list'],'slug'),
                $id,
                $type,
                $label
        );
    }
    else{
    	echo '';
    } 	
 	exit();
 }

?>