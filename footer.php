<?php 
	// Exit if access directly
	if (!defined('ABSPATH')) exit; 
?>
<div class="wrapper main-footer">
	<footer id="footer" class="container">
		<section class="footer-widgets">
			<div class="four columns"></div>
			<div class="four columns"></div>
			<div class="four columns"></div>
			<div class="four columns"></div>
		</section>
	</footer>
	<div class="sixteen columns copyright">
		<p>&copy; <?php bloginfo('name'); ?> <?php echo date('Y'); ?>. All Rights Reserved.</p>
	</div>
</div>
<?php wp_footer(); ?>
</body>
</html>