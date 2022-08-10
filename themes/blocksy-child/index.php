<?php

get_header(); ?>
<style>
.sidebar{
    width:30%;
    padding: 80px 20px;
    
}
.sidebar ul{
    list-style: none;
}
.sidebar .widget.widget_block{
    padding:20px;
    background-color:#e5fdff;
    margin-bottom:20px;
}
.sidebar a:hover{
    color:#ff9f00;
}
.clearboth{clear:both;}
.blog-c-ws {
    width: 70%;
    padding-right: 15px;
}
.blog-c-ws h2{
    /* margin-bottom:5px; */
}
</style>


<main>
        <!-- my-breadcrumb section -->
        <section class="abt-sec">
            <div class="inner-abt">
                <div class="my-breadcrumbs">
                    <?php woocommerce_breadcrumb(); ?>
                </div>
            </div>            
        </section>
        <?php $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1; ?> 
                     <?php $blog_posts = new WP_Query( 
                        array( 
                            'post_type' => 'post',
                             'post_status’' => 'publish',
			      'paged' => $paged,
                              'posts_per_page' => 12
                               )
                                ); ?> 
        
        <section class="blog-page">
            <div class="inner-blog my-row">
                <div class="blogs blog-c-ws">
                    <h2>blog</h2> 
                                 <?php if ( $blog_posts->have_posts() ) : ?> 
                    <div class="my-row">   
                    <?php while ( $blog_posts->have_posts() ) : $blog_posts->the_post(); 
                      $the_cat = get_the_category(); 
                      $category_name = $the_cat[0]->cat_name;                      
                      $category_link = get_category_link( $the_cat[0]->cat_ID );?>
                        <div class="m-col-3">
                            <div class="card"><a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url(); ?>" alt=""></a>
                                    <p class="date"><?php echo get_the_date(); ?> | <a href="<?php echo $category_link ?>"><?php echo $category_name; ?></a></p>
                                    <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?>
                                    </h4>
                                </a></div>
                        </div>
                        <?php endwhile; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php get_sidebar(); ?>
            </div>
        </section>

</main>


<!-- <div class="clearboth"></div> -->
<?php get_footer(); ?>
