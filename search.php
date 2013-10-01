<?php
	// Exit if access directly
	if(!defined('ABSPATH')) exit;
?>

<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.1
 */
?>

<?php get_header(); ?>

	<div class="wrapper main-content">
		<div class="container content" role="main">
			<?php skeleton_content_before(); ?>
			<main id="main" <?php skeleton_main_classes() ?>>
				<?php skeleton_content_top(); ?>
				<?php if(have_posts()) : ?>
					<header class="page-header">
						<h1 class="page-title"><?php printf(__('Search Results for: %s', 'skeleton_wordpress'), get_search_query()); ?></h1>
					</header>
					<?php while(have_posts()) : the_post(); ?>
						<?php get_template_part('templates/content/content', get_post_format()); ?>
					<?php endwhile; ?>
					<?php skeleton_paging_nav(); ?>
				<?php else : ?>
					<?php get_template_part('templates/content/content', 'none'); ?>
				<?php endif; ?>
				<?php skeleton_content_bottom(); ?>
			</main><!-- /main -->
			<?php skeleton_content_after(); ?>
		</div><!-- /.wrapper.main-content -->
	</div><!-- /.container.content -->
<?php get_footer(); ?>