<?php
/*
Template Name: Дополнительные услуги
*/
?>
<?php
    the_post();
    $content = get_the_content(); 
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]>', $content );
    $text_and_images = get_text_and_image($content);
    $paragraph_array = $text_and_images[0];
    $img_set = $text_and_images[1];
?>
<?php get_header(); ?>
    <div class="container">
        <div class="content">
            <div class="content-info">
                <h2 class="content-header"><?php echo array_shift($paragraph_array[0]); ?></h2>
                <div class="content-text">
                <?php
                    foreach($paragraph_array[0] as $paragraph){
                        echo $paragraph;
                    }
                ?>
                </div>
            </div>
            <?php if($post->post_name == "plotter"){
                echo '<div class="content-info">';
                echo '<h2 class="content-header">'.array_shift($paragraph_array[1]).'</h2>';
                echo '<div class="content-text">';
                foreach($paragraph_array[1] as $paragraph){
                    echo $paragraph;
                };
                echo '</div>';
                echo '</div>';
            }else{
                print_footer_with_images($post->post_name, $img_set[0]);
            };
            ?>
            
        </div>
        <?php print_sidebar(); ?>
    </div>
<?php get_footer('services'); ?>