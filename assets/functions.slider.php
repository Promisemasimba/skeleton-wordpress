<?php

/*
	SIMPLE USAGE:

	function set_skeleton_flexslider_rotators($rotators = array()) {
		$rotators['homepage'] 		= array('size' => 'large', 'heading_tag' => 'h1');
		$rotators['contactus'] 		= array('size' => 'thumbnail');
		$rotators['gallerypage'] 	= array('size' => 'medium', 'hide_slide_data' => true);
		$rotators['amenities'] 		= array('size' => 'your-custom-size', 'limit' => 5);
		return $rotators;
	}
	add_filter('skeleton_flexslider_rotators', 'set_skeleton_flexslider_rotators');
*/

// SETUP
add_action('init', 'skeleton_flexslider_setup_init');
add_action('admin_head', 'skeleton_flexslider_admin_icon');
add_action('add_meta_boxes', 'skeleton_flexslider_create_slide_metaboxes');
add_action('save_post', 'skeleton_flexslider_save_meta', 1, 2);
add_filter('manage_edit-slides_columns', 'skeleton_flexslider_columns');
add_action('manage_slides_posts_custom_column', 'skeleton_flexslider_add_columns');
add_shortcode('flexslider', 'skeleton_flexslider_shortcode');

/**
 * Sets the slider locations
 * @return mixed
 */
function skeleton_flexslider_rotators() {
	$rotators = array(); 	// initialize array
	$rotators['homepage'] = array('size' => 'large');
	return apply_filters('skeleton_flexslider_rotators', $rotators);
}


/**
 * Create Slides post type
 * @return void
 */
function skeleton_flexslider_setup_init() {
	// 'SLIDES' POST TYPE
	$labels = array(
		'name' => __('Slides', 'skeleton_flexslider'),
		'singular_name' => __('Slide', 'skeleton_flexslider'),
		'all_items' => __('All Slides', 'skeleton_flexslider'),
		'add_new' => __('Add New Slide', 'skeleton_flexslider'),
		'add_new_item' => __('Add New Slide', 'skeleton_flexslider'),
		'edit_item' => __('Edit Slide', 'skeleton_flexslider'),
		'new_item' => __('New Slide', 'skeleton_flexslider'),
		'view_item' => __('View Slide', 'skeleton_flexslider'),
		'search_items' => __('Search Slides', 'skeleton_flexslider'),
		'not_found' => __('No Slide found', 'skeleton_flexslider'),
		'not_found_in_trash' => __('No Slide found in Trash', 'skeleton_flexslider'),
		'parent_item_colon' => ''
	);

	$args = array(
		'labels'               => $labels,
		'public'               => true,
		'publicly_queryable'   => true,
		'_builtin'             => false,
		'show_ui'              => true,
		'query_var'            => true,
		'rewrite'              => apply_filters('skeleton_flexslider_post_type_rewite', array("slug" => "slides")),
		'capability_type'      => 'post',
		'hierarchical'         => false,
		'menu_position'        => 26.6,
		'supports'             => array('title', 'thumbnail', 'excerpt', 'page-attributes'),
		'taxonomies'           => array(),
		'has_archive'          => true,
		'show_in_nav_menus'    => false
	);

	register_post_type('slides', $args);
}


/**
 * Adds the images and necessary styles for the custom post type image on the wp admin nav
 * @return void
 * @see admin_head
 */
function skeleton_flexslider_admin_icon() {
	$icon = IMAGES . "menu-icon.png";
	$icon_32 = IMAGES . "icon-32.png";

	echo "
<style type\"text/css\">
	#menu-posts-slides .wp-menu-image { background: url({$icon}) no-repeat 6px -17px !important; }
	#menu-posts-slides.wp-has-current-submenu .wp-menu-image { background-position:6px 6px!important; }
	.icon32-posts-slides { background: url({$icon_32}) no-repeat 0 0 !important; }
</style>
	";
}


/**
 * Show slider(s)
 */
