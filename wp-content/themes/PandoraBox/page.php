<?php 
get_header(); 
?>
<div class="colorblock" id="bg"></div>
 <div class="block whiteblock blogblock">
        <div id="blog" class="block-container">
            <?php while ( have_posts() ) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('single-page'); ?>>
                    <h1 class="title"><?php the_title(); ?></h1>
                    <?php the_post_thumbnail(); ?>
                    <div class="post-body">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>

            <?php comments_template('', true); ?>
        </div>
    </div>

<?php get_footer(); ?>