<?php
/*
Template Name: Контакты
*/
?>
<?php get_header('contacts'); ?>
<div id="contacts" class="single-contacts-page">
    <?php 
        $post = get_post(7291);
        setup_postdata($post);
        print_contacts(get_the_content());
        wp_reset_postdata();
    ?>
</div>
<?php get_footer(); ?>