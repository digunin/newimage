<?php 
    add_action('wp_enqueue_scripts', 'ni_styles');
    add_action('wp_footer', 'ni_scripts');

    function ni_styles(){

        // а так - остальные файлы
        // третий параметр - от каких файлов зависит подключаемый файл
        wp_enqueue_style('normalize', get_template_directory_uri()."/assets/css/normalize.min.css");
        if(is_page_template('secondary-service.php')){
            wp_enqueue_style('services-style', get_template_directory_uri()."/assets/css/services-style.min.css", array('normalize'));
        }else{
            wp_enqueue_style('style', get_template_directory_uri()."/assets/css/style.min.css", array('normalize'));
        }

        // так подключается файл style.css из корневой папки темы
        // wp_enqueue_style('style', get_stylesheet_uri());
    }

    function ni_scripts(){
        wp_enqueue_script('fss-script', get_template_directory_uri()."/assets/js/fss.min.js");
    }

    function get_text_and_image($source){
        $txt = [];
        $imgs = [];
        $tag_with_img = '';
        $source = explode("\n", $source);
        foreach($source as $line){
            $line = trim($line);
            if(startsWith($line, "<p")){
                array_push($txt, $line);
            };
            if(startsWith($line, "<figure")){
                $img_set = array(
                    "src" => extract_img_src($line),
                    "alt" => extract_img_alt($line),
                    "title" => extract_img_title($line)
                );
                array_push($imgs, $img_set);
            }
        }
        return [$txt, $imgs];
    }

    function startsWith($targetStr, $start){
        $len = strlen($start);
        return (substr($targetStr, 0, $len) === $start); 
    }

    function extract_img_src($str){
        $start = strpos($str, "src=");
        $end = strpos($str, " alt=", $start);
        return substr($str, $start+5, $end - $start - 6);
    }

    function extract_img_alt($str){
        $start = strpos($str, "alt=");
        $end = strpos($str, " class=", $start);
        return substr($str, $start+5, $end - $start - 6);
    }

    function extract_img_title($str){
        $start = strpos($str, "title=");
        $end = strpos($str, " srcset=", $start);
        return substr($str, $start+7, $end - $start - 8);
    }
?> 