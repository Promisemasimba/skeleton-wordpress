Skeleton WordPress &alpha;
==========================

A friendly responsive boilerplate theme for WordPress.

## So What's Different?
Skeleton WordPress is different from your run-of-the-mill boilerplate responsive templates. Skeleton WordPress is a marriage between [Skeleton Sass](https://github.com/atomicpages/skeleton-sass) and an easy-to-style WordPress theme. Skeleton WordPress is 100% responsive so your WordPress site will look great on all of you and your client's devices.

## Requirements
* [WordPress Requirements](http://wordpress.org/about/requirements/)
	* PHP version 5.2.4 or greater
	* MySQL version 5.0 or greater

### Recommended Software
* [Sass](http://sass-lang.com/)
* [Compass](http://compass-style.org/)

## TL;DR

### Better Structure
Skeleton WordPress has a verbose and flexible structure that allows for rapid theme development without the need for writing additional HTML or PHP. The general structure of all frontend pages can be seen below.


```
<div class="wrapper header"><!-- spans the width of the viewport -->
	<header class="container"><!-- set fixed or percentage width -->
		<div class="sixteen columns"> <!-- 2% or 20px less than the overall width -->
			<nav class="top-nav">
				<ul>
					<li><a href="#"></a></li>
					<li><a href="#"> </a></li>
				</ul>
			</nav>
		</div>
		<div class="sixteen columns">...</div>
	</header>
</div>
<div class="wrapper main-nav"><!-- width of viewport -->
	<nav class="container"><!-- user-defined width -->
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
Each section of Skeleton WordPress has the following structure:

* Element wrapper that spans the entire viewport. This means it's 100% the width of the browser window regardless of monitor size or resolution.
	* Element that spans the width of `.container`. This width can be based on pixel dimensions or percentages to achieve a "fluid" design.
		* All inner elements are subject to the CSS rules as described by the selectors used. See individual elements for their rules.

##### For Designers
As designers, you need to to be able to spend less time in a DOM inspector guessing how your CSS might alter other elements and more time creating with your client wants. Because of Skeleton WordPress's predictable and flexible DOM, you know exactly what is going on at all times.

##### For Developers
Skeleton WordPress is founded on the AtomicPages fork of [SMOF](https://github.com/atomicpages/Options-Framework). This framework creates the admin interface for your clients. All files are separated into unambiguous sections in the theme root directory:

* `nav`
* `posts`
* `sidebars`
* `pages`
* `assets`
	* `fonts`
	* `images`
	* `js`
	* `functions`

The core of the framework is found in `/admin/`. Any custom options that need to be added can be done at `/admin/functions/functions/options.php`. See the [wiki entry](https://github.com/atomicpages/skeleton-wordpress/wiki/Custom-Options) on creating custom administrative options and linking any options to the frotnend.


### Shortcodes
* `[wp-link]` prints a link to WordPress.org: `<a href="http://wordpress.org">WordPress</a>`
* `[theme-link]` prints out `<a href="https://github.com/atomicpages/skeleton-wordpress">Skeleton WordPress</a>`
* `[blog_title]` prints out the title of the site `get_bloginfo("name")` 
* `[home_url]` prints out the home url of the site `home_url()`
* `[year]` prints out the year.
	* Options for the `[year]` shortcode include an **optional** format attribute which use values as [WordPress Date/Time functions](http://codex.wordpress.org/Formatting_Date_and_Time). Examples are:
		* `[year format="y"]` produces `13`
		* `[year format="l, F j, Y"]` produces `Tuesday, August 13, 2013`
		* `[year format="h:iA"]` produces `12:59PM`
* `[button]` creates a button that is easy to style and ready for your client's use
* `[credit]` creates a link to this Skeleton WordPress repository and gives us some lovin!
