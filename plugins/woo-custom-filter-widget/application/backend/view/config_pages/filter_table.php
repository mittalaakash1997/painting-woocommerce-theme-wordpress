<?php 
if (!defined('ABSPATH')) exit;

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );    
}

if(!class_exists('EO_WCFW_Filter_Table')){
	
	class EO_WCFW_Filter_Table extends WP_List_Table{
		
		public function __construct(){

			 parent::__construct([
	                        'singular' => 'filter', 
	                        'plural'   => 'filters', 
	                        'ajax'     => false 
                        ]);
		}
		
		public function get_filters(){

			$filters_data=unserialize(get_option('woo_custome_filter_widget',"a:0:{}"));

			$_rows=array();

        	if(count($filters_data)>0){

            	foreach ($filters_data as $key=>$item) {

            		if(is_object($item)){
            			$item=(array)$item;           
            		}            		            
            		
                    $item_name=FALSE;
                    $item_name=@wc_get_attribute($item['name']);

                    if(!empty($item_name) and !is_wp_error($item_name)) {
                        $item_name=$item_name->name;
                    }
                    else{
                        $item_term=@(get_term_by('id',$item['name'],'product_cat'));
                    
                        if(is_array($item_term)){
                            $item_name=$item_term['name'];  
                        }
                        elseif (is_object($item_term)) {
                            $item_name=$item_term->name;    
                        }    
                    }

            		$_rows[]=array( 'id'=>$item['name'],
            						'filter'=>$item_name,
            						'label'=>$item['label'],
            						'type'=>($item['advance']=='1'?__('Yes'):__('No')),
            						'input'=>$item['input'],
                                    'column_width'=>( empty($item['column_width'])? '0%' : $item['column_width'].'%' ),
                                    'order'=>empty($item['order'])?'0':$item['order']
            					);                    
            	}
            	return $_rows;
            } else {
	        	return array();
	        }                     
		}

		function no_items(){
			echo "<span>".__("No filter(s) exists, please add some filters.",'woo-bundle-choice')."</span>";
		}

		function column_cb($item) {
			
			$actions = array(
		        /*'edit'      => sprintf('<a href="?page=%s&action=%s&map=%s&eo_wbc_action=single_map">Edit</a>',$_REQUEST['page'],'edit',$item['id']),*/
		        'delete'    => sprintf('<a href="?page=%s&&tab=shop_cat_opt&action=%s&name=%s&eo_wcfw_action=%s">'.__('Delete','woo-bundle-choice').'</a>',$_REQUEST['page'],'delete',$item['id'],'single_filter_delete'),
		    );

	        return sprintf('<span><input type="checkbox" name="cb[]" value="%1s" /></span><div style="width: max-content;">%2s</div>', $item['id'],$this->row_actions($actions));    
	    }
	

		//get list of columns to label on the table's top and bottom.
        function get_columns(){
          $columns = array(        
          	'cb'=>'<input type="checkbox" />',    
            'filter'    => __('Filter','woo-bundle-choice'),
            'label'   => __('Label','woo-bundle-choice'),
            'type'=>__('Advance filter','woo-bundle-choice'),
            'input'=>__('Input type','woo-bundle-choice'),
            'column_width'=>__('Column Width','woo-bundle-choice'),
            'order'=>__('Ordering','woo-bundle-choice')
          );
          return $columns;
        }
     
        //make data ready to be shown.
        function prepare_items() {
          	$columns = $this->get_columns();
            
        	$hidden = array();
    	    $sortable = array();

	        $this->_column_headers = array($columns, $hidden, $sortable);          

          	$data=$this->get_filters();

		  	$per_page = 5;
		  	$current_page = $this->get_pagenum();            
            if(is_array($data) || is_object($data)){
                $total_items = count($data);    
            }		  	
		  	
		  	// only ncessary because we have sample data
		  	/*if(is_array($data)){
		  		$data = array_slice($data,(($current_page-1)*$per_page),$per_page);	
		  	}*/
		  	
		  	/*$this->set_pagination_args( array(
			    'total_items' => $total_items,                  //WE have to calculate the total number of items
		    	'per_page'    => $per_page                     //WE have to determine how many items to show on a page
		  	) );*/

		  	$this->items =$data;
          
        }
        
        function column_default( $item, $column_name ) {
              switch( $column_name ) { 
                case 'filter':                    
                case 'label':
                case 'type':     
                case 'input':   
                case 'column_width': 
                case 'order':                           
                  return $item[ $column_name ];
                default:
                  return print_r( $item, true ) ; //Show the whole array for troubleshooting purposes
            }
        }

        function get_bulk_actions() {
		  $actions = array(
		    'delete'    => __('Delete','woo-bundle-choice'),
		    /*'edit'    => 'Edit'*/
		  );
		  return $actions;
		}
	}
}