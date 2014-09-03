<?php 
    $pandora_options = get_option('pandora_options'); 
    $menu_icons = get_option('menu_icons');
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>> 
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?php bloginfo('charset'); ?>">
    <title><?php bloginfo( 'name' ); wp_title(); ?></title>
    <meta name="author" content="iltaen">
    <meta name="keywords" content="<?php echo $pandora_options['meta_key'];?>">
    <meta name="description" content="<?php echo $pandora_options['meta_description'];?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
    <link rel="alternate" type="application/atom+xml" title="<?php bloginfo('name'); ?> Atom Feed" href="<?php bloginfo('atom_url'); ?>" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="iconmenu">
        <i class="icon-ellipsis-horizontal"></i>
    </div>
    <div class="mainmenu">
        <div class="menuwrapper">
            <nav class="menulist <?php if (isset($pandora_options['menu_position']) && $pandora_options['menu_position'] == "right") echo 'menu-right' ?>">
                <?php 
                    wp_nav_menu (array(
                        'theme_location'    => 'primary',
                        'container'         =>'',
                        'container_class'   => '',
                        'container_id'      => '',
                        'sort_column'       => 'menu_order',
                        'menu_class'        => 'items',
                        'fallback_cb'       => '',
                        'items_wrap'        => '<ul class="items">%3$s</ul>', 
                        'walker'            => ''
                        ));
                ?>
            </nav>
            <a href="<?php echo esc_url(home_url()); ?>" class="logoblock">
            <?php if (isset($pandora_options['logo_image']) && $pandora_options['logo_image'] != "") { ?>
            	<img class="companylogo" src="<?php echo $pandora_options['logo_image']; ?>">
            <?php } else { ?>
                	<span class="companyname"><?php bloginfo('name'); ?></span>
            <?php } ?>
            </a>

            <?php if (empty($pandora_options['menu_position']) || $pandora_options['menu_position'] != "right") {?>
            <div class="socialblock">
                <?php for ($i=0; $i < count($menu_icons); $i++){ ?>
                <a href="<?php echo $menu_icons[$i]['menu_icon_link'];?>" title="<?php echo $menu_icons[$i]['menu_icon_alt'];?>" class="socialicon"><i class="<?php echo $menu_icons[$i]['menu_icon'];?>"></i></a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>