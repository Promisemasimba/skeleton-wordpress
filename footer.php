<?php
	// Exit if access directly
	if (!defined('ABSPATH')) exit;
?>
<div class="wrapper main-footer">
	<footer id="footer" class="container">
		<section class="sixteen columns footer-widgets">
			<?php if(!is_active_sidebar("footer-1")) : ?>
			<div class="four columns alpha">
				<?php dynamic_sidebar("footer-1") ?>
			</div>
			<div class="four columns">
				<?php dynamic_sidebar("footer-2") ?>
			</div>
			<div class="four columns">
				<?php dynamic_sidebar("footer-3") ?>
			</div>
			<div class="four columns omega">
				<?php dynamic_sidebar("footer-4") ?>
			</div>
			<?php endif; ?>
		</section>
		<div class="sixteen columns copyright">
			<p><?php skeleton_footer() ?></p>
		</div>
	</footer>
</div>
<?php wp_footer(); ?>
</body>
</html>