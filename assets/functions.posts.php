<?php

/**
 * All post-related functions will be here
 *
 * @package WordPress
 * @subpackage skeleton_wordpress
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 * @since 1.0
 */
if(!function_exists("skeleton_post_meta")) {
	function skeleton_post_meta() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(__(", ", "skeleton_wordpress"));

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list("", __(", ", "skeleton_wordpress"));

		$date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
			esc_url(get_permalink()),
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date())
		);

		$author = sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url(get_author_posts_url(get_the_author_meta('ID'))),
			esc_attr(sprintf(__('View all posts by %s', 'skeleton_wordpress'), get_the_author())),
			get_the_author()
		);

		// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
		if ( $tag_list ) {
			$utility_text = __('This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'skeleton_wordpress');
		} elseif ( $categories_list ) {
			$utility_text = __('This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'skeleton_wordpress');
		} else {
			$utility_text = __('This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'skeleton_wordpress');
		}
		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			$date,
			$author
		);
	}
}