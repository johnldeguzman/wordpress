<?php
/*
Plugin Name: PandoraBox 3D Slider
Plugin URI:
Description: 3D slider special for template "PandoraBox"
Author: Iltaen
Version: 1.1
Author URI: http://themeforest.net/user/Iltaen
*/

global $post;

add_theme_support( "post-thumbnails" );

function create_pandora_slide() {
    $args = array(
        'labels' => array(
                'name' => 'PB Slider',
                'singular_name' => 'PB Slide',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Slide',
                'edit' => 'Edit',
                'edit_item' => 'Edit Slide',
                'new_item' => 'New Slide',
                'view' => 'View',
                'view_item' => 'View Slide',
                'search_items' => 'Search Slides',
                'not_found' => 'No Slides found',
                'not_found_in_trash' => 'No Slides found in Trash',
                'parent' => 'Parent Slides'
            ),
        'singular_label' => "Slide",
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 110
       );

    register_post_type("pandora-slide" , $args );
}  
add_action('init', 'create_pandora_slide');
add_action('save_post', 'pb_slide_save', 0);
add_action('do_meta_boxes', 'change_image_box');
add_action('do_meta_boxes', 'pb_slide_options', 1);

function change_image_box()
{
    remove_meta_box( 'postimagediv', 'pandora-slide', 'side' );
    add_meta_box('postimagediv', __('Slide image'), 'post_thumbnail_meta_box', 'pandora-slide', 'normal', 'high');
}


function pb_slide_image_html( $content ) {
    $content = str_replace( __( 'Set featured image' ), __( 'Select or upload image' ), $content );
    return $content;
}

add_filter( 'admin_post_thumbnail_html', 'pb_slide_image_html' );

function pb_slide_options() {
    add_meta_box( 'pb_slide_options',
        'Slide options',
        'pb_slide_options_meta_box',
        'pandora-slide', 'normal', 'low'
    );
}

function pb_slide_options_meta_box( $post ) { 

    $slide_img_link = get_post_meta(get_the_ID(), 'slide_img_link', true);

    ?>  
    <table>
        <tr>
            <th class="px200">
                Image link:
            </th>
            <td class="w100">
                <input type="text" name="slide_img_link" value="<?php echo $slide_img_link; ?>" class="w100" placeholder="http://" />
            </td>
        </tr>

        <tr>
            <th>
                Slide id:
            </th>
            <td class="w100">
                <strong class="x2"> <?php echo $post->ID; ?> </strong><span class="fggray">  use this id for creating slider with custom slides, for example: [pb_slider ids="<?php echo $post->ID; ?>, xxx, yyy"] </span>
            </td>
        </tr>
    </table>

    <input type="hidden" name="slide_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />  

<?php }


function pandora_add_script()
{
    wp_register_script( 'pandora-slider', plugins_url( '/js/pandora-slider.js', __FILE__ ), '1.1', true );
    wp_enqueue_script( 'pandora-slider');
}
add_action( 'wp_enqueue_scripts', 'pandora_add_script' );


function pb_slide_save($post_id) 
{     
    if (isset($_POST['slide_fields_nonce']) && !wp_verify_nonce($_POST['slide_fields_nonce'], __FILE__) ) return false; 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;  
    if (!current_user_can('edit_post', $post_id) ) return false;  
    
    if (isset($_POST['slide_img_link'])) update_post_meta($post_id, 'slide_img_link',  $_POST['slide_img_link'] ); 

    return $post_id;  
}

function slide_create($post_id){
    $slide_img_link = get_post_meta($post_id, 'slide_img_link', true);

    $slide = '<div class="slide">';
    $slide .=   '<div class="slide-wrapper">';
    $slide .=     '<div class="picture">';

    if ($slide_img_link) {$slide .= '<a href='.$slide_img_link.'>';}
    $slide .=       get_the_post_thumbnail($post_id, 'large');
    if ($slide_img_link) {$slide .= '</a>';}

    $slide .=     '</div>';
    $slide .=     '<div class="container">';
    $slide .=          '<h1 class="title">' . get_the_title($post_id) . '</h1>';
    $slide .=          '<div class="description">';

    $pb_slide_object = get_post( $post_id );
    $pb_slide_content = $pb_slide_object->post_content;

    $slide .=              apply_filters( 'the_content', $pb_slide_content );
    $slide .=          '</div>';
    $slide .=     '</div>';
    $slide .=   '</div>';
    $slide .='</div>';

    return $slide;
}

function pb_insert_slider($atts)
{
    extract(shortcode_atts(array(
      'ids' => '',
      'time' => '10000',
   ), $atts));

    if ($ids) $ids_arr = explode(",", $ids);
    $idr = rand(1,100);

	$slider =  '<div id="pb_slider'.$idr.'" class="pb_slider">';

    if ($time != '0'){
        $slider .=  '<script>
                jQuery(window).load(function(){
                    var handclick = false;
                    $(".pb_slider .navigation-right").mousedown(function(){handclick = true;});
                    $(".pb_slider .navigation-left").mousedown(function(){handclick = true;});
                    setInterval(function(){if (!handclick) $("#pb_slider'.$idr.' .navigation-right").click();}, '.$time.');
                });
                </script>';
    }

    $slider .=  '<div class="navigation navigation-left">
                    <i class="icon-chevron-left"></i>
                </div>

                <div class="navigation navigation-right">
                    <i class="icon-chevron-right"></i>
                </div>
                
                <div class="rotator">';

		$pandoraslider_query= "post_type=pandora-slide";
		query_posts($pandoraslider_query);

    if (have_posts()) { 
        if($ids){
        	foreach ($ids_arr as &$value){
                $slider .= slide_create($value);
            }
        } else {
            while (have_posts()) : the_post();
                $slider .= slide_create(get_the_ID());
            endwhile; 
        }
    }

	wp_reset_query();
		
		$slider .= '</div></div>';
	return $slider;
}

add_shortcode('pb_slider', 'pb_insert_slider');

function bp_insert_button($atts){

    extract(shortcode_atts(array(
      'image' => 'playmarket',
      'link' => '#',
   ), $atts));

   $url = plugins_url() . '/pandora-slider/img/' . $image; 
   $pb_button = '<a class="storebutton" href="'. $link .'"><img src="'. $url .'.png"></a>';
   return $pb_button;
}

add_shortcode('pb_button', 'bp_insert_button');