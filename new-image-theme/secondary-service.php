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
    [$paragraph_array, $img_url] = get_text_and_image($content);
?>
<?php get_header('services'); ?>
    <div class="container">
        <div class="content">
            <div class="content-info">
                <h2 class="content-header"><?php echo get_the_title(); ?></h2>
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
                echo '<div class="footer '.$post->post_name.'-footer">';
                if($post->post_name == "souvenir"){
                    echo '<img class="souvenirs-small" src="'.$img_url[0]["src"].'" alt="'.$img_url[0]["alt"].'" title="'.$img_url[0]["title"].'">';
                    echo '<img class="souvenirs-big" src="'.$img_url[1]["src"].'" alt="'.$img_url[1]["alt"].'" title="'.$img_url[1]["title"].'">';
                }else{
                    echo '<img src="'.$img_url[0]["src"].'" alt="'.$img_url[0]["alt"].'" title="'.$img_url[0]["title"].'">'; 
                }
                echo '</div>';
            };
            ?>
            
        </div>
        <?php print_sidebar(); ?>
    </div>
<?php get_footer('services');