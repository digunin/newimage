<?php
/*
Template Name: Страница не найдена
*/
?>
<?php get_header(); ?>
<div id="notfound">
        <div class="wrapper">
            <div class="logo"><img src="<?php echo get_template_directory_uri().'/assets/img/contrast_logo_blue.png'?>"></div>
            <h1>Страница не найдена.<br>Мы обновили сайт, возможно, вы найдете то, что искали, <br>по ссылкам ниже:</h1>
            <div class="links-wrapper">
                <div class="links-block">
                    <ul>
                        <li><a href="<?php echo get_home_url(); ?>">Главная</a></li>
                        <li><a href="<?php echo get_permalink(7291); ?>">Контакты</a></li>
                        <li><a href="<?php echo get_permalink(7303); ?>">Дизайн</a></li>
                        <li><a href="<?php echo get_permalink(7308); ?>">Полиграфия</a></li>
                        <li><a href="<?php echo get_permalink(7305); ?>">Пластиковые карты</a></li>
                        <li><a href="<?php echo get_permalink(7317); ?>">Бейджи</a></li>
                    </ul>
                </div>
                <div class="links-block">
                    <ul>
                        <li><a href="<?php echo get_permalink(7299); ?>">Лазерная резка, гравировка</a></li>
                        <li><a href="<?php echo get_permalink(7311); ?>">Наклейки, плоттерная резка</a></li>
                        <li><a href="<?php echo get_permalink(7256); ?>">Печать на сувенирной и рекламной продукции</a></li>
                        <li><a href="<?php echo get_permalink(7301); ?>">Брендирование авто</a></li>
                        <li><a href="<?php echo get_permalink(7314); ?>">Баннеры, плакаты, наружная реклама</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php get_footer(); ?>