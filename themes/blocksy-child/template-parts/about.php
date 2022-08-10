<?php
// Template Name: About us

get_header(); ?>



<main>
        <!-- my-breadcrumb section -->
        <section class="abt-sec">
            <div class="inner-abt">
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
        <section class="abt-ban">
            <div class="banner" style="background: url('<?php the_post_thumbnail_url();?>');">
                <div class="inner-abt-ban">
                    <div class="banner-content">
                        <!-- <h2>About me</h2>
                        <p>Vaishali J. Goswami is a Fine Art Professional and Art Educator. </p> -->
                        <?php the_content();   ?>
                    </div>
                </div>                
            </div>
        </section>
        <!-- hero end -->

        <!-- about section -->
        <section>
            <div class="about-the-artist">
            <?php
                $aboutartist = get_field('about_the_artist', get_the_ID());
                ?>
                <h2><?php echo $aboutartist['heading']; ?></h2>
                <p><?php echo $aboutartist['text']; ?>
                    </p>
            </div>
        </section>
        <!-- about end -->

        <!-- painting section -->
        <section class="printing-sec">
            <div class="inner-printing-sec">
                <?php $aboutpainting = get_field('about_the_painting', get_the_ID());
                ?>
                <div class="painting">
                    <h2><?php echo $aboutpainting['heading']; ?></h2>
                    <div class="my-row">
                        <div class="m-col-5">
                            <img src="<?php echo $aboutpainting['image']; ?>" alt="" class="img">
                        </div>
                        <div class="m-col-5 painting-text-c">
                            <div class="painting-text">
                                <p><?php echo $aboutpainting['text']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- painting end -->

        <!-- achievement section -->
        <section>
        <?php $achievment = get_field('acheivement', get_the_ID());
            ?>
            <div class="achievement">
                <h2><?php echo $achievment['heading']; ?></h2>
                <div class="my-row">
                    <div class="m-col-5 achievement-text-c">
                        <div class="achievement-text">
                            <p><?php echo $achievment['text']; ?></p>
                        </div>
                    </div>
                    <div class="m-col-5">
                        <img src="<?php echo $achievment['image']; ?>" alt="" class="img">
                    </div>
                </div>
            </div>

        </section>
        <!-- achievement end -->

        <!-- art journey section -->
        <section class="jrny-sec">
            <div class="inner-jrny-sec">
                <?php $artjourney = get_field('art_journey', get_the_ID());
                ?>
                <div class="artjrny">
                    <h2><?php echo $artjourney['heading']; ?></h2>
                    <div class="my-row">
                        <div class="m-col-5">
                            <img src="<?php echo $artjourney['image']; ?>" alt="" class="img">
                        </div>
                        <div class="m-col-5 artjrny-text-c">
                            <div class="artjrny-text">
                                <p><?php echo $artjourney['text']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- art journey end -->

        <!-- art mission section -->
        <section class="miss-sec">
            <div class="inner-miss-sec">
                <div class="about mission her-mission">
                    <?php $hermssion = get_field('her_mission', get_the_ID());
                    ?>
                    <div class="about-img">
                        <img src="<?php echo $hermssion['image']; ?>" alt="" class="img">
                    </div>
                    <div class="about-content artmission-content">
                        <div class="about-us art-mission">
                            <h3><?php echo $hermssion['heading']; ?></h3>
                            <p><?php echo $hermssion['text']; ?></p>
                        </div>
                    </div>
                </div>
            </div>            
        </section>
        <!-- art mission end -->

        <!-- art she says section -->
        <section>
        <?php $shesays = get_field('she_says', get_the_ID());
            ?>
            <div class="shesays">
                <h2><?php echo $shesays['heading']; ?></h2>
                <div class="my-row">
                    <div class="m-col-5 shesays-text-c">
                        <div class="shesays-text">
                            <p><?php echo $shesays['text']; ?></p>
                        </div>
                    </div>
                    <div class="m-col-5">
                        <img src="<?php echo $shesays['image']; ?>" alt="" class="img">
                    </div>
                </div>
            </div>

        </section>
        <!-- art she says end -->        

</main>











<?php get_footer(); ?>