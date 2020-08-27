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
        <div class="sidebar">
            <div class="logo"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_inv.png' ?>"></div>
            <div class="phones">
                <a class="phone-href" href="tel:+74956469779">+7 (495) 646-9779</a>
                <a class="phone-href" href="tel:+74955053203">+7 (495) 505-3203</a>
            </div>
        </div>
    </div>
<?php get_footer('services');