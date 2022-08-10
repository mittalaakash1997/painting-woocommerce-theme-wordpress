<?php
// Template Name: Commision Page

get_header(); ?>



<main>
        <!-- my-breadcrumb section -->
        <section class="commision-sec">
            <div class="inner-commision">
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
        <!-- hero section -->
        <section class="commision-ban">            
            <div class="banner" style="background: url('<?php the_post_thumbnail_url();?>');">
                <div class="inner-commision-ban">
                    <div class="banner-content">
                        <!-- <h2>About me</h2>
                        <p>Vaishali J. Goswami is a Fine Art Professional and Art Educator. </p> -->
                        <?php the_content();   ?>
                    </div>
                </div>                
            </div>
        </section>
        <!-- hero end -->
        <!-- section end -->
        
        <Section>
        <?php $sec1 = get_field('section_1', get_the_ID());
            ?>
            <div class="commision-p b-white">
                <h2><?php echo $sec1['heading']; ?></h2>
                <?php echo $sec1['content']; ?>
            </div>    
        </Section>
            
        <!-- section end -->
        <!-- section end -->
        
        <Section class="secc-2">
            <div class="inner-secc-2">
                <?php $sec2 = get_field('section_2', get_the_ID());
                ?>
                <div class="commision-p b-red">
                    <h2><?php echo $sec2['heading']; ?></h2>
                    <?php echo $sec2['content']; ?>
                </div> 
            </div>               
        </Section>
            
        <!-- section end -->
        
        <!-- section end -->
        
        <Section>
        <?php $sec3 = get_field('section_3', get_the_ID());
            ?>
            <div class="commision-p b-white">
            <h2><?php echo $sec3['heading']; ?></h2>
                <?php echo $sec3['content']; ?>
            </div>    
        </Section>
            
        <!-- section end -->
        <!-- section end -->
        
        <Section class="secc-4">
            <div class="inner-secc-4">
                <?php $sec4 = get_field('section_4', get_the_ID()); ?>
                <div class="commision-p b-yellow">
                <h2><?php echo $sec4['heading']; ?></h2>
                    <?php echo $sec4['content']; ?>
                </div> 
            </div>               
        </Section>
            
        <!-- section end -->
        <!-- section end -->
        
        <Section>
        <?php $sec5 = get_field('section_5', get_the_ID());
            ?>
            <div class="commision-p b-white">
            <h2><?php echo $sec5['heading']; ?></h2>
                <?php echo $sec5['content']; ?>
            </div>    
        </Section>
            
        <!-- section end -->
        <!-- section end -->
        
        <Section class="secc-6">
        <?php $sec6 = get_field('section_6', get_the_ID());
            ?>
            <div class="commision-p b-red">
            <h2><?php echo $sec6['heading']; ?></h2>
                <?php echo $sec6['content']; ?>
            </div>    
        </Section>
            
        <!-- section end -->
        <!-- section end -->
        
        <Section>
        <?php $sec7 = get_field('section_7', get_the_ID());
            ?>
            <div class="commision-p b-white">
            <h2><?php echo $sec7['heading']; ?></h2>
                <?php echo $sec7['content']; ?>
            </div>    
        </Section>
            
        <!-- section end -->
        <!-- section end -->
        
        <Section class="secc-8">
            <div class="inner-secc-8">
                <div class="commision-p b-yellow2">
                    <h2><?php the_field('gallery_slider_heading', get_the_ID());?></h2>
                    <?php if( have_rows('gallery_images', get_the_ID()) ):?>
                    <div class="owl-carousel commision-works" id="commisionwork">
                            <?php while( have_rows('gallery_images', get_the_ID()) ) : the_row();
                            $gimage= get_sub_field('image');
                            ?>
                        <div class="item">
                            <img src="<?php echo $gimage;?>" alt="">
                        </div>    
                        <?php endwhile; ?>              
                    </div>
                    <?php endif; ?>
                </div>
            </div>    
        </Section>
            
        <!-- section end -->






<?php get_footer(); ?>