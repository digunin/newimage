<?php
    add_action('wp_enqueue_scripts', 'ni_styles');
    add_action('after_setup_theme', 'menu_reg');

    function menu_reg(){
        add_theme_support('title-tag');
        register_nav_menu('hamburger_menu', 'Меню-гамбургер');
    }

    function ni_styles(){
        wp_deregister_script('jquery-core');
        wp_deregister_script('jquery');
        wp_enqueue_style('normalize', get_template_directory_uri()."/assets/css/normalize.min.css");
        wp_register_script( 'jquery', includes_url().'js/jquery/jquery.js', false, null, true );
        wp_enqueue_script( 'jquery' );
        if(is_front_page()||is_page_template('contacts.php')){
            wp_enqueue_style('style', get_template_directory_uri()."/assets/css/style.css", array('normalize'));
        }else{
            wp_enqueue_style('services-style', get_template_directory_uri()."/assets/css/services-style.min.css", array('normalize'));
        }
    }

    function fonts_preload_tag(){
        echo '<link rel="preload" href="';
        echo get_template_directory_uri();
        echo '/assets/fonts/PFBagueSansPro.woff2" as="font" type="font/woff2" crossorigin>';
        echo '<link rel="preload" href="';
        echo get_template_directory_uri();
        echo '/assets/fonts/PFBagueSansPro-Bold.woff2" as="font" type="font/woff2" crossorigin>';
        echo '<link rel="preconnect" href="//api-maps.yandex.ru">';
        echo '<link rel="dns-prefetch" href="//api-maps.yandex.ru">';
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
                };
                continue;
            };
            if(startsWith($line, "<a")){
                array_push($current, $line);
                continue;
            };
            array_push($current, $line);
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

    function print_contacts(){
        echo '<div class="wrapper">';
        echo '<div class="logo"><img src="';
        echo get_template_directory_uri();
        echo '/assets/img/contrast_logo_blue.png"></div>';
        echo '<div class="contacts-body">';
            echo '<div  class="contacts-wrapper">';
                echo '<div class="contacts moscow">';
                    echo '<h2 class="header">КОНТАКТЫ В МОСКВЕ</h2>';
                    echo '<p class="phones">';
                        echo '<a class="phone-href" href="tel:+74956469779">Тел.: +7 (495) 646-9779</a>';
                        echo '<a class="phone-href" href="tel:+79255053203">Тел.: +7 (925) 505-3203</a>';
                    echo '</p>';
                    echo '<a href="mailto:info@new-image.su" class="e-mail">Email: info@new-image.su</a>                    ';
                echo '</div>';
                echo '<div class="contacts">';
                    echo '<p class="adress">127273, г. Москва, Сигнальный проезд, д.19. Бизнес-центр «Вэлдан»</p>';
                echo '</div>';
            echo '</div>';
            echo '<div class="map-wrapper">';
            echo '<div id="yamap0"  style="position: relative; min-height: 30em; margin-bottom: 0 !important;">';
            echo '<div class="spinner-wrapper">';
            echo '<div class="spinner"></div>';
            echo '</div>';
            echo '</div>';
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
        if($name == "printing-advertising-products"){
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

    function get_scroll_script(){
        echo '<script>';
        echo 'Object.assign||Object.defineProperty(Object,"assign",{enumerable:!1,configurable:!0,writable:!0,value:function(a,b){"use strict";null==a&&error("Cannot convert first argument to object");for(var c=Object(a),d=1;d<arguments.length;d++){var e=arguments[d];if(null!=e)for(var f=Object.keys(Object(e)),g=0,h=f.length;g<h;g++){var i=f[g],j=Object.getOwnPropertyDescriptor(e,i);void 0!==j&&j.enumerable&&(c[i]=e[i])}}return c}}),function(){function t(t,e){e=e||{bubbles:!1,cancelable:!1,detail:void 0};var n=document.createEvent("CustomEvent");return n.initCustomEvent(t,e.bubbles,e.cancelable,e.detail),n}"function"!=typeof window.CustomEvent&&(t.prototype=window.Event.prototype,window.CustomEvent=t)}();var swipe=function(el,settings){var settings;(settings=Object.assign({},{minDist:60,maxDist:120,maxTime:700,minTime:50},settings)).maxTime<settings.minTime&&(settings.maxTime=settings.minTime+500),(settings.maxTime<100||settings.minTime<50)&&(settings.maxTime=700,settings.minTime=50);var dir,swipeType,dist,isMouse=!1,isMouseDown=!1,startX=0,distX=0,startY=0,distY=0,startTime=0,support_pointer=!!("PointerEvent"in window||"msPointerEnabled"in window.navigator),support_touch=!!(void 0!==window.orientation||/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)||"ontouchstart"in window||navigator.msMaxTouchPoints||"maxTouchPoints"in window.navigator>1||"msMaxTouchPoints"in window.navigator>1),getSupportedEvents,eventsUnify=function(e){return e.changedTouches?e.changedTouches[0]:e},checkStart=function(e){var event=eventsUnify(e);support_touch&&void 0!==e.touches&&1!==e.touches.length||(dir="none",swipeType="none",dist=0,startX=event.pageX,startY=event.pageY,startXfromSwipeEvent=startX,startYfromSwipeEvent=startY,startTime=(new Date).getTime(),isMouse&&(isMouseDown=!0))},checkMove=function(e){if(!isMouse||isMouseDown){var event=eventsUnify(e);distX=event.pageX-startX,distY=event.pageY-startY,dir=Math.abs(distX)>Math.abs(distY)?distX<0?"left":"right":distY<0?"up":"down"}},checkEnd=function(e){if(!isMouse||isMouseDown){var endTime,time=(new Date).getTime()-startTime;if(time>=settings.minTime&&time<=settings.maxTime&&(Math.abs(distX)>=settings.minDist&&Math.abs(distY)<=settings.maxDist?swipeType=dir:Math.abs(distY)>=settings.minDist&&Math.abs(distX)<=settings.maxDist&&(swipeType=dir)),dist="left"===dir||"right"===dir?Math.abs(distX):Math.abs(distY),"none"!==swipeType&&dist>=settings.minDist){var swipeEvent=new CustomEvent("swipe",{bubbles:!0,cancelable:!0,detail:{full:e,dir:swipeType,dist:dist,time:time}});el.dispatchEvent(swipeEvent)}}else mouseDown=!1},events=function(){switch(!0){case support_touch:events={type:"touch",start:"touchstart",move:"touchmove",end:"touchend",cancel:"touchcancel"};break;case support_pointer:events={type:"pointer",start:"PointerDown",move:"PointerMove",end:"PointerUp",cancel:"PointerCancel",leave:"PointerLeave"};var ie10=window.navigator.msPointerEnabled&&Function("/*@cc_on return document.documentMode===10@*/")();for(var value in events)"type"!==value&&(events[value]=ie10?"MS"+events[value]:events[value].toLowerCase());break;default:events={type:"mouse",start:"mousedown",move:"mousemove",end:"mouseup",leave:"mouseleave"}}return events}();(support_pointer&&!support_touch||"mouse"===events.type)&&(isMouse=!0),el.addEventListener(events.start,checkStart),el.addEventListener(events.move,checkMove),el.addEventListener(events.end,checkEnd)};const byID=function(id){return document.getElementById(id)};var current=+localStorage.getItem(pageName+"currentSection")||0,sectionCount=0,wheelDelay=!1,startXfromSwipeEvent=0,startYfromSwipeEvent=0,previousOffsetValue=-1,scrollDirection="down",isMapLoaded=!1;const fssOnClick=function(n){n!=current&&moveTo(n)},moveTo=function(index){if(setCurrentSection(index),current=index,previousOffsetValue=-1,localStorage.setItem(pageName+"currentSection",current),"index-"==pageName&&!isMapLoaded&&"contacts"==sectionsNames[current]){var elem_with_map_script=document.createElement("script");elem_with_map_script.type="text/javascript",elem_with_map_script.src="//api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=e511ca73-3039-488e-8fef-064eff47e4c4&ver=2.1&onload=get_ya_map",document.getElementsByTagName("body")[0].appendChild(elem_with_map_script),isMapLoaded=!0}"cards-"==pageName&&(document.getElementsByClassName("sidebar")[0].style.display=0==current||1==current?"none":"flex")},setCurrentSection=function(n){let buttons=document.getElementsByClassName("fss-button");sectionsNames.map((function(name,i){let section=byID(name),btn=buttons[i];i<n?setPrevious(section):i==n?setActive(section):setNext(section),i==n?btn.classList.add("active"):btn.classList.remove("active")}))},setPrevious=function(elem){elem.classList.remove("active-section"),elem.classList.remove("next-section"),elem.classList.contains("previous-section")||elem.classList.add("previous-section")},setActive=function(elem){elem.classList.remove("previous-section"),elem.classList.remove("next-section"),elem.classList.contains("active-section")||elem.classList.add("active-section"),elem.classList.add("active-section")},setNext=function(elem){elem.classList.remove("previous-section"),elem.classList.remove("active-section"),elem.classList.contains("next-section")||elem.classList.add("next-section")},keyHandler=function(event){elem=byID(sectionsNames[current]);let currentOffsetValue=Math.max(document.documentElement.scrollTop,elem.scrollTop);if("ArrowDown"==event.code||"ArrowRight"==event.code){if(currentOffsetValue>previousOffsetValue)return void(previousOffsetValue=currentOffsetValue);moveToNext()}if("ArrowUp"==event.code||"ArrowLeft"==event.code){if(currentOffsetValue<previousOffsetValue)return void(previousOffsetValue=currentOffsetValue);moveToPrevious()}},moveToNext=function(){current<sectionCount-1&&moveTo(current+1)},moveToPrevious=function(){current>0&&moveTo(current-1)},wheelHandler=function(event){if(wheelDelay)return;if(cursor_in_map(event.clientX,event.clientY))return;elem=byID(sectionsNames[current]);let currentOffsetValue=Math.max(document.documentElement.scrollTop,elem.scrollTop);if(currentOffsetValue+=event.deltaY,event.deltaY<0){if(isScrollDirChange("up")&&(previousOffsetValue=currentOffsetValue-event.deltaY),scrollDirection="up",currentOffsetValue<previousOffsetValue)return void(previousOffsetValue=currentOffsetValue);moveToPrevious()}else{if(isScrollDirChange("down")&&(previousOffsetValue=currentOffsetValue-event.deltaY),scrollDirection="down",currentOffsetValue>previousOffsetValue)return void(previousOffsetValue=currentOffsetValue);moveToNext()}wheelDelay=!0,setTimeout((function(){wheelDelay=!1}),200)},cursor_in_map=function(x,y){let elem=document.elementFromPoint(x,y);return!(!elem||"YMAPS"!=elem.tagName)},swipeHandler=function(e){if(cursor_in_map(startXfromSwipeEvent,startYfromSwipeEvent))return;let dir=e.detail.dir;"left"==dir&&moveToNext(),"right"==dir&&moveToPrevious()},isScrollDirChange=function(currentDir){return currentDir!=scrollDirection};function get_ya_map(){document.getElementById("yamap0").innerHTML="";var myMap0=new ymaps.Map("yamap0",{center:[55.8549,37.5934],zoom:17,type:"yandex#map",controls:["zoomControl","routeButtonControl"]},{suppressMapOpenBlock:!1});myMap0placemark1=new ymaps.Placemark([55.8551,37.5948],{hintContent:"",iconContent:"Вторая проходная бц «Вэлдан»"},{preset:"islands#blueStretchyIcon",iconColor:"#1e98ff"}),myMap0placemark2=new ymaps.Placemark([55.8544,37.5935],{hintContent:"",iconContent:"ООО «Новый имидж»"},{preset:"islands#blueStretchyIcon",iconColor:"#ff1f75"}),myMap0.geoObjects.add(myMap0placemark1).add(myMap0placemark2)}sectionCount=sectionsNames.length,swipe(window,{maxTime:800,minTime:100,maxDist:200,minDist:100}),window.addEventListener("swipe",swipeHandler,{passive:!1}),window.addEventListener("keyup",keyHandler),window.addEventListener("wheel",wheelHandler),moveTo(current);';
        echo '</script>';
    }
?>