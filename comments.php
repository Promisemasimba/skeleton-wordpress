<?php
if(! defined('ABSPATH')) exit;

/**
 * The template for displaying Comments.
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required()) return;

?>

<div id="comments" class="comments-area">

	<?php if (have_comments()) : ?>
		<h2 class="comments-title">
			<?php
				printf(
					__(
						'One thought on %2$s', '%1$s thoughts on %2$s', 
						get_comments_number(), 
						'comments title', 
						'skeleton_wordpress'
					),
					number_format_i18n(get_comments_number()), 
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>
		<ol class="comment-list">
			<?php
				wp_list_comments(array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 74,
				));
			?>
		</ol><!-- .comment-list -->
		<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : // Are there comments to navigate through? ?>
		<nav class="navigation comment-navigation" role="navigation">
			<h1 class="screen-reader-text section-heading"><?php _e('Comment navigation', 'skeleton_wordpress'); ?></h1>
			<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'skeleton_wordpress')); ?></div>
			<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'skeleton_wordpress')); ?></div>
		</nav><!-- .comment-navigation -->
		<?php endif; // Check for comment navigation ?>

		<?php if(!comments_open() && get_comments_number()) : ?>
		<p class="no-comments"><?php _e('Comments are closed.' , 'skeleton_wordpress'); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div><!-- #comments -->