<?php
// Template Name: Testimonial

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

    <!-- testimonial section -->
    <section>
            <div class="testimonial">
                <h2><?php the_field('testimonial_heading', get_the_ID());?></h2>
                
                <?php 
       if( have_rows('testimonial', get_the_ID()) ):
       while( have_rows('testimonial', get_the_ID()) ) : the_row();
       $timage= get_sub_field('client_image');
       $tdesc= get_sub_field('feedback');
       $tname= get_sub_field('client_name');
       $tlocation= get_sub_field('location');
    ?>
                <div class="testi-outer">
                    <div class="my-row">
                        <div class="m-col-3"><img src="<?php echo $timage;?>" alt="" class="img"></div>
                        <div class="m-col-7">
                            <div class="testimonial-content">
                                <img src="<?php echo get_stylesheet_directory_uri();?>/assets/image/star.png" alt="" class="star">
                                <p class="testi-text">“<?php echo $tdesc;?>” </p>
                                <div>
                                    <p class="testi-name">~<?php echo $tname;?></p>
                                    <p class="testi-location"><?php echo $tlocation;?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile; endif; ?>
                
            </div>
        </section>
        <!-- testimonial end -->
       

</main>








        <?php get_footer(); ?>