<?php get_header(); ?>
<?php the_post(); ?>

<style type="text/css">
	.artifacts-finder input[type=text] {
		font-family: "ApexNew Book";
		height: 52px;
		font-size: 24px;
	}
</style>
<section rel="main">
	<div class="row">
	<article class="twelve columns">
		<h2><?php the_title(); ?></h2>
		<div class="row fill-very-light list-finder artifacts-finder">
			<div class="eight mobile-three columns centered">
			<input type="text" name="artSearch" placeholder="Start typing to find an artifact!"></input> 
			<a href="#" class="list-finder-clear button black" style="display:none; position:absolute; top:10px; right:23px;">Clear</a>
			</div>		
		</div>	

		<script type="text/javascript">
			$(function(){
				$('.list-finder input').keyup(function(){
					listFinderSearchByTerm( $(this).val().toLowerCase() );
				});

				searchhash = window.location.hash.slice(1);
				if(searchhash){
					listFinderSearchByTerm( searchhash );
					$('.list-finder input').val(searchhash);
				}
				$('.list-finder-clear').click( listFinderClear );
			});
		</script>

		<br /><br />

		<ul id="artList" class="none search-list">			
		<?php
			$args = array(
				'post_type'   => 'attachment', 
				'order'       => 'asc', 
				'orderby'     => 'title', 
				'numberposts' => -1, 
				'post_status' => 'any', 	
				'post_parent' => null, 
				'category_name' => 'artifact'
			); 
			$attachments = get_posts( $args );
			if ($attachments) {
				foreach ( $attachments as $post ) {
					echo "<li class=\"artifact\">";
					setup_postdata($post);
					
					$cat = get_the_category($post->ID);
					$teetle = $post->post_title;

					echo "<h4 style=\"line-height:0.5\"><a onclick=\"setTimeout(function(){javascript:_gaq.push(['_trackEvent','artifact','". $teetle ."']);},500);\" style=\"color:#009bb3;\" href=\"" . wp_get_attachment_url() . "\">";
					if ($cat[0]->cat_name == 'Tool') {
						echo "<span class=\"evelyn-tools\" style=\"margin-left: -1.2em;\"> </span>";
					}else if (strpos($teetle, "Duarte") !== false ){
						echo "<span class=\"evelyn-logo-bug\" style=\"margin-left: -1.2em;\"> </span>";
					}else{
						echo "<span class=\"evelyn-document\" style=\"margin-left: -1.2em;\"> </span>";
					};
										the_title();
										echo "</a></h4>";					
					echo "<h5 style=\"line-height:1.2\">";
					

					$uTime = $post->post_modified;
					if ($post->post_excerpt) { 
						echo $post->post_excerpt . "<br /><small>" . "Updated " . date('F jS \'y', strtotime($uTime));
					} else {
						echo "<small>" . "Updated " . date('F jS \'y', strtotime($uTime));
					};
					echo "</small></h5>";
					echo "</li>";
				}
			} 
			
				echo "<div id='noResults' style='display:none'><h3 class='thin'>Oops! Looks like the document you are looking for isn't here.<br></h3><h5>How about trying a global search by clicking on the little magnifying glass at the top of the page?</h5></div>";
			
		?>
		</ul>
	</article>	
</div>
</section>

<?php get_footer(); ?>