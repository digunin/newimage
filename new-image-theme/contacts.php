<?php
/*
Template Name: Контакты
*/
?>
<?php get_header('contacts'); ?>
<div id="contacts" class="single-contacts-page">
        <div class="wrapper">
            <div class="logo"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_blue.png'?>"></div>
            <div class="contacts-wrapper">
                <div class="contacts moscow">
                    <p class="header">КОНТАКТЫ В МОСКВЕ</p>
                    <p class="adress">
                        <span>127273, г. Москва,</span>
                        <span>Сигнальный проезд, д.19. Бизнес-центр «Вэлдан»</span>
                    </p>
                    <p class="phones">
                        <a class="phone-href" href="tel:+74956469779">Тел.: +7 (495) 646-9779</a>
                        <a class="phone-href" href="tel:+74955053203">Тел.: +7 (495) 505-3203</a>
                    </p>
                    <a href="mailto:info@new-image.su" class="e-mail">Email: info@new-image.su</a>
                </div>
                <div class="contacts spb">
                    <p class="header">КОНТАКТЫ В ПИТЕРЕ</p>
                    <p class="adress">
                        <span>196084, г. C.-Петербург,</span>
                        <span>наб. Обводного канала, д.92. Бизнес-центр «Обводный», оф. 318.</span>
                    </p>
                    <p class="phones">
                        <a class="phone-href" href="tel:+79218754505">Тел.: +7 (921) 875-4505</a>
                        <a class="phone-href" href="tel:+78123718625">Тел.: +7 (812) 371-8625</a>
                    </p>
                    <a href="mailto:spb@new-image.su" class="e-mail">Email: spb@new-image.su</a>
                </div>
            </div>
            <div class="route">
                <p>Проезд в Москве: По Алтуфьевскому шоссе до поворота на Нововладыкинский проезд (при съезде с эстакады).
                    Далее 500м. по Нововладыкинскому проезду до второй проходной бизнес-центра «Вэлдан».</p>
                <p>1. м. Владыкино, обойти слева высотное здание гостиницы «Восход»далее пешком 100м до
                    Нововладыкинского проезда и направо 500м до второй проходной бизнес-центра «Вэлдан».</p>
                <p>2. м. Отрадное, пешком 700м по ул. Хачатуряна в сторону центра до мечети. Перед мечетью налево,
                    позади мечети мост через р. Лихоборка и выход к проходной бизнес-центра «Вэлдан».</p>
            </div>
            <div class="map-wrapper">
                <?php echo do_shortcode(apply_filters( 'the_content', get_the_content())) ?>
            </div><!-- map wrapper -->
        </div>
</div>
<?php get_footer(); ?>