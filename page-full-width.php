<?php

// Exit if accessed directly
if ( !defined('ABSPATH')) exit;

/**
 * Full Content Template
 *
   Template Name:  Full Width Page (no sidebar)
 *
 * @file           full-width.php
 * @package        Skeleton WrdPress
 * @author         AtomicPages LLC
 * @copyright      2013 AtomicPages LLC
 * @license        license.txt
 * @version        0.3
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          0.3
 */
?>

<?php get_header(); ?>

	<div class="wrapper main-content">
		<div class="container content" role="main">
			<main id="main" class="twelve columns omega">
				<?php if(have_posts()) : ?>

					<?php while(have_posts()) : ?>
						<?php the_post(); ?>
						<?php get_template_part('posts/post', get_post_format()); ?>
					<?php endwhile; ?>

				<?php else : ?>

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

				<?php endif; ?>
			</main><!-- /main -->
			<?php get_sidebar(); ?>
		</div><!-- /.content -->
	</div><!-- /.main-content -->
<?php get_footer(); ?>