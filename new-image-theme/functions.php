<?php 
    add_action('wp_enqueue_scripts', 'ni_styles');
    add_action('wp_footer', 'ni_scripts');

    function ni_styles(){

        // а так - остальные файлы
        // третий параметр - от каких файлов зависит подключаемый файл
        wp_enqueue_style('normalize', get_template_directory_uri()."/assets/css/normalize.min.css");
        wp_enqueue_style('style', get_template_directory_uri()."/assets/css/style.min.css", array('normalize'));

        // так подключается файл style.css из корневой папки темы
        // wp_enqueue_style('style', get_stylesheet_uri());
    }

    function ni_scripts(){
        wp_enqueue_script('fss-script', get_template_directory_uri()."/assets/js/fss.min.js");
    }
?> 