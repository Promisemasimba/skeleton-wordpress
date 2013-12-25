<?php
	// Exit if access directly
	if (!defined('ABSPATH')) exit;

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
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
			<?php while(have_posts()) : ?>
				<?php the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="post-header">
						<h1 class="post-title"><?php the_title(); ?></h1>
					</header>
					<div class="post-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'skeleton_wordpress' ), 'after' => '</div>' ) ); ?>
					</div><!-- .post-content -->
					<footer class="post-meta">
						<?php edit_post_link( __( 'Edit', 'skeleton_wordpress' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .post-meta -->
				</article><!-- #post -->
			<?php endwhile; ?>
			<?php skeleton_content_bottom(); ?>
		</main><!-- /main -->
		<?php skeleton_content_after(); ?>
	</div><!-- /.wrapper.main-content -->
</div><!-- /.container.content -->
<?php get_footer(); ?>
