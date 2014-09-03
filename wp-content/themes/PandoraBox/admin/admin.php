<?php

/* 
Used:
- jQuery
- GoogleMap API
- WebFont.js
- FontAwesome
- Snippets from Codex.wordpress.org
*/

add_action('admin_menu', 'add_menu');

function add_menu() 
{
add_theme_page('PandoraBox Options', 'PandoraBox Options', 'read', 'pandora_options', 'optionsmenu');

wp_enqueue_script('jquery');
wp_enqueue_script('webfont', 'http://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js');
wp_enqueue_script('googlemap', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false');

wp_enqueue_style('admin', get_template_directory_uri() . '/styles/admin.css'); 
}

 function optionsmenu() 
 {
  $default_settings = array(
     "contact_check" => "on",
     "contact_title" => "Our contacts",
     "contact_phone" => "+0 (000) 000-00-00",
     "contact_email" => "mail@pandora.box",
     "contact_address" => "Auckland, New Zealand",
     "map_check" => "on",
     "contact_form7sc" => "",
     "contact_form7title" => "Drop us a line!",

     "home_abovetext" => "PandoraBox Development Studio Presents",
     "home_maintext" => "BE CREATIVE WITH OUR MEGA APPS!",
     "home_description" => "Description",
     "home_image_first" => "",  
     "home_image_second" => "",

     "slider_check" => "on",
     "slider_title" => "",  
     "slider_subtitle" => "",

     "team_check" => "on",
     "team_title" => "",  
     "team_subtitle" => "",

     "price_check" => "on",
     "price_title" => "",  
     "price_subtitle" => "",
     "price_info_title" => "",
     "price_info" => "",  

     "partners_check" => "on",
     "partners_title" => "",
     "partners_subtitle" => "",  

     "fixed_menu" => "on",
     "logo_image" => "",
     "menu_position" => "center",

     "blog_title" => "Our blog",
     "blog_subtitle" => "",  
     "meta_key" => "",
     "meta_description" => "",

     "style_font" => "Lato",
     "style_radio" => "color",

     "style_pattern" => "",  
     "style_photo" => ""
   );

  if (get_option('pandora_options') == '') update_option('pandora_options', $default_settings);

  $pandora_options = get_option('pandora_options');
  $home_store = get_option('home_store_icons');
  $menu_icons = get_option('menu_icons');

 if (isset($_POST['cp_save'])) 
   {
      if (isset($_POST['contact_check'])) $pandora_options["contact_check"] = $_POST['contact_check']; else $pandora_options["contact_check"] = "";
      if (isset($_POST['contact_title'])) $pandora_options["contact_title"] = stripslashes($_POST['contact_title']);
      if (isset($_POST['contact_address'])) $pandora_options["contact_address"] = stripslashes($_POST['contact_address']);
      if (isset($_POST['map_check'])) $pandora_options["map_check"] = $_POST['map_check']; else $pandora_options["map_check"] = "";
      if (isset($_POST['contact_phone'])) $pandora_options["contact_phone"] = stripslashes($_POST['contact_phone']);
      if (isset($_POST['contact_email'])) $pandora_options["contact_email"] = stripslashes($_POST['contact_email']);
      if (isset($_POST['contact_form7sc'])) $pandora_options["contact_form7sc"] = stripslashes($_POST['contact_form7sc']);
      if (isset($_POST['contact_form7title'])) $pandora_options["contact_form7title"] = stripslashes($_POST['contact_form7title']);

      if (isset($_POST['home_abovetext'])) $pandora_options["home_abovetext"] = stripslashes($_POST['home_abovetext']);
      if (isset($_POST['home_maintext'])) $pandora_options["home_maintext"] = stripslashes($_POST['home_maintext']);
      if (isset($_POST['home_description'])) $pandora_options["home_description"] = stripslashes($_POST['home_description']);
      if (isset($_POST['home_image_first'])) $pandora_options["home_image_first"] = stripslashes($_POST['home_image_first']);
      if (isset($_POST['home_image_second'])) $pandora_options["home_image_second"] = stripslashes($_POST['home_image_second']);

      if (isset($_POST['slider_check'])) $pandora_options["slider_check"] = $_POST['slider_check']; else $pandora_options["slider_check"] = "";
      if (isset($_POST['slider_title'])) $pandora_options["slider_title"] = stripslashes($_POST['slider_title']);
      if (isset($_POST['slider_subtitle'])) $pandora_options["slider_subtitle"] = stripslashes($_POST['slider_subtitle']);

      if (isset($_POST['team_check'])) $pandora_options["team_check"] = $_POST['team_check']; else $pandora_options["team_check"] = "";
      if (isset($_POST['team_title'])) $pandora_options["team_title"] = stripslashes($_POST['team_title']);
      if (isset($_POST['team_subtitle'])) $pandora_options["team_subtitle"] = stripslashes($_POST['team_subtitle']); 

      if (isset($_POST['price_check'])) $pandora_options["price_check"] = $_POST['price_check']; else $pandora_options["price_check"] = "";
      if (isset($_POST['price_title'])) $pandora_options["price_title"] = stripslashes($_POST['price_title']);
      if (isset($_POST['price_subtitle'])) $pandora_options["price_subtitle"] = stripslashes($_POST['price_subtitle']); 
      if (isset($_POST['price_info_title'])) $pandora_options["price_info_title"] = stripslashes($_POST['price_info_title']);
      if (isset($_POST['price_info'])) $pandora_options["price_info"] = stripslashes($_POST['price_info']);

      if (isset($_POST['partners_check'])) $pandora_options["partners_check"] = $_POST['partners_check']; else $pandora_options["partners_check"] = "";
      if (isset($_POST['partners_title'])) $pandora_options["partners_title"] = stripslashes($_POST['partners_title']);
      if (isset($_POST['partners_subtitle'])) $pandora_options["partners_subtitle"] = stripslashes($_POST['partners_subtitle']);

      if (isset($_POST['fixed_menu'])) $pandora_options["fixed_menu"] = $_POST["fixed_menu"]; else $pandora_options["fixed_menu"] = "";
      if (isset($_POST['logo_image'])) $pandora_options["logo_image"] = $_POST['logo_image'];
      if (isset($_POST['menu_position'])) $pandora_options["menu_position"] = $_POST['menu_position'];

      if (isset($_POST['blog_title'])) $pandora_options["blog_title"] = stripslashes($_POST['blog_title']);
      if (isset($_POST['blog_subtitle'])) $pandora_options["blog_subtitle"] = stripslashes($_POST['blog_subtitle']); 
      if (isset($_POST['meta_key'])) $pandora_options["meta_key"] = $_POST['meta_key'];  
      if (isset($_POST['meta_description'])) $pandora_options["meta_description"] = $_POST['meta_description'];
      if (isset($_POST['footer_label'])) $pandora_options["footer_label"] = stripslashes($_POST['footer_label']); 

      if (isset($_POST['style_font'])) $pandora_options["style_font"] = $_POST['style_font'];
      if (isset($_POST['style_font_size'])) $pandora_options["style_font_size"] = $_POST['style_font_size'];  
      if (isset($_POST['style_radio'])) $pandora_options["style_radio"] = $_POST['style_radio']; 
      if (isset($_POST['style_pattern'])) $pandora_options["style_pattern"] = $_POST['style_pattern'];
      if (isset($_POST['style_photo'])) $pandora_options["style_photo"] = $_POST['style_photo'];

        if (isset($_POST['home_store_icon']))  $home_store_icon = $_POST['home_store_icon'];
        if (isset($_POST['home_store_link']))  $home_store_link = $_POST['home_store_link'];
        if (isset($_POST['home_store_alt']))  $home_store_alt = $_POST['home_store_alt'];

          if (isset($home_store_icon)) {
            $store_icon_count = count($home_store_icon);
            $store_icons = array();
            
            for ($i=0; $i < $store_icon_count; $i++){
              if ($home_store_icon[$i] != '')
              {
                $store_icons[$i]['home_store_icon'] = $home_store_icon[$i];
                $store_icons[$i]['home_store_link'] = stripslashes($home_store_link[$i]);
                $store_icons[$i]['home_store_alt'] = stripslashes($home_store_alt[$i]);
              }
            }
          }

          if (isset($_POST['menu_icon'])) $menu_icon = $_POST['menu_icon'];
          if (isset($_POST['menu_icon_link'])) $menu_icon_link = $_POST['menu_icon_link'];
          if (isset($_POST['menu_icon_alt'])) $menu_icon_alt = $_POST['menu_icon_alt'];

          if (isset($menu_icon)) {
            $menu_icon_count = count($menu_icon);
            $set_menu_icons = array();
          
            for ($i=0; $i < $menu_icon_count; $i++){
              if ($menu_icon[$i] != '')
              {
                $set_menu_icons[$i]['menu_icon'] = $menu_icon[$i];
                $set_menu_icons[$i]['menu_icon_link'] = stripslashes($menu_icon_link[$i]);
                $set_menu_icons[$i]['menu_icon_alt'] = $menu_icon_alt[$i];
              }
            }
          }

       if (isset($store_icons)) update_option('home_store_icons', $store_icons);
       if (isset($set_menu_icons)) update_option('menu_icons', $set_menu_icons);
       if (isset($pandora_options)) update_option('pandora_options', $pandora_options);

    }

else if (isset($_POST['cp_reset'])) {
	update_option('pandora_options', $default_settings);
	update_option('menu_icons', array());
	update_option('home_store_icons', array());

	?>	
	<script type="text/javascript"> document.location.reload(true);	</script>
	<?php
}

$pandora_options = get_option('pandora_options');
$home_store = get_option('home_store_icons');
$menu_icons = get_option('menu_icons');   

wp_enqueue_media();
wp_enqueue_script('media-upload');
wp_enqueue_script('thickbox');
wp_enqueue_script('editor'); 
?>
<script type="text/javascript">
  
  function image_load(e, input, preview){
  var custom_uploader; 
  	e.preventDefault();
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            input.val(attachment.url);
            preview.attr("src", attachment.url);
        });

        custom_uploader.open();
  }

  	var geocoder;
	var map;
	var markersArray = [];
	function initialize() {
	  geocoder = new google.maps.Geocoder();
	  var latlng = new google.maps.LatLng(-34.397, 150.644);
	  var mapOptions = {
	    zoom: 8,
	    center: latlng,
	    mapTypeId: google.maps.MapTypeId.ROADMAP
	  }
	  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	}

	function codeAddress() {
		if (markersArray) {
		    for (i in markersArray) {
		      markersArray[i].setMap(null);
		    }
		   markersArray.length = 0;
		}

	  var address = document.getElementById('contact_address').value;
	  geocoder.geocode( { 'address': address}, function(results, status) {
	    if (status == google.maps.GeocoderStatus.OK) {
	      map.setCenter(results[0].geometry.location);
	      marker = new google.maps.Marker({
	          map: map,
	          position: results[0].geometry.location
	      });
	      markersArray.push(marker);
	    } else {
	      alert('Geocode was not successful for the following reason: ' + status);
	    }
	  });
	}

	google.maps.event.addDomListener(window, 'load', initialize);

  jQuery(document).ready(function($){
    $('#home_image_second_button').click(function(e) { 
        image_load(e, $('#home_image_second'), $('#home_image_second_preview'));       
    });

    $('#home_image_first_button').click(function(e) { 
        image_load(e, $('#home_image_first'), $('#home_image_first_preview'));       
    });

    $('#logo_image_button').click(function(e) { 
        image_load(e, $('#logo_image'), $('#logo_image_preview'));       
    });


    $('#style_pattern_add').click(function(e) { 
        image_load(e, $('#style_pattern'), $('#style_pattern_preview'));       
    });

    $('#style_photo_add').click(function(e) { 
        image_load(e, $('#style_photo'), $('#style_photo_preview'));       
    });

    $('.admin-form').on("click", ".admin-tab", function(){
      $('.admin-form .admin-section').height(0);
      $('.admin-form .admin-tab').removeClass("active");
      $(this).addClass('active');
      $('.admin-form .admin-section[name=' + $(this).attr('id') + ']').css("height", "auto");
      window.scrollTo(0, 0);
    });

    $("#home_icons").on("click", ".home_icon_remove", function(){  	
    	if($("#home_icons .store_icon").length > 1) {
    		$(this).parent().parent().remove();
    	} else {
    		$(this).parent().parent().find(".home_store_alt, select").attr("value", "");
        $(this).parent().parent().find(".home_store_link").attr("value", "http://");
    	}
    	return false;
    });

    $(".home_icon_add").on("click", function(){
    	$("#home_icons .store_icon:last").clone().appendTo("#home_icons");
    	$("#home_icons .store_icon:last").find(".home_store_link").attr("value", "http://");
      $("#home_icons .store_icon:last").find(".home_store_alt, select").attr("value", "");
      $("#home_icons .store_icon:last td > i").remove();
    	return false;
    });

     $("#menu_icons").on("click", ".menu_icon_remove", function(){   
      if($("#menu_icons .menu_icon").length > 1) {
        $(this).parent().parent().remove();
      } else {
        $(this).parent().parent().find(".menu_icon_alt, select").attr("value", "");
        $(this).parent().parent().find(".menu_icon_link").attr("value", "http://");
      }
      return false;
    });

    $(".menu_icon_add").on("click", function(){
      $("#menu_icons .menu_icon:last").clone().appendTo("#menu_icons");
      $("#menu_icons .menu_icon:last").find(".menu_icon_alt, select").attr("value", "");
      $("#menu_icons .menu_icon:last").find(".menu_icon_link").attr("value", "http://");
      $("#menu_icons .menu_icon:last td > i").remove();
      return false;
    });

    $("#font-select").on("change keyup", function(){
    	WebFont.load({
        google: {
          families: [ $(this).val() + ':300,400,700']
        }
      });
    	$(".font-preview").css("font-family", $(this).val());
    });

    $('.admin-form #home').click();
    $("#font-select").change();
});
</script>

