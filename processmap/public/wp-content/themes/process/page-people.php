<?php get_header(); ?>
<?php the_post(); ?>
<script type="text/javascript">
	$(function() {
		$('#teams').hide();
		$('#tab').on('click','a', 
			function() {
				if($(this).attr('id')=='fullList') {
					$('#fullList').addClass('active');
					$('#byTeam').removeClass('active');
					$('#individuals').show();
					$('#teams').hide();
				} else {
					$('#byTeam').addClass('active');
					$('#fullList').removeClass('active');
					$('#individuals').hide();
					$('#teams').show();
				}
			});
	});
</script>
<section rel="main">
	<div class="row">
		<div class="row" id="tab">
			<div class="four columns"><a id="fullList" class="button black expand active">Full List</a></div>
			<div class="four columns"><a id="byTeam" class="button black expand">Group by Team</a></div>
			
			
		</div>


	<article class="twelve columns" id="individuals">

		

		<div class="row fill-very-light list-finder">
			<div class="eight mobile-three columns centered">
			<input type="text" name="peopleSearch" placeholder="Search for someone by name, phone number, birthday, etc."></input> 
			<a href="#" class="list-finder-clear button black" style="display:none; position:absolute; top:10px; right:23px;">Clear</a>
			</div>		
		</div>	

		<script type="text/javascript">
			$(function(){
				$('.list-finder input').keyup( _.debounce(function(){
					listFinderSearchByTerm( $(this).val().toLowerCase() );
				}, 500) );

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
				'post_type'   => 'people', 
				'order'       => 'asc', 
				'orderby'     => 'title', 
				'numberposts' => -1, 
				'post_status' => 'publish', 
				'post_parent' => null
			); 

			$attachments = get_posts( $args );
			if ($attachments) {
				foreach ( $attachments as $person ) {
					echo "<li>";
					$post = $person;
					setup_postdata($post);
					
					$cat = get_the_category($post->ID);
					$teetle = $post->post_title;

					$posts = get_field('people-team');
 
					if( $posts ) {
						foreach( $posts as $post) { // variable must be called $post (IMPORTANT) 
							setup_postdata($post); 
							$teamLink = get_permalink();
							$teamTitle = get_the_title();
						}
						wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly 
					}

					$post = $person;
					setup_postdata($post);

					
					echo "<div class='row'>";
						echo "<div class='three columns'>";
							if( get_field('people-bio-photo')) {
								echo "<img src='". get_field('people-bio-photo'). "'/>";
							}
						echo "</div>";
						
						echo "<div class='four columns'>";
						echo "<h3 style='margin-bottom:0px'>". get_the_title() ."</h3>";
						
						echo "<h5 style='margin-bottom:0'>Team: <a class='color-bondi-blue' style='line-height: 0; ' href='/teams/#". strtolower($teamTitle)."'><b>".$teamTitle."</b></a></h5>";

						echo "<h5 style='margin-bottom:10px; ' class=''>Job: ";
						echo "<b style=''>".get_field("people-job-title")."</b></h5>";

					?>
					
						<div class="row unpadded" style="padding-top:0">
							<div class="three columns text-right color-gulf-stream" style="padding-top:0px; padding-right: 5px">email</div>
							<div class="nine columns" style="padding-top:0px; padding-left: 0"><?php if (get_field('people-email-address')) {echo "<a href='".get_field('people-email-address')."'>".get_field('people-email-address')."</a>";} else {echo "<div class='color-text-lighter' style='font-style:oblique'>None on file</div>";} ?></div>
						</div>
						<div class="row unpadded" style="padding-top:0">
							<div class="three columns text-right color-gulf-stream" style="padding-top:0px; padding-right: 5px">ext</div>
							<div class="nine columns" style="padding-top:0px; padding-left: 0"><?php if (get_field('people-phone-extension')) {echo get_field('people-phone-extension');} else {echo "<div  class='color-text-lighter' style='font-style:oblique'>None on file</div>";} ?></div>
						</div>
						<div class="row unpadded">
							<div class="three columns text-right color-gulf-stream" style="padding-right: 5px">cell</div>
							<div class="nine columns" style="padding-left: 0"><?php if (get_field('people-cell-number')) {echo get_field('people-cell-number');} else {echo "<div  class='color-text-lighter' style='font-style:oblique'>None on file</div>";} ?></div>
						</div>
						<div class="row unpadded">
							<div class="three columns text-right color-gulf-stream" style="padding-right: 5px">chat</div>
							<div class="nine columns " style="padding-left: 0"><?php if (get_field('people-im-screen-name')) {echo get_field('people-im-screen-name');} else {echo "<div  class='color-text-lighter' style='font-style:oblique'>None on file</div>";} ?></div>
						</div>

					</div>

					<?php

					//  echo "<div class='row'>";
				    
				 //    echo "<div class='four columns text-right' style='margin-right:-20px;' >";
				 //    echo "extension<br>";
				 //    echo "cell<br>";
				 //    echo "chat<br>";
				 //    echo "</div>";
				 //    echo "<div class='eight columns text-left' >";
				 //    echo "".get_field('people-phone-extension')."<br>";
				 //    echo "".get_field('people-cell-number')."<br>";
				 //    echo "".get_field('people-im-screen-name')."<br>";
				    
				 //    echo "</div></div>";
					// echo "</div>";

					echo "<div class='five columns text-right'>";
					// $hireDate=get_field("people-date-of-hire");
					// echo $hireDate."<br>";
					$now = time(); // or your date as well
					$thisYear = date('Y',$now);
					$thisMonth = date('m',$now);
					$hireDate = DateTime::createFromFormat('Ymd', get_field('people-date-of-hire'));
					// $hireYear= strtotime($hireDate->format('Y'));
					$hireMonth = date('m',strtotime(get_field('people-date-of-hire')));
					$hireDate =  strtotime(get_field('people-date-of-hire'));

				    $datediff = $now - $hireDate;
				    $days = floor($datediff/(60*60*24));
				    $years = floor($days/365);

				    if ($thisMonth >= $hireMonth) {$months = $thisMonth - $hireMonth;}
				    else {$months = 12 - ($hireMonth - $thisMonth);}

				    // echo "this month = ".$thisMonth."<br>";
				    // echo "hire month = ".$hireMonth."<br>";
				    echo "<h5 style='margin-top:5px;'>";
				    if (get_field('people-date-of-hire')) {
					    echo "Hired ";
					    if ($years > 0) { 
					    	echo "<b>".$years."</b> ";
					    	if ($years == 1) {echo "year ";}
					    	else {echo "years ";}
					    }
					    if($years > 0 && $months >0) {echo " and ";}
					    if ($months > 0) {
					    	echo "<b>".$months."</b> ";
					    	if ($months == 1) {echo "month ";}
					    	else { echo "months ";}
					    }
					    if ($years == 0 && $months == 0) {echo "this month.";}
					    else { echo " ago.";}
					    echo "<br>";
				    }

				    $birthMonth = get_field('people-date-of-birth-month');
				    $monthName = date("F", mktime(0, 0, 0, $birthMonth, 10));
				    $birthDay = get_field('people-date-of-birth-day');
				    $dayName = date("jS", mktime(0, 0, 0, $birthMonth, $birthDay));

				    if(get_field('people-date-of-birth-month') && get_field('people-date-of-birth-day')) {
					    echo "Birthday: <b>".$monthName." ".$dayName."</b>";
					}
					echo "</h5>";

				    // echo "<h5><b>Contact info:</b></h5>";
				    if (get_field('people-bio-page-url')) {echo "<a class='button black next clear' href='".get_field('people-bio-page-url')."'>Bio Page</a><br>";}
				    if (get_field('people-email-address')) {echo "<a class='button black next clear' href='mailto:".get_field('people-email-address')."'>".get_field('people-email-address')."</a><br><br>";}
				    
					
					// echo $date->format('d-m-Y');
					
					echo "</div>";

					echo "</div>";
					// echo "<hr>";
					echo "</li>";
					
				}
			} 
			
				echo "<div id='noResults' style='display:none'><h3 class='thin'>Oops! Looks like the document you are looking for isn't here.<br></h3><h5>How about trying a global search by clicking on the little magnifying glass at the top of the page?</h5></div>";
			
		?>
		</ul>
	</div>
</div>
	</article>	

		<article class="twelve columns" id="teams">
				
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