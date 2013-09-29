<?php
/*
Template Name: Debug
*/
get_header();
?>

<?php
/**
 * Useful when debugging templates!
 *
 * @package WordPress
 * @subpackage Skeleton
 * @author Dennis Thompson
 * @copyright 2009-2013 AtomicPages LLC
 * @license license.txt
 * @since 0.2
 */
?>

<pre>
<?php 
$smof_data_r = print_r($smof_data, true); 
$smof_data_r_sans = htmlspecialchars($smof_data_r, ENT_QUOTES); 
echo $smof_data_r_sans; ?>
</pre>
	
<?php get_footer(); ?>
