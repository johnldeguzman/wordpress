<?php 
$pandora_options = get_option('pandora_options'); 
?>  

<!-- Smooth SVG font for webkit-browsers on Windows -->
<style>
        @media screen and (-webkit-min-device-pixel-ratio:0) {
        @font-face {
          font-family: 'FontAwesome';
          src: url('<?php echo plugins_url();?>/font-awesome/assets/font/fontawesome-webfont.svg') format('svg');
        }

        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri() ?>/font/lato-regular.svg') format('svg');
            font-weight: normal;
            font-style: normal; 
        }

        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri() ?>/font/lato-bold.svg') format('svg');
            font-weight: 700;
        }

        @font-face {
            font-family: 'Lato';
            src: url('<?php echo get_template_directory_uri() ?>/font/lato-light.svg') format('svg');
            font-weight: 300;
        }
      } 

      body {
          font-family: '<?php echo $pandora_options["style_font"];?>';
      }
      <?php if($pandora_options['fixed_menu']) {echo '.mainmenu{position: fixed;}';} 
          else {echo '.mainmenu{position: absolute;}';}
      ?>
</style>

<script type="text/javascript">
          if (document.getElementById('map-canvas')) getMap("<?php echo $pandora_options['contact_address'];?>", "<?php echo $pandora_options['contact_address'];?>");

          WebFont.load({
            google: {
              families: ['<?php echo $pandora_options["style_font"];?>:300,400,700,300italic,400italic,700italic']
            }
            });
</script>