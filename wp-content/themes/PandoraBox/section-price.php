<?php 
    $pandora_options = get_option('pandora_options');
?>

<?php if (isset($pandora_options["price_check"]) && $pandora_options["price_check"] == "on") { ?>
<div class="colorblock block priceblock">
    <div id="price" class="block-container">
        <div class="hexagon hexagon-top">
            <div class="outer"></div>
            <div class="inner"></div>
        </div>

        <h2 class="title"><?php echo $pandora_options['price_title']; ?></h2>
        <div class="description"><?php echo $pandora_options['price_subtitle']; ?></div>

    <?php 
    if (is_plugin_active('pandora-price/pandora-price.php')){
        query_posts(array('post_type'=>'pandora-price')); 

        if ( have_posts() ) {

            the_post();
            $col_name       = get_post_meta($post->ID, 'col_name', true);
            $option_name    = get_post_meta($post->ID, 'option_name', true);
            $option_check   = get_post_meta($post->ID, 'check', true);
            $period         = get_post_meta($post->ID, 'period', true);
            $col_cost       = get_post_meta($post->ID, 'col_cost', true);
            $button_link    = get_post_meta($post->ID, 'button_link', true);
            $button_name    = get_post_meta($post->ID, 'button_name', true);

            $c_option = count($option_name);
            $c_col = count($col_name);

            if($col_name){

        ?> 
        <div class="pricetable">
            <?php for ($td = 0; $td < $c_col; $td++ ){ ?>
            <div class="priceitem">
                <div class="wrapper">
                    <h3 class="title"><?php echo $col_name[$td]; ?></h3>
                    <div class="services-list">
                        <?php for ($tr = 0; $tr < $c_option; $tr++ ){ 
                            if (isset($option_check[$tr][$td])) {
                            ?>
                        <div class="service <?php if ($option_check[$tr][$td] == 'on') {echo 'include';} else {echo 'exclude';} ?>">
                            <i class="<?php if ($option_check[$tr][$td] == 'on') {echo 'icon-ok-sign';} else {echo 'icon-remove-sign';} ?>"></i>
                            <span><?php echo $option_name[$tr]; ?></span>
                        </div>
                        <?php }} ?>
                    </div>
                    <div class="cost">
                        <div class="container">
                            <h1><?php echo $col_cost[$td]; ?></h1>
                            <span class="line"><?php if (!empty($period)) {echo "/"; echo $period;} ?></span>
                        </div>
                    </div>
                    <a href="<?php echo $button_link[$td]; ?>" class="button"><?php echo $button_name; ?></a>
                </div>
            </div>
            <?php } ?>
        </div>
        <?php } ?>
    <?php }} ?>


        <div class="infoblock">
            <h3 class="title"><?php echo $pandora_options['price_info_title']; ?></h3>
            <div class="subscription">
                <?php echo apply_filters('the_content', $pandora_options['price_info']); ?>
            </div>
            <?php if ($pandora_options['price_info'] || $pandora_options['price_info_title']) {?>
            <div class="contacticons">
                <div class="item">
                    <i class="icon-phone"></i>
                    <span class="sign"><?php echo $pandora_options['contact_phone']; ?></span>
                </div>

                <a href="mailto:<?php echo $pandora_options['contact_email']; ?>" class="item">
                    <i class="icon-envelope"></i>
                    <span class="sign"><?php echo $pandora_options['contact_email']; ?></span>
                </a>

            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php } ?>