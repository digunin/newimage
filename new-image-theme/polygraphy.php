<?php
/*
Template Name: Полиграфия
*/
?>
<?php
    global $post; 
    $content = get_the_content(); 
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]>', $content );
    [$paragraph_array, $img_set] = get_text_and_image($content);
?>
<?php get_header(); ?>
    <section id="polygraphy1">
        <div class="primary-services-container">
            <div class="side left-side">
                <div class="left-side-header"><?php echo array_shift($paragraph_array[0]) ?></div>
                <div class="left-side-info">
                <?php 
                    foreach($paragraph_array[0] as $paragraph){
                        echo $paragraph;
                    }
                ?>   
                </div>
                <div class="left-side-footer"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_blue.png'?>" alt=""></div>
            </div>
            <div class="side right-side poly1">
                    <?php print_img_tag($img_set[0][0]); ?>
            </div>
        </div>
    </section>
    <section id="polygraphy2">
        <div class="primary-services-container">
            <div class="side right-side poly2">
                <?php print_img_tag($img_set[0][1]); ?>
            </div>
        </div>
    </section>
<?php get_footer('services'); ?>