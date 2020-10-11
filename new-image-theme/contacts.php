<?php
/*
Template Name: Контакты
*/
?>
<?php get_header('contacts'); ?>
<div id="contacts" class="single-contacts-page">
    <?php 
        print_contacts();
    ?>
</div>
<script>
    var elem_with_map_script = document.createElement('script');
    elem_with_map_script.type = 'text/javascript';
    elem_with_map_script.src = '//api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=e511ca73-3039-488e-8fef-064eff47e4c4&ver=2.1&onload=get_ya_map';
    document.getElementsByTagName('body')[0].appendChild(elem_with_map_script);
    function get_ya_map(){
        document.getElementById("yamap0").innerHTML = "";
    var myMap0 = new ymaps.Map("yamap0", {
                                    center: [55.8549,37.5934],
                                    zoom: 17,
                                    type: "yandex#map",
                                    controls: ["zoomControl", "routeButtonControl"] ,
                                    
                                },
                                {
                                  suppressMapOpenBlock: false
                                }); 

              
    myMap0placemark1 = new ymaps.Placemark([55.8551,37.5948], {
                              hintContent: "",
                              iconContent: "Вторая проходная бц «Вэлдан»",


                            
                          }, {                        
                            preset: "islands#blueStretchyIcon", 
                            iconColor: "#1e98ff",
                          });  
  
    myMap0placemark2 = new ymaps.Placemark([55.8544,37.5935], {
                              hintContent: "",
                              iconContent: "ООО «Новый имидж»",


                            
                          }, {                        
                            preset: "islands#blueStretchyIcon", 
                            iconColor: "#ff1f75",
                          });  
    myMap0.geoObjects.add(myMap0placemark1).add(myMap0placemark2);
}
</script>
<?php get_footer(); ?>