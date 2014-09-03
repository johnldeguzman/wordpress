	<div class="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'pandora' ); ?></p>
	</div>
	<?php
		return;
		endif;
	?>

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( _n( 'One comment:', '%1$s Comments:', get_comments_number(), 'pandora' ),
					number_format_i18n( get_comments_number() ), '<span>' . get_the_title() . '</span>' );
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'pandora' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'pandora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'pandora' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<ul class="commentlist">
			<?php wp_list_comments( array( 'callback' => 'pandora_comment' ) );	?>
		</ul>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', 'pandora' ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', 'pandora' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', 'pandora' ) ); ?></div>
			</nav>
		<?php endif; ?>

		<?php
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Comments are closed.' , 'pandora' ); ?></p>
		<?php endif; ?>

	<?php endif;  

	$comment_args = array( 'title_reply'=>'Leave a Comment:',

	'fields' => apply_filters( 'comment_form_default_fields', array(
		'author' => '<p class="comment-form-author">'.'<input id="author" name="author" type="text" value="'.esc_attr( $commenter['comment_author'] ).'" size="30"'.'placeholder="YOUR NAME'.( $req ? '*' : '' ).'" /></p>',   
		'email'  => '<p class="comment-form-email">' .'<input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . 'placeholder="YOUR MAIL'.( $req ? '*' : '' ).'" />'.'</p>', 'url' => '' )),
	    'comment_field' => '' . '<textarea id="comment" name="comment" aria-required="true"' . 'placeholder="YOUR MESSAGE'.( $req ? '*' : '' ).'"></textarea>',    	
		'comment_notes_before' => '',
		'comment_notes_after' => '<p class="notes-after">* - required fields</p>'
	);

	comment_form($comment_args); 

	?>

</div>
