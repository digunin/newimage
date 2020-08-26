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
        $tag_with_img = '';
        $source = explode("\n", $source);
        foreach($source as $line){
            $line = trim($line);
            if(startsWith($line, "<p")){
                array_push($txt, $line);
            };
            if(startsWith($line, "<figure")){
                $tag_with_img = $line;
            }
        }
        return [$txt, extract_img_src($tag_with_img)];
    }

    function startsWith($targetStr, $start){
        $len = strlen($start);
        return (substr($targetStr, 0, $len) === $start); 
    }

    function extract_img_src($str_with_src){
        $start = strpos($str_with_src, "src=");
        $end = strpos($str_with_src, " alt=");
        return substr($str_with_src, $start+5, $end - $start - 6);
    }
?> 