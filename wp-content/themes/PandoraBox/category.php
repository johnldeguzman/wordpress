<?php 
get_header(); 
$pandora_options = get_option('pandora_options');
?>

<div class="colorblock" id="bg"></div>
        
 <div class="block whiteblock blogblock">
        <div id="blog" class="block-container">
            <h1 class="title"> <?php if (isset($pandora_options['blog_title'])) echo $pandora_options['blog_title'];?></h1>
            <div class="description"><?php if (isset($pandora_options['blog_subtitle'])) echo $pandora_options['blog_subtitle'];?></div>

            <div class="postlist"> 
            <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post(); ?>
                <article <?php post_class('article-post'); ?>>
                    <div class="meta">
                        <div class="type">
                            <a href="<?php the_permalink() ?>">
                            <?php if (has_post_format('chat')) {echo '<i class="icon-comments icon-2x"> </i>';} 
                             else if (has_post_format('gallery')) {echo '<i class="icon-picture icon-2x"> </i>';}
                             else if (has_post_format('link')) {echo '<i class="icon-link icon-2x"> </i>';}
                             else if (has_post_format('image')) {echo '<i class="icon-camera icon-2x"> </i>';}
                             else if (has_post_format('quote')) {echo '<i class="icon-quote-left icon-2x"> </i>';}
                             else if (has_post_format('video')) {echo '<i class="icon-facetime-video icon-2x"> </i>';}
                             else if (has_post_format('audio')) {echo '<i class="icon-headphones icon-2x"> </i>';}
                             else {echo '<i class="icon-file-text icon-2x"> </i>';}
                            ?>
                            </a>
                        </div>
                        <div class="date metablock"><?php echo get_the_date('d M Y')?></div>
                        <div class="author metablock">by&nbsp;<?php the_author() ?></div>
                        <div class="comments-count metablock"> <?php comments_popup_link( 'No comments', '1 comment', '% comments', 'comments-link', 'Comments are closed'); ?> </div>
                        <div class="category metablock"> <?php the_category(', '); ?> </div>
                        <div class="tags metablock"> <?php the_tags('', ', ', ''); ?>  </div>
                    </div>
                    <div class="post-body">
                        <?php the_post_thumbnail(); ?>
                        <h3 class="title">
                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        </h3>

                        <div class="post-container">
                            <?php the_content('Read more');?>
                        </div>
                    </div>
                </article>
                <?php endwhile; ?>

                <?php if (function_exists('wp_corenavi')) wp_corenavi(); else posts_nav_link(); ?>

                <?php else : ?>
                    <article><h4><?php echo 'Posts not found!'; ?></h4></article>
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>

<?php get_footer(); ?>