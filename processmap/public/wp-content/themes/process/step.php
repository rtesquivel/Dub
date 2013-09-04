<?php
get_header(); 
the_post();
?>

<?php get_template_part('timeline'); ?>

<section role="main">

	<div class="row unpadded" style="margin-bottom: 10px;">
		<div class="four columns text-right offset-by-eight">
			<?php
				$page_type = (\Duarte\Process\is_studio()) ? 'studio' : 'factory';
				echo previous_page_not_post("&nbsp;", 'expand', 'sort_column=menu_order&sort_order=asc', $page_type, "tiny button black prev"); 
				echo "&nbsp;&nbsp;&nbsp;";
				echo next_page_not_post("&nbsp;", 'expand', 'sort_column=menu_order&sort_order=asc', $page_type, "tiny button black next "); 
			?>
		</div>
	</div>


	<div class="row unpadded">	
		<nav class="two columns">
			<header>Phase</header>
			<?php 
				$this_page_id = get_the_ID();
				$this_parent_id = $post->post_parent;
				$parent = get_post($this_parent_id);
			?>
			<h4 class="entry-title"><a href="<?php echo get_permalink($parent->ID); ?>"><?php echo $parent->post_title; ?></a></h4>			
			<ol class="phase-nav none">
				<!-- Phase Children -->
				<?php

  					$query = new WP_Query(array(
  						'post_parent' => $this_parent_id,
  						'post_type'   => $post->post_type,  						
  						'post_status' => 'publish',
						'orderby'     => 'menu_order',
						'order'       => 'ASC',
						'nopaging'    => true
  					));
  					// Start New Loop
					while( $query->have_posts() ){
						$query->the_post();

  						printf('<li %s><a href="%s">%s</a></li>', 
  							($this_page_id == get_the_ID()) ? 'class="active"' : '', 
  							get_permalink(),   							
  							get_the_title()
  						);
					}
					wp_reset_postdata();
					// End Loop
				?>
			</ol>
		</nav>



		<article class="seven columns">
			<header>Step</header>
			<h4><?php the_title(); ?></h4>			

			<h3 class="thin"><?php echo get_the_content(); ?></h3>

			<?php 
			// Load the field groups for Best Practices and Gallery
			$this_page_fields = get_fields();
			$this_parent_fields = get_fields($this_parent_id);

			$bestPracticesFG = (Duarte\Process\is_studio()) ? 4 : 5;
			$galleryFG = (Duarte\Process\is_studio()) ? 25 : 70;

			// Instantiate a field group controller
			$fgc = new acf_field_group();
			
			// Get a list of all the fields in each group
			$bestPracticesFields = $fgc->get_fields(array(), $bestPracticesFG);
			$galleryFields = $fgc->get_fields(array(), $galleryFG);

			?>
						
			<?php $process = get_field('process'); ?>
			<?php if($process) : ?>
			<hr />
			<header>Process</header>
				<?php echo $process; ?>
			<?php endif; ?>

			<hr />
			<header>Best Practices</header>
			<?php
    			foreach($bestPracticesFields as $field) {
    				// $value = get_field( $field['name']);
    				if($field['type'] == "tab") continue;

    				$value = (isset($this_page_fields[ $field['name'] ])) ? $this_page_fields[ $field['name'] ] : false;

    				if($value){
		        		printf('<h5 class="auto-highlight">%s<div class="bubble"></div></h5> %s', 
		        			$field['label'], 
		        			$value);
		        	}
		        }
			?>
			
			<?php comments_template( '', true ); ?>

		</article>

		<article class="three columns" >
			<header>Artifacts &amp; Documents</header>
			<ul class="artifacts none">
			<?php
				$artifacts = get_field('artifacts');
				if(is_array($artifacts)) {
					foreach( $artifacts as $artifact) {
						// $scope =  get_field('scope', $artifact->ID);
						// if($scope[0] == 'Internal' ){
						// 	$badge = "<span class=\"label small alert\">INT</span>";
						// }
						// else {
						// 	$badge =  "<span class=\"label secondary\">EXT</span>";
						// }
			  			printf('<li class="artifact" ><h5 style="margin-bottom:0"><a href="%s">%s</a></h5><small class="color-warm-grey" style="line-height:0">Updated %s ago</small><br> <p class="caption">%s</p></li>', 
			  				wp_get_attachment_url($artifact->ID), 
			  				$artifact->post_title,
			  				Duarte\Process\time_elapsed_string( strtotime($artifact->post_modified) ),
			  				$artifact->post_excerpt
			  			);
					}
				}
				else {
					echo "<p>This step has no artifacts.</p>";
				}
			?>
			</ul>			
			
			<hr />
			<header>Gallery</header>
			<ul class="gallery block-grid one-up none">
			<?php 
	            foreach($galleryFields as $field) {
	                // $attachment_id = get_field($field['name']);
	                $attachment_id = (isset($this_parent_fields[ $field['name'] ])) ? $this_parent_fields[ $field['name'] ] : false;
	                // echo "<pre>";
	                // print_r($field);
	                // echo "</pre>";

	                if($attachment_id){
						printf('<li><a href="%s">%s</a></li>', 
							wp_get_attachment_url($attachment_id),
							wp_get_attachment_image($attachment_id, "medium")
						);
	                }
	            }
			?>
			</ul>

		</article>

	</div>
</section>	
	
<?php get_footer(); ?>