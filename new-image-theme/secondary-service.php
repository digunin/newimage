<?php
/*
Template Name: Дополнительные услуги
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