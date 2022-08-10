<?php
class WOO_CUSTOME_FILTER_Config
{   
    public function __construct()
    {
        $this->menu();        
    }
    public function menu()
    {           
        require_once 'admin_service_attr_icons.php';        
        add_action('admin_menu',function(){
            
            add_menu_page('Woo Custom Filter Widget','Woo Custom Filter Widget','administrator','woo-custome-filter-config',function(){   
                if(isset($_GET) && !empty($_GET['automation_product_install'])) {

                    require_once apply_filters('woo_custome_filter_automation','WOO_CUSTOME_FILTER_Auto.php');
                } elseif (isset($_GET) && !empty($_GET['automation_product_remove'])) {
                    require_once apply_filters('woo_custome_filter_cleanup','WOO_CUSTOME_FILTER_AutoClean.php');
                } else {
                    require_once apply_filters('woo_custome_filter_backview','view/WOO_CUSTOME_FILTER_BackView.php');    
                }                
            });                            
            
        },11);        
    }
}