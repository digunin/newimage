<?php
/*
Template Name: Дополнительные услуги
*/
?>
<?php get_header('services'); ?>
    <div class="container">
        <div class="content">
            <div class="content-info">
                <div class="content-header"><?php echo get_the_title(); ?></div>
                <div class="content-text">
                <?php 
                    $content = get_the_content(); 
                    $content = apply_filters( 'the_content', $content );
                    $content = str_replace( ']]>', ']]>', $content );
                    [$paragraph_array, $img_url] = get_text_and_image($content);
                    foreach($paragraph_array as $paragraph){
                        echo $paragraph;
                    }
                ?>
                </div>
            </div>
            <div class="footer">
                <img src="<?php echo $img_url?>" alt="Примеры наружной рекламы" title="Примеры наружной рекламы">
            </div>
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