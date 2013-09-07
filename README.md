Skeleton WordPress
==================

A friendly responsive boilerplate theme for WordPress.

## So What's Different?
Skeleton WordPress is different from your run-of-the-mill boilerplate responsive templates. Skeleton WordPress is a marriage between [Skeleton Sass](https://github.com/atomicpages/skeleton-sass) and an easy to style WordPress theme. Skeleton WordPress is 100% responsive so your WordPress site will look amazing on all of your or your client's devices. Skeleton WordPress is optimized for using Sass or your favorite CSS preprocessor.

## TL;DR

### Better Structure
Skeleton WordPress has a verbose and flexible structure that allows for rapid theme development without the need for writing additional HTML or PHP. Here is a preview of the general structure that Skeleton WordPress follows:


```
<div class="wrapper header">
	<header class="container">
		<div class="sixteen columns">
			<nav class="top-nav">
				<ul>
					<li><a href="#"></a></li>
					<li><a href="#"> </a></li>
				</ul>
			</nav>
		</div>
		<div class="sixteen columns"></div>
	</header>
</div>
<div class="wrapper main-nav">
	<nav class="container">
		<div class="sixteen columns">
			<ul>
				<li><a href="#" class="first"></a></li>
				<li><a href="#"></a></li>
				<li><a href="#"></a></li>
				<li><a href="#" class="last"></a></li>
			</ul>
		</div>
	</nav>
</div>
<div class="wrapper main-content">
	<div class="container content">
		<aside id="sidebar-one" class="four columns alpha">
			<section></section>
		</aside>
		<main id="main" class="twelve columns omega">
			<article></article>
		</main>
	</div>
</div>
<div class="wrapper main-footer">
	<footer id="footer" class="container">
		<section class="footer-widgets">
			<div class="four columns"></div>
			<div class="four columns"></div>
			<div class="four columns"></div>
			<div class="four columns"></div>
		</section>
		<div class="sixteen columns">
			<div class="copyright"></div>
		</div>
	</footer>
</div>
```

#### The Breakdown
Each "main" section of Skeleton WordPress has the following structure:

* element wrapper that span the entire viewport
	* element that spans the width of `.container`
		* content that allows you to control everything inside `.container`

##### For Designers
Designers need to be able to quickly and efficiently style a WordPress theme without having to wade through seas of code. Skeleton WordPress allows you to do this. Easily meet clients requests without having to touch any HTML or PHP code!

##### For Developers
Skeleton WordPress is founded on [SMOF](https://github.com/syamilmj/Options-Framework). This framework creates and fortifies the admin interface for your clients. All files are separated into unambiguous sections in the theme directory.

* `nav`
* `posts`
* `sidebars`
* `pages`
* `assets`
	* `fonts`
	* `images`
	* `js`
	* `functions`


### Shortcodes
* [wp-link] prints a link to WordPress.org. Here's the HTML `<a href="http://wordpress.org">WordPress</a>`
* [theme-link] prints out `<a href="https://github.com/atomicpages/skeleton-wordpress">Skeleton WordPress</a>`
* [blog-title] prints out the title of the site
* [blog-link] prints out the home url of the site
* [year] prints out the year.
	* Options for the `[year]` shortcode include an **optional** format attribute which use values as [WordPress Date/Time functions](http://codex.wordpress.org/Formatting_Date_and_Time). Examples are:
		* [year format="y"] produces `13`
		* [year format="l, F j, Y"] produces `Tuesday, August 13, 2013`
		* [year format="h:iA"] produces `12:59PM`
* `[button]` creates a button that is easy to style and ready for your client's use