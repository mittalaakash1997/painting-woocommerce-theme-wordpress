<?php get_header(); ?>
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
            <div class="about-the-artist">
            <?php the_content();   ?>
            </div>
        </section>

    </main>


    <?php get_footer(); ?>