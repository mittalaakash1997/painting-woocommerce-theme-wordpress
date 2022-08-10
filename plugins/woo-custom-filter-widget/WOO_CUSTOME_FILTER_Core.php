<?php
class WOO_CUSTOME_FILTER_Core   {   

    public function __construct(){

        if (class_exists( 'WooCommerce' )){
            //if request from Admin
            if(is_admin()){	
                //Go to eo_wbc_admin method
                $this->backend();                 
            }
            //if request from User
            else{				
                //Go to eo_wbc_frontend method
                $this->frontend();                
            }            
        }        
    }

    private function backend() { 
        
        /*if($_POST && isset($_POST['_wpnonce'])) {*/
            

            require_once apply_filters('woo_custome_filter_action','application/backend/WOO_CUSTOME_FILTER_Action.php',30);
            
            if(class_exists('WOO_CUSTOME_FILTER_Action')){                
                new WOO_CUSTOME_FILTER_Action();
            }
        /*}   */     

        require_once apply_filters('woo_custome_filter_config','application/backend/WOO_CUSTOME_FILTER_Config.php',30);
        
        if(class_exists('WOO_CUSTOME_FILTER_Config')){
            
            new WOO_CUSTOME_FILTER_Config();
        }
        
    }

    private function frontend() {
        //$this->wcfw_sanitize();
        require_once apply_filters('woo_custome_filter_widget','application/frontend/WOO_CUSTOME_FILTER_Widget.php',30);

        if (class_exists('WOO_CUSTOME_FILTER_Widget')) {                        
            
            $widget=new WOO_CUSTOME_FILTER_Widget();           

            $_category=array();
            $_attribute=array();

            add_shortcode('woo_custome_filter_begin',function() use(&$widget){
                ob_start();
                    ?>
                    
                        <form method="GET" class="woo_custome_filter_short_form">
                            <input type="hidden" name="woo_custome_filter" value="1"/>
                            <div class="filter_container" id="filter_container">
                    <?php
                return ob_get_clean();
            },10);

            add_shortcode('woo_custome_filter_end',function($config) use(&$widget,&$_category,&$_attribute){
                ob_start();
                    extract( shortcode_atts( array(
                        'filter_size'=>2
                    ), $config,'woo_custome_filter_end') );

                    $config_data=unserialize(get_option('woo_custome_filter_widget_config'));                    

                    ?>
                                <a href="#" class="woo-custome-filter-redirect" id="woo-custome-filter-redirect"><?php echo isset($config_data['submit_text'])?$config_data['submit_text']:'OK'; ?></a>
                            </div>                            
                            <input type="hidden" name="_category" value="<?php echo implode(',',$_category) ?>"/>
                            <input type="hidden" name="_attribute" value="<?php echo implode(',',$_attribute) ?>"/>
                        </form>      
                        <?php if(is_array($config_data) and !empty($config_data)): ?>                    
                            <style type="text/css">
                                .filter_container select{
                                    border: 1px solid <?php echo $config_data['dropdown_border_color'];?>;
                                    color: <?php echo $config_data['dropdown_font_color'];?>;
                                    background-color: <?php echo $config_data['dropdown_back_color'];?>;
                                    padding: <?php echo $config_data['dropdown_padding'];?>px;
                                    font-size: <?php echo $config_data['dropdown_font_size'];?>;
                                    <?php echo $config_data['dropdown_inline_css'];?>;
                                }
                                .filter_container{
                                    display: grid;
                                    grid-template-columns: <?php for ($i=0; $i < $filter_size ; $i++) { echo 'auto ';} ?> max-content;
                                }
                                .woo-custome-filter-redirect{                                                                        
                                    text-decoration: none;
                                    align-self: center;                                    
                                    color: <?php echo $config_data['submit_font_color'];?>;
                                    background-color: <?php echo $config_data['submit_back_color'];?>;
                                    border: 1px solid <?php echo $config_data['submit_border_color'];?>;
                                    padding: <?php echo $config_data['submit_padding'];?>px !important;
                                    font-size:<?php echo $config_data['submit_font_size'];?>px !important;
                                    <?php echo $config_data['submit_inline_css'];?>;
                                }
                                @media only screen and (max-width: 600px) {
                                  .woo-custome-filter-redirect{
                                    width: 100%;
                                  }
                                  .filter_container{
                                    grid-template-columns: auto;
                                  }
                                }
                                <?php echo $config_data['submit_add_css']; ?>
                                <?php echo $config_data['dropdown_add_css']; ?>
                            </style>
                        <?php endif; ?>                        
                    <?php
                    wp_register_script('woo_custome_filter_shortcode_js',plugin_dir_url( __FILE__ ).'/application/frontend/js/shortcode.js');
                    wp_enqueue_script('woo_custome_filter_shortcode_js');
                    wp_localize_script('woo_custome_filter_shortcode_js','filter_ob',array(
                        'ajaxurl' => admin_url('admin-ajax.php'),
                        'cat_url'=> get_option('siteurl').'/product-category/',
                        'shop_url'=>get_permalink(wc_get_page_id('shop')),
                        'not_required_all_select'=>$config_data['flexible_filter']
                        )
                    ) ;
                return ob_get_clean();
            },10);

            add_shortcode('woo_custome_filter',function($config) use(&$widget,&$_category,&$_attribute){                    
                ob_start();                        
                    extract( shortcode_atts( array(
                        'input'=>'dropdown',
                        'id'=>'0',
                        'label'=>'Title',
                        'type'=>'0',
                        'node_type'=>'parent',
                        'parent_node'=>'',
                        'node_name'=>''
                    ), $config,'woo_custome_filter') );

                    $widget->enque_asset();
                    $term=null;

                    if($type=='0'){
                        $term=get_term_by('id',$id,'product_cat');
                        if(@$term->slug){
                            $_category[]=@$term->slug;
                        }
                    }
                    elseif($type=='1'){
                        $term=wc_get_attribute($id);                                                
                        if(@$term->slug){
                            $_attribute[]=@$term->slug;    
                        }                       
                    }

                    /*switch ($input) {
                        case 'text_slider':                            
                            $filter=$widget->range_steps($id,$label,$type);                                                     
                            $widget->input_text_slider(                                   
                                    $filter['slug'],
                                    array_column($filter['list'],'name'),
                                    array_column($filter['list'],'slug'),
                                    $item['type']
                            );
                            break;
                        case 'step_slider':
                            $widget->input_step_slider($id,$label,$type);
                            break;

                        case 'checkbox':

                            $filter=$widget->range_steps($id,$label,$type);                                                     
                            $widget->input_checkbox(                                   
                                    $filter['slug'],
                                    array_column($filter['list'],'name'),
                                    array_column($filter['list'],'slug'),
                                    $item['type']
                            );
                            break;                      
                        default:*/
                        ?><div data-node-name="<?php echo $node_name; ?>" data-node-id="<?php echo $id; ?>"> <?php
                            $filter=$widget->range_steps($id,$label,$type);                                               
                            if($filter){
                                $widget->input_dropdown(
                                        $filter['slug'],
                                        array_column($filter['list'],'name'),
                                        array_column($filter['list'],'slug'),
                                        $id,
                                        $type,
                                        $label
                                    );                                     
                            }
                        ?></div> <?php  
                    /*}                    */
                    echo "<script>console.log('".$parent_node." ".$node_type." ".$node_name."');</script>";

                    if(!empty($parent_node) && $node_type=='Child'){
                        ?>
                            <script>
                                jQuery(document).ready(function($){
                                    bind_dependency("<?php echo $parent_node ?>","<?php echo $node_name; ?>","change");
                                });
                            </script>
                        <?php
                    }
                return ob_get_clean();
            },10);

            add_shortcode('woo_custom_filter_widget_filters',function($config) use(&$widget){
                
               
                    wp_register_script( 'wcfw_filter',plugin_dir_url(__FILE__).'js/wcfw_filter.js',array('jquery'));
                    wp_enqueue_script( 'wcfw_filter');

                    wp_localize_script('wcfw_filter','eo_wcfw_object',array(
                        'eo_product_url'=>'',
                        //'eo_view_tabular'=>($current_category=='solitaire'?1:0),
                        'disp_regular'=>get_option('eo_wbc_e_tabview_status',false)?1:0,
                        'eo_admin_ajax_url'=>admin_url( 'admin-ajax.php'),
                        'eo_part_site_url'=>get_site_url().'/index.php',
                        'eo_part_end_url'=>'/',
                        'eo_cat_site_url'=>site_url(),
                        'eo_cat_query'=>'/?'.http_build_query($_GET),
                        'ajax_url'=>get_permalink(wc_get_page_id( 'shop' ))
                    ));  

                    wp_register_style( 'wcfw_style',plugin_dir_url(__FILE__).'css/fomantic/semantic.min.css',true);
                    wp_enqueue_style( 'wcfw_style' );

                    wp_register_script( 'wcfw_script',plugin_dir_url(__FILE__).'js/fomantic/semantic.min.js',array('jquery'));
                    wp_enqueue_script( 'wcfw_script');                       
              
                /*add_action( 'woocommerce_before_shop_loop',function() use(&$widget){*/
                        $widget->enque_asset();
                        $widget->get_widget();
                                                            
                /*},30);*/
            });           

            add_action('template_redirect',function() use(&$widget){

                $filter_target_data=unserialize(get_option('woo_custome_filter_target',"a:0:{}"));
                global $wp_query;

                if($filter_target_data['page_shop'] && is_shop() ){
                    add_action( 'wp_enqueue_scripts',function(){
                        wp_register_script( 'wcfw_filter',plugin_dir_url(__FILE__).'js/wcfw_filter.js',array('jquery'));
                        wp_enqueue_script( 'wcfw_filter');

                        wp_localize_script('wcfw_filter','eo_wcfw_object',array(
                            'eo_product_url'=>'',
                            //'eo_view_tabular'=>($current_category=='solitaire'?1:0),
                            'disp_regular'=>get_option('eo_wbc_e_tabview_status',false)?1:0,
                            'eo_admin_ajax_url'=>admin_url( 'admin-ajax.php'),
                            'eo_part_site_url'=>get_site_url().'/index.php',
                            'eo_part_end_url'=>'/',
                            'eo_cat_site_url'=>site_url(),
                            'eo_cat_query'=>'/?'.http_build_query($_GET),
                            'ajax_url'=>get_permalink(wc_get_page_id( 'shop' ))
                        ));  

                        wp_register_style( 'wcfw_style',plugin_dir_url(__FILE__).'css/fomantic/semantic.min.css',true);
                        wp_enqueue_style( 'wcfw_style' );

                        wp_register_script( 'wcfw_script',plugin_dir_url(__FILE__).'js/fomantic/semantic.min.js',array('jquery'));
                        wp_enqueue_script( 'wcfw_script');                       
                        
                    });
                    add_action( 'woocommerce_before_shop_loop',function() use(&$widget){
                            $widget->enque_asset();
                            $widget->get_widget();                                    
                    },30);                
                }
                elseif( is_product_category() and $filter_target_data['page_category'] ){
                    add_action( 'wp_enqueue_scripts',function(){
                        
                        wp_register_script( 'wcfw_filter',plugin_dir_url(__FILE__).'js/wcfw_filter.js',array('jquery'));
                        wp_enqueue_script( 'wcfw_filter');

                        wp_localize_script('wcfw_filter','eo_wcfw_object',array(
                            'eo_product_url'=>'',
                            //'eo_view_tabular'=>($current_category=='solitaire'?1:0),
                            'disp_regular'=>get_option('eo_wbc_e_tabview_status',false)?1:0,
                            'eo_admin_ajax_url'=>admin_url( 'admin-ajax.php'),
                            'eo_part_site_url'=>get_site_url().'/index.php',
                            'eo_part_end_url'=>'/',
                            'eo_cat_site_url'=>site_url(),
                            'eo_cat_query'=>'/?'.http_build_query($_GET),
                            'ajax_url'=> ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'])
                        ));  

                        wp_register_style( 'wcfw_style',plugin_dir_url(__FILE__).'css/fomantic/semantic.min.css',true);
                        wp_enqueue_style( 'wcfw_style' );

                        wp_register_script( 'wcfw_script',plugin_dir_url(__FILE__).'js/fomantic/semantic.min.js',array('jquery'));
                        wp_enqueue_script( 'wcfw_script');
                        
                    });
                    
                    if(is_product_category() && $filter_target_data['cat_id']==get_queried_object()->term_id ) { 

                        add_action( 'woocommerce_before_shop_loop',function() use(&$widget){      
                                $widget->enque_asset();
                                $widget->get_widget();                                    
                        },30);                
                    }
                }

                /*if(is_product_category() OR is_shop()) { 

                    add_action( 'woocommerce_before_shop_loop',function() use(&$widget){                              
                            $widget->get_widget();                                    
                    },30);                
                }*/
            });
        }        
    }

    private function wcfw_sanitize(){
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
}

?>