<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Skeleton_WordPress
 * @since 0.3
 */
?>

<header class="page-header">
	<h1 class="page-title"><?php _e( 'Nothing Found', 'skeleton_wordpress' ); ?></h1>
</header>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
	
	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'skeleton_wordpress' ), admin_url( 'post-new.php' ) ); ?></p>
	
	<?php elseif ( is_search() ) : ?>
	
	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'skeleton_wordpress' ); ?></p>
	<?php get_search_form(); ?>
	
	<?php else : ?>
	
	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'skeleton_wordpress' ); ?></p>
	<?php get_search_form(); ?>
	
	<?php endif; ?>
</div><!-- .page-content -->
