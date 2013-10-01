<?php
/**
 * The template for displaying Author archive pages.
 *
 * @package			WordPress
 * @subpackage		Skeleton
 * @author 			Dennis Thompson <http://atomicpages.net/>
 * @copyright		2009 - 2013 AtomicPages LLC
 * @license			license.txt
 * @since 			0.3
 */
?>

<?php get_header(); ?>
	<div class="wrapper main-content">
		<div class="container content" role="main">
			<?php skeleton_content_before(); ?>
			<main id="main" <?php skeleton_main_classes() ?>>
				<?php skeleton_content_top(); ?>
				<?php if(have_posts()) : ?>
					<?php the_post(); ?>
					<header class="archive-header">
						<h1 class="archive-title"><?php printf(__('All posts by %s', 'skeleton_wordpress'), '<span class="vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '" title="' . esc_attr(get_the_author()) . '" rel="me">' . get_the_author() . '</a></span>'); ?></h1>
					</header><!-- .archive-header -->
					<?php rewind_posts(); ?>
		
					<?php if(get_the_author_meta('description')) : ?>
						<?php get_template_part('templates/author/author', 'bio'); ?>
					<?php endif; ?>
		
					<?php while(have_posts()) : the_post(); ?>
						<?php get_template_part('templates/content/content', get_post_format()); ?>
					<?php endwhile; ?>
		
					<?php skeleton_wordpress_paging_nav(); ?>
		
				<?php else : ?>
					<?php get_template_part('templates/content/content', 'none'); ?>
				<?php endif; ?>
			<?php skeleton_content_bottom(); ?>
		</main><!-- main -->
			<?php skeleton_content_after(); ?>
		</div><!-- .container.content -->
	</div><!-- .wrapper.main-content -->
<?php get_footer(); ?>
