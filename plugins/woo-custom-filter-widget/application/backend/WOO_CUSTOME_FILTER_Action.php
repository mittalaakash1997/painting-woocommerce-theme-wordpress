<?php
class WOO_CUSTOME_FILTER_Action{

	public function __construct() {
        
		if (!empty($_POST['_wpnonce']) and wp_verify_nonce( $_POST['_wpnonce'],'woo_custome_filter_action_add') ) {

            $this->wcfw_sanitize();            
            $this->add_filter();       
        }            
        /*elseif ( wp_verify_nonce( $_POST['_wpnonce'],'woo_custome_filter_action_remove' ) ) {                
            
            $this->wcfw_sanitize();
        	$this->del_filter();
		}*/
        elseif(!empty($_POST['_wpnonce']) and wp_verify_nonce( $_POST['_wpnonce'],'woo_custom_filter-config_opt') ){

            $this->wcfw_sanitize();
            $this->config();            
        }
        elseif(!empty($_POST['_wpnonce']) and wp_verify_nonce( $_POST['_wpnonce'],'woo_custome_filter_target' )){

            $this->wcfw_sanitize();
            $this->filter_target();
        } elseif( 
            !empty($_POST['_wpnonce']) and wp_verify_nonce($_POST['_wpnonce'],'bulk-filters') && $_POST['eo_wcfw_action']==='bulk-filter-action'
        ){
            if($_POST['action']=='edit' || $_POST['action2']=='edit'){
                //edit save action here
                //$this->filter_bulk_edit();
            }   
            elseif ($_POST['action']=='delete' || $_POST['action2']=='delete') {                    
                //delete action here                  
                $this->filter_bulk_delete();
            }
        } elseif (            
            !empty($_GET['action']) 
            && $_GET['action']=='delete' 
            && !empty($_GET['eo_wcfw_action'])
            && $_GET['eo_wcfw_action']=='single_filter_delete'            
            && !empty($_GET['name'])
        ) {                    
            //delete action here                            
            $this->filter_single_delete();
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

	private function add_filter() {

        $filter_name=$_POST["filter_name"];
        $filter_type=$_POST["filter_type"];
        $filter_label=(!empty($_POST["filter_label"])?$_POST["filter_label"]:"");
        $filter_advanced=(!empty($_POST["filter_advanced"])?"1":"0");
        $filter_input=$_POST["filter_input"];
        $filter_dependent=(!empty($_POST["filter_dependent"])?"1":"0");
        $filter_width=$_POST["filter_width"];        
        $filter_order=$_POST["filter_order"];
        $filter_reset = (isset($_POST['filter_reset'])?"1":"0");

        $filter_icon_size = $_POST['filter_icon_size'];
        $filter_icon_font_size = $_POST['filter_icon_font_size'];

        $filter_child_filter = empty($_POST['filter_child_filter'])?'0':'1';
        $filter_child_label = $_POST['filter_child_label'];

        $filter_text_slider_prefix = $_POST['filter_text_slider_prefix'];
        
        $filter_data=unserialize(get_option('woo_custome_filter_widget',"a:0:{}"));
        if(!empty($filter_data)){
            foreach ($filter_data as $key=>$item) {
                
                if ($item['name']==$filter_name) {                 
                    add_action( 'admin_notices',function (){
                        echo "<div class='notice notice-warning is-dismissible'><p><strong>".__( 'Filter Already Exists.', 'woo-bundle-choice' )."</strong></p></div>";
                    });
                    return;
                }
            }
        }
        $data=array(
                        'name'=>$filter_name,
                        'type'=>$filter_type,
                        'label'=>$filter_label,
                        'advance'=>$filter_advanced,
                        'input'=>$filter_input,
                        'dependent'=>$filter_dependent,
                        'column_width' => $filter_width,                        
                        'order'=>$filter_order,
                        'reset'=>$filter_reset,
                    );
        
        if($filter_input == 'icon' || $filter_input == 'icon_text'){
            $data['icon_size'] = $filter_icon_size;
            $data['font_size'] = $filter_icon_font_size;
        }       

        if ($filter_child_filter == '1') {
            $data['child_label'] =$filter_child_label;
        }

        if($filter_input == 'numeric_slider') {
            $data['text_slider_prefix'] =$filter_text_slider_prefix;   
        }

        $filter_data[$filter_name] = $data;          
        update_option('woo_custome_filter_widget',serialize($filter_data)); 
        add_action( 'admin_notices',function (){
            echo "<div class='notice notice-success is-dismissible'><p><strong>".__( 'New Filter Added Successfully.', 'woo-bundle-choice' )."</strong></p></div>";
        });                    
	}
    /////////////////////////////////////////////////
    //Delete filters in bundle - { POST REQUEST }
    private function filter_bulk_delete(){
        
        if(!empty($_POST['cb'])){

            if(is_array($_POST['cb'])){
                foreach ($_POST['cb'] as $name) {
                    $this->filter_delete('woo_custome_filter_widget',$name);
                }
            } else {
                $this->filter_delete('woo_custome_filter_widget',$_POST['cb']);
            }
            add_action( 'admin_notices',function (){
                echo "<div class='notice notice-success is-dismissible'><p><strong>".__( 'Filter(s) Deleted Successfully.', 'woo-bundle-choice' )."</strong></p></div>";
            });
        }  
    }
    //Delete single map - { GET REQUEST }
    private function filter_single_delete(){
        
        $this->filter_delete('woo_custome_filter_widget',$_GET['name']);        
        add_action( 'admin_notices',function (){
            echo "<div class='notice notice-success is-dismissible'><p><strong>".__( 'Filter Deleted Successfully.', 'woo-bundle-choice' )."</strong></p></div>";
        });
        header('Location: '.admin_url('admin.php?page=woo-custome-filter-config&tab=shop_cat_opt'));
    }
    //Delete map function
    private function filter_delete($target,$filter){                       

        $filter_data=unserialize(get_option($target,"a:0:{}"));                
        foreach ($filter_data as $key=>$item) {
            
            if ($item['name']==$filter) {                 
                unset($filter_data[$key]);
            }
        }
        update_option($target,serialize($filter_data)); 
    }

    /////////////////////////////////////////////////

	private function del_filter() {

        $filter_data=unserialize(get_option('woo_custome_filter_widget',"a:0:{}"));                
        foreach ($filter_data as $key=>$item) {
            
            if ($item['name']==$_POST['del_filter_name']) {                 
                unset($filter_data[$key]);
            }
        }
        update_option('woo_custome_filter_widget',serialize($filter_data));
	}

    private function config(){
        if (
                isset($_POST['wcfw_config_opt_submit_text']) &&
                isset($_POST['wcfw_config_opt_submit_bg_color']) &&
                isset($_POST['wcfw_config_opt_submit_border_color']) &&
                isset($_POST['wcfw_config_opt_submit_font_color']) &&
                isset($_POST['wcfw_config_opt_submit_font_size']) &&
                isset($_POST['wcfw_config_opt_submit_padding']) &&
                isset($_POST['wcfw_config_opt_submit_inline_css']) &&
                isset($_POST['wcfw_config_opt_submit_additional_css']) &&
                isset($_POST['wcfw_config_opt_submit_url']) &&

                

                isset($_POST['wcfw_config_opt_dropdown_bg_color']) &&
                isset($_POST['wcfw_config_opt_dropdown_border_color']) &&
                isset($_POST['wcfw_config_opt_dropdown_font_color']) &&
                isset($_POST['wcfw_config_opt_dropdown_font_size']) &&
                isset($_POST['wcfw_config_opt_dropdown_padding']) &&
                isset($_POST['wcfw_config_opt_dropdown_inline_css']) &&
                isset($_POST['wcfw_config_opt_dropdown_additional_css'])

        ) {

            $config_data=array(
                'submit_text'=>$_POST['wcfw_config_opt_submit_text'],
                'submit_back_color'=>$_POST['wcfw_config_opt_submit_bg_color'],
                'submit_border_color'=>$_POST['wcfw_config_opt_submit_border_color'],
                'submit_font_color'=>$_POST['wcfw_config_opt_submit_font_color'],
                'submit_font_size'=>$_POST['wcfw_config_opt_submit_font_size'],
                'submit_padding'=>$_POST['wcfw_config_opt_submit_padding'],
                'submit_inline_css'=>$_POST['wcfw_config_opt_submit_inline_css'],
                'submit_add_css'=>$_POST['wcfw_config_opt_submit_additional_css'],
                'submit_url'=>$_POST['wcfw_config_opt_submit_url'],
                'flexible_filter'=>(isset($_POST['wcfw_config_opt_flexible_filter'])?1:0),

                'dropdown_back_color'=>$_POST['wcfw_config_opt_dropdown_bg_color'],
                'dropdown_border_color'=>$_POST['wcfw_config_opt_dropdown_border_color'],
                'dropdown_font_color'=>$_POST['wcfw_config_opt_dropdown_font_color'],
                'dropdown_font_size'=>$_POST['wcfw_config_opt_dropdown_font_size'],
                'dropdown_padding'=>$_POST['wcfw_config_opt_dropdown_padding'],
                'dropdown_inline_css'=>$_POST['wcfw_config_opt_dropdown_inline_css'],
                'dropdown_add_css'=>$_POST['wcfw_config_opt_dropdown_additional_css']                
            );
            
            update_option('woo_custome_filter_widget_config',serialize($config_data));
        }
    }

    private function filter_target() {
        
        $config_data=array(
            'page_shop'=>(isset($_POST['filter_target_shop'])?"1":"0"),
            'page_category'=>(isset($_POST['filter_target_category'])?"1":"0"),
            'cat_id'=>(empty($_POST['filter_target_cat'])?'':$_POST['filter_target_cat']),
            'add_css'=>$_POST['wcfw_shop_opt_submit_additional_css'],
            'show_tab'=>isset($_POST['filter_show_tab'])?"1":"0",
            'alternate_mobile'=>isset($_POST['filter_alternate_mobile'])?"1":"0",
            'preview_selected'=>isset($_POST['filter_preview_selected'])?"1":"0",
            'tab_first_cat'=>(!empty($_POST['filter_tab_first_cat'])?$_POST['filter_tab_first_cat']:''),
            'tab_first_label'=>(!empty($_POST['filter_tab_first_label'])?$_POST['filter_tab_first_label']:''),
            'tab_second_cat'=>(!empty($_POST['filter_tab_second_cat'])?$_POST['filter_tab_second_cat']:''),
            'tab_second_label'=>(!empty($_POST['filter_tab_second_label'])?$_POST['filter_tab_second_label']:'')
        );
        
        if(isset($_POST['filter_alternate_mobile'])){
            update_option('eo_wbc_alternate_mobile_filters',true);
        } else {
            update_option('eo_wbc_alternate_mobile_filters',false);
        }
        
        if(isset($_POST['filter_preview_selected'])){
            update_option('eo_wbc_preview_selected_filters',true);
        } else {
            update_option('eo_wbc_preview_selected_filters',false);
        }
        
        update_option('woo_custome_filter_target',serialize($config_data));           
    }
}
?>