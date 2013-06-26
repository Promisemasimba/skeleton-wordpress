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
 * @subpackage skeleton_wordpress
 * @since Skeleton WordPress 1.0
 */
?>
<?php get_header(); ?>
<div class="wrapper main-content">
	<div class="container content" role="main">
		<main id="main" class="twelve columns omega">
			<?php while(have_posts()) : ?>
				<?php the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header>

					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'skeleton_wordpress' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
					<footer class="entry-meta">
						<?php edit_post_link( __( 'Edit', 'skeleton_wordpress' ), '<span class="edit-link">', '</span>' ); ?>
					</footer><!-- .entry-meta -->
				</article><!-- #post -->
			<?php endwhile; ?>
		</main>
	</div>
		<?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>