<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package theme
 * @since theme 1.0
 */

get_header(); ?>
<script type="text/javascript">
	jQuery(function(){
		jQuery('.global-finder').trigger('show');
	});
</script>
	<div  class="row global-content">
		<div class="twelve columns" role="main">

			<article id="post-0" class="post error404 not-found">
				
				<h4 class="entry-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'theme' ); ?></h4>
				

				<div class="entry-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'theme' ); ?></p>


				</div><!-- .entry-content -->
			</article><!-- #post-0 .post .error404 .not-found -->

		</div><!-- #content .site-content -->
	</div><!-- #primary .content-area -->

<?php get_footer();