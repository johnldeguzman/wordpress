<?php

function load_scripts() {
  wp_register_script('pandorascript', get_template_directory_uri() . '/js/script.js', array(), '1.0', true );
  wp_register_script('googlemap', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', array(), '3.0', false );
  wp_register_script('pandoramap', get_template_directory_uri() . '/js/map.js', array(), '1.0', false );
  wp_register_script('webfont', 'http://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js', array(), '1.4.7', false );

  if (!is_admin()){
    wp_register_style('basic', get_template_directory_uri() . '/styles/basic.css');
    wp_enqueue_style('basic'); 

    wp_register_style('style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('style');
  }

  wp_enqueue_script('jquery');
  wp_enqueue_script('pandorascript');
  wp_enqueue_script('googlemap');    
  wp_enqueue_script('pandoramap'); 

  if ( is_singular() ) wp_enqueue_script( 'comment-reply' );

  wp_enqueue_script('webfont');   
}

add_action('init', 'load_scripts'); 


add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat' ) );
add_theme_support( 'automatic-feed-links' );
add_theme_support( 'post-thumbnails' );
add_theme_support( 'custom-header');
add_theme_support( 'custom-background');

register_sidebar( array(
    'name'          => __( 'Blog Right Sidebar', 'pandorabox' ),
    'id'            => 'sidebar-blog',
    'description'   => __( 'Blog right sidebar', 'pandorabox' ),
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  ) );

if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'name' => 'Footer Widgets Left',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Footer Widgets Center',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));


if ( function_exists('register_sidebar') )
        register_sidebar(array(
            'name' => 'Footer Widgets Right',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h4 class="widget-title">',
            'after_title' => '</h4>',
        ));

register_nav_menus(
   array(
  'primary'=>__('Main menu')
  )
);

if( current_user_can( 'manage_options' ) ) {
require_once(TEMPLATEPATH . '/admin/admin.php'); 
}

class Pandora_Customize{
  public static function register ( $wp_customize ){
    wp_enqueue_script( 'pandorabox-themecustomizer', get_template_directory_uri().'/js/theme-customizer.js', array('customize-preview'), '', true);

     $wp_customize->add_section( 'pandora_options', 
           array(
              'title' => __( 'PandoraBox Options', 'pandorabox' ), 
              'priority' => 35, 
              'capability' => 'edit_theme_options', 
              'description' => __('Allows you to customize some example settings for pandora.', 'pandora'),
           ) 
        );
        
      $wp_customize->add_setting( 'pandora_options-link_textcolor', 
         array(
            'default' => '#00a99d', 
            'type' => 'theme_mod', 
            'capability' => 'edit_theme_options', 
            'transport' => 'postMessage',
         ) 
      );   

      $wp_customize->add_control( new WP_Customize_Color_Control( 
         $wp_customize,
         'pandora_link_textcolor', 
         array(
            'label' => __( 'Basic Color', 'pandorabox' ), 
            'section' => 'colors', 
            'settings' => 'pandora_options-link_textcolor', 
            'priority' => 10, 
         ) 
      )); 

  }

  public static function header_output(){
    $pandora_options = get_option('pandora_options'); 
    $color = get_theme_mod('pandora_options-link_textcolor');
    if (!$color) $color = '#00a99d'
    ?> 

      <style type="text/css" id="dynstyles">
         a , .whiteblock a , .socialblock .socialicon i:hover , .skillsblock .skillcontainer:hover .skillogo .logocontainer , .skillsblock .skillcontainer:hover .title , .blogblock .block-container .post .post-body .title a:hover, .blogblock .block-container .post .meta .type i:hover {          
        color: <?php echo $color ?>;
        }
      
         input:focus,textarea:focus , .skillsblock .skillcontainer .wrapper .skillogo .logocontainer , .teamblock .block-container .teamcontainer .personal:hover .photo, .contactsblock .block-container .wrapper .mailbutton.active, .contactsblock .block-container .wrapper .mailbutton:hover, .contactsblock .block-container .wrapper .mailbutton.active { 
        border-color: <?php echo $color ?>;
        }

        *::selection, input::selection, textarea::selection {
          background-color: <?php echo $color ?>;
        }

        button, input.send, input[type="submit"], .hexagon .inner, .colorblock, .storebutton:hover, .iconmenu, .mainmenu, .appsblock .apps .slider .navigation:hover, .priceblock .block-container .pricetable .priceitem, .contactsblock .input-container input[type="submit"], .footerblock, .blogblock .navigation .page-numbers.current, .mainmenu .menuwrapper .menulist ul li ul li, .contactsblock .block-container .wrapper .contact-info a:hover, .contactsblock .block-container .wrapper .mailbutton.active {
          background-color: <?php echo $color ?>;
       }

       .hexagon .inner:before {
        border-color: transparent transparent <?php echo $color ?> transparent;
       }

       .hexagon .inner:after{
        border-color: <?php echo $color ?> transparent transparent  transparent;
       }

       .skillsblock .skillcontainer:hover .skillogo .logocontainer , .teamblock .block-container .teamcontainer .personal .photo
      { border-color: #c8c8c8; }

      .comments .commentlist .comment-article:hover .comment-block img{
        box-shadow: 0 0 0 3px #fff, 0 0 0 6px <?php echo $color ?>;
      }
		
  		#bg{
  			background-color: #e5e5e5;
  		}

      body{
        font-size: <?php if (!empty($pandora_options["style_font_size"])) echo $pandora_options["style_font_size"]; ?>;
      }

      </style>
    

    <?php

    if($pandora_options["style_radio"] == "pattern") {
        wp_enqueue_style('pattern', get_template_directory_uri() . '/styles/background-pattern.css');
        ?> 
        <style>
        .colorblock{
            background: url('<?php echo $pandora_options["style_pattern"]; ?>') repeat;
        }
        </style> 
        <?php
    }

    if($pandora_options["style_radio"] == "photo") {
        wp_enqueue_style('photo', get_template_directory_uri() . '/styles/background-photo.css');
        ?> 
        <style>
            .colorblock{
                background: url('<?php echo $pandora_options["style_photo"]; ?>') no-repeat;
                background-size: cover;
            }
        </style>
        <?php
    }
  }
}

add_action('customize_register', array( 'Pandora_Customize' , 'register' ) );
add_action( 'wp_head' , array( 'Pandora_Customize' , 'header_output' ) );

function pandora_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  ?>
  <li <?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="li-comment-<?php comment_ID() ?>">
    <article id="comment-<?php comment_ID(); ?>" class="comment-article">
      <div class="comment-block">
        <div class="comment-author vcard">
          <div class="comment-avatar">
            <?php
              $avatar_size = 80;
              echo get_avatar( $comment, $avatar_size );
            ?>
          </div>
          <div <?php comment_class('comment-container'); ?>   >
            
            <div class="comment-title">
              <span class="comment-title-author"> <?php printf( '%s', comment_author() ); ?></span>
              <span class="comment-title-datetime"> <?php printf( '  on %s at', get_comment_date() ); ?> <?php printf( '%s', get_comment_time() ); ?></span>
              
              <span class="activity"> 
                <?php edit_comment_link( __( 'Edit', 'pandora' ), '<span class="edit-link">', '</span> |' ); ?>
                <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?> 
              </span>
            </div>

            <div class="comment-content"><?php comment_text(); ?></div>
            
          </div>
        </div>

        <?php if ( $comment->comment_approved == '0' ) : ?>
          <div class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'pandora' ); ?></div>
          <br />
        <?php endif; ?>

      </div>

      
    </article>
    </li>
  <?php
}

