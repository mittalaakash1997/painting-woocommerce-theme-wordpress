<?php

if (! defined('WP_DEBUG')) {
	die( 'Direct access forbidden.' );
}

add_action( 'wp_enqueue_scripts', function () {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
});





if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
    
    'page_title' => 'Theme General Settings',
    
    'menu_title'	=> 'Theme Settings',
    
    'menu_slug' => 'theme-general-settings',
    
    'capability'	=> 'edit_posts',
    
    'redirect'	=> false
    
    ));
    
    }


	register_nav_menus(
    
		array(
		
		'top-menu' => __('Top Menu', 'theme'),
		'footer-menu' => __('Footer Menu1', 'theme'),
		
		)
		
		);




/**
 * Change several of the breadcrumb defaults
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'jk_woocommerce_breadcrumbs' );
function jk_woocommerce_breadcrumbs() {
    return array(
            'delimiter'   => ' ',
            'wrap_before' => '<ul class="my-breadcrumb" itemprop="breadcrumb">',
            'wrap_after'  => '</ul>',
            'before'      => '<li>',
            'after'       => '</li>',
            'home'        => _x( 'Home', 'breadcrumb', 'woocommerce' ),
        );
}


add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
    /* Register the 'primary' sidebar. */
    register_sidebar(
        array(
            'id'            => 'primary',
            'name'          => __( 'Primary Sidebar' ),
            'description'   => __( 'sva painting sidebar.' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}