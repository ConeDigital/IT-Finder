<?php
    /**
    * Template Name: logout2
    */

?>

<?php //echo do_shortcode('[logout redirect_page="/" ]'); ?>
 <?php wp_logout(); ?>
 
 <?php wp_redirect(site_url()); ?>
 