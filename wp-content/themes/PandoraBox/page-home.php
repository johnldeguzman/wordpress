<?php 
/*
    Template Name: Pandora Home
*/
?>

<?php get_header(); ?>

<?php get_template_part('section', 'home'); ?>

<?php get_template_part('section', 'slider'); ?>

<?php get_template_part('section', 'skills'); ?>

<?php get_template_part('section', 'team'); ?>

<?php get_template_part('section', 'price'); ?>

<?php get_template_part('section', 'partners'); ?>

<?php get_template_part('section', 'twitter'); ?>

<?php echo do_shortcode('[pb_block]'); ?>

<?php get_template_part('section', 'contact'); ?>

<?php get_footer(); ?>