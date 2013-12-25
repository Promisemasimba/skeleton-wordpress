<?php
	// Exit if access directly
	if(!defined('ABSPATH')) exit;
?>

<?php
/**
 * The main template file.
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
 * @author Dennis Thompson
 * @copyright 2009-2013 AtomicPages LLC
 * @license license.txt
 * @since 0.1
 *
 * EXTRA DOCUMENTATION
 * @see skeleton_main_classes()		assets/functions.sidebar.php:57
 */
?>

<?php get_header(); ?>

	<div class="wrapper main-content">
		<div class="container content" role="main">
			<?php skeleton_content_before(); ?>
			<main id="main" <?php skeleton_main_classes() ?>>
				<?php skeleton_content_top(); ?>
				<?php if(have_posts()) : ?>
					<?php while(have_posts()) : ?>
						<?php the_post(); ?>
						<?php get_template_part('templates/content/content', get_post_format()); ?>
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part("templates/content/content", "none"); ?>
				<?php endif; ?>
				<?php skeleton_content_bottom(); ?>
			</main><!-- /main -->
			<?php skeleton_content_after(); ?>
		</div><!-- /.wrapper.main-content -->
	</div><!-- /.container.content -->
<?php get_footer(); ?>
