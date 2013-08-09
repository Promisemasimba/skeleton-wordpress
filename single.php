<?php 
	// Exit if access directly
	if(!defined('ABSPATH')) exit; 
?>

<?php
/**
 * The most generic and basic file
 *
 * @package Skeleton
 * @author Dennis Thompson
 * @copyright 2009-2013 AtomicPages LLC
 * @license license.txt
 * 
 * @since Skeleton 1.0
 */
?>

<?php get_header(); ?>

	<div class="wrapper main-content">
		<div class="container content" role="main">
			<main id="main" class="twelve columns omega">
				<?php while(have_posts()) : ?>
					<?php the_post(); ?>
					<?php get_template_part('posts/post', get_post_format()); ?>
				<?php endwhile; ?>
				<?php comments_template('', true); ?>
			</main><!-- /main -->
		</div><!-- .content -->
	</div><!-- /.main-content -->

<?php get_footer(); ?>