function wp_corenavi() {
  global $wp_query, $wp_rewrite;
  $max = $wp_query->max_num_pages;
  if (!$current = get_query_var('paged')) $current = 1;
  $a['base'] = str_replace(999999999, '%#%', get_pagenum_link(999999999));
  $a['total'] = $max;
  $a['current'] = $current;

  $total = 1; 
  $a['mid_size'] = 3; 
  $a['end_size'] = 1; 
  $a['prev_text'] = '<i class="icon-angle-left icon-large"></i>'; 
  $a['next_text'] = '<i class="icon-angle-right icon-large"></i>'; 

  if ($max > 1) echo '<div class="navigation">';
  echo paginate_links($a);
  if ($max > 1) echo '</div>';
}

add_editor_style( get_template_directory_uri().'/styles/editor.css');
remove_theme_support('custom-header');
remove_theme_support('custom-background');
remove_theme_support('widgets');
remove_theme_support('sidebar');

require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'pandorabox_register_required_plugins' );

function pandorabox_register_required_plugins() {

  $plugins = array(

    array(
      'name'            => 'PandoraBox Blocks', 
      'slug'            => 'pandora-block', 
      'source'          => get_stylesheet_directory() . '/plugins/pandora-block.zip', 
      'required'        => true, 
      'version'         => '', 
      'force_activation'    => false,
      'force_deactivation'  => false, 
      'external_url'      => '',
    ),

    array(
      'name'            => 'PandoraBox Slider', 
      'slug'            => 'pandora-slider', 
      'source'          => get_stylesheet_directory() . '/plugins/pandora-slider.zip', 
      'required'        => true, 
      'version'         => '', 
      'force_activation'    => false,
      'force_deactivation'  => false, 
      'external_url'      => '',
    ),

    array(
      'name'            => 'PandoraBox Sections', 
      'slug'            => 'pandora-sections', 
      'source'          => get_stylesheet_directory() . '/plugins/pandora-sections.zip', 
      'required'        => true, 
      'version'         => '', 
      'force_activation'    => false,
      'force_deactivation'  => false, 
      'external_url'      => '',
    ),

    array(
      'name'            => 'PandoraBox PriceTable', 
      'slug'            => 'pandora-price', 
      'source'          => get_stylesheet_directory() . '/plugins/pandora-price.zip', 
      'required'        => true, 
      'version'         => '', 
      'force_activation'    => false,
      'force_deactivation'  => false, 
      'external_url'      => '',
    ),

    array(
      'name'    => 'Font Awesome Icons',
      'slug'    => 'font-awesome',
      'version' => '3.2.1',
      'required'  => true,
    ),

    array(
      'name'    => 'Contact Form 7',
      'slug'    => 'contact-form-7',
      'required'  => false,
    ),

  );

  $theme_text_domain = 'pandorabox';

  $config = array(
    'strings'         => array()
  );

  tgmpa( $plugins, $config );

}

?>
<?php include('images/social.png'); ?>