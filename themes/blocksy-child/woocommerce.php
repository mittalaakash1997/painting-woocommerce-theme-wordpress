<?php get_header(); ?>

<main>
        <!-- my-breadcrumb section -->
        <section class="giclee-sec">
            <div class="inner-giclee-sec">
                <div class="my-breadcrumbs">
                    <!-- <ul class="my-breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li>Shop</li>
                    </ul> -->
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>            
        </section>
        <!-- my-breadcrumb end -->
        <section>
            
            <div class="my-woo-sec">
                <div class="center-text mb_50">
                <h2><?php echo single_term_title("", false); ?></h2>
                <p><?php echo term_description("", false); ?></p></div>
            <?php woocommerce_content(); ?>
            
            </div>
        </section>
        <?php if(is_product()){ ?>
            <section>
            <div class="gallery">
            <?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
            </div>
        </section>
       <?php } ?>

</main>

<?php get_footer(); ?>
<?php 
/*
[woo_custome_filter_begin]
[woo_custome_filter input='dropdown' id='32'  label='By Medium' type='0' node_type='Parent' parent_node=''  node_name='medium']
[woo_custome_filter input='dropdown' id='47'  label='By Genre' type='0' node_type='Parent' parent_node=''  node_name='genre']
[woo_custome_filter input='dropdown' id='40'  label='Painting Type' type='0' node_type='Parent' parent_node=''  node_name='painting-type']
[woo_custome_filter_end filter_size='3']
*/
?>