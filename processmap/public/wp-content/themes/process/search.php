<?php get_header(); ?>

<script type="text/javascript">
	require(['jquery'], function($){
		$('.duarte-finder').trigger('showPartial');
	})
</script>

<section role="main">
	<div class="row">
		<article class="twelve columns">
			<header>Search Results</header>
			<?php if( have_posts() ) {

				while( have_posts() ) { 
					the_post();
					
					if( has_category('Graphic') ) {							
						$size = array(167,167);
						$permalink = false;
						$icon = true;
						$text = false;
						printf('<div class="row"><div class="two columns">%s</div><div class="ten columns"><h4><a href="%s">%s</a></h4><p>%s</p></div></div>', 
							wp_get_attachment_link($post->ID, $size, $permalink, $icon, $text),
							wp_get_attachment_url(),
							get_the_title(),
							get_the_excerpt()
						);
					}
					elseif( get_post_type() == 'attachment' ) {							
						
						printf('<h4><a href="%s"><span class="subheader">Artifacts / </span>%s</a><br><small>Updated %s ago</small></h4><p>%s</p>', 
							wp_get_attachment_url(),
							get_the_title(),
							Duarte\Process\time_elapsed_string( strtotime($post->post_modified) ),
							get_the_excerpt()
						);
					}
					else { 
						$prefix = '';
						if(\Duarte\Process\is_studio()) {
							$prefix = '<span class="subheader">Studio / </span>';
						}
						elseif(\Duarte\Process\is_factory()) {
							$prefix = '<span  class="subheader">Factory / </span>';
						}
						if($post->post_parent) {
							$prefix .= '<span class="subheader">'. get_the_title( $post->post_parent) . " / </span>";
						}
						printf('<h4 class="entry-title"><a href="%s">%s%s</a></h4><p>%s</p>', 
							get_permalink(),
							$prefix,
							get_the_title(),
							get_the_excerpt()
						);
					}
				}
			}
			else {
				echo "<h4>Nothing Found</h4>";
				echo "<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>";
			}
		?>
		</article>
	</div>
</section>

<?php get_footer();