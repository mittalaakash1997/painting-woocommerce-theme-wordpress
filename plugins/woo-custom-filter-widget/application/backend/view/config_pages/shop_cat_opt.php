
	<?php
        wp_enqueue_script('wp-theme-plugin-editor');
        wp_enqueue_style('wp-codemirror');
    ?>

    <form name="woo_custome_filter_action_remove" method="post">
		<?php wp_nonce_field('woo_custome_filter_action_remove'); ?>
		<input type="hidden" name="del_filter_name" value="" id="del_filter_name">				
	</form>
    <style type="text/css">
        #woo_custome_filter_table_cat_shop_setting td{
            vertical-align: top !important;
        }
        .CodeMirror.cm-s-default.CodeMirror-wrap{
            height: 150px !important;
        }
    </style>
    <div class="wrap woocommerce">              
        <h3>Settings</h3>
        <form method="post" name="woo_custome_filter_target" >
            <?php 
                $filter_target_data=unserialize(get_option('woo_custome_filter_target',"a:0:{}"));            
            ?>
            <?php wp_nonce_field('woo_custome_filter_target'); ?>
            <table style="background-color: white; border-radius: 2px; margin-top:1.5em; padding: 1.5em;" id="woo_custome_filter_table_cat_shop_setting">
                <tr>
                    <td><strong>Filter Location</strong></td>
                    <td>                    
                        <input type="checkbox" name="filter_target_shop" id="filter_target_shop" value="shop" onclick="//document.getElementById('filter_target_select_cat').style.display='none'" <?php /*echo count($filter_target_data)&&$filter_target_data['page']!='category'?'checked="checked"':''*/ echo empty($filter_target_data['page_shop'])?'':'checked="checked"'; ?> ><label for="filter_target_shop">Shop Page</label>                    &nbsp;
                        <input type="checkbox" name="filter_target_category" id="filter_target_category" value="category" onclick="if(this.checked){document.getElementById('filter_target_cat').style.display='inline-block'} else { document.getElementById('filter_target_cat').style.display='none' }" <?php /*echo count($filter_target_data)&&$filter_target_data['page']=='category'?'checked="checked"':''*/ echo empty($filter_target_data['page_category'])?'':'checked="checked"'; ?> ><label for="filter_target_category">Category Page</label>

                        <select name="filter_target_cat" id="filter_target_cat" style="width: 100%;">
                            <?php echo __categories__(''); ?>                        
                        </select> 
                        <script>
                            jQuery(document).ready(function(){
                                var _ck = jQuery("#filter_target_category")
                                if(_ck[0].checked){
                                    document.getElementById('filter_target_cat').style.display='inline-block'
                                } else { 
                                    document.getElementById('filter_target_cat').style.display='none' 
                                }
                            });
                        </script>
                        <?php echo !empty($filter_target_data)&&$filter_target_data['page_category']?"<script>document.getElementById('filter_target_cat').style.display='inline-block';document.getElementById('filter_target_cat').value='".$filter_target_data['cat_id']."'</script>":'' ?>
                        <p style="color:grey">( Specify on which page you want to display filter, if you select category then you will be asked to select category on which you want to display the filter. )</p>
                        <br/>
                    </td>
                </tr>
                <tr>
                    <td><strong>Two Filters?</strong></td>
                    <td><input type="checkbox" value="1" name="filter_show_tab" <?php echo !empty($filter_target_data['show_tab'])?'checked="checked"':"" ?> />
                        <p style="color:grey;">( For some specific requirements you might want to display two filters on same page, the two filters function separately based on category, if you enable this option you will be asked to select dependent categories. )</p>
                        <br/>
                    </td>
                </tr>
                <tr class="filter_show_tab <?php echo !empty($filter_target_data['show_tab'])?'':"hidden" ?>">
                    <td><strong>First Category</strong></td>
                    <td>
                        <select name="filter_tab_first_cat" id="filter_tab_first_cat" style="width: 100%;">
                            <?php echo __categories__(''); ?>                        
                        </select> 
                        <p style="color:grey;">( The first category of the two different filters, please select the main category of which all attribute options and products you want to include in this filter's layout and search results. )</p>
                        <br/>
                    </td>
                </tr>
                <tr class="filter_show_tab <?php echo !empty($filter_target_data['show_tab'])?'':"hidden" ?>">
                    <td><strong>First Filter Title</strong></td>
                    <td><input type="text" value="<?php echo empty($filter_target_data['tab_first_label'])?'':$filter_target_data['tab_first_label']; ?>" name="filter_tab_first_label">
                        <p style="color: grey;">( The title text that is set to this filter's heading title. )</p>
                        </br>
                    </td>
                </tr>
                <tr class="filter_show_tab <?php echo !empty($filter_target_data['show_tab'])?'':"hidden" ?>">
                    <td><strong>Second Category</strong></td>
                    <td>
                        <select name="filter_tab_second_cat" id="filter_tab_second_cat" style="width: 100%;">
                            <?php echo __categories__(''); ?>                        
                        </select> 
                        <p style="color:grey;">( The second category of the two different filters, please select the main category of which all attribute options and products you want to include in this filter's layout and search results. )</p>
                        </br>
                    </td>
                </tr>
                <tr class="filter_show_tab <?php echo !empty($filter_target_data['show_tab'])?'':"hidden" ?>">
                    <td><strong>Second Filter Title</strong></td>
                    <td><input type="text" value="<?php echo empty($filter_target_data['tab_second_label'])?'':$filter_target_data['tab_second_label']; ?>" name="filter_tab_second_label"><p style="color: grey;">( The title text that is set to this filter's heading title. )</p></br></td>
                </tr>
                <tr>
                    <td><strong>Alternate Mobile View?</strong></td>
                    <td>
                        <input type="checkbox" value="1" name="filter_alternate_mobile" <?php echo !empty($filter_target_data['alternate_mobile'])?'checked="checked"':"" ?> />
                        <p style="color: grey;">( Enable this option if you want to use alternate mobile UI which is quite suitable for mobile layout. )</p>
                        <br/></td>
                </tr>
                <tr>
                    <td><strong>Selected Filters?</strong></td>
                    <td><input type="checkbox" value="1" name="filter_preview_selected" <?php echo !empty($filter_target_data['preview_selected'])?'checked="checked"':"" ?> /><p style="color: grey;">( Enable this option if you want to show in a line all selected filters with an option to remove them. )</p><br/><br/></td>
                </tr>               
                
                <tr style="/*display: none;*/">
                    <td><strong>Want Sample Filters?&nbsp;&nbsp;</strong></td>
                    <td>                    
                        <span class="button secondry" onclick="window.location.href=window.location.href+'&automation_product_install=1'">Add sample filter data</span>
                        <span class="button secondry" onclick="window.location.href=window.location.href+'&automation_product_remove=1'">Remove sample data</span>
                        <p style="color: grey;">( If you want to see sample filters with sample data the please click add button above, you can select what sample data you want to add in the next step and later you can remove sample data by clicking "Remove sample data" button above. After adding sample data visit this <a href="<?php echo get_permalink( get_page_by_path( 'filter-widget-page' ) ); ?>" target="_blank">sample page</a> to see it in action! )</p>
                        </br>
                    </td>                    
                </tr>
                <tr>
                    <td><strong>CSS for Custom Styling</strong></td>
                    <td class="forminp">                                                        
                        <textarea name="wcfw_shop_opt_submit_additional_css" rows="2" id="wcfw_shop_opt_submit_additional_css" data-init="1" style="border: 1px solid #ddd;"><?php echo $filter_target_data?@$filter_target_data['add_css']:'' ?></textarea>  
                        <script>                                 
                            jQuery(document).ready(function($) {     
                                var cm_settings=<?php echo json_encode(array('codeEditor' =>wp_enqueue_code_editor(array('type' => 'text/css')))); ?>                              
                                wp.codeEditor.initialize($('#wcfw_shop_opt_submit_additional_css'), cm_settings); 
                            });
                        </script>
                        <p style="color: grey;">( Specify your custom CSS for the custom styling, you can override any class of any element of the filter layout to achieve styling of your choice. )</p>
                        </br>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>                             
                    <td><input type="submit" value="Save" class="submit button-primary" name="Submit"></td>
                </tr>
            </table>                                                
        </form>

        <h3 style="margin-bottom: 0px;margin-top: 2em;">Add Filter Fields</h3>	
		<style type="text/css">
            #add_filter_first_table td{
                vertical-align: top !important;
            }      
        </style>
        <?php require_once 'filter_table.php'; ?>
        <div style="border: 1px solid black;padding:3em;" class="boxed-container">
            <form target="_self" action="" method="post">               
                <?php
                    
                    $ob=new EO_WCFW_Filter_Table();
                    $ob->prepare_items();
                    $ob->display();
                ?>                  
                <input type="hidden" name="eo_wcfw_action" value="bulk-filter-action">
            </form>
            <br/><br/>
            <form method="POST" name="add_filter_first">
                <?php echo wp_nonce_field('woo_custome_filter_action_add'); ?>
                <input type="hidden" name="eo_wcfw_action" value="bulk-filter-add">                
                <table style="width: 100%;background-color: #f9f9f9;" id="add_filter_first_table">
                    <tbody>
                        <tr  class="form-filter-td">                            
                            <td><?php _e("Filter") ?></td>                            
                            <td>                
                                <select name="filter_name" data-group='first' onchange="document.getElementById('filter_type_first').value=this.options[this.selectedIndex].getAttribute('data-type')">
                                    <?php echo __categories__(''); ?>
                                    <?php echo __attributes__(); ?>
                                </select>
                                <input type="hidden" name="filter_type" value="0" data-group='first' id="filter_type_first">
                                <p style="color: grey;">( Select category or attribute on which this filter field should do the searching. )</p>
                            </td>                           
                        </tr>
                        <tr class="form-filter-td">
                            <td><?php _e("Label"); ?>(optional)</td>
                            <td>
                                <input type="text" name="filter_label"/>
                                <p style="color: grey;">( Label text to display on website for this filter field. )</p>
                            </td>
                        </tr>
                        <tr class="form-filter-td">
                            <td><?php _e("Is advanced filter option?");?> (optional)</td>
                            <td>
                                <input type="checkbox" name="filter_advanced" class="form-input">
                                <p style="color: grey;">( If this option is selected this field will be placed in advanced section )</p>
                            </td>
                        </tr>
                        <tr class="form-filter-td">      
                            <td><?php _e("Column Width");?></td>
                            <td>
                                <input type="number" name="filter_width" class="form-input" style="width: 5em;" value="50" step="6.25" min="6.25" max="100">%
                                <p style="color: grey;">( Width of the field area in filter layout. )</p>
                            </td>                            
                        </tr>
                        <tr class="form-filter-td">
                            <td><?php _e("Ordering"); ?></td>
                            <td>
                                <input type="number" step="1" name="filter_order" value="0" placeholder="Numeric" style="width: 3em;">
                                <p style="color: grey;">( Display order of the filter fields. )</p>
                            </td>                            
                        </tr>
                        <tr class="form-filter-td">
                            <td><?php _e("Input Type"); ?></td>
                            <td>
                                <select name="filter_input" data-group='first' data-ificon-action=".icon-config-first">
                                    <option value="icon"><?php _e("Icon Only"); ?></option>
                                    <option value="icon_text"><?php _e("Icon and Text"); ?></option>
                                    <option value="numeric_slider"><?php _e("Numeric slider"); ?></option>
                                    <option value="text_slider"><?php _e("Text slider"); ?></option>
                                    <option value="checkbox"><?php _e("Checkbox"); ?></option>
                                </select>
                                <p style="color: grey;">( Select the type of input field that you want to display for e.g. if you select dropdown, a dropdown box will appear on your website. )</p>
                                <script type="text/javascript">
                                jQuery(document).ready(function($){
                                    $("[name='filter_input'][data-group='first']").on('change',function(){
                                        _value = $(this).val()
                                        console.log(_value);
                                        if( _value == 'icon'){
                                            
                                            $($(this).attr('data-ificon-action')).css('visibility','hidden');

                                            $($(this).attr('data-ificon-action')+'.config-icon').css('visibility','visible');
                                            $($(this).attr('data-ificon-action')+'.config-child').css('visibility','visible');

                                        } else if(_value == 'icon_text' ){
                                            $($(this).attr('data-ificon-action')).css('visibility','hidden');            
                                            $($(this).attr('data-ificon-action')+'.config-icon').css('visibility','visible');
                                            $($(this).attr('data-ificon-action')+'.config-label').css('visibility','visible');
                                            $($(this).attr('data-ificon-action')+'.config-child').css('visibility','visible');
                                        }
                                        else {
                                            $($(this).attr('data-ificon-action')).css('visibility','hidden');
                                            $($(this).attr('data-ificon-action')+'.config-child').css('visibility','hidden');   
                                        }
                                    });
                                })
                                </script>
                            </td>
                        </tr>
                        <tr  class="form-filter-td icon-config-first config-icon">
                            <td><?php _e("Icon size") ?></td>
                            <td>
                                <input type="text" name="filter_icon_size" value="45px"/>
                            </td>                            
                        </tr>
                        <tr class="form-filter-td icon-config-first config-label">         
                            <td><?php _e("Icon label size") ?></td>
                            <td>
                                <input type="text" name="filter_icon_font_size" value="0.78571429rem"/>
                                <p style="color: grey;">( When you select icon input type with text, use this field to specify font size of the text. )</p>
                            </td>
                        </tr>
                        <tr class="form-filter-td">                    
                            <td><label>Add reset action? (optional)</label></td>
                            <td>
                                
                                <input type="checkbox" value="1" name="filter_reset"/>
                            </td>
                        </tr>
                        <tr class="form-filter-td icon-config-first config-child">
                            <td><?php _e("Child filter?") ?> (optional)</td>
                            <td>
                                <input type="checkbox" name="filter_child_filter" value="1" onclick="this.checked?jQuery('.config_child_label').css('visibility','visible'):jQuery('.config_child_label').css('visibility','hidden');" />
                                <p style="color: grey;">( Mark this filter for dependency based filtering. )</p>
                            </td>
                        </tr>
                        <tr class="form-filter-td icon-config-first config_child_label" style="visibility: hidden;">
                            <td><?php _e("Child label") ?></td>
                            <td>
                                <input type="text" name="filter_child_label" value=""/>
                                <p style="color: grey;">( Label text to display on website for the child filter field. )</p>
                            </td>
                        </tr>
                        <tr class="form-filter-td filter_text_slider_prefix" style="visibility: hidden;">
                            <td><label>Label Postfix</label></td>
                            <td>
                                <input type="text" value="mm" name="filter_text_slider_prefix"/>
                            </td>
                        </tr> 
                        <tr class="form-filter-td">
                            <td>&nbsp;</td>
                            <td><input type="submit" value="<?php _e("Save"); ?>" class="submit button-primary" name="Submit"></td>
                        </tr>                      
                    </tbody>
                </table>                                                
            </form>
            <div data-group="first" class="icon_msg" style="display:none;">
                <p><strong>Since you want to use icons with attributes filter this plugin will enable icon option for attributes on woocommerce page, so please set icons from there.</strong></p>
            </div>
        </div>

	</div>

<script>
    jQuery(document).ready(function($){        
        jQuery("[name='filter_show_tab']").on('click',function(){
            if(this.checked){
                jQuery(".filter_show_tab").removeClass('hidden');
            } else {
                jQuery(".filter_show_tab").addClass('hidden');
            }
        });

        $("#filter_tab_first_cat").val("<?php echo empty($filter_target_data['tab_first_cat'])?'':$filter_target_data['tab_first_cat']; ?>");
        $("#filter_tab_second_cat").val("<?php echo empty($filter_target_data['tab_second_cat'])?'':$filter_target_data['tab_second_cat']; ?>")
        //jQuery(".popup").popup({transition:'Horizontal Flip'});
        $('[name="filter_input"]').on('change',function(){
            if($(this).val() == 'numeric_slider') {
                $("#filter_text_slider_prefix").css('visibility','visible');
            } else {
                $("#filter_text_slider_prefix").css('visibility','hidden');
            }
        });

        $('[name="filter_name"],[name="filter_input"]').on('change',function(){

            /*group = jQuery(this).attr('data-group');
            console.log(group);*/
            
            /*jQuery('.icon_msg[data-group="'+group+'"]').css('display','none');

            if($('[name="filter_type"][data-group="'+group+'"]').val()==1 && ($('[name="filter_input"][data-group="'+group+'"]').val() == 'icon' || $('[name="filter_input"][data-group="'+group+'"]').val() == 'icon_text')){
                jQuery('.icon_msg[data-group="'+group+'"]').css('display','block');
            }*/

            jQuery('.icon_msg').css('display','none');

            if($('[name="filter_type"]').val()==1 && ($('[name="filter_input"]').val() == 'icon' || $('[name="filter_input"]').val() == 'icon_text')){
                jQuery('.icon_msg').css('display','block');
            } 
        });
    });
</script>