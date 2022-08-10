<?php get_header(); ?>
    <main>
        <!-- slider section -->
        <?php 
       if( have_rows('slider_details', get_the_ID()) ):?>
        <section class="slider">
            <div class="owl-carousel owl-carousel1" id="owl-1">
                <?php while( have_rows('slider_details', get_the_ID()) ) : the_row();
                $Simage= get_sub_field('slider_image');
                $Sheading= get_sub_field('slider_heading');
                $Stext= get_sub_field('slider_text');
                $Slink= get_sub_field('product_link');                
                ?>
                
                <div class="item" style="background: url('<?php echo $Simage;?>');">
                    <div class="mx-width">
                        <div class="item-content">
                            <h2><?php echo $Sheading;?></h2>
                            <p><?php echo $Stext;?></p>
                            <?php if( $Slink ):?>
                            <a href="<?php echo $Slink;?>" class="buy">Buy now</a>
                            <?php endif; ?>
                        </div>
                    </div>                    
                </div>
                <?php endwhile; endif; ?>
                
            </div>
        </section>
        <!-- slider end -->

        <!-- product slider -->
        <section>
            <div class="feature-collection">
                <h2><?php the_field('section_2_heading_featured_products', get_the_ID());?></h2>
                <div class="owl-carousel owl-carousel2" id="owl-2">
                <?php
                $args = array(
                    'post_type' => 'product',
                    'posts_per_page' => 6
                );
                $loop = new WP_Query( $args );
                if ( $loop->have_posts() ) {
                    while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="item f-product">
                            <?php wc_get_template_part( 'content', 'product' ); ?>
                        </div>
                        <?php endwhile;
                    } else {
                        echo __( 'No products found' );
                    }
                    wp_reset_postdata();?>
                                        
                </div>
            </div>
        </section>
        
        <!-- about me -->
        <section class="about-sec">
            <div class="inner-about">
                <div class="about about-rs">
                    <?php
                    $about = get_field('about_me_section', get_the_ID());
                    ?>
                    <div class="about-img my-png">
                        <img src="<?php echo $about['about_me_image'];?>" alt="">
                    </div>
                    <div class="about-content">
                        <div class="about-us">
                            <h3><?php echo $about['title'];?></h3>
                            <p><?php echo $about['text_detail'];?> </p>
                            <img src="<?php echo $about['signature_image'];?>" alt="">
                            <?php if( $about['button_link'] ):?>
                            <a href="<?php echo $about['button_link'];?>"><?php echo $about['button_text'];?></a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- about me end -->

        <!-- commision works -->
        <section>
            <div class="commision">
            <?php
                $commision = get_field('commision_works_section', get_the_ID());
                ?>
                <h2><?php echo $commision['title'];?></h2>
                <div class="my-row">
                    <div class="m-col-5 commision-text-c">
                        <div class="commision-text">
                        <?php echo $commision['description'];?>
                            <?php if( $commision['button_link'] ):?>
                        <a href="<?php echo $commision['button_link'];?>"><?php echo $commision['button_text'];?></a>
                        <?php endif; ?>
                        </div>
                    </div>
                    <div class="m-col-5">
                        <img src="<?php echo $commision['image'];?>" alt="">
                    </div>
                </div>
            </div>

        </section>
        <!-- commision works end -->
        <!-- gallery section -->
        <!--<section class="gall-sec">-->
        <!--    <div class="inner-gall">-->
        <!--        <div class="gallery">-->
        <!--            <img src="<?php //the_field('gallery_image', get_the_ID());?>" alt="">-->
        <!--        </div>-->
        <!--    </div>            -->
        <!--</section>-->
        <!-- gallery section end -->
        <!-- resources end -->
        <!--<section>-->
        <!--    <div class="resources">-->
           <?php
                //$resources = get_field('free_resources', get_the_ID());
              ?>
        <!--        <h2><?php //echo $resources['title'];?></h2>-->
        <!--        <div class="my-row">-->
        <!--            <div class="m-col-5">-->
        <!--                <img src="<?php //echo $resources['image'];?>" alt="">-->
        <!--            </div>-->
        <!--            <div class="m-col-5 resources-text-c">-->
        <!--                <div class="resources-text">-->
        <!--                    <h3> <?php //echo $resources['title_2'];?></h3>-->
        <!--                    <?php //echo $resources['description'];?>-->
        <!--                    <?php //if( $resources['button_link'] ):?>-->
        <!--                    <a href="<?php //echo $resources['button_link'];?>" class="buy"><?php //echo $resources['button_text'];?></a>-->
        <!--                    <?php //endif; ?>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </div>-->
        <!--    </div>-->

        <!--</section>-->
        <!-- resources end -->
        <!-- blog section -->
                    <?php $blog_posts = new WP_Query( 
                        array( 
                            'post_type' => 'post',
                             'post_status’' => 'publish',
                              'posts_per_page' => 4
                               )
                                ); ?> 
        <section class="blog-sec">
            <div class="inner-blog">
                <div class="blogs">
                    <h2>Featured blog</h2> 
                              
                    <?php if ( $blog_posts->have_posts() ) : ?> 
                    <div class="my-row">   
                    <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); ?>
                        <div class="m-col-4">
                            <div class="card"><a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt="">
                                    <p class="date"><?php echo get_the_date(); ?></p>
                                    <h4><?php the_title(); ?>
                                    </h4>
                                </a></div>
                        </div>
                        <?php endwhile; wp_reset_postdata();?>
                    </div>
                    <?php endif;?>
                    <?php $link = get_field('blogs_link');
                            ?>
                    <a href="<?php echo $link; ?>" class="buy">View blog</a>
                    <?php //endif; ?>
                </div>
            </div>
        </section>
        <!-- blog section end -->


    </main>


    <?php get_footer(); ?>