<?php
/*
Plugin Name: PandoraBox PriceTable
Plugin URI:
Description: Price Table special for template "PandoraBox"
Author: Iltaen
Version: 1.0
Author URI: http://themeforest.net/user/Iltaen
*/


add_action( 'init', 'create_pandora_price' );

function create_pandora_price() {
    register_post_type( 'pandora-price',
        array(
            'labels' => array(
                'name' => 'PB PriceTable',
                'singular_name' => 'PB PriceTable',
                'add_new' => 'Add New',
                'add_new_item' => 'Add New PriceTable',
                'edit' => 'Edit',
                'edit_item' => 'Edit PriceTable',
                'new_item' => 'New PriceTable',
                'view' => 'View',
                'view_item' => 'View PriceTable',
                'search_items' => 'Search PriceTable',
                'not_found' => 'No PriceTables found',
                'not_found_in_trash' => 'No PriceTables found in Trash',
                'parent' => 'Parent PriceTable'
            ),
            'public' => true,
            'menu_position' => 113,
            'supports' => array( 'title' ),
            'taxonomies' => array( '' ),   
            'has_archive' => true
        )
    );
}

add_action('add_meta_boxes', 'price_table', 1);

function price_table() {
    add_meta_box( 'price_table',
        'Price Table',
        'price_table_meta_box',
        'pandora-price', 'normal', 'low'
    );
}

function price_table_meta_box( $post ){
	?> 
		<style>
		#price-table td{padding: 3px;}
		#price-table a.button{width: 100%;}
		#price-table a.option_remove, #price-table a.col_remove {background: #FBE9DB;}
		#price-table .option_col{background: #EFEFEF;}
		</style>

		<script type="text/javascript">
		jQuery(document).ready(function($){
			$( '#price-table a.option_add' ).on('click', function() {
				$('#price-table tr.option_row:last').clone().insertAfter("#price-table tr.option_row:last");
				
				$('#price-table tr.option_row:last input[name="option_name[]"]').attr("value", "");
				$('#price-table tr.option_row:last input[name="option_check[]"]').removeAttr("checked");
				$('#price-table tr.option_row:last input[type="hidden"]').attr("name","option_check[]");

				if ($('#price-table tr.option_row').length > 1){
					$('a.option_remove').removeAttr("disabled");
				}
				return false;
			});
	  	
			$('#price-table').on('click', 'a.option_remove', function() {
				if ($('#price-table tr.option_row').length > 1){		
					$(this).parents('tr.option_row').remove();
					
				}

				if ($('#price-table tr.option_row').length <= 1){
					$('a.option_remove').attr("disabled", "disabled");
				}

			return false;
			});

			if ($('#price-table tr.option_row').length <= 1){
				$('a.option_remove').attr("disabled", "disabled");
			}

			if ($('#price-table tr:first>td.option_col').length <= 1){
				$('a.col_remove').attr("disabled", "disabled");
			}

			$( '#price-table a.col_add' ).on('click', function() {
				$('#price-table tr').each(function(){
					$('td.option_col:last', this).clone().insertAfter($('td.option_col:last', this));
					$('td.option_col:last input[type="text"]', this).removeAttr("value");
					$('td.option_col:last input[type="checkbox"]', this).removeAttr("checked");
					$('td.option_col:last input[name="button_link[]"]', this).attr("value", "http://");
				});

				if ($('#price-table tr:first>td.option_col').length > 1){
					$('a.col_remove').removeAttr("disabled");
				}
				return false;
			});

			$( '#price-table' ).on('click', 'a.col_remove', function() {
				var ind = $(this).parent().index() - 1;

				if ($('#price-table tr:first>td.option_col').length > 1){
				$('#price-table tr').each(function(){
					$('td.option_col:eq('+ ind +')', this).remove();
				});
				}

				if ($('#price-table tr:first>td.option_col').length <= 1){
					$('a.col_remove').attr("disabled", "disabled");
				}
				return false;
			});

			$( '#price-table' ).on('click', 'input[type=checkbox]', function() {
				if($(this).prop("checked")){
					$(this).parent().find('input[type=hidden]').attr("name","");
				} else {
					$(this).parent().find('input[type=hidden]').attr("name","option_check[]");
				}
			});
		});


		</script>
		

		<table id="price-table" cellspacing="0">
			<?php
		        $option_check 	= get_post_meta($post->ID, 'check', true);
				$option_name 	= get_post_meta($post->ID, 'option_name', true);
				$col_name 		= get_post_meta($post->ID, 'col_name', true); 
				$col_cost 		= get_post_meta($post->ID, 'col_cost', true);
				$button_link 	= get_post_meta($post->ID, 'button_link', true);
				$period 		= get_post_meta($post->ID, 'period', true);
				$button_name 	= get_post_meta($post->ID, 'button_name', true);


				$c_option = count($option_name);
				$c_col = count($col_name);
				if ($c_option <= 0) $c_option = 1;
		        if ($c_col <= 0) $c_col = 1;
	        ?>

			<tr>
				<td></td>
					<?php for ($td = 0; $td < $c_col; $td++ ){ ?>
					<td class="option_col"><input type="text" name="col_name[]" placeholder="Title" value="<?php if (isset($col_name[$td])) echo $col_name[$td] ?>"/></td>
					<?php } ?>
				<td><a class="col_add button">Add column</a></td>
			</tr>
			<?php for ($tr = 0; $tr < $c_option; $tr++ ){ ?>
			<tr class="option_row">
				<td><input type="text" name="option_name[]" placeholder="Option label" value="<?php if (isset($option_name[$tr])) echo $option_name[$tr] ?>"/></td>
					<?php
					for ($td = 0; $td < $c_col; $td++ ){ ?>
					<td class="option_col" style="text-align: center;">
						<input type="hidden" name="<?php if(isset($option_check[$tr][$td]) && $option_check[$tr][$td] == "off") {echo "option_check[]";} else {echo 'off';} ?>" />
						<input type="checkbox" name="option_check[]" <?php if(isset($option_check[$tr][$td]) && $option_check[$tr][$td] == "on") {echo "checked";} else {echo 'test';} ?> /></td>
					<?php } ?>
				<td><a class="option_remove button">Remove option</a></td>
			</tr>
			<?php } ?>
			<tr>
				<td>Cost /<input type="text" name="period" placeholder="month" style="width: 100px;" value="<?php echo $period ?>"/></td>
				<?php
					for ($td = 0; $td < $c_col; $td++ ){ ?>
					<td class="option_col"><input type="text" name="col_cost[]" placeholder="$" value="<?php if (isset($col_cost[$td])) echo $col_cost[$td] ?>" /></td>
				<?php } ?>
				<td></td>
			</tr>
			<tr>
				<td><input type="text" name="button_name" placeholder="Button label" value="<?php echo $button_name ?>"/></td>
				<?php
					for ($td = 0; $td < $c_col; $td++ ){ ?>
					<td class="option_col"><input type="text" placeholder="http://" name="button_link[]" value="<?php if (isset($button_link[$td])) echo $button_link[$td] ?>" /></td>
				<?php } ?>
				<td></td>
			</tr>
			<tr>
				<td><a class="option_add button" style="">Add option</a></td>
				<?php
					for ($td = 0; $td < $c_col; $td++ ){ ?>
					<td class="option_col"><a class="col_remove button">Remove column</a></td>
					<?php } ?>
				<td></td>
			</tr>

			
		</table>
		<input type="hidden" name="price_fields_nonce" value="<?php echo wp_create_nonce(__FILE__); ?>" />  
	<?php
}