function show_flexslider_rotator($slug) {
	$rotators = skeleton_flexslider_rotators(); // get all sliders
	$image_size = isset($rotators[ $slug ]['size']) ? $rotators[ $slug ]['size'] : 'large'; // set image size
	$hide_slide_data = isset($rotators[ $slug ]['hide_slide_data']) ? true : false; // hide slide text
	$header_type = isset($rotators[ $slug ]['heading_tag']) ? $rotators[ $slug ]['heading_tag'] : "h2"; // heading HTML element
	$orderby = isset($rotators[ $slug ]['orderby']) ? $rotators[ $slug ]['orderby'] : "menu_order"; // order by params
	$order = isset($rotators[ $slug ]['order']) ? $rotators[ $slug ]['order'] : "ASC";
	$limit = isset($rotators[ $slug ]['limit']) ? $rotators[ $slug ]['limit'] : "-1";
	$query_args = array('post_type' => 'slides', 'order' => $order, 'orderby' => $orderby, 'meta_key' => '_slider_id', 'meta_value' => $slug, 'posts_per_page' => $limit); // default query params


	// If attachments, we need post parent
	if($slug == "attachments") {
		$query_args['post_type'] = 'attachment';
		$query_args['post_parent'] = get_the_ID();
		$query_args['post_status'] = 'inherit';
		$query_args['post_mime_type'] = 'image';
		unset($query_args['meta_value']);
		unset($query_args['meta_key']);
	}

	$rtn = "";

	query_posts(apply_filters('skeleton_flexslider_query_post_args', $query_args));
	if (have_posts()) {
		$rtn .= '<div id="skeleton_flexslider_' . $slug . '_wrapper" class="skeleton_wordpress-wrapper">';
		$rtn .= '<div id="skeleton_flexslider_' . $slug . '" class="skeleton_flexslider_' . $slug . ' flexslider skeleton_wordpress">';
		$rtn .= '<ul class="slides">';

		while (have_posts()) {
			the_post();

			$url = get_post_meta(get_the_ID(), "_slide_link_url", true);
			$a_tag_opening = '<a href="' . $url . '" title="' . the_title_attribute(array('echo' => false)) . '" >';


			$rtn .= '<li>';
			$rtn .= '<div id="slide-' . get_the_ID() . '" class="slide">';

			if($slug == "attachments") {
				$rtn .= wp_get_attachment_image(get_the_ID(), $image_size);
			} else if (has_post_thumbnail()) {
				if($url) { $rtn .= $a_tag_opening; }
				$rtn .= get_the_post_thumbnail(get_the_ID(), $image_size , array('class' => 'slide-thumbnail'));
				if($url) { $rtn .= '</a>'; }
			}

			if(!$hide_slide_data) {
				$rtn .= '<div class="slide-data">';

				$rtn .= '<' . $header_type . ' class="slide-title skeleton_wordpress-title">';

				if($url) { $rtn .= $a_tag_opening; }
				$rtn .= get_the_title();
				if($url) { $rtn .= '</a>'; }

				$rtn .= '</' . $header_type . '>';

				$rtn .= get_the_excerpt();
				$rtn .= '</div>';
			}

			$rtn .= '</div><!-- #slide-' . get_the_ID() . ' -->';
			$rtn .= '</li>';
		}

		$rtn .= '</ul>';
		$rtn .= '</div><!-- close: #skeleton_flexslider_' . $slug . ' -->';
		$rtn .= '</div><!-- close: #skeleton_flexslider_' . $slug . '_wrapper -->';


		// INIT THE ROTATOR
		$rtn .= '<script>';
		$rtn .= " jQuery('#skeleton_flexslider_{$slug}').flexslider(";

		if(isset($rotators[ $slug ]['options']) AND $rotators[ $slug ]['options'] != "") {
			$rtn .= $rotators[ $slug ]['options'];
		}

		$rtn .= "); ";
		$rtn .= '</script>';
	}

	wp_reset_query();

	return $rtn;
}


