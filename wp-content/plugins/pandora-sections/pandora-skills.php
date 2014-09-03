<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
add_action( 'init', 'create_pandora_skills' );

function create_pandora_skills() {
    register_post_type( 'pandora-skills',
        array(
            'labels' => array(
                'name' => 'PB Skills',
                'singular_name' => 'PB Skill',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Skill',
                'edit' => 'Edit',
                'edit_item' => 'Edit Skill',
                'new_item' => 'New Skill',
                'view' => 'View',
                'view_item' => 'View Skill',
                'search_items' => 'Search Skills',
                'not_found' => 'No Skills found',
                'not_found_in_trash' => 'No Skills found in Trash',
                'parent' => 'Parent Skill'
            ),
            'public' => true,
            'menu_position' => 111,
            'supports' => array( 'title', 'editor' ,'thumbnail' ),
            'taxonomies' => array( '' ),   
            'has_archive' => true
        )
    );
}

add_action( 'save_post', 'add_skill_fields', 0);

function add_skill_fields($post_id) 
{     
    if (isset($_POST['skill_fields_nonce']) && !wp_verify_nonce($_POST['skill_fields_nonce'], __FILE__) ) return false; 
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;  
    if ( !current_user_can('edit_post', $post_id) ) return false;  
    
    if (isset($_POST['skill_icon_select'])) update_post_meta($post_id, 'skill_icon', esc_attr( $_POST['skill_icon_select'] )); 
    if (isset($_POST['skill_link'])) update_post_meta($post_id, 'skill_link', stripcslashes($_POST['skill_link'])); 

    return $post_id;  
} 

add_action( 'admin_init', 'skills_icon_select', 1);
add_action( 'admin_init', 'skills_link', 1);
add_action('do_meta_boxes', 'remove_fimage_box');

function remove_fimage_box(){
    remove_meta_box( 'postimagediv', 'pandora-skills', 'side' );
}


function skills_icon_select() {
    add_meta_box( 'skill_icon_select',
        'Select icon',
        'skill_icon_select_meta_box',
        'pandora-skills', 'normal', 'high'
    );
}

function skills_link() {
    add_meta_box( 'skill_link',
        'Add link',
        'skill_link_meta_box',
        'pandora-skills', 'normal', 'high'
    );
}

function skill_icon_select_meta_box( $post ) {  
    $skill_icon = get_post_meta($post->ID, 'skill_icon');
    ?>

    <?php if (is_plugin_active('font-awesome/plugin.php')) {?>
    <table>
        <tr>
            <th style="min-width: 70px;">Skill icon:</th>
            <td style="font-size: 18px; text-align: center; color: #777;">
                <i title="Old icon" class="<?php echo $skill_icon[0] ?>"></i>
            </td>
            <td>
                <select style="width: 200px; font-family:'FontAwesome', Arial; font-size: 14px; color: #333;" name="skill_icon_select">
                        <option value="<?php if (isset($skill_icon[0])) echo $skill_icon[0]; ?>"> <?php if (isset($skill_icon[0])) echo $skill_icon[0]; ?></option> 
                        <option> </option>
                        <?php readfile(plugin_dir_path( __FILE__ ) . "icons-list.html"); ?>
                </select> 
            </td>
        </tr>
    </table>
    <?php } else {?>
        <blockquote>Plugin <a href="http://wordpress.org/plugins/font-awesome/"> FontAwesome Icons</a> don't activated! Please, install and enable it on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote>
      <?php } ?>

    <input type="hidden" name="skill_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />  
<?php
}


function skill_link_meta_box( $post ) {  
    $skill_link = get_post_meta($post->ID, 'skill_link', true);
    ?>

    <table style="width: 100%;">
        <tr>
            <th style="width: 60px;">Link:</th>
            <td>
            <input type="text" name="skill_link" style="width: 100%;" value="<?php if (isset($skill_link)) echo $skill_link; ?>">
            </td>
        </tr>
    </table>

<?php } ?>