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

* element wrapper
	* element
		* content

Why so many HTML elements anyway? As designers and front-end developers, your client's choices might change on a dime. That background on the `nav` element might stretch across the browser viewport today and they might want it to stretch across the width of the `nav` element tomorrow. Skeleton WordPress makes this a breeze. Instead of meddling with pesky PHP and HTML, you can spend more time getting stuff done easily.

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