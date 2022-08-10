<style type="text/css">
    .wcfw_help{
        color: grey;
        font-size:smaller;
    }
    select,input{
        min-width: 250px;
    }
</style>

<?php

if(!function_exists('__categories__')){

	function __categories__($prefix='',$slug='')
    {
        $map_base = get_categories(array(
            'hierarchical' => 1,
            'show_option_none' => '',
            'hide_empty' => 0,
            'parent' => @get_term_by('slug',$slug,'product_cat')->term_id,
            'taxonomy' => 'product_cat'
        ));
            
        $category_option_list='';
        foreach ($map_base as $base) {
            $category_option_list.= "<option data-type='0' data-slug='{$base->slug}' value='".$base->term_id."'>".$prefix.$base->name."</option>".__categories__($prefix.'-',$base->slug);
        }
        return $category_option_list;
    }
}
	
if(!function_exists('__attributes__')){

	function __attributes__()
    {    
        $attributes='';
        foreach (wc_get_attribute_taxonomies() as $item) {                     
        	$attributes .= "<option data-type='1' data-slug='{$item->attribute_name}' value='{$item->attribute_id}'>{$item->attribute_label}</option>";            
        }
        return $attributes;
    }
}

/*function wcfw_sanitize(){
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
*/
/*add_action( 'admin_enqueue_scripts',function(){*/
    wp_register_style('wcfw_fomantic_css',plugins_url( 'css/fomantic/semantic.min.css',dirname(dirname(dirname(__FILE__) ))));
    wp_enqueue_style('wcfw_fomantic_css');

    wp_register_script('wcfw_fomantic_js',plugins_url( 'js/fomantic/semantic.min.js',dirname(dirname(dirname(__FILE__) ))));
    wp_enqueue_script('wcfw_fomantic_js');

    add_filter( 'admin_footer_text',function($footer_text){
            /* translators: %1s: <strong> tag */
            /* translators: %2s: </strong> tag */
            /* translators: %3s: rating link */
            return sprintf('If you like %1$s Woo Custom Filter Widget %2$s please leave us a %3$s  rating. A huge thanks in advance!',"<strong>","</strong>","<a href='https://wordpress.org/support/plugin/woo-custom-filter-widget/reviews/?filter=5#new-post' target='_blank' class='wc-rating-link' data-rated='Thanks :)'>★★★★★</a>");
        });
        add_action('admin_footer',function(){
            ?>
                <style type="text/css">
                    #wpfooter{
                        position: unset !important;
                    }
                </style>
            <?php
        });

/*}, 10 );*/

?>
<style type="text/css">
    .ui.popup{overflow:auto;}    

    .nav-tab.config-opt-tabs{
        background: white;
    }
    .nav-tab.config-opt-tabs.nav-tab-active{
        
        border-width: 1.5px;
    }
</style>
<div class="wrap">
    <div>		
        <img style="width: 80px;height: auto;" class="ui middle aligned tiny image" src="<?php echo plugins_url( 'img/EO_WBC_Img/icon-256x256.png',dirname(dirname(dirname(__FILE__) ))); ?>">
        <span><strong style="font-size: x-large;">Woo Custom Filter Widget <i style="float: right;font-size: xxx-large;    top: 0.5em;position: relative;" class="question circle outline eo_help icon" data-html="
        <div class='ui basic segments'>
          <div class='ui compact segment'>
            <a style='cursor:pointer;' href='https://sphereplugins.com/woo-custom-filter-widget/docs/getting-started/' target='_blank'><i class='hands helping icon'></i>&nbsp;Documentation</a>
          </div>
          <div class='ui compact segment'>
            <a style='cursor:pointer;' href='https://sphereplugins.com/woo-custom-filter-widget/docs/shortcodes-for-filter-widgets/' target='_blank'><i class='file alternate icon'></i>&nbsp;Shortcode Docs</a>
          </div>
          <div class='ui compact segment'>
            <a style='cursor:pointer;' href='https://sphereplugins.com/woo-custom-filter-widget/docs/shop-category-page-filters/' target='_blank'><i class='file alternate icon'></i>&nbsp;Shop/Cat Filter Docs</a>
          </div>
          <div class='ui compact segment'>
            <a style='cursor:pointer;' href='https://wordpress.org/support/plugin/woo-custom-filter-widget/' target='_blank'><i class='hands helping icon'></i>&nbsp;Contact Support</a>
          </div>
          <div class='ui compact segment'>
            <a style='cursor:pointer;' href='http://sphereplugins.com/contact-us' target='_blank'><i class='comment alternate icon'></i>&nbsp;Feature requests/ideas & feedback</a>
          </div>
        </div>"></i></strong></span>        
	</div>
    <br/>

    <p style="color: blue;">If you are looking for feature-rich experience for any kind of filters then we recommend you use our other plugin <a href="https://wordpress.org/plugins/woo-bundle-choice/">Woo Choice Plugin</a>, we hope you will enjoy it more! After installing Woo Choice Plugin just enable shortcode filters or filters for shop/category pages from setup wizard. And if you are running a jewelry/diamond or clothing site then <a href="https://wordpress.org/plugins/woo-bundle-choice/">Woo Choice Plugin</a> has a lot for you! </p> 
    
    <p style="color: blue;">We are thinking of publishing the same features on this plugin maybe after a few months but till we can not do so we recommend you to use our above mentioned other plugin. </p>

    <br/>

    <script>
        jQuery(document).ready(function(){
            jQuery(".question.circle.outline.eo_help.icon").popup({hoverable:true,onShow:function(){jQuery('.ui.popup').css('max-height', jQuery(window).height());}});
        });
    </script>
    <?php $config_page=(isset($_GET['tab']))?$_GET['tab']:'config_opt'; ?>    

    <h2 class="nav-tab-wrapper">

        <a href="?page=woo-custome-filter-config&tab=config_opt" 
            class="nav-tab <?php echo $config_page=='config_opt'?'nav-tab-active':''; ?>">
            Shortcode Filter
        </a>
        <a href="?page=woo-custome-filter-config&tab=shop_cat_opt" 
            class="nav-tab <?php echo $config_page=='shop_cat_opt'?'nav-tab-active':''; ?>">
            Shop | Category Filter
        </a>
        <!-- <a href="?page=woo-custome-filter-config&tab=shortcode_opt" 
            class="nav-tab <?php echo $config_page=='shortcode_opt'?'nav-tab-active':''; ?>">
            Shortcode Filter
        </a> -->
        <a href="?page=woo-custome-filter-config&tab=extensions" 
            class="nav-tab <?php echo $config_page=='extensions'?'nav-tab-active':''; ?>">
            Extensions/Plugins
        </a>        
    </h2>
	
	<?php
        
        switch ($config_page) {

            case 'config_opt':                                                
                require_once 'config_pages/config_opt.php';                
                break;

            case 'shop_cat_opt':
                require_once 'config_pages/shop_cat_opt.php';
                break;            

            case 'shortcode_opt':
                require_once 'config_pages/shortcode_opt.php';
                break;
            case 'extensions':                
                require_once 'config_pages/view_extensions.php'; 
                break;        
            default:
                require_once 'config_pages/config_opt.php';
                break;
        }        
    ?>

</div>

