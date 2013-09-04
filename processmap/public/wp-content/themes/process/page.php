<?php get_header(); ?>
<?php while(have_posts()) : the_post(); ?>

<section rel="main" class="page">
	<div class="row">

		<nav class="three columns">
			<h3 class="thin">Pages</h3>
			<ul>
			<?php wp_list_pages('title_li='); ?>
			</ul>
		</nav>
		<div class="nine columns">						
			<?php the_content() ?>
		</div>
	<div>
</section>

<?php endwhile;?>
<?php get_footer(); ?>