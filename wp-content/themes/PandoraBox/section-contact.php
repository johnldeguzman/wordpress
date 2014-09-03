<?php $pandora_options = get_option('pandora_options'); ?>

<?php if ($pandora_options["contact_check"]) { ?>
<div class="block colorblock contactsblock" id="contacts">

    <?php if (isset($pandora_options["map_check"]) && $pandora_options["map_check"]) { ?>
    <div class="map">
        <div id="map-canvas"></div>
    </div>
    <?php } ?>

    <div class="block-container">
        <div class="wrapper">
            <h2 class="title"><?php echo $pandora_options['contact_title'];?></h2>
            <?php if ($pandora_options['contact_email']) { ?>
            <div class="contact-info">
                <div class="title">Write us via e-mail</div>
                <a href="mailto:<?php echo $pandora_options['contact_email'];?>"><?php echo $pandora_options['contact_email'];?></a>
            </div>
            <?php } ?>

            <?php if ($pandora_options['contact_address']) { ?>
            <div class="contact-info">
                <div class="title">Visit us</div>
                <p>
                    <?php echo $pandora_options['contact_address'];?>
                </p>
            </div>
            <?php } ?>

            <?php if ($pandora_options['contact_phone']) { ?>
            <div class="contact-info">
                <div class="title">Phone us</div>
                <p>
                    <?php echo $pandora_options['contact_phone'];?>
                </p>
            </div>
            <?php } ?>

            <?php if (is_plugin_active('contact-form-7/wp-contact-form-7.php') && $pandora_options['contact_form7sc'] != '') { ?>
            <div class="mailbutton active">
                <i class="icon-envelope"></i>
            </div>
            <?php } ?>
        </div>
    </div>

    <?php if (is_plugin_active('contact-form-7/wp-contact-form-7.php') && $pandora_options['contact_form7sc'] != '' ) { ?>
    <div class="input-container active">
        <div class="wrapper">
            <h3 class="title"><?php echo $pandora_options['contact_form7title'];?></h3>
            <?php echo do_shortcode($pandora_options['contact_form7sc']); ?>
        </div>
    </div>
    <?php } ?>
</div>
<?php } ?>