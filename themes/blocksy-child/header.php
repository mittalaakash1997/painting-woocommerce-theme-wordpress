<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SVA</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/assets/css/style.css">
</head>

<body <?php body_class(); ?>>


    <!-- header start -->
    <header>
        <div class="top-nav">
            <div class="top-inner-nav">
                <div class="my-row">
                    <div class="left">
                        <p><?php the_field('top_header_tag_line', 'option');?></p>
                    </div>
                    <div class="right">
                        <?php                                
                            $logged_in = is_user_logged_in();
                                            
                            if ($logged_in) {
                                                
                                ?> <a href="my-account" class="login">MY ACCOUNT</a> <?php
                                                
                            } else {
                                                
                                ?> <a href="my-account" class="login">LOGIN/REGISTER</a> <?php
                                
                            }                    
                        ?>
                        <!-- <a href="my-account" class="login">LOGIN/REGISTER</a> -->
                        <a href="cart" class="cart">CART</a>
                        <!-- <a href="#" class="lang">USD</a> -->
                        <div class="currency_code"><?php echo do_shortcode('[woocs sd=1]'); ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="my-navbar">
            <div class="my-row">
                <div class="logo">
                    <a href="<?php echo home_url();?>"><img src="<?php the_field('logo_image', 'option');?>" alt=""></a>
                </div>
                <button type="button" class="nav-toggler">
                    <span></span>
                </button>
                <nav class="my-nav">
                    <!-- <ul>
                        <li><a href="#">home</a></li>
                        <li><a href="#">about me</a></li>
                        <li><a href="#">shop</a></li>
                        <li><a href="#">services</a></li>
                        <li><a href="#">contact me</a></li>
                        <li><a href="#">faq</a></li>
                    </ul> -->
                    <?php
                        wp_nav_menu(
                        array(
                        'theme_location' =>'top-menu',
                        'menu_id' =>'top-menu',
                        'container' => 'ul'
                        )
                        );
                        ?>
                </nav>
            </div>
        </div>

    </header>
    <!-- header end -->