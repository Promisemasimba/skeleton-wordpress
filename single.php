<?php 
	// Exit if access directly
	if(!defined('ABSPATH')) exit;
?>

<?php
/**
 * The most generic and basic file for displaying a single post
 *
 * @package WordPress
 * @subpackage Skeleton
 * @author Dennis Thompson
 * @copyright 2009-2013 AtomicPages LLC
 * @license license.txt
 * @since 0.1
 */
?>

<?php get_header(); ?>

	<div class="wrapper main-content">
		<div class="container content" role="main">
			<?php skeleton_content_before(); ?>
			<main id="main" class="twelve columns omega">
				<?php skeleton_content_top(); ?>
				<?php while(have_posts()) : ?>
					<?php the_post(); ?>
					<?php get_template_part('posts/post', get_post_format()); ?>
				<?php endwhile; ?>
				<?php comments_template('', true); ?>
				<?php skeleton_content_bottom(); ?>
			</main><!-- /main -->
			<?php skeleton_content_after(); ?>
		</div><!-- .content -->
	</div><!-- /.main-content -->

<?php get_footer(); ?>