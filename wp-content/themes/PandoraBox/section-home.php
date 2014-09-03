<?php 
    $pandora_options = get_option('pandora_options');
    $home_store = get_option('home_store_icons');
?>
    <div id="home" class="homeblock colorblock block">
        <div  class="block-container">

            <a href="<?php echo esc_url(home_url()); ?>" class="logoblock">
                <?php if (isset($pandora_options['logo_image']) && $pandora_options['logo_image'] != "") { ?>
                    <img class="companylogo" src="<?php echo $pandora_options['logo_image']; ?>">
                <?php } else { ?>
                        <span class="companyname"><?php bloginfo('name'); ?></span>
                <?php } ?>
            </a>

            <div id="description-home">
                <div class="wrapper">
                    <p class="developer"><?php echo $pandora_options['home_abovetext'];?></p>
                    <h1 id="header" class="maintext"><?php echo $pandora_options['home_maintext'];?></h1>
                    <div class="descriptiontext">
                        <?php echo apply_filters('the_content', $pandora_options['home_description']); ?>
                    </div>

                    <div class="mobilebrands">
                        <?php for ($i=0; $i < count($home_store); $i++){ ?>
                            <a href="<?php echo $home_store[$i]['home_store_link'];?>" class="mobileicon" title="<?php echo $home_store[$i]['home_store_alt'];?>"><i class="<?php echo $home_store[$i]['home_store_icon'];?>"></i></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div id="picture-home">
                <div class="wrapper">
                    <?php if($pandora_options['home_image_second']) { ?>
                    <div class="tablet container">
                        <div class="stack">
                            <img class="gadget" src="<?php echo $pandora_options['home_image_second'];?>">
                        </div>
                        <div class="shadow"></div>
                    </div>
                    <?php } ?>

                    <?php if($pandora_options['home_image_first']) { ?>
                    <div class="phone container">
                        <div class="stack">
                            <img class="gadget" src="<?php echo $pandora_options['home_image_first'];?>">
                        </div>
                        <div class="shadow"></div>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <div class="hexagon">
                <div class="outer"></div>
                <div class="inner"></div>
            </div>
        </div>
    </div>