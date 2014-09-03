<?php
 $pandora_options = get_option('pandora_options');
?>

    <?php if (isset($pandora_options["partners_check"]) && $pandora_options["partners_check"] == "on") { ?>
    <div class="block whiteblock partnersblock">
        <div id="partners" class="block-container">
            <h2 class="title"><?php echo $pandora_options['partners_title']; ?></h2>
            <div class="description"><?php echo $pandora_options['partners_subtitle']; ?></div>
            <div class="partnerslist">
                <?php query_posts(array('post_type'=>'pandora-partners')); ?> 
                <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?> 
                <a href="<?php echo (get_post_meta($post->ID, 'partner_link', true)); ?>" class="partner"><?php the_post_thumbnail(); ?></a>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
<?php } ?>