add_action( 'save_post', 'price_table_save', 0);

function price_table_save($post_id) 
{     
    if (isset($_POST['price_fields_nonce']) && !wp_verify_nonce($_POST['price_fields_nonce'], __FILE__) ) return false; 
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false;  
    if ( !current_user_can('edit_post', $post_id) ) return false;  

    if (isset($_POST['option_check'])) $option_check = $_POST['option_check'];
	if (isset($_POST['option_name'])) $option_name = $_POST['option_name'];
	if (isset($_POST['col_name'])) $col_name =  $_POST['col_name'];
	if (isset($_POST['col_cost'])) $col_cost = $_POST['col_cost'];
	if (isset($_POST['button_link'])) $button_link = $_POST['button_link'];

	if (isset($_POST['period'])) $period = $_POST['period'];
	if (isset($_POST['button_name'])) $button_name = $_POST['button_name'];
	

	$check = array();
	$ind = 0;
    
    if (isset($_POST['option_name'])){
	    for ($tr=0; $tr < count($option_name); $tr++){
	    	for ($td=0; $td < count($col_name); $td++){
	    		if ($option_check[$ind] == "on"){
	    			$check[$tr][$td] = $option_check[$ind];
	    		} else {
	    			$check[$tr][$td] = "off";	
	    		}
	    		
	    		$ind++;
	    	}
		}
	}

    if (isset($_POST['period'])) update_post_meta($post_id, 'period', $period);
    if (isset($_POST['button_name'])) update_post_meta($post_id, 'button_name', $button_name); 
    if (isset($_POST['option_name'])) update_post_meta($post_id, 'option_name', $option_name);
    if (isset($_POST['col_name'])) update_post_meta($post_id, 'col_name', $col_name); 
    if (isset($_POST['col_cost'])) update_post_meta($post_id, 'col_cost', $col_cost);
    if (isset($_POST['button_link'])) update_post_meta($post_id, 'button_link', $button_link); 
    update_post_meta($post_id, 'check', $check); 

    return $post_id;  
}

?>