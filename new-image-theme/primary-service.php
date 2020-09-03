<?php
/*
Template Name: Основные услуги
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
    <div class="primary-services-container <?php $post->post_name ?>">
        <div class="side left-side">
            <div class="left-side-header"><?php array_shift($paragraph_array[0]) ?></div>
            <div class="left-side-info">
                <?php 
                    foreach($paragraph_array[0] as $paragraph){
                        echo $paragraph;
                    }
                ?>
            </div>
            <div class="left-side-footer"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_blue.png' ?>" alt=""></div>
        </div>
        <div class="side right-side">
            <img src="<?php echo $img_url[0]["src"] ?>" alt="<?php echo $img_url[0]["alt"] ?>" title="<?php echo $img_url[0]["title"] ?>">
        </div>
    </div>
<?php get_footer('services'); ?>
