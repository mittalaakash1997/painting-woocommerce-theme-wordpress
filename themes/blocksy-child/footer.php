<footer>
        <div class="footer">
            <div class="my-row">
                <div class="m-col-5">
                    <img src="<?php the_field('footer_logo_image', 'option');?>" alt="">
                    <h4><?php the_field('newsletter_form_heading', 'option');?></h4>
                    <p><?php the_field('newsletter_form_text', 'option');?></p>
                    <?php echo do_shortcode('[wpforms id="157"]')?>
                </div>
                <div class="m-col-4">
                    <h4>navigation</h4>
                    <!-- <ul class="footer-nav">
                        <li><a href="#">home</a></li>
                        <li><a href="#">about me</a></li>
                        <li><a href="#">shop</a></li>
                        <li><a href="#">services</a></li>
                        <li><a href="#">contact me</a></li>
                        <li><a href="#">faq</a></li>
                        <li><a href="#">testimonial</a></li>
                    </ul> -->
                    <?php
                        wp_nav_menu(
                        array(
                        'theme_location' =>'footer-menu',
                        'menu_id' =>'main-menu-2',
                        'container' => 'ul',
                        'menu_class' => 'footer-nav'
                        )
                        );
                        ?>
                </div>
                <div class="m-col-4">
                    <h4 class="mb-10">follow us</h4>
                    <a href="<?php the_field('facebook_url', 'option');?>" class="buy"><i class="fa fa-facebook" aria-hidden="true"></i>facebook</a>
                    <a href="<?php the_field('instagram_url', 'option');?>" class="buy"><i class="fa fa-instagram" aria-hidden="true"></i>instagram</a>
                </div>
            </div>
            <div class="my-row footer-copyright">
                <div class="m-col-5">
                    <p class="copyright">© Copyright 2021 STUDIO VAISHALI ARTS. All rights reserved.</p>
                </div>
                <div class="m-col-5">
                    <a href="#" class="cookie">terms & conditions</a>
                    <a href="#" class="cookie">privacy policy</a>
                </div>
            </div>
        </div>

    </footer>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/jquery.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/owl.carousel.min.js"></script>
<script src="<?php echo get_stylesheet_directory_uri();?>/assets/js/custom.js"></script>

    <script>
            // $(".nav-toggler").click(function(){
            // $(".my-nav").toggle(400);
            // });

    </script>
    
    <?php wp_footer(); ?>
</body>

</html>