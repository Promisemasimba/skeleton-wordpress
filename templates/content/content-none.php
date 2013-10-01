<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Skeleton_WordPress
 * @since 0.3
 */
?>

<article id="post-0" <?php post_class(); ?> class="post no-results not-found">
	<?php the_post_thumbnail(); ?>
	<?php if(is_single()) : ?>
	<h1 class="entry-title"><?php the_title(); ?></h1>
	<?php else : ?>
	<h1 class="entry-title">
		<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(sprintf(__('Permalink to %s', 'twentytwelve'), the_title_attribute('echo=0'))); ?>" rel="bookmark"><?php the_title(); ?></a>
	</h1>
	<?php endif; // is_single() ?>
<?php if(current_user_can('edit_posts')) : // show custom message to those who can edit posts ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php _e('No posts to display', 'skeleton_wordpress'); ?></h1>
	</header>
	<div class="entry-content">
		<p><?php printf(__('Ready to publish your first post? <a href="%s">Get started here</a>.', 'skeleton_wordpress'), admin_url('post-new.php')); ?></p>
	</div><!-- .entry-content -->
<?php else : // Show the default message to everyone else. ?>
	<header class="entry-header">
		<h1 class="entry-title"><?php _e('Nothing Found', 'skeleton_wordpress'); ?></h1>
	</header>
	<div class="entry-content">
		<p><?php _e('Apologies, but no results were found. Perhaps searching will help find a related post.', 'skeleton_wordpress'); ?></p>
		<?php get_search_form(); ?>
	</div>
<?php endif;?>
</article>