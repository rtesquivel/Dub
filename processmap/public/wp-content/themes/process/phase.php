<?php
get_header(); 
get_template_part('timeline');
the_post();
?>
	
<section role="main">

	<div class="row unpadded" style="margin-bottom: 10px;">
		<div class="four columns text-right offset-by-eight">
			<?php
				$page_type = (\Duarte\Process\is_studio()) ? 'studio' : 'factory';
				echo previous_page_not_post("&nbsp;", 'expand', 'sort_column=menu_order&sort_order=asc', $page_type, "tiny button black prev"); 
				echo "&nbsp;&nbsp;&nbsp;";
				echo next_page_not_post("&nbsp;", 'expand', 'sort_column=menu_order&sort_order=asc', $page_type, "tiny button black next"); 
			?>
		</div>
	</div>

	<div class="row unpadded">
		<nav class="two columns">
			<header>Phase</header>
			<h4 class="entry-title"><?php the_title(); ?></h4>
			<ol class="phase-nav none">
				<!-- Phase Children -->
  				<?php
  					$this_page_id = get_the_ID();

  					$query = new WP_Query(array(
  						'post_parent' => get_the_ID(),
  						'post_type'   => $post->post_type,  						
  						'post_status' => 'publish',
						'orderby'     => 'parent menu_order',
						'order'       => 'ASC',
						'nopaging'    => true
  					));
  					$a_out = array();

  					// Start New Loop
					while( $query->have_posts() ){
						$step = $query->the_post();

  						printf('<li %s><a href="%s">%s</a></li>', 
  							($this_page_id == get_the_ID()) ? 'class="active"' : '', 
  							get_permalink(),   							
  							get_the_title()
  						);

						$artifacts = get_field('artifacts');
						if($artifacts) {
							// start another loop
							foreach( $artifacts as $artifact) {							
								setup_postdata($artifact);
								$scope =  get_field('scope');
								// if($scope[0] == 'Internal' ){
								// 	$badge = " <span class=\"label success\">IN</span>";
								// }
								// else {
								// 	$badge = " <span class=\"label alert\">EX</span>";
								// }
					  			$a_out[] = sprintf('<li class="artifact">%s / <strong><a href="%s">%s</a></strong><br><small>Updated %s ago</small></li>', 
					  				get_the_title(),
					  				wp_get_attachment_url($artifact->ID), 
					  				$artifact->post_title,
					  				Duarte\Process\time_elapsed_string( strtotime($artifact->post_modified) )
					  			);
							}
							
						}
					}
					wp_reset_postdata();
					// End Loop

				?>
			</ol>			
		</nav>

		<article class="ten columns" role="main">
			<?php 
				$bannerID = get_field('banner', $post->ID);
				if($bannerID)
					echo wp_get_attachment_link($bannerID, array(803, 200), false, true, false); 
			?>

			<header>Big Picture</header>			
			<?php the_content(); ?>
			
		
			<?php if(count($a_out) > 0 ) {
				echo "<header>Phase Artifacts</header>";
				echo '<ul class="block-grid three-up mobile-two-up">';

				echo implode($a_out, "\n"); 
				echo '</ul>';
				}
			?>
		
		</article>		
	</div>
	
</section>

<?php get_footer(); ?>