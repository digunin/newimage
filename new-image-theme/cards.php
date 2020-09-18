<?php
/*
Template Name: Пластиковые карты
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
    <section id="cards1" class="full-screen-section active-section">
        <div class="primary-services-container">
            <div class="side left-side">
                <div class="left-side-header"><?php echo array_shift($paragraph_array[0]); ?></div>
                <div class="left-side-info">
                <?php 
                    foreach($paragraph_array[0] as $paragraph){
                        echo $paragraph;
                    }
                ?>
                </div>
                <div class="left-side-footer"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_inv.png'?>" alt=""></div>
            </div>
            <div class="side right-side">
            <?php 
                $tmp = wp_upload_dir();
                $uploads_url = $tmp['baseurl'];
            ?>
                <a href="<?php echo $uploads_url.'/2020/09/illustrator-template.ai' ?>" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/ai.png'?>" alt=""></a>
                <a href="<?php echo $uploads_url.'/2020/09/indesign-template.indd' ?>" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/id.png'?>" alt=""></a>
                <a href="<?php echo $uploads_url.'/2020/09/photoshop-template.psd' ?>" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/psd.png'?>" alt=""></a>
                <a href="<?php echo $uploads_url.'/2020/09/corel-template.cdr' ?>" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/cdr.png'?>" alt=""></a>
            </div>
        </div>
    </section>
    <section id="cards2" class="full-screen-section next-section">
        <div class="primary-services-container">
            <div class="side left-side">
                <div class="left-side-header"><?php echo array_shift($paragraph_array[1]); ?></div>
                <div class="left-side-info">
                <?php 
                    foreach($paragraph_array[1] as $paragraph){
                        echo $paragraph;
                    }
                ?>
                </div>
                <div class="left-side-footer"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_inv.png'?>" alt=""></div>
            </div>
            <div class="side right-side">
            <?php
                foreach($img_set[0] as $img){
                    print_img_tag($img);
                } 
            ?>
            </div>
        </div>
    </section>
    <section id="cards3" class="full-screen-section next-section">
        <div class="container">
            <div class="content">
                <div class="content-info">
                    <div class="content-header"><?php echo array_shift($paragraph_array[2]); ?></div>
                    <div class="content-text">
                    <?php 
                        foreach($paragraph_array[2] as $paragraph){
                            echo $paragraph;
                        }
                    ?>
                    </div>
                </div>
                <?php print_footer_with_images('cards', $img_set[1]); ?>
            </div>
        </div>
    </section>
    <section id="cards4" class="full-screen-section next-section">
        <div class="container">
            <div class="content">
                <div class="content-info">
                    <div class="content-header"><?php echo array_shift($paragraph_array[3]); ?></div>
                    <div class="content-text">
                    <?php 
                        foreach($paragraph_array[3] as $paragraph){
                            echo $paragraph;
                        }
                    ?>
                    </div>
                </div>
                <?php print_footer_with_images('cards', $img_set[2]); ?>
            </div>
            
        </div>
    </section>
    <?php print_sidebar(); ?>
    <div class="fss-nav">
        <div class="fss-button" onClick="fssOnClick(0)"></div>
        <div class="fss-button" onClick="fssOnClick(1)"></div>
        <div class="fss-button" onClick="fssOnClick(2)"></div>
        <div class="fss-button" onClick="fssOnClick(3)"></div>
    </div>
    <script>
        var sectionsNames = ["cards1", "cards2", "cards3", "cards4"]
        var pageName = 'cards-'
    </script>
<?php get_footer('services');