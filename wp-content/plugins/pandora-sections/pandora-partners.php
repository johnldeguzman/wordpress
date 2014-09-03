<?php
add_action( 'init', 'create_pandora_partners' );

function create_pandora_partners() {
    register_post_type( 'pandora-partners',
        array(
            'labels' => array(
                'name' => 'PB Partners',
                'singular_name' => 'PB Partner',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Partner',
                'edit' => 'Edit',
                'edit_item' => 'Edit Partner',
                'new_item' => 'New Partner',
                'view' => 'View',
                'view_item' => 'View Partner',
                'search_items' => 'Search Partners',
                'not_found' => 'No Partners found',
                'not_found_in_trash' => 'No Partners found in Trash',
                'parent' => 'Parent Partner'
            ),
            'public' => true,
            'menu_position' => 114,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( '' ),   
            'has_archive' => true
        )
    );
}


add_action('do_meta_boxes', 'add_logo_box');
add_action('do_meta_boxes', 'add_partner_link');
add_action( 'save_post', 'save_partners', 0);

function add_logo_box(){
	remove_meta_box( 'postimagediv', 'pandora-partners', 'side' );
	add_meta_box('postimagediv', __('Partner Logo'), 'post_thumbnail_meta_box', 'pandora-partners', 'normal', 'high');
 }

function add_partner_link() {
    add_meta_box( 'add_partner_link',
        'Partner`s link',
        'partner_link_meta_box',
        'pandora-partners', 'normal', 'low'
    );
}

function partner_link_meta_box($post){
	?>
	<label for="partner_link">Link address: </label>
	<input type="text" name="partner_link" style="width: 300px;" value="<?php echo get_post_meta($post->ID, 'partner_link', true) ?>" placeholder="http://" />
	<input type="hidden" name="partners_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" /> 
	<?php
}

function save_partners($post_id) 
{     
    if (isset($_POST['partners_fields_nonce']) && !wp_verify_nonce($_POST['partners_fields_nonce'], __FILE__) ) return false; 
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;  
    if ( !current_user_can('edit_post', $post_id) ) return false;  

    if (isset($_POST['partner_link'])) update_post_meta($post_id, 'partner_link', $_POST['partner_link']); 

    return $post_id;  
}



?>