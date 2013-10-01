<?php

if ( !defined('ABSPATH')) exit;

/**
 * Page metadata template part file. Things like comment links, author, date/time, etc.
 *
 * @package			WordPress
 * @subpackage		Skeleton
 * @author         	AtomicPages LLC
 * @copyright      	2013 AtomicPages LLC
 * @since          	0.3
 */

?>

<h1 class="entry-title post-title"><?php the_title(); ?></h1>

<?php if ( comments_open() ) : ?>
<div class="post-meta">
<?php responsive_post_meta_data(); ?>
	<?php if ( comments_open() ) : ?>
		<span class="comments-link">
		<span class="mdash">&mdash;</span>
	<?php comments_popup_link(__('No Comments &darr;', 'responsive'), __('1 Comment &darr;', 'responsive'), __('% Comments &darr;', 'responsive')); ?>
		</span>
	<?php endif; ?>
</div><!-- end of .post-meta -->
<?php endif; ?>