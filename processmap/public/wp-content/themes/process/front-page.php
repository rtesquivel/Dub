<?php get_header(); ?>



<section rel="main" id="front-page">
	<div class="row">
		<div class="two columns">
			<h3 class="thin unpadded" style="margin-top:0; margin-bottom:0; font-family:'ApexNew Light Italic'">Apps</h3>
			<?php 
				$menu = 'Apps Menu';
				$args = array(
			        'order'                  => 'ASC',
			        'orderby'                => 'menu_order',
			        'post_type'              => 'nav_menu_item',
			        'post_status'            => 'publish',
			        'output'                 => ARRAY_A,
			        'output_key'             => 'menu_order',
			        'nopaging'               => true,
			        'update_post_term_cache' => false );


				$items = wp_get_nav_menu_items( $menu, $args );

				foreach($items as $item) {
					//var_dump($item);
					echo "<br>";
					echo "<div class='button black tiny expand' style='margin-bottom:2px'><a class='color-white' href='".$item->url."'>".$item->title."</a></div>";
				}

			?>
		
		</div>
		<div class="seven columns">
			<h3 class="thin unpadded" style="margin-top:0; font-family:'ApexNew Light Italic'">Updates</h3>


			<?php 	// get Updates
			$args = array(
				'post_type'   => 'post', 
				'order'       => 'asc', 
				'orderby'     => 'title', 
				'numberposts' => -1, 
				'post_status' => 'publish', 
				'post_parent' => null
			); 

			$attachments = get_posts( $args );
			if ($attachments) {
				foreach ($attachments as $post){
					setup_postdata($post);

					// var_dump($post);
					echo "<strong>";
					echo get_the_title();
					echo "</strong>";
					the_content();

				}

			}

			wp_reset_postdata();

			?>



		</div>
		<div class="three columns text-right">
			<h3 class="thin unpadded" style="margin-top:0; font-family:'ApexNew Light Italic'">Events</h3>
			<?php
			$args = array(
				'post_type'   => 'people', 
				'order'       => 'asc', 
				'orderby'     => 'title', 
				'numberposts' => -1, 
				'post_status' => 'publish', 
				'post_parent' => null
			); 

			$i=0;
			$j=0;

			$attachments = get_posts( $args );
			if ($attachments) {
				foreach ( $attachments as $post ) {
						setup_postdata($post);
						$birthMonth = get_field('people-date-of-birth-month');
						$birthDay = get_field('people-date-of-birth-day');
						$birthDate = strtotime($birthMonth."/".$birthDay.date("Y"));
						$thisWeekStart = strtotime("now")-date('w')*60*60*24;
						if (($birthDate - $thisWeekStart)/(60*60*24) <= 7 && ($birthDate - $thisWeekStart)/(60*60*24)>= 0) {
							$thisWeekBirthday[$i] =  "<a href='/people/#".get_field('people-email-address')."' >".get_the_title()."</a> / ".date("l",$birthDate);
							$i++;
						}

						$dateOfHire = strtotime(get_field('people-date-of-hire'));
						$anniversary = strtotime(date("m/d/",$dateOfHire).date("Y"));
						if (($anniversary - $thisWeekStart)/(60*60*24) <= 7 && ($anniversary - $thisWeekStart)/(60*60*24)>= 0) {
							$thisWeekAnniversary[$j] = "<a href='/people/#".get_field('people-email-address')."' >".get_the_title()."</a> / ".date("l",$anniversary);
							$j++;
						}
					}

					$birthdaysThisWeek = $i;
					$anniversariesThisWeek = $j;
			}

			wp_reset_postdata();
			$k=0;
			echo "<strong style='margin-bottom:10px'>Birthdays this week:<br><br></strong>";
			echo "<p>";
			for($k==0;$k<$birthdaysThisWeek;$k++) {
				echo $thisWeekBirthday[$k]."<br>";
			}

			echo "</p>";

			$k=0;
			echo "<br><strong style='margin-bottom:10px'>Anniversaries this week:<br><br></strong>";

			echo "<p>";
			for($k==0;$k<$anniversariesThisWeek;$k++) {
				echo $thisWeekAnniversary[$k]."<br>";
			}
			echo "</p>";

			?>
			
		</div>
	</div>
	<div class="row">

		<div class="eight columns centered">
			<h1 class="thin text-center">Welcome to the <br>Wonderful World of Duarte.</h1>
		</div>
		<div class="twelve columns centered">
			<div class="row text-center">
				<article class="three columns text-center" >
					<a class=" text-center circle" href="<?php echo home_url(); ?>/studio/acquisition-2">
						Studio
					</a>
					<p class="text-center">
						<h6 class="caption text-center" >The process for longer,<br> more developed projects.</h6>
					</p>
				</article>

				<article class="three columns text-center" >
					<a class=" text-center circle" href="<?php echo home_url(); ?>/studio/acquisition">
						Factory
					</a>
					<p class="text-center">
						<h6 class="caption text-center">The process for quicker <br>production-based projects.</h6>
					</p>
				</article>

				<article class="three columns" >
					<a class=" text-center circle" href="<?php echo home_url(); ?>/artifacts">
						Artifacts
					</a>
					<p>
						<h6 class="caption">Templates, tools, <br>and Duarte brand assets.</h6>
					</p>
				</article>

				<article class="three columns" >
					<a class=" text-center circle" href="<?php echo home_url(); ?>/duartepedia">
						Duartepedia
					</a>
					<p>
						<h6 class="caption">Your Duarte manual.</h6>
					</p>
				</article>
			
			</div>

			<div class="row text-center">
				<article class="three columns text-center" >
					<a class=" text-center circle" href="http://relay.duarte.com">
						Relay
					</a>
					<p class="text-center">
						<h6 class="caption text-center" >Send and receive files.</h6>
					</p>
				</article>

				<article class="three columns text-center" >
					<a class=" text-center circle" href="https://webmail-us.mimecast.com/">
						Mimecast
					</a>
					<p class="text-center">
						<h6 class="caption text-center">For when the email server goes down.</h6>
					</p>
				</article>

				<article class="three columns" >
					<a class=" text-center circle" href="<?php echo home_url(); ?>/suggestions">
						Suggestions
					</a>
					<p>
						<h6 class="caption">Anonymous feedback to <br> Nancy,Drew, and Kerry.</h6>
					</p>
				</article>

				<article class="three columns" >
					<a class=" text-center circle" href="mailto:help@duarte.com">
						Help Desk
					</a>
					<p>
						<h6 class="caption">Send a direct line <br> to the Tech Team.</h6>
					</p>
				</article>
			
			</div>
		</div>

	<div>
</section>

<?php get_footer(); ?>