<<<<<<< HEAD
<?php
/**
 * The template for displaying posts in the Link post format.
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.3
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php // echo esc_url(twentythirteen_get_link_url()); ?>"><?php the_title(); ?></a>
		</h1>

		<div class="entry-meta">
			<?php skeleton_entry_date(); ?>
			<?php edit_post_link(__('Edit', 'skeleton_wordpress'), '<span class="edit-link">', '</span>'); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'skeleton_wordpress')); ?>
		<?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'skeleton_wordpress') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
	</div><!-- .entry-content -->

	<?php if(is_single()) : ?>
	<footer class="entry-meta">
		<?php skeleton_post_meta(); ?>
		<?php if(get_the_author_meta('description') && is_multi_author()) : ?>
			<?php get_template_part('author-bio'); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
	<?php endif; // is_single() ?>
</article><!-- #post -->
=======
<?php
/**
 * The template for displaying posts in the Link post format.
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.3
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title">
			<a href="<?php // echo esc_url(twentythirteen_get_link_url()); ?>"><?php the_title(); ?></a>
		</h1>

		<div class="entry-meta">
			<?php skeleton_entry_date(); ?>
			<?php edit_post_link(__('Edit', 'skeleton_wordpress'), '<span class="edit-link">', '</span>'); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'skeleton_wordpress')); ?>
		<?php wp_link_pages(array('before' => '<div class="page-links"><span class="page-links-title">' . __('Pages:', 'skeleton_wordpress') . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>')); ?>
	</div><!-- .entry-content -->

	<?php if(is_single()) : ?>
	<footer class="entry-meta">
		<?php skeleton_post_meta(); ?>
		<?php if(get_the_author_meta('description') && is_multi_author()) : ?>
			<?php get_template_part('author-bio'); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
	<?php endif; // is_single() ?>
</article><!-- #post -->
>>>>>>> b521916e5fdbbe572ed319d6288ff6dd070f7a5f