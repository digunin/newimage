<?php 
    add_action('wp_enqueue_scripts', 'ni_styles');
    add_action('wp_footer', 'ni_scripts');
    add_action('after_setup_theme', 'menu_reg');
    remove_action( 'shutdown', 'wp_ob_end_flush_all', 1 );

    function menu_reg(){
        add_theme_support('title-tag');
        register_nav_menu('hamburger_menu', 'Меню-гамбургер');
    }

    function ni_styles(){
        wp_enqueue_style('normalize', get_template_directory_uri()."/assets/css/normalize.min.css");
        if(is_front_page()||is_page_template('contacts.php')){
            wp_enqueue_style('style', get_template_directory_uri()."/assets/css/style.min.css", array('normalize'));
        }else{
            wp_enqueue_style('services-style', get_template_directory_uri()."/assets/css/services-style.min.css", array('normalize'));
        }
    }

    function ni_scripts(){
        if(is_front_page()||is_page_template('cards.php')){
            wp_enqueue_script('fss-script', get_template_directory_uri()."/assets/js/fss.min.js");
        }
    }

    function get_text_and_image($source){
        $txt_blocks = [];
        $img_blocks = [];
        $current = [];
        $imgs = [];
        $tag_with_img = '';
        $source = explode("\n", $source);
        foreach($source as $line){
            $line = trim($line);
            if($line == ""){
                continue;
            };
            if(startsWith($line, "<p><a")){
                array_push($current, extract_text_from_tag($line, "p"));
                continue;
            };
            if(startsWith($line, "<h")){
                if(sizeof($current)>0){
                    array_push($txt_blocks, $current);
                    $current = [];
                }
                if(sizeof($imgs)>0){
                    array_push($img_blocks, $imgs);
                    $imgs = [];
                }
                array_push($current, extract_text_from_tag($line, "<h"));
                continue;
            };
            if(strPos($line, "<img")){
                $img_set = array(
                    "id" => extract_img_id($line),
                    "src" => extract_from_attr($line, "src="),
                    "alt" => extract_from_attr($line, "alt="),
                    "title" => extract_from_attr($line, "title=")
                );
                array_push($imgs, $img_set);
                continue;
            };
            if(startsWith($line, "<p")){
                $txt = extract_text_from_tag($line, "p");
                $txt = trim($txt);
                if(strlen($txt)>0){
                    array_push($current, $line);
                }
            };
            if(startsWith($line, "<a")){
                array_push($current, $line);
            };
        }
        array_push($txt_blocks, $current);
        array_push($img_blocks, $imgs);
        return [$txt_blocks, $img_blocks];
    }

    function startsWith($targetStr, $start){
        $len = strlen($start);
        return (substr($targetStr, 0, $len) === $start); 
    }

    function extract_from_attr($str, $attr){
        $attr_len = strlen($attr);
        $start = strpos($str, $attr);
        if($start == false){
            return "";
        };
        $end = strpos($str, "\"", $start + $attr_len + 1);
        return substr($str, $start+$attr_len+1, $end - $start - $attr_len-1);
    }

    function extract_text_from_tag($str, $tag){
        $tag_len = strlen($tag)+2;
        return substr($str, $tag_len, strlen($str)-($tag_len*2+1));
    }

    function extract_img_id($str){
        $start = strpos($str, "wp-image-")+9;
        $end = strpos($str, "\"", $start);
        return absint(substr($str, $start, $end-$start));
    }

    function print_sidebar(){
        echo '<div class="sidebar">';
            echo '<a style="display: block" href="'; 
            echo get_home_url();
            echo '" class="logo"><img src="';
            echo get_template_directory_uri();
            echo '/assets/img/contrast_logo_inv.png'.'"></a>';
            echo '<div class="phones">';
                echo '<a class="phone-href" href="tel:+74956469779">+7 (495) 646-9779</a>';
                echo '<a class="phone-href" href="tel:+74955053203">+7 (495) 505-3203</a>';
            echo "</div>";
        echo "</div>";
    }

    function print_img_tag($img_set, $extra_class=""){
        echo '<img';
        echo ' loading="lazy"';
        echo ' src="';
        echo $img_set["src"];
        echo '" alt="';
        echo $img_set["alt"];
        echo '" title="';
        echo $img_set["title"];
        echo '" srcset ="';
        echo wp_get_attachment_image_srcset($img_set["id"], 'medium');
        if($extra_class != ""){
            echo '" class="';
            echo $extra_class;
        }
        echo '">';
    }

    function print_contacts($content){
        echo '<div class="wrapper">';
        echo '<div class="logo"><img src="';
        echo get_template_directory_uri();
        echo '/assets/img/contrast_logo_blue.png"></div>';
        echo '<div class="contacts-body">';
            echo '<div class="contacts-wrapper">';
                echo '<div class="contacts moscow">';
                    echo '<h2 class="header">КОНТАКТЫ В МОСКВЕ</h2>';
                    echo '<p class="phones">';
                        echo '<a class="phone-href" href="tel:+74956469779">Тел.: +7 (495) 646-9779</a>';
                        echo '<a class="phone-href" href="tel:+74955053203">Тел.: +7 (495) 505-3203</a>';
                    echo '</p>';
                    echo '<a href="mailto:info@new-image.su" class="e-mail">Email: info@new-image.su</a>                    ';
                echo '</div>';
                echo '<div class="contacts">';
                    echo '<p class="adress">127273, г. Москва, Сигнальный проезд, д.19. Бизнес-центр «Вэлдан»</p>';
                echo '</div>';
            echo '</div>';
            echo '<div class="map-wrapper">';
            echo do_shortcode(apply_filters( 'the_content', $content));
            echo '</div>';
        echo '</div>';
        
        echo '<div class="contacts-footer">';
            echo '<p>Проезд в Москве: По Алтуфьевскому шоссе до поворота на Нововладыкинский проезд (при съезде с эстакады). Далее 500м. по Нововладыкинскому проезду до второй проходной бизнес-центра «Вэлдан».</p>';
            echo '<p>1. м. Владыкино, обойти слева высотное здание гостиницы «Восход»далее пешком 100м до
                Нововладыкинского проезда и направо 500м до второй проходной бизнес-центра «Вэлдан».</p>';
            echo '<p>2. м. Отрадное, пешком 700м по ул. Хачатуряна в сторону центра до мечети. Перед мечетью налево,
                позади мечети мост через р. Лихоборка и выход к проходной бизнес-центра «Вэлдан».</p>';
        echo '</div>';
        echo '<div class="contacts spb">';
            echo '<h2 class="header">КОНТАКТЫ В ПИТЕРЕ</h2>';
            echo '<p class="phones">';
                echo '<a class="phone-href" href="tel:+79218754505">Тел.: +7 (921) 875-4505</a>';
            echo '</p>';
            echo '<a href="mailto:spb@new-image.su" class="e-mail">Email: spb@new-image.su</a>';
        echo '</div>';
        echo '</div>';
    }

    function get_class_for_footer($count){
        switch($count){
            case 0:
                return '';
            break;
            case 1:
            case 2:
                return ' _'.$count.'-in-row';
            break;
            case 3:
            case 4:
                return ' _2-in-row';
            break;
            default:
                return ' _3-in-row';
            break;
        }
    }

    function print_footer_with_images($name, $img_set){
        echo '<div class="footer ';
        echo $name;
        echo '-footer';
        if($name == "souvenir"){
            echo '">';
            print_img_tag($img_set[0], "souvenirs-small");
            print_img_tag($img_set[1], "souvenirs-big");
        }else{
            echo ' '.get_class_for_footer(count($img_set));
            echo '">';
            foreach($img_set as $single_img){
                echo '<div class="img-wrapper">';
                print_img_tag($single_img);
                echo '</div>';
            }
        }
        echo '</div>';
    }
?> 