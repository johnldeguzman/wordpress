<?php get_header(); ?>

	<div class="colorblock" id="bg"></div>

	 <div class="block whiteblock blogblock">
        <div id="blog" class="block-container single">
            <?php while ( have_posts() ) : the_post(); ?>
                <h1 class="title"> <?php the_title(); ?> </h1>
                <div class="table">
                    <div class="postlist">
                	<article <?php post_class('article-post'); ?>>
                	

                		<div class="meta">
                            <div class="type">
                                
                                <?php if (has_post_format('chat')) {echo '<i class="icon-comments icon-2x"> </i>';} 
                                 else if (has_post_format('gallery')) {echo '<i class="icon-picture icon-2x"> </i>';}
                                 else if (has_post_format('link')) {echo '<i class="icon-link icon-2x"> </i>';}
                                 else if (has_post_format('image')) {echo '<i class="icon-camera icon-2x"> </i>';}
                                 else if (has_post_format('quote')) {echo '<i class="icon-quote-left icon-2x"> </i>';}
                                 else if (has_post_format('video')) {echo '<i class="icon-facetime-video icon-2x"> </i>';}
                                 else if (has_post_format('audio')) {echo '<i class="icon-headphones icon-2x"> </i>';}
                                 else {echo '<i class="icon-file-text icon-2x"> </i>';}
                                ?>
                                
                            </div>
                            <div class="date metablock"><?php echo get_the_date('d M Y')?></div>
                            <div class="author metablock">by&nbsp;<?php the_author() ?></div>
                            <div class="comments-count metablock"> <?php comments_popup_link( 'No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?> </div>
                            <div class="category metablock"> <?php the_category(', '); ?> </div>
                            <div class="tags metablock"> <?php the_tags('', ', ', ''); ?>  </div>
                        </div>

                        <div class="post-body">
                        	<?php the_post_thumbnail(); ?>
                            <div class="post-container">
                                <?php the_content();?>
                            </div>
                        </div>
        			</article>
        			
        			<div class="navigation">
         			<?php previous_post_link('<span class="alignleft"> %link </span>','<i class="icon-angle-left"></i> Previous'); ?>
        			<?php next_post_link('<span class="alignright"> %link </span>', 'Next <i class="icon-angle-right"></i>'); ?> 
        			<?php wp_link_pages(); ?>
                    </div>
        			<?php endwhile; ?>

                <?php comments_template('', true); ?>
                </div>
                <?php get_sidebar(); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>