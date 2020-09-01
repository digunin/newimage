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
    [$paragraph_array, $img_url] = get_text_and_image($content);
?>
<?php get_header(); ?>
    <section id="polygraphy1">
        <div class="primary-services-container">
            <div class="side left-side">
                <div class="left-side-header"><?php echo get_the_title(); ?></div>
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
            <img src="<?php echo $img_url[0]["src"] ?>" alt="<?php echo $img_url[0]["alt"] ?>" title="<?php echo $img_url[0]["title"] ?>">
            </div>
        </div>
    </section>
    <section id="polygraphy2">
        <div class="primary-services-container">
            <div class="side right-side poly2">
            <img src="<?php echo $img_url[1]["src"] ?>" alt="<?php echo $img_url[1]["alt"] ?>" title="<?php echo $img_url[1]["title"] ?>">
            </div>
        </div>
    </section>
<?php get_footer('services'); ?>