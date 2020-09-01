<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body>
<header>
<input id="menu-toggle" type="checkbox" />
<label class="menu-btn" for="menu-toggle">
    <span></span>
</label>
<div class="menu-wrapper">
<?php wp_nav_menu( [
    'theme_location'  => 'hamburger_menu',
    'container'       => null
    ] ); 
?>
</div>
</header>