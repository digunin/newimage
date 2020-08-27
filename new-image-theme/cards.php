<?php
/*
Template Name: Пластиковые карты
*/
?>
<?php
    $content = get_the_content(); 
    $content = apply_filters( 'the_content', $content );
    $content = str_replace( ']]>', ']]>', $content );
    [$paragraph_array, $img_url] = get_text_and_image($content);
?>
<?php get_header('services'); ?>
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
                <a href="/1.rar" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/ai.png'?>" alt=""></a>
                <a href="/2.rar" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/id.png'?>" alt=""></a>
                <a href="/3.rar" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/psd.png'?>" alt=""></a>
                <a href="/4.rar" download><img src="<?php echo get_template_directory_uri().'/assets/img/services/cards/cdr.png'?>" alt=""></a>
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
                <img src="<?php echo $img_url[0]["src"] ?>" alt="<?php echo $img_url[0]["alt"] ?>" title="<?php echo $img_url[0]["title"] ?>">
                <img src="<?php echo $img_url[1]["src"] ?>" alt="<?php echo $img_url[1]["alt"] ?>" title="<?php echo $img_url[1]["title"] ?>">
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
                <div class="footer">
                <img src="<?php echo $img_url[2]["src"] ?>" alt="<?php echo $img_url[2]["alt"] ?>" title="<?php echo $img_url[2]["title"] ?>">
                </div>
            </div>
            <?php print_sidebar(); ?>
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
                <div class="footer">
                    <img src="<?php echo $img_url[3]["src"] ?>" alt="<?php echo $img_url[3]["alt"] ?>" title="<?php echo $img_url[3]["title"] ?>">
                </div>
            </div>
            <?php print_sidebar(); ?>
        </div>
    </section>
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