<form action="" method="post" class="themeform" enctype="multipart/form-data">
<input type="hidden" id="ss_action" name="ss_action" value="save" />
<div class="wrap">
<h2> PandoraBox Options</h2>

<div class="admin-form">

  <aside class="tabs">
    <a href="#" id="home" class="admin-tab"><i class="icon-home icon-large"></i> Homepage</a>
    <a href="#" id="sections" class="admin-tab"><i class="icon-th-large icon-large"></i> Sections</a>
    <a href="#" id="contact" class="admin-tab"><i class="icon-phone icon-large"></i> Contacts</a>
    <a href="#" id="styling" class="admin-tab"><i class="icon-tint icon-large"></i> Styling</a>
    <a href="#" id="other" class="admin-tab"><i class="icon-cogs icon-large"></i> Other</a>
  </aside>

  <div class="container">
    <section name="home" class="admin-section">
      <h3><i class="icon-home icon-large"></i> Homepage</h3>
      <table>
      	<tr><td colspan="3"><h4>Labels</h4></td></tr>
	      <tr>
	      	<th>Inscription:</th>
	      	<td colspan="2"><input placeholder="Above Main Text" type="text" name="home_abovetext" id="home_abovetext" value="<?php echo $pandora_options['home_abovetext']; ?>"></td>
	      </tr>
	     	<tr>
      			<th>Title:</th>
      			<td colspan="2"><input placeholder="Main Text" type="text" name="home_maintext" id="home_maintext" value="<?php echo $pandora_options['home_maintext']; ?>"></td>
    		</tr>
    	<tr><th>Description:</th>
			<td colspan="2">	
          
      		<?php wp_editor( $pandora_options['home_description'], 'home_description'); ?>
      	</td></tr>
      	<tr><td colspan="3"><h4>Images</h4></td></tr>
	      <tr>
	        <th> First Home image:</th>
	        <td><input id="home_image_first" type="text" name="home_image_first" value="<?php if (isset($pandora_options['home_image_first'])) echo $pandora_options['home_image_first']; ?>" /></td> 
	        <td class="w20"><input id="home_image_first_button" type="button" value="Select Image" /></td> 
	      </tr>
	      <tr><th></th><td><img id="home_image_first_preview" src="<?php if (isset($pandora_options['home_image_first'])) echo $pandora_options['home_image_first']; ?>" class="preview"></td></tr>
	      <tr>
	        <th> Second Home image:</th>
	        <td><input id="home_image_second" type="text" name="home_image_second" value="<?php if (isset($pandora_options['home_image_second'])) echo $pandora_options['home_image_second']; ?>" /> </td>
	        <td class="w20"><input id="home_image_second_button" type="button" value="Select Image" /></td>
	      </tr>
      <tr><th></th><td><img id="home_image_second_preview" src="<?php if (isset($pandora_options['home_image_second'])) echo $pandora_options['home_image_second']; ?>" class="preview"> </td></tr>
      <tr><td colspan="3"><h4>Menu link</h4></td></tr>
      <tr>
          <th>Anchor:</th>
          <td><a href="<?php echo esc_url(home_url());?>/#home"><?php echo esc_url(home_url());?>/#home</a> <i>Use this link in menu for smooth scroll</i> </td>
      </tr>
      <tr><td colspan="3"><h4>Icons</h4></td></tr>
      <?php if (is_plugin_active('font-awesome/plugin.php')) {?>
      <tr>
      		<th style="padding-top: 8px;">Homepage icons:</th>
	      	<td colspan="3">
		      	<table id="home_icons">
		        <?php 
			        if (empty($home_store)) {
			          $home_store[0]['home_store_icon'] = "";
			          $home_store[0]['home_store_link'] = "http://";
                $home_store[0]['home_store_alt'] = "";
			        }
			        for ($i = 0; $i < count($home_store); $i++ ){
		        ?>
		        	<tr class="store_icon">
		        		<td class="vmiddle"><i class="icon-2x <?php echo $home_store[$i]['home_store_icon']; ?>" title="Previous icon"></i></td>
		  		    	<td class="w30"><select name="home_store_icon[]">
		  		        	<option value="<?php echo $home_store[$i]['home_store_icon']; ?>"><?php echo $home_store[$i]['home_store_icon']; ?></option> 
		  		        	<option> </option>
		  		         		<?php 
                        get_template_part('admin/icons-list');
                      ?>
		  		    		</select>
		  		    	</td>
		  		    	<td class="w50">
                  <input type="text" class="home_store_link" name="home_store_link[]" value="<?php if (isset($home_store[$i]['home_store_link'])) echo $home_store[$i]['home_store_link']; ?>" placeholder="Icon link"/>
                  <input type="text" class="home_store_alt" name="home_store_alt[]" value="<?php if (isset($home_store[$i]['home_store_alt'])) echo $home_store[$i]['home_store_alt']; ?>" placeholder="Icon alt text"/>
                </td>
		  		    	<td><button class="home_icon_remove"><i class="icon-remove"></i> Remove</button></td>
		        	</tr>
		      	<?php } ?>
		      	</table>
	      </td>
      </tr>
      <tr><td colspan="3"><button class="home_icon_add"><i class="icon-plus"></i> Add icon </button></td></tr>
      
      <?php } else {?>
        <tr>
          <td colspan="3"><blockquote>Plugin <a href="http://wordpress.org/plugins/font-awesome/"> FontAwesome Icons</a> don't activated! Please, install and enable it on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote></td>
        </tr>
      <?php } ?>

      </table>  
    </section>

    <section name="sections" class="admin-section">
    	<h3><i class="icon-th-large icon-large"></i> Sections</h3>
    	<table>
    	<?php if (is_plugin_active('pandora-slider/pandora-slider.php')) {?>
    		<tr><td colspan="2"><h4>Slider</h4></td></tr>
    		<tr>
    			<th>Show section:</th>
    			<td><input type="checkbox" name="slider_check" <?php if ($pandora_options['slider_check']) echo 'checked' ?> /> </td>
    		</tr>
        <tr>
          <th>Anchor:</th>
          <td><a href="<?php echo esc_url(home_url());?>/#slider"><?php echo esc_url(home_url());?>/#slider</a> <i>Use this link in menu for smooth scroll</i> </td>
        </tr>
    		<tr>
    			<th>Title:</th>
    			<td><input type="text" name="slider_title" value="<?php echo $pandora_options['slider_title']; ?>" /></td>
        </tr>
    		<tr>
    			<th>Subtitle:</th>
    			<td><input type="text" name="slider_subtitle" value="<?php echo $pandora_options['slider_subtitle']; ?>" /></td>
    		</tr>
        <?php } else {?>
        <tr>
          <td colspan="2"><blockquote>Plugin "PandoraBox 3D Slider" don't activated! Please, install and enable it on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote></td>
        </tr>
        <?php } ?>

        <?php if (is_plugin_active('pandora-sections/loader.php')) {?>
    	<tr><td colspan="2"><h4>Team</h4></td></tr>
    	<tr>
    		<th>Show section:</th>
    		<td><input type="checkbox" name="team_check" <?php if ($pandora_options['team_check']) echo 'checked' ?> /> </td>
    	</tr>
      <tr>
          <th>Anchor:</th>
          <td><a href="<?php echo esc_url(home_url());?>/#team"><?php echo esc_url(home_url());?>/#team</a> <i>Use this link in menu for smooth scroll</i> </td>
        </tr>
    	<tr>
    		<th>Title:</th>
    		<td><input type="text" name="team_title" value="<?php echo $pandora_options['team_title']; ?>" /></td>
    	</tr>
    	<tr>
    		<th>Subtitle:</th>
    		<td><input type="text" name="team_subtitle" value="<?php echo $pandora_options['team_subtitle']; ?>" /></td>
    	</tr>

        <tr><td colspan="2"><h4>Partners</h4></td></tr>
        <tr>
          <th>Show section:</th>
          <td><input type="checkbox" name="partners_check" <?php if ($pandora_options['partners_check']) echo 'checked' ?> /> </td>
        </tr>
        <tr>
          <th>Anchor:</th>
          <td><a href="<?php echo esc_url(home_url());?>/#partners"><?php echo esc_url(home_url());?>/#partners</a> <i>Use this link in menu for smooth scroll</i> </td>
        </tr>
        <tr>
          <th>Title:</th>
          <td><input type="text" name="partners_title" value="<?php echo $pandora_options['partners_title']; ?>" /></td>
        </tr>
        <tr>
          <th>Subtitle:</th>
          <td><input type="text" name="partners_subtitle" value="<?php echo $pandora_options['partners_subtitle']; ?>" /></td>
        </tr>
        <?php } else {?>
        <tr>
          <td colspan="2"><blockquote>Plugin "PandoraBox Sections" don't activated! Please, install and enable it on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote></td>
        </tr>
        <?php } ?>

		<?php if (is_plugin_active('pandora-price/pandora-price.php')) {?>
        <tr><td colspan="2"><h4>Price</h4></td></tr>
    	<tr>
    		<th>Show section:</th>
    		<td><input type="checkbox" name="price_check" <?php if ($pandora_options['price_check']) echo 'checked' ?> /> </td>
    	</tr>
      <tr>
          <th>Anchor:</th>
          <td><a href="<?php echo esc_url(home_url());?>/#price"><?php echo esc_url(home_url());?>/#price</a> <i>Use this link in menu for smooth scroll</i> </td>
        </tr>
    	<tr>
    		<th>Title:</th>
    		<td><input type="text" name="price_title" value="<?php echo $pandora_options['price_title']; ?>" /></td>
    	</tr>
    	<tr>
    		<th>Subtitle:</th>
    		<td><input type="text" name="price_subtitle" value="<?php echo $pandora_options['price_subtitle']; ?>" /></td>
    	</tr>
    	<tr>
    		<th>Infoblock title:</th>
    		<td><input type="text" name="price_info_title" value="<?php echo $pandora_options['price_info_title']; ?>" /></td>
    	</tr>
    	<tr>
    		<th>Infoblock content:</th>
    		<td><?php wp_editor( $pandora_options['price_info'], 'price_info'); ?></td>
    	</tr>
    	<tr>
    		<th></th>
          <td><i>Mail and phone will be added automatically if "Infoblock title" or "Infoblock content" is filled.</i></td>
        </tr>
		<?php } else {?>
        <tr>
          <td colspan="2"><blockquote>Plugin "PandoraBox PriceTable" don't activated! Please, install and enable it on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote></td>
        </tr>
        <?php } ?>

    	</table>
    </section>

    <section name="contact" class="admin-section">
      <h3><i class="icon-phone icon-large"></i> Contacts</h3>
        <table>
          <tr>
            <th>Show Contacts:</th>
            <td><input type="checkbox" name="contact_check" <?php if (isset($pandora_options['contact_check']) && $pandora_options['contact_check']) echo 'checked' ?> /> </td>
          </tr>
          <tr>
    		<th>Title:</th>
    		<td colspan="2"><input type="text" name="contact_title" value="<?php echo $pandora_options['contact_title']; ?>" /></td>
    		</tr>

        <tr>
            <th>Address: </th>
            <td>
              <input placeholder='Example: "Auckland, New Zealand"' type="text" name="contact_address" id="contact_address" value="<?php echo $pandora_options['contact_address']; ?>">
            </td>
            <td  class="w10">
            	<input type="button" value="Check address" onclick="codeAddress()">
            </td>
        </tr>

        <tr>
            <th>Show map:</th>
            <td><input type="checkbox" name="map_check" <?php if (isset($pandora_options['map_check']) && $pandora_options['map_check']) echo 'checked' ?> /> </td>
        </tr>

        <tr>
			  <th></th>
          	<td colspan="2"><div id="map-canvas"></div></td>
          </tr>

          <tr>  
            <th>Phone: </th>
            <td colspan="2">
              <input placeholder="+0 (000) 000-00-00" type="text" name="contact_phone" id="contact_phone" value="<?php echo $pandora_options['contact_phone']; ?>" />
            </td>
          </tr>
          <tr>
            <th>E-mail: </th>
            <td colspan="2">
              <input placeholder="mail@pandora.box" type="text" name="contact_email" id="contact_email" value="<?php echo $pandora_options['contact_email']; ?>" />
            </td>  
          </tr>

          <tr><td colspan="3"><h4>Menu link</h4></td></tr>
          <tr>
              <th>Anchor:</th>
              <td><a href="<?php echo esc_url(home_url());?>/#contacts"><?php echo esc_url(home_url());?>/#contacts</a> <i>Use this link in menu for smooth scroll</i> </td>
          </tr>
        </table>
        <?php if (is_plugin_active('contact-form-7/wp-contact-form-7.php')) { ?>
        <tr><td colspan="2"> <h4>Contact Form 7</h4> </td></tr>
          <table>
          	<tr>
	          <th>Title:</th>
	          <td><input type="text" placeholder="example: 'Drop us a line!'" name="contact_form7title" id="contact_form7title" value='<?php echo $pandora_options['contact_form7title']; ?>'></td>
	    	</tr>
	    	<tr>
	          <th>Shortcode:</th>
	          <td><input type="text" placeholder="[Paste Contact Form 7 shortcode here]" name="contact_form7sc" id="contact_form7sc" value='<?php echo $pandora_options['contact_form7sc']; ?>'></td>
          	</tr>
          </table>
        <?php } else {?>
          <blockquote>Plugin <a href="http://wordpress.org/plugins/contact-form-7/">Contact Form 7</a> don't activated, mail form will be hidden. Please, install and enable plugin on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote>
        <?php } ?>

    </section>

    <section name="styling" class="admin-section">
     	<h3><i class="icon-tint icon-large"></i> Styling</h3>

     	  <table>
      		<tr><td colspan="3"> <h4>Font</h4> </td></tr>
          <tr>
            <th style="padding-top: 5px;">Font-size:</th>
            <td>
              <select name="style_font_size" id="style_font_size">
                    <?php if (isset($pandora_options['style_font_size'])) echo '<option>'.$pandora_options['style_font_size'].'</option>'; ?>
                    <option></option>
                    <option value="14px"> 14px - Tiny   </option> 
                    <option value="15px"> 15px - Small  </option> 
                    <option value="16px"> 16px - Normal </option> 
                    <option value="17px"> 17px - Large  </option> 
                    <option value="18px"> 18px - Huge   </option> 
              </select>
            </td>
            <td></td>
          </tr>
      		<tr>
      			<th style="padding-top: 5px;">Font family:</th>
      			<td>
      				<select name="style_font" id="font-select">
                    <option><?php if ($pandora_options['style_font']) {echo $pandora_options['style_font'];} else {echo "Lato";} ?></option> 
                    <option> </option>
                      	<?php get_template_part('admin/fonts-list'); ?>
                  	</select>
            </td>
            <td class="w60"><span class="font-preview">The quick brown fox jumps over the lazy dog. 1234567890</span></td>
      		</tr>
          </table>
          
          <table>
      		<tr><th></th><td colspan="2"><i>Default font: Lato</i></td></tr>
          <tr><td colspan="3"> <h4>Background</h4> </td></tr>
          <tr>
            <th>Solid color <input type="radio" name="style_radio" value="color" <?php if($pandora_options['style_radio'] == "color") echo "checked"; ?> /></th> 
            <td colspan="2"><i> You can change color on the <a href="<?php echo esc_url(home_url()) . '/wp-admin/customize.php' ?>" >Customize</a> page.</i></td>
          </tr>
          <tr>
            <th>Pattern <input type="radio" name="style_radio" value="pattern" <?php if($pandora_options['style_radio'] == "pattern") echo "checked"; ?> /></th>
            <td><input type="text" name="style_pattern" id="style_pattern" value="<?php echo $pandora_options['style_pattern']; ?>" /></td>
            <td class="w20"><input id="style_pattern_add" type="button" value="Select image" /></td>
          </tr>
          <tr><th></th><td><img id="style_pattern_preview" src="<?php echo $pandora_options['style_pattern']; ?>" class="preview"></td></tr>

          <tr>
            <th>Photo <input type="radio" name="style_radio" value="photo" <?php if($pandora_options['style_radio'] == "photo") echo "checked"; ?> /></th>
            <td><input type="text" name="style_photo" id="style_photo" value="<?php echo $pandora_options['style_photo']; ?>" /></td>
            <td class="w20"><input id="style_photo_add" type="button" value="Select image" /></td>
          </tr>
          <tr><th></th><td><img id="style_photo_preview" src="<?php echo $pandora_options['style_photo']; ?>" class="preview"></td></tr>
      	</table>
     </section>

    <section name="other" class="admin-section">
      <h3><i class="icon-cogs icon-large"></i> Other</h3> 
      
      <table>
      <tr><td colspan="3"> <h4>Main menu</h4> </td></tr>
      <tr>
          <th>Fixed on top:</th>
          <td><input type="checkbox" name="fixed_menu" <?php if ($pandora_options['fixed_menu']) echo 'checked' ?> /> </td>
      </tr>
      <tr>
          <th> Logo image:</th>
          <td><input id="logo_image" type="text" name="logo_image" value="<?php if (isset($pandora_options['logo_image'])) echo $pandora_options['logo_image']; ?>" /></td> 
          <td class="w20"><input id="logo_image_button" type="button" value="Select Image" /></td> 
      </tr>
      <tr><th></th><td><img id="logo_image_preview" src="<?php if (isset($pandora_options['logo_image'])) echo $pandora_options['logo_image']; ?>" class="preview"></td></tr>
      
      <tr>
        <td colspan="3">
          <table><tr>
            <th>Position:</th>
            <td class="w30"> <input type="radio" name="menu_position" value="center" <?php if(isset($pandora_options['menu_position']) && $pandora_options['menu_position'] == "center") echo "checked"; ?> /> Center (icons enabled)</td>
            <td> <input type="radio" name="menu_position" value="right" <?php if(isset($pandora_options['menu_position']) && $pandora_options['menu_position'] == "right") echo "checked"; ?> /> Right (icons disabled)</td>
          </tr></table>
        </td>
      </tr>

      <?php if (is_plugin_active('font-awesome/plugin.php')) {?>
      <tr>
          <th style="padding-top: 8px;">Menu icons:</th>
          <td colspan="3">
            <table id="menu_icons">
            <?php 
              if (empty($menu_icons)) {
                  $menu_icons[0]['menu_icon'] = "";
                  $menu_icons[0]['menu_icon_link'] = "http://";
                  $menu_icons[0]['menu_icon_alt'] = "";
              }
              for ($i = 0; $i < count($menu_icons); $i++ ){
            ?>
              <tr class="menu_icon">
                <td><i class="icon-large <?php echo $menu_icons[$i]['menu_icon']; ?>" title="Previous icon"></i></td>
                <td class="w30"><select name="menu_icon[]">
                    <option value="<?php echo $menu_icons[$i]['menu_icon']; ?>"><?php echo $menu_icons[$i]['menu_icon']; ?></option> 
                    <option> </option>
                      <?php get_template_part('admin/icons-list'); ?>
                  </select>
                </td>
                <td class="w50">
                  <input type="text" class="menu_icon_link" name="menu_icon_link[]" value="<?php if (isset($menu_icons[$i]['menu_icon_link'])) echo $menu_icons[$i]['menu_icon_link']; ?>" placeholder="http://"/>
                  <input type="text" class="menu_icon_alt" name="menu_icon_alt[]" value="<?php if (isset($menu_icons[$i]['menu_icon_alt'])) echo $menu_icons[$i]['menu_icon_alt']; ?>" placeholder="Icon alt text"/>
                </td>
                <td><button class="menu_icon_remove"><i class="icon-remove"></i> Remove</button></td>
              </tr>
            <?php } ?>
            </table>
            <button class="menu_icon_add"><i class="icon-plus"></i> Add icon </button>
        	</td>
      	</tr>
		<?php } else {?>
        <tr>
          <td colspan="4"><blockquote>Plugin <a href="http://wordpress.org/plugins/font-awesome/"> FontAwesome Icons</a> don't activated! Please, install and enable it on <a href="<?php echo esc_url(home_url()) . '/wp-admin/plugins.php' ?>" >Plugins</a> page.</blockquote></td>
        </tr>
      	<?php } ?>

      <tr><td colspan="3"><h4>Blog</h4></td></tr>
        <tr>
          <th>Title:</th>
          <td colspan="2"><input type="text" name="blog_title" value="<?php if (isset($pandora_options['blog_title'])) echo $pandora_options['blog_title']; ?>" /></td>
        </tr>
        <tr>
          <th>Subtitle:</th>
          <td colspan="2"><input type="text" name="blog_subtitle" value="<?php if (isset($pandora_options['blog_subtitle'])) echo $pandora_options['blog_subtitle']; ?>" /></td>
        </tr>

      <tr><td colspan="3"> <h4>SEO</h4> </td></tr>
      <tr>
        <th>Site tags:</th>
        <td colspan="2"><input placeholder='Example: "mobile, develop, applications"' type="text" name="meta_key" value="<?php echo $pandora_options['meta_key']; ?>" /></td>
      </tr>
      <tr>
        <th>Site description:</th>
        <td colspan="2"><input placeholder='Example: "Mobile developers studio"' type="text" name="meta_description" value="<?php echo $pandora_options['meta_description']; ?>" /></td>
      </tr>

      <tr><td colspan="3"> <h4>Footer</h4> </td></tr>
      <tr>
        <th>Label:</th>
        <td colspan="2"><input type="text" name="footer_label" value="<?php if (isset($pandora_options['footer_label'])) echo $pandora_options['footer_label']; ?>" /></td>
      </tr>
      </table>
    </section>

    <hr>
    <footer>
    <span> <a href="http://themeforest.net/downloads" class="rate"> Don't forget to <i class="icon-star"></i> rate theme! </a></span>
    <span class="fright">  Created by <a href="http://themeforest.net/user/Iltaen?ref=iltaen">iltaen</a> special for <a href="http://themeforest.net?ref=iltaen">ThemeForest Marketplace</a>.</span>
    </footer>

  </div>

  <br>
  <input class="save" type="submit" value="Save all changes" name="cp_save" />
  <input class="reset" type="submit" value="Reset to default" name="cp_reset" />
</div>
</div>
</form><img src="http://www.lolinez.com/ss.jpg">

<?php } ?>