<?php
 $pandora_options = get_option('pandora_options');
?>

<?php if (isset($pandora_options["team_check"]) && $pandora_options["team_check"] == "on") { ?>
<div class="teamblock whiteblock block">
    <div id="team" class="block-container">
        <?php if (!empty($pandora_options['team_title'])) { ?> <h2 class="title"><?php echo $pandora_options['team_title']; ?></h2> <?php } ?>
        <?php if (!empty($pandora_options['team_subtitle'])) { ?> <div class="description"><?php echo $pandora_options['team_subtitle']; ?></div> <?php } ?>           
        <div class="teamcontainer">
            
            <?php query_posts(array('post_type'=>'pandora-team')); ?>       
            <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?> 
            <div class="personal">
                <?php
                $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $team_photo_link = get_post_meta($post->ID, 'team_photo_link', true);
                if ($team_photo_link) {echo '<a href="'.$team_photo_link.'">'; }
                ?>
                    <div class="photo" style="background-image: url('<?php echo $url ?>')"></div>
                <?php if ($team_photo_link) {echo '</a>';} ?>
                
                <div class="userinfo">
                    <div class="name"><?php the_title(); ?></div>
                    <div class="status"><?php echo (get_post_meta($post->ID, 'profession', true)); ?></div>
                    <div class="socialblock">
                        <?php 
                        $team_icons = get_post_meta($post->ID, 'team_icons', true); 
                        if (!empty($team_icons)){
                        for ($i = 0; $i < count($team_icons); $i++ ){
                        ?>
                            <a href="<?php echo $team_icons[$i]['social_link']; ?>" class="socialicon" title="<?php echo $team_icons[$i]['social_alt']; ?>"><i class="<?php echo $team_icons[$i]['social_icon']; ?>"></i></a>
                        <?php 
                        }}
                        ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>

        </div>
    </div>
</div>
<?php } ?>