<?php 
    $pandora_options = get_option('pandora_options');
?>

    <div class="block footerblock">
        <div class="block-container"> <?php get_sidebar('footer'); ?> </div>
        <?php if (isset($pandora_options['footer_label']) && !empty($pandora_options['footer_label'])) { ?>
        	<a href="<?php echo site_url();?>" class="copyright"> <?php echo $pandora_options['footer_label']; ?>  </a>
    	<?php } else {?>
    		<a href="<?php echo site_url();?>" class="copyright"> <?php bloginfo('name'); ?> &copy; <?php echo date('Y'); ?></a>
    	<?php } ?>
    </div> 

<?php get_template_part('admin/loader'); ?>

<?php wp_footer(); ?>
</body>
</html>