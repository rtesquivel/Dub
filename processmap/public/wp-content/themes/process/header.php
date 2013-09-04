<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?><!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title('|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php wp_head(); ?>
<?php include_once('process.js.php'); ?>

<?php global $post; ?>
</head>

<body <?php body_class(); ?>>

	<?php get_search_form(); ?>

	<header>
		<div class="row">

			<div class="six columns">
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_stylesheet_directory_uri()."/img/franklin-logo.png"; ?>" width="137px"></img></a>				
			</div>

			<div class="six columns">
				<div class="row">
					<div class="twelve columns">
						<i class="evelyn-search search-icon right" style="font-size:28px; padding-top: 15px; margin-bottom:.9em"></i>
					</div>
				</div>
				<nav class="row">
					<div class="twelve columns" >
						<?php 
							wp_nav_menu( ); 
						?>
						<h5 class="thin" style="text-align:right">Today is <?php echo date('l, F jS Y', time()-(8*3600)); ?></h5>
					</div>
				</nav>
			</div>
		</div>
	</header>
