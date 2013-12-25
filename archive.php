<?php
/**
 * Archive Pages
 *
 * Have old posts that are noq hidden from your post page? All of your previous
 * postings will show up here!
 *
 * @package			WordPress
 * @subpackage		Skeleton
 * @author 			Dennis Thompson <http://atomicpages.net/>
 * @copyright		2009 - 2013 AtomicPages LLC
 * @license			license.txt
 * @since 			0.1
 *
 * EXTRA DOCUMENTATION
 * @see skeleton_main_classes()		assets/functions.sidebar.php:57
 */
?>

<?php
	// Exit if access directly
	if (!defined('ABSPATH')) exit;
?>

<?php get_header(); ?>

<div class="wrapper main-content">
	<div class="container content" role="main">
		<?php skeleton_content_before(); ?>
			<main id="main" <?php skeleton_main_classes() ?>>
				<?php skeleton_content_top(); ?>
				<?php if(have_posts()) : ?>
					<section class="header archive">
					<?php
					if (is_day()) {
						printf(__('Daily Archives: %s', 'skeleton_wordpress'), get_the_date());
					} elseif (is_month()) {
						printf(__('Monthly Archives: %s', 'skeleton_wordpress'), get_the_date(_x('F Y', 'monthly archives date format', 'skeleton_wordpress')));
					} elseif (is_year()) {
						printf(__('Yearly Archives: %s', 'skeleton_wordpress'), get_the_date(_x('Y', 'yearly archives date format', 'skeleton_wordpress' )));
					} else {
						_e('Archives', 'skeleton_wordpress');
					}
					?>
					</section>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('content', get_post_format()); ?>
				<?php endwhile; ?>
				<section class="content archive">

				</section>
				<?php else : ?>
					<?php get_template_part('content', 'none'); ?>
				<?php endif; ?>
				<?php skeleton_content_bottom(); ?>
			</main><!-- /main -->
	<?php skeleton_content_after(); ?>
	</div><!-- /.content -->
</div><!-- /.main-content -->

<?php get_footer(); ?>
