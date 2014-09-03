<?php
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

add_action( 'init', 'create_pandora_team' );

function create_pandora_team() {
    register_post_type( 'pandora-team',
        array(
            'labels' => array(
                'name' => 'PB Team',
                'singular_name' => 'PB Person',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New Person',
                'edit' => 'Edit',
                'edit_item' => 'Edit Person',
                'new_item' => 'New Person',
                'view' => 'View',
                'view_item' => 'View Person',
                'search_items' => 'Search Persons',
                'not_found' => 'No Persons found',
                'not_found_in_trash' => 'No Persons found in Trash',
                'parent' => 'Parent Person'
            ),
            'public' => true,
            'menu_position' => 112,
            'supports' => array( 'title', 'thumbnail' ),
            'taxonomies' => array( '' ),   
            'has_archive' => true
        )
    );
}


function change_default_title( $title ){ 
    $screen = get_current_screen(); 
    if ( 'pandora-team' == $screen->post_type ){
        $title = 'Person`s name';
    } 
    return $title;
}
 
add_filter( 'enter_title_here', 'change_default_title' );

add_action('do_meta_boxes', 'add_team_photo_box');
add_action('do_meta_boxes', 'profession_field', 1);
add_action('do_meta_boxes', 'team_icon_select', 1);
add_action( 'save_post', 'add_team_fields', 0);


function add_team_photo_box(){
	remove_meta_box( 'postimagediv', 'pandora-team', 'side' );
	add_meta_box('postimagediv', __('Photo'), 'post_thumbnail_meta_box', 'pandora-team', 'normal', 'high');
 }

function add_team_fields($post_id) 
{     
    if (isset($_POST['team_fields_nonce']) && !wp_verify_nonce($_POST['team_fields_nonce'], __FILE__) ) return false; 
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;  
    if (!current_user_can('edit_post', $post_id) ) return false;  
    
    if (isset($_POST['social_icon_select'])) $social_icon = $_POST['social_icon_select'];
	if (isset($_POST['social_icon_link'])) $social_link = $_POST['social_icon_link'];
    if (isset($_POST['social_icon_alt'])) $social_alt = $_POST['social_icon_alt'];

	if (isset($social_icon)) {
        $count = count($social_icon);
    	$team_icons = array();
        for ($i=0; $i < $count; $i++){
        	if ($social_icon[$i] != '')
        	{
    	    	$team_icons[$i]['social_icon'] = $social_icon[$i];
    	    	$team_icons[$i]['social_link'] = stripslashes($social_link[$i]);
                $team_icons[$i]['social_alt'] = $social_alt[$i];
        	}
    	}
    }

    if (isset($team_icons)) update_post_meta($post_id, 'team_icons', $team_icons); 
    if (isset($_POST['profession'])) update_post_meta($post_id, 'profession',  $_POST['profession'] ); 
    if (isset($_POST['team_photo_link'])) update_post_meta($post_id, 'team_photo_link',  $_POST['team_photo_link'] ); 
    return $post_id;  
}

function team_icon_select() {
    add_meta_box( 'team_icon_select',
        'Social icon',
        'team_icon_select_meta_box',
        'pandora-team', 'normal', 'low'
    );
}


function team_icon_select_meta_box( $post ) {
    ?>

    <script type="text/javascript">
	jQuery(document).ready(function($){
		$( '#add_link' ).on('click', function() {
			$('#links_table tr:last').clone().appendTo("#links_table");
			$('#links_table tr:last input[name="social_icon_link[]"]').attr("value", "http://");
			$('#links_table tr:last select[name="social_icon_select[]"]').val("");
			
			if ($('#links_table tr').length > 1){
			$('.remove_link').removeAttr("disabled");
			}
			return false;
		});
  	
		$('#links_table').on('click', '.remove_link', function() {
			if ($('#links_table tr').length > 1){		
				$(this).parents('tr').remove();
			}

			if ($('#links_table tr').length <= 1){
				$('.remove_link').attr("disabled", "disabled");
			}

		return false;
		});

		if ($('#links_table tr').length <= 1){
			$('.remove_link').attr("disabled", "disabled");
		}
	});


	</script>
    <?php if (is_plugin_active('font-awesome/plugin.php')) {?>
    <table id="links_table">
        <?php
        $team_icons = get_post_meta($post->ID, 'team_icons', true);

        if (empty($team_icons)) {
        	$team_icons[0]['social_icon'] = "";
        	$team_icons[0]['social_link'] = "http://";
            $team_icons[0]['social_alt'] = "";
        }

        for ($i = 0; $i < count($team_icons); $i++ ){
        ?>
        <tr>
            <th class="px200">Social icon:</th>
            <td style="font-size: 18px; text-align: center; color: #777;">
            	<i title="Old icon" class="<?php echo $team_icons[$i]['social_icon']; ?>"></i>
            </td>
            <td class="w50">
                <select class="icon-select" name="social_icon_select[]"> 
                	<option value="<?php echo $team_icons[$i]['social_icon']; ?>"> <?php echo $team_icons[$i]['social_icon']; ?> </option>
                	<option> </option>
					<?php readfile(plugin_dir_path( __FILE__ ) . "icons-list.html"); ?>
                </select> 
            </td>
            <td class="w100">
            	<input type="text" class="w100" name="social_icon_link[]" value="<?php if (isset($team_icons[$i]['social_link'])) echo $team_icons[$i]['social_link']; ?>" placeholder="Icon link" />
                <input type="text" class="w100" name="social_icon_alt[]" value="<?php if (isset($team_icons[$i]['social_alt'])) echo $team_icons[$i]['social_alt']; ?>" placeholder="Icon title" />
            </td>
            <td>
            	 <a class="button remove_link">Remove icon</a>
            </td>
        </tr>
       <?php } ?>
    </table>
    <a id="add_link" class="button">Add icon</a>
    <?php } else {?>
        <blockquote>Plugin <a href="http://wordpress.org/plugins/font-awesome/"> FontAwesome Icons</a> don't activated! Please, install and enable it on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote>
      <?php } ?>

    <input type="hidden" name="team_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />  
<?php
}


function profession_field() {
    add_meta_box( 'profession_field',
        'Options',
        'profession_field_meta_box',
        'pandora-team', 'normal', 'low'
    );
}

function profession_field_meta_box( $post ) {
	?>
    <table>
        <tr>
            <th class="px200">
                Photo link:
            </th>
            <td class="w100">
                <input type="text" name="team_photo_link" value="<?php echo get_post_meta($post->ID, 'team_photo_link', true); ?>" class="w100" placeholder="http://" />
            </td>
        </tr>
        <tr>
            <th>
                Profession:
            </th>
            <td class="w100">
                <input type="text" name="profession" value="<?php echo get_post_meta($post->ID, 'profession', true);  ?>" class="w100" />
            </td>
        </tr>
    </table>
	<?php
}

?>