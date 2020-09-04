<?php
/*
Template Name: Контакты
*/
?>
<?php get_header('contacts'); ?>
<div id="contacts" class="single-contacts-page">
    <div class="wrapper">
        <div class="logo"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_blue.png'?>"></div>
        <div class="contacts-body">
            <div class="contacts-wrapper">
                <div class="contacts moscow">
                    <h2 class="header">КОНТАКТЫ В МОСКВЕ</h2>
                    <p class="phones">
                        <a class="phone-href" href="tel:+74956469779">Тел.: +7 (495) 646-9779</a>
                        <a class="phone-href" href="tel:+74955053203">Тел.: +7 (495) 505-3203</a>
                    </p>
                    <a href="mailto:info@new-image.su" class="e-mail">Email: info@new-image.su</a>                    
                </div>
                <div class="contacts spb">
                    <h2 class="header">КОНТАКТЫ В ПИТЕРЕ</h2>
                    <p class="phones">
                        <a class="phone-href" href="tel:+79218754505">Тел.: +7 (921) 875-4505</a>
                    </p>
                    <a href="mailto:spb@new-image.su" class="e-mail">Email: spb@new-image.su</a>
                </div>
            </div>
            <div class="map-wrapper">
                <?php 
                    $post = get_post(183);
                    setup_postdata($post);
                    echo do_shortcode(apply_filters( 'the_content', get_the_content()));
                    wp_reset_postdata();
                 ?>
            </div><!-- map_wrapper -->
        </div>
        
        <div class="contacts-footer">
            <p>127273, г. Москва, Сигнальный проезд, д.19. Бизнес-центр «Вэлдан»</p>
            <p>Проезд в Москве: По Алтуфьевскому шоссе до поворота на Нововладыкинский проезд (при съезде с эстакады).
                Далее 500м. по Нововладыкинскому проезду до второй проходной бизнес-центра «Вэлдан».</p>
            <p>1. м. Владыкино, обойти слева высотное здание гостиницы «Восход»далее пешком 100м до
                Нововладыкинского проезда и направо 500м до второй проходной бизнес-центра «Вэлдан».</p>
            <p>2. м. Отрадное, пешком 700м по ул. Хачатуряна в сторону центра до мечети. Перед мечетью налево,
                позади мечети мост через р. Лихоборка и выход к проходной бизнес-центра «Вэлдан».</p>
        </div>
    </div>
</div>
<?php get_footer(); ?>