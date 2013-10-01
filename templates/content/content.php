<<<<<<< HEAD
<?php
/**
 * The main template file that controls the output of all posts that do **not** have a defined post type of default.
 * This will most likely be the file that needs to be edited to change the appearance of the posts.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.3
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_sticky() && is_home() && ! is_paged()) : ?>
	<div class="featured-post">
		<?php _e('Featured post', 'skeleton_wordpress'); ?>
	</div>
	<?php endif; ?>
	<header class="post-header">
		<?php the_post_thumbnail(); ?>
		<?php if(is_single()) : ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'skeleton_wordpress'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>
		<?php if(comments_open()) : ?>
			<div class="comments-link">
				<?php comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'skeleton_wordpress') . '</span>', __('1 Reply', 'skeleton_wordpress'), __('% Replies', 'skeleton_wordpress')); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>
	</header><!-- .post-header -->

	<?php if(is_search()) : // Only display Excerpts for Search ?>
	<div class="post-summary">
		<?php the_excerpt(); ?>
	</div><!-- .post-summary -->
	<?php else : ?>
	<div class="post-content">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'skeleton_wordpress')); ?>
		<?php wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'skeleton_wordpress'),
				'after' => '</div>'
			)
		); ?>
	</div><!-- .post-content -->
	<?php endif; ?>

	<footer class="post-meta">
		<?php skeleton_post_meta(); ?>
		<?php edit_post_link(__('Edit', 'skeleton_wordpress'), '<span class="edit-link">', '</span>'); ?>
		<?php if(is_singular() && get_the_author_meta('description') && is_multi_author()) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('skeleton_wordpress_author_bio_avatar_size', 68)); ?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h2><?php printf(__('About %s', 'skeleton_wordpress'), get_the_author()); ?></h2>
					<p><?php the_author_meta('description'); ?></p>
					<div class="author-link">
						<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
							<?php printf(__('View all posts by %s <span class="meta-nav">&rarr;</span>', 'skeleton_wordpress'), get_the_author()); ?>
						</a>
					</div><!-- .author-link	-->
				</div><!-- .author-description -->
			</div><!-- .author-info -->
		<?php endif; ?>
	</footer><!-- .post-meta -->
=======
<?php
/**
 * The main template file that controls the output of all posts that do **not** have a defined post type of default.
 * This will most likely be the file that needs to be edited to change the appearance of the posts.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.3
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_sticky() && is_home() && ! is_paged()) : ?>
	<div class="featured-post">
		<?php _e('Featured post', 'skeleton_wordpress'); ?>
	</div>
	<?php endif; ?>
	<header class="post-header">
		<?php the_post_thumbnail(); ?>
		<?php if(is_single()) : ?>
		<h1 class="post-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'skeleton_wordpress'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>
		<?php if(comments_open()) : ?>
			<div class="comments-link">
				<?php comments_popup_link('<span class="leave-reply">' . __('Leave a reply', 'skeleton_wordpress') . '</span>', __('1 Reply', 'skeleton_wordpress'), __('% Replies', 'skeleton_wordpress')); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>
	</header><!-- .post-header -->

	<?php if(is_search()) : // Only display Excerpts for Search ?>
	<div class="post-summary">
		<?php the_excerpt(); ?>
	</div><!-- .post-summary -->
	<?php else : ?>
	<div class="post-content">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'skeleton_wordpress')); ?>
		<?php wp_link_pages(
			array(
				'before' => '<div class="page-links">' . __('Pages:', 'skeleton_wordpress'),
				'after' => '</div>'
			)
		); ?>
	</div><!-- .post-content -->
	<?php endif; ?>

	<footer class="post-meta">
		<?php skeleton_post_meta(); ?>
		<?php edit_post_link(__('Edit', 'skeleton_wordpress'), '<span class="edit-link">', '</span>'); ?>
		<?php if(is_singular() && get_the_author_meta('description') && is_multi_author()) : // If a user has filled out their description and this is a multi-author blog, show a bio on their entries. ?>
			<div class="author-info">
				<div class="author-avatar">
					<?php echo get_avatar(get_the_author_meta('user_email'), apply_filters('skeleton_wordpress_author_bio_avatar_size', 68)); ?>
				</div><!-- .author-avatar -->
				<div class="author-description">
					<h2><?php printf(__('About %s', 'skeleton_wordpress'), get_the_author()); ?></h2>
					<p><?php the_author_meta('description'); ?></p>
					<div class="author-link">
						<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" rel="author">
							<?php printf(__('View all posts by %s <span class="meta-nav">&rarr;</span>', 'skeleton_wordpress'), get_the_author()); ?>
						</a>
					</div><!-- .author-link	-->
				</div><!-- .author-description -->
			</div><!-- .author-info -->
		<?php endif; ?>
	</footer><!-- .post-meta -->
>>>>>>> b521916e5fdbbe572ed319d6288ff6dd070f7a5f
</article><!-- #post -->