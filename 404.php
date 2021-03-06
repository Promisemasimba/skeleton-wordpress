<?php
/**
 * 404 Page
 *
 * For those pages that cannot be found, this will show.
 *
 * @package			WordPress
 * @subpackage		Skeleton
 * @author 			Dennis Thompson <http://atomicpages.net/>
 * @copyright		2009 - 2013 AtomicPages LLC
 * @license			license.txt
 * @since 			0.1
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
				<h2>Oops!</h2>
				<h4>We are really sorry but the page you are requesting cannot be found.</h4>
				<p>It seems the page you are trying to reach doesn't existing anymore, or maybe it has been removed. We think the best thing to do is to start again from the <a href="<?php echo bloginfo("url") ?>">home page</a>.</p>
				<?php skeleton_content_bottom(); ?>
			</main><!-- /main -->
	<?php skeleton_content_after(); ?>
	</div><!-- /.content -->
</div><!-- /.main-content -->

<?php get_footer(); ?>