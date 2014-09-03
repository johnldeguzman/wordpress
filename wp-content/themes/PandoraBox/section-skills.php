<?php
 $pandora_options = get_option('pandora_options');
?>

<?php query_posts(array('post_type'=>'pandora-skills')); 
    if ( have_posts() ){
?>       
    <div class="skillsblock block grayblock" id="skills">
        <div class="block-container">
            <?php while ( have_posts() ) : the_post(); 
            $skill_link = get_post_meta($post->ID, 'skill_link', true);
            ?> 
            <<?php if (empty($skill_link)) {echo "div";} else {echo 'a href="'.$skill_link.'"';  } ?> class="skillcontainer">
                <div class="wrapper">
                   <div class="skillogo">
                       <div class="logocontainer">
                           <i class="<?php echo (get_post_meta($post->ID, 'skill_icon', true)); ?>"></i>
                       </div>
                   </div>
                    <h4 class="title">
                    <?php the_title(); ?>   
                    </h4>
                    <div class="description">
                    <?php the_content();?>
                    </div>
                </div>
            </<?php if (empty($skill_link)) {echo "div";} else {echo 'a'; } ?>>
            <?php endwhile; ?>
        </div>
    </div>
    <?php } ?>