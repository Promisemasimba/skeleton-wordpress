<?php
/**
 * Header file! This file houses basic:
 *   * DOCTYPE info
 *   * Header information
 *   * Main navigation
 *
 * @package			skeleton_wordpress
 * @author 			Dennis Thompson <http://atomicpages.net/>
 * @copyright		2009 - 2013 AtomicPages LLC
 * @license			license.txt MIT
 * @version			1.0
 * @since 			1.0
 */
?>
<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js ie" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-control" content="public">
<title><?php wp_title('&#124;', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<?php wp_head(); ?>
<?php global $data; ?>
<pre><?php var_dump($data) ?></pre>
</head>
<body <?php body_class(); ?>>
	<div class="wrapper main-header">
	<header class="container">
		<div class="sixteen columns">
			<?php if(get_header_image() != '') : ?>
				<div id="logo">
					<a href="<?php echo home_url('/'); ?>"><img src="<?php header_image(); ?>" width="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> width;} else { echo HEADER_IMAGE_WIDTH;} ?>" height="<?php if(function_exists('get_custom_header')) { echo get_custom_header() -> height;} else { echo HEADER_IMAGE_HEIGHT;} ?>" alt="<?php bloginfo('name'); ?>" /></a>
				</div><!-- end of #logo -->
			<?php endif; // header image was removed ?>

			<?php if(!get_header_image()) : ?>
				<div id="logo">
					<span class="site-name"><a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a></span>
					<span class="site-description"><?php bloginfo('description'); ?></span>
				</div><!-- end of #logo -->
			<?php endif; ?>
		</div>
	</header>
	</div>
	<?php get_template_part('nav/nav', 'main'); ?>