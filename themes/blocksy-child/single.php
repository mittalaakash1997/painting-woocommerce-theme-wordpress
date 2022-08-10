<?php

get_header(); 
the_post();

 $the_cat = get_the_category();
 
 $category_name = $the_cat[0]->cat_name;
 
 $category_link = get_category_link( $the_cat[0]->cat_ID );
 
 ?>
        <section class="abt-sec">
            <div class="inner-abt">
                <div class="my-breadcrumbs">
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>            
        </section>
        <section>
        <div class="my-row">
            <div class="commision blog-detail blogs blog-c-ws">
                <h2><?php the_title();?></h2>
                <p class="date"><?php echo get_the_date(); ?> | <a href="<?php echo $category_link ?>"><?php echo $category_name; ?></a></p>
               <img src="<?php the_post_thumbnail_url(); ?>" alt="">
               <?php the_content(); ?>
            </div>
            <?php get_sidebar(); ?>
        </div>

        </section>




<?php get_footer(); ?>