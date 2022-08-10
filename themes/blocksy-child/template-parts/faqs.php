<?php
// Template Name: Faqs

get_header(); ?>


<main>
    <!-- my-breadcrumb section -->
    <section class="faq-sec">
        <div class="inner-faq">
            <div class="my-breadcrumbs">
                <!-- <ul class="my-breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li>Faq's</li>
                </ul> -->
                <?php woocommerce_breadcrumb(); ?>
            </div>
        </div>        
    </section>
    <!-- my-breadcrumb end -->
    <!-- faqs -->
    <section>
        <div class="faq my-row">
            <div class="fab-bottom my-row">
                <div class="tab">
                    <div class="tab-btn">
                        <h2>faq categories</h2>
                        <?php 
                        if( have_rows('faqs_section', get_the_ID()) ):
                            $i = 1;
                        while( have_rows('faqs_section', get_the_ID()) ) : the_row();
                        $faqCat= get_sub_field('faq_category');
                        $faqID= get_sub_field('faq_category_name_without_space');
                     ?>
                        <button class="tablinks" onclick="openCity(event, '<?php echo $faqID;?>')" id="defaultOpen<?php echo $i;?>"><?php echo $faqCat;?></button>
                        <?php $i++; endwhile; endif; ?>
                        <!-- <button class="tablinks" onclick="openCity(event, 'Paris')" id="defaultOpen2">certificate</button>
                        <button class="tablinks" onclick="openCity(event, 'Tokyo')" id="defaultOpen3">purchase</button>
                        <button class="tablinks" onclick="openCity(event, 'Toky')" id="defaultOpen4">purchase</button> -->
                    </div>
                </div>
                <div class="tab-area">
                    <div class="tab-area-inner">
                        <h2>Certificate of authenticify Faq</h2>
                        <?php 
                        if( have_rows('faqs_section', get_the_ID()) ):
                            $i = 1;
                        while( have_rows('faqs_section', get_the_ID()) ) : the_row();
                        $faqID= get_sub_field('faq_category_name_without_space');
                        ?>
                        <div id="<?php echo $faqID;?>" class="tabcontent">
                            <ol>
                            <?php 
                        if( have_rows('faq_questions', get_the_ID()) ):
                        while( have_rows('faq_questions', get_the_ID()) ) : the_row();
                        $faqQ= get_sub_field('question');
                        $faqA= get_sub_field('answer');
                        ?>
                                <li class="faq-question">
                                    <h3><?php echo $faqQ;?></h3>
                                    <?php echo $faqA;?>
                                </li>
                                <?php $i++; endwhile; endif; ?>
                                <!-- <li class="faq-question">
                                    <h3>test</h3>
                                    <p>London is the capital city of EnglandLondon is the capital city of EnglandLondon
                                        is the capital city of England.</p>
                                    <p>London is the caLondon is the capital city of EnglandLondon is the capital city
                                        of Englandpital city of England.</p>
                                    <p>London is the cLondon is the capital city of EnglandLondon is the capital city of
                                        Englandapital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                </li>
                                <li class="faq-question">
                                    <h3>test</h3>
                                    <p>London is the capital city of EnglandLondon is the capital city of EnglandLondon
                                        is the capital city of England.</p>
                                    <p>London is the caLondon is the capital city of EnglandLondon is the capital city
                                        of Englandpital city of England.</p>
                                    <p>London is the cLondon is the capital city of EnglandLondon is the capital city of
                                        Englandapital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                </li> -->
                            </ol>
                        </div>
                        <?php $i++; endwhile; endif; ?>
                        <!-- <div id="Paris" class="tabcontent">
                            <ol>
                                <li class="faq-question">
                                    <h3>test</h3>
                                    <p>London is the capital city of EnglandLondon is the capital city of EnglandLondon
                                        is the capital city of England.</p>
                                    <p>London is the caLondon is the capital city of EnglandLondon is the capital city
                                        of Englandpital city of England.</p>
                                    <p>London is the cLondon is the capital city of EnglandLondon is the capital city of
                                        Englandapital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                </li>
                                <li class="faq-question">
                                    <h3>test</h3>
                                    <p>London is the capital city of EnglandLondon is the capital city of EnglandLondon
                                        is the capital city of England.</p>
                                    <p>London is the caLondon is the capital city of EnglandLondon is the capital city
                                        of Englandpital city of England.</p>
                                    <p>London is the cLondon is the capital city of EnglandLondon is the capital city of
                                        Englandapital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                </li>
                            </ol>
                        </div>
                        <div id="Tokyo" class="tabcontent">
                            <ol>
                                <li class="faq-question">
                                    <h3>test</h3>
                                    <p>London is the capital city of EnglandLondon is the capital city of EnglandLondon
                                        is the capital city of England.</p>
                                    <p>London is the caLondon is the capital city of EnglandLondon is the capital city
                                        of Englandpital city of England.</p>
                                    <p>London is the cLondon is the capital city of EnglandLondon is the capital city of
                                        Englandapital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                </li>
                                
                            </ol>
                        </div>
                        <div id="Toky" class="tabcontent">
                            <ol>
                                <li class="faq-question">
                                    <h3>test</h3>
                                    <p>London is the capital city of EnglandLondon is the capital city of EnglandLondon
                                        is the capital city of England.</p>
                                    <p>London is the caLondon is the capital city of EnglandLondon is the capital city
                                        of Englandpital city of England.</p>
                                    <p>London is the cLondon is the capital city of EnglandLondon is the capital city of
                                        Englandapital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                    <p>London is the capital city of England.</p>
                                </li>
                                
                            </ol>
                        </div> -->




                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- faqs end -->
</main>




<?php get_footer(); ?>