/**
 * Admin meta box
 */
function skeleton_flexslider_create_slide_metaboxes() {
	add_meta_box('skeleton_flexslider_metabox_1', __('Slide Settings', 'skeleton_wordpress'), 'skeleton_flexslider_metabox_1', 'slides', 'normal', 'default');
}

/**
 * Not sure yet
 * @return mixed
 */
function skeleton_flexslider_metabox_1() {
	global $post;
	$rotators = skeleton_flexslider_rotators();

	$slide_link_url 	= get_post_meta($post->ID, '_slide_link_url', true);
	$slider_id		 	= get_post_meta($post->ID, '_slider_id', true); ?>

	<p>URL: <input type="text" style="width: 90%;" name="slide_link_url" value="<?php echo esc_attr($slide_link_url); ?>"></p>
	<span class="description"><?php echo _e('The URL this slide should link to.', 'skeleton_flexslider'); ?></span>

	<p>
		<?php if($rotators) : ?>
		<?php _e('Attach to:', 'skeleton_flexslider'); ?>
		<select name="slider_id">
			<?php foreach($rotators as $rotator => $size) : ?>
				<option value="<?php echo $rotator ?>" <?php if($slider_id == $rotator) echo " SELECTED"; ?>><?php echo $rotator ?></option>
			<?php endforeach; ?>
		</select>
		<?php else : ?>
			<div style="color: red;">
				<?php _e('No rotators have been setup. Contact your site developer.', 'skeleton_flexslider'); ?><br>
			</div>
		<?php endif; ?>
	</p>

	<?php
}


/**
 * Save meta information from the slide
 * @return void
 */
function skeleton_flexslider_save_meta($post_id, $post) {
	if (isset($_POST['slide_link_url'])) {
		update_post_meta($post_id, '_slide_link_url', strip_tags($_POST['slide_link_url']));
	}
	if (isset($_POST['slider_id'])) {
		update_post_meta($post_id, '_slider_id', strip_tags($_POST['slider_id']));
	}
}


/**
 * Admin columns
 * @return array
 */
function skeleton_flexslider_columns($columns) {
	$columns = array(
		'cb'       => '<input type="checkbox">',
		'image'    => __('Image', 'skeleton_flexslider'),
		'title'    => __('Title', 'skeleton_flexslider'),
		'ID'       => __('Slider ID', 'skeleton_flexslider'),
		'order'    => __('Order', 'skeleton_flexslider'),
		'link'     => __('Link', 'skeleton_flexslider'),
		'date'     => __('Date', 'skeleton_flexslider')
	);

	return $columns;
}

/**
 * Add columns
 * @return void
 */
function skeleton_flexslider_add_columns($column) {
	global $post;
	$edit_link = get_edit_post_link($post->ID);

	if ($column == 'image') 	echo '<a href="' . $edit_link . '" title="' . $post->post_title . '">' . get_the_post_thumbnail($post->ID, array(60, 60), array('title' => trim(strip_tags( $post->post_title)))) . '</a>';
	if ($column == 'order') 	echo '<a href="' . $edit_link . '">' . $post->menu_order . '</a>';
	if ($column == 'ID') 		echo get_post_meta($post->ID, "_slider_id", true);
	if ($column == 'link') 	echo '<a href="' . get_post_meta($post->ID, "_slide_link_url", true) . '" target="_blank" >' . get_post_meta($post->ID, "_slide_link_url", true) . '</a>';
}


/**
 * Flexslider shortcode
 * @return String
 */
function skeleton_flexslider_shortcode($atts, $content = null) {
	$slug = isset($atts['slug']) ? $atts['slug'] : "attachments";
	if(!$slug) {
		return apply_filters('skeleton_flexslider_empty_shortcode', "<p>Please include a <code>slug</code> parameter. <code>[flexslider slug=\"homepage\"]</code></p>");
	}

	return show_flexslider_rotator($slug);
}
