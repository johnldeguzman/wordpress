<?php
/*
Plugin Name: PandoraBox Blocks
Plugin URI:
Description: Homepage blocks for template "PandoraBox"
Author: Iltaen
Version: 1.0
Author URI: http://themeforest.net/user/Iltaen
*/

global $post;

function create_pandora_block() {
    $args = array(
        'labels' => array(
                'name' => 'PB Blocks',
                'singular_name' => 'PB Block',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Block',
                'edit' => 'Edit',
                'edit_item' => 'Edit Block',
                'new_item' => 'New Block',
                'view' => 'View',
                'view_item' => 'View Block',
                'search_items' => 'Search Blocks',
                'not_found' => 'No Blocks found',
                'not_found_in_trash' => 'No Blocks found in Trash',
                'parent' => 'Parent Blocks'
            ),
        'singular_label' => "Block",
        'public' => true,
        'show_ui' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'rewrite' => true,
        'supports' => array('title', 'editor', 'thumbnail'),
        'menu_position' => 105
       );

    register_post_type("pandora-block" , $args );
}  
add_action('init', 'create_pandora_block');
add_action( 'save_post', 'pb_block_save', 0);
add_action('do_meta_boxes', 'pb_block_options', 1);


function pb_block_save($post_id) 
{     
    if (isset($_POST['block_fields_nonce']) && !wp_verify_nonce($_POST['block_fields_nonce'], __FILE__) ) return false; 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;  
    if (!current_user_can('edit_post', $post_id) ) return false;  
    
    $block_colored = "color";
    if (isset($_POST['block_colored'])) $block_colored = $_POST['block_colored'];

    if (isset($_POST['block_description'])) update_post_meta($post_id, 'block_description',  $_POST['block_description'] ); 
    update_post_meta($post_id, 'block_colored', $block_colored); 

    return $post_id;  
}


function pb_block_options() {
    add_meta_box( 'pb_block_options',
        'Block options',
        'pb_block_options_meta_box',
        'pandora-block', 'normal', 'low'
    );
}

function pb_block_options_meta_box( $post ) { 

	$block_description = get_post_meta($post->ID, 'block_description', true);
	$block_colored = get_post_meta($post->ID, 'block_colored', true);
	?>

	<table>
		<tr>
			<th>
				Shortcode:
			</th>
			<td class="w100">
				<strong class="x2"> [pb_block id="<?php echo $post->ID; ?>"] </strong> - use this shortcode for display single block.
			</td>
		</tr>

		<tr>
			<th>
				Subtitle:
			</th>
			<td class="w100">
				<input type="text" class="w100" name="block_description" value="<?php echo $block_description; ?>" /> 
			</td>
		</tr>

		<tr>
			<th>
				Background:
			</th>
			<td>
				<input type="radio" name="block_colored" value="color" <?php if ($block_colored == "color") echo "checked"  ?>  /> <span class="radio_label"> Color </span>
				<input type="radio" name="block_colored" value="white" <?php if ($block_colored == "white") echo "checked"  ?>  /> <span class="radio_label"> White </span>
				<input type="radio" name="block_colored" value="gray" <?php if ($block_colored == "gray") echo "checked"  ?>  /> <span class="radio_label"> Gray </span>

			</td>
		</tr>
	</table>

    <input type="hidden" name="block_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />  

<?php }

function pb_insert_block($atts)
{
	extract(shortcode_atts(array(
      'id' => -1,
   ), $atts));

	$pb_block = "";

	$pb_block_query = "post_type=pandora-block";
	query_posts($pb_block_query);


	if ($id == -1 && have_posts()) {
		while (have_posts()) : the_post();
			$block_description = get_post_meta(get_the_ID(), 'block_description', true);
			$block_colored = get_post_meta(get_the_ID(), 'block_colored', true);

			if ($block_colored == "color") {$block_colored = "colorblock";} 
			if ($block_colored == "white") {$block_colored = "whiteblock";}
			if ($block_colored == "gray") {$block_colored = "grayblock";}

			$pb_block .= '<div class="block '. $block_colored .'">';
			$pb_block .=   '<div class="block-container">';
  			$pb_block .=     '<h2 class="title">'. get_the_title( get_the_ID() ) .'</h2>';
        	$pb_block .=     '<div class="description">'. $block_description .'</div>';
        	$pb_block .=     '<div class="content">';
            $pb_block .=         apply_filters( 'the_content', get_the_content() );
            $pb_block .=     '</div>';
            $pb_block .=   '</div>';
            $pb_block .='</div>';
		endwhile; 
		
	} else if (have_posts()) {
		$block_description = get_post_meta($id, 'block_description', true);
		$block_colored = get_post_meta($id, 'block_colored', true);
		
		if ($block_colored == "color") {$block_colored = "colorblock";} 
		if ($block_colored == "white") {$block_colored = "whiteblock";}
		if ($block_colored == "gray") {$block_colored = "grayblock";}

		$pb_block .= '<div class="block '. $block_colored .'">';
		$pb_block .=   '<div class="block-container">';
			$pb_block .=     '<h2 class="title">'. get_the_title( $id ) .'</h2>';
    	$pb_block .=     '<div class="description">'. $block_description .'</div>';
    	$pb_block .=     '<div class="content">';

    	$pb_block_object = get_post( $id );
    	$pb_block_content = $pb_block_object->post_content;

        $pb_block .=         apply_filters( 'the_content', $pb_block_content );
        $pb_block .=     '</div>';
        $pb_block .=   '</div>';
        $pb_block .='</div>';
	}

	wp_reset_query();

	return $pb_block;
}

add_shortcode('pb_block', 'pb_insert_block');