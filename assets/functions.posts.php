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
		if($tag_list) {
			$utility_text = __('This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'skeleton_wordpress');
		} elseif($categories_list) {
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

/**
 * Prints HTML with date information for current post.
 * @param bool [ $echo = true ]
 * @return string The HTML-formatted post date.
 * @since 0.3
 */
if(!function_exists('skeleton_entry_date')) {
	function skeleton_entry_date($echo = true) {
		if(has_post_format(array('chat', 'status'))) {
			$format_prefix = _x('%1$s on %2$s', '1: post format name. 2: date', 'skeleton_wordpress');
		} else {
			$format_prefix = '%2$s';
		}
	
		$date = sprintf('<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
			esc_url(get_permalink()),
			esc_attr(sprintf(__('Permalink to %s', 'skeleton_wordpress'), the_title_attribute('echo=0'))),
			esc_attr(get_the_date('c')),
			esc_html(sprintf($format_prefix, get_post_format_string(get_post_format()), get_the_date()))
		);
		if($echo) {
			echo $date;
		}
		
		return $date;
	}
}

/**
 * Displays navigation to next/previous set of posts when applicable.
 * @return void
 * @since 0.3
 */
if(!function_exists('skeleton_paging_nav')) {
	function skeleton_paging_nav() {
		global $wp_query;
		// Don't print empty markup if there's only one page.
		if($wp_query->max_num_pages < 2) { return; }
		?>
		<nav class="navigation paging-navigation" role="navigation">
			<h1 class="screen-reader-text"><?php _e('Posts navigation', 'skeleton_wordpress'); ?></h1>
			<div class="nav-links">
				<?php if(get_next_posts_link()) : ?>
				<div class="nav-previous"><?php next_posts_link(__('<span class="meta-nav">&larr;</span> Older posts', 'skeleton_wordpress')); ?></div>
				<?php endif; ?>
				<?php if(get_previous_posts_link()) : ?>
				<div class="nav-next"><?php previous_posts_link(__('Newer posts <span class="meta-nav">&rarr;</span>', 'skeleton_wordpress')); ?></div>
				<?php endif; ?>
			</div><!-- .nav-links -->
		</nav><!-- .navigation -->
		<?php
	}
}
