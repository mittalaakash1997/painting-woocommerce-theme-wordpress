<?php
// Template Name: My Account

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
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile; else: endif; ?>
            </div>
        </section>






<?php get_footer(); ?>