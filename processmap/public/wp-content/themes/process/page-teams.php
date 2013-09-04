<?php get_header(); ?>
<?php the_post(); ?>

<section rel="main">
	<div class="row">
	<article class="twelve columns">
		<h2><?php the_title(); ?></h2>
		<div class="row fill-very-light list-finder">
			<div class="eight mobile-three columns centered">
			<input type="text" name="peopleSearch" placeholder="Search for a team by name or by person"></input> 
			<a href="#" class="list-finder-clear button black" style="display:none; position:absolute; top:10px; right:23px;">Clear</a>
			</div>		
		</div>	

		<script type="text/javascript">
			$(function(){
				$('.list-finder input').keyup( _.debounce(function(){
					listFinderSearchByTerm( $(this).val().toLowerCase() );
				}, 500));

				searchhash = window.location.hash.slice(1);
				if(searchhash){
					listFinderSearchByTerm( searchhash );
					$('.list-finder input').val(searchhash);
				}
				$('.list-finder-clear').click( listFinderClear );
			});
		</script>

		<br /><br />
		<div class='row'>
		<div class='ten columns centered'>
		<ul id="peopleList" class="none search-list">			
		<?php
			$args = array(
				'post_type'   => 'teams', 
				'order'       => 'asc', 
				'orderby'     => 'title', 
				'numberposts' => -1, 
				'post_status' => 'publish', 
				'post_parent' => null
			); 
			$attachments = get_posts( $args );
			if ($attachments) {
				foreach ( $attachments as $team ) {
					echo "<li>";
					$post = $team;
					setup_postdata($post);
					$teamID = $post->ID;
					$cat = get_the_category($teamID);

					$teetle = $post->post_title;

					// $posts = get_field('people-team');
 
					// if( $posts ): 

					// 	foreach( $posts as $post): // variable must be called $post (IMPORTANT) 
					// 		setup_postdata($post); 
					// 		$teamLink=get_permalink();
					// 		$teamTitle=get_the_title();
					// 	endforeach;
					// 	wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
					// endif;

					// $post = $person;
					// setup_postdata($post);
					$thisTeam = get_the_title();
					
					echo "<div class='row' style='border-bottom:1px dashed; border-color:#bdbcaf'>";
						echo "<div class='row unpadded'>";
							echo "<div class='four columns' style='padding-left:0px; padding-bottom:0px'>";
								echo "<h2 style='line-height:1.0';margin-bottom:5px'>";
								$teamName=get_the_title();
								if (is_numeric($teamName)) {
									echo "Team ";
								}
									the_title();
								echo "</h2>";		
								echo "<h6 class='color-text-lighter' style='line-height:1.0'>".get_field("teams-group");
								//echo "<h5>VP - ".get_field("teams-vp")."</h5>";
								$vps = get_field("teams-vp");
								if($vps){
									foreach($vps as $vp){
										$post = $vp;
										setup_postdata($post);
										echo " / ".get_field('people-first-name') ."</h6>";
										wp_reset_postdata();
									}
									$post = $team;
									setup_postdata($post);
								}
								
								echo "<p>".get_field("teams-description")."</p>";
							echo "</div>";
							echo "<div class='eight columns'><div class='row unpadded' >";
							
								// echo "<h5>".get_field("teams-description")."</h5>";

							$people = get_posts(array(
								'post_type' => 'people',
								'posts_per_page'  => -1,
								'meta_query' => array(
									array(
										'key' => 'people-team', // name of custom field
										'value' => $teamID, // matches exaclty "123", not just 123. This prevents a match for "1234"
										'compare' => 'LIKE'
									)
								)
							));
							 
							if( $people )
							{
								$i=0;
								foreach ($people as $person) {
									$post = $person;
									setup_postdata($post);
									$i++;

									$fullname = get_field('people-first-name')." ".get_field('people-last-name');

									echo "<div class='four columns ' style='float:left'>";
									// echo "<div class='row unpadded'>";
									if( get_field('people-bio-photo')) {
										echo "<a href='/people/#". strtolower(get_field('people-email-address')) ."'>";
										echo "<img src='". get_field('people-bio-photo'). "'/>";
										echo "</a>";
									}
									echo "<br><h5><a class='color-bondi-blue' href='/people/#". strtolower(get_field('people-email-address')) ."'>". $fullname ."</a><br><small>".get_field('people-job-title')."</small></h5></div>";
									if ($i%3==0) {echo "</div><div class='row unpadded'>";}
								}
							}
							// echo "</div>";
						echo "</div>";
					echo "</div>";
					echo "</li>";
					
				}
			} 
			
				echo "<div id='noResults' style='display:none'><h3 class='thin'>Oops! Looks like the document you are looking for isn't here.<br></h3><h5>How about trying a global search by clicking on the little magnifying glass at the top of the page?</h5></div>";
			
		?>
		</ul>
	</div>
</div>
	</article>	
</div>

</section>

<?php get_footer(); ?>