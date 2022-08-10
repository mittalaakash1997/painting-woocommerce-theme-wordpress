<?php
// Template Name: Shop Page

get_header(); ?>



<main>
        <!-- my-breadcrumb section -->
        <section>
            <div class="my-breadcrumbs">
                <!-- <ul class="my-breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>About me</li>
                   
                </ul> -->
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </section>
        <!-- my-breadcrumb end -->
        <section>
            <div class="my-woo-sec">
           <h1 class="text_center"><?php the_title(); ?></h1>
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; else: endif; ?>
            </div>
        </section>
        <?php if(is_cart()){ ?>
            <section>
            <div class="gallery">
            <?php
		// do_action( 'woocommerce_after_cart_totals' );
        woocommerce_cross_sell_display(3);
	?>
            </div>
        </section>
       <?php } ?>





<?php get_footer(); ?>