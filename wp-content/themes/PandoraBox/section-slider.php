<?php
 $pandora_options = get_option('pandora_options');
?>

    <?php if (isset($pandora_options["slider_check"]) && $pandora_options["slider_check"] == "on") { ?>
    <div id="slider" class="appsblock whiteblock block">
        <div class="block-container">
            <?php if (!empty($pandora_options['slider_title'])) { ?><h2 class="title"><?php echo $pandora_options['slider_title']; } ?></h2>
            <div class="description"><?php echo $pandora_options['slider_subtitle']; ?></div>
            <div class="apps">
                <?php if (is_plugin_active('pandora-slider/pandora-slider.php')) echo do_shortcode('[pb_slider]'); ?>
            </div>
        </div>
    </div>
    <?php } ?>

