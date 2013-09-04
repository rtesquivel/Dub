<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */

get_header(); 

the_post();

?>
<!-- Single.php -->
<h1><?php the_title(); ?></h1>
<?php the_content(); ?>


<?php get_footer(); ?>