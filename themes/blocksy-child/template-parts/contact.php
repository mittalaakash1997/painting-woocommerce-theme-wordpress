<?php
// Template Name: Contact Page

get_header(); ?>



<main>
        <!-- my-breadcrumb section -->
        <section class="contact-sec">
            <div class="inner-contact">
                <div class="my-breadcrumbs">
                    <!-- <ul class="my-breadcrumb">
                        <li><a href="#">Home</a></li>
                        <li>About me</li>
                    </ul> -->
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>            
        </section>
        <!-- my-breadcrumb end -->
        <section>
            <div class="contactme">
                <div class="my-row">
                    <div class="m-col-5">
                    <?php $leftC = get_field('left_content', get_the_ID());
            ?>
                        <div class="contact-form">
                            <h2><?php echo $leftC['heading']; ?></h2>
                            <p><?php echo $leftC['content']; ?></p>
                            <?php echo do_shortcode('[wpforms id="156"]')?>
                        </div>
                    </div>
                    <div class="m-col-5">
                        <div class="cont-left">
                        <div class="contact-d">
                            <h2>connect with us</h2>
                            <?php if( have_rows('contact_detail', get_the_ID()) ):
                                while( have_rows('contact_detail', get_the_ID()) ) : the_row();
                                $icon= get_sub_field('icon');
                                $ctext= get_sub_field('text');?>
                            <div class="contact-detail">
                                <img src="<?php echo $icon;?>" alt="" class="contac-d"><p> <?php echo $ctext;?></p>
                            </div>
                            <?php endwhile; endif; ?>
                        </div>
                        <div class="contact-d1">
                            <div class="contact-detail">
                            <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/image/building.png" alt="" class="contac-d">
                            <h2 class="cont-h">office</h2>
                            </div>
                            <p><?php the_field('address', get_the_ID());?></p>
                            <a href="<?php the_field('google_map_link', get_the_ID());?>" class="g-map">View on Google Map <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>






        





<?php get_footer(); ?>