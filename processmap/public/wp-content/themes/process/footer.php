<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since Twenty Twelve 1.0
 */
?>

	<footer>
		<div class="row">

			<div class="eight columns offset-by-four text-right">
				<ul class="legal">				
					<li>&copy; 2013 <a href="http://www.duarte.com/">Duarte, Inc.</a></li>								
					<li>CONFIDENTIAL</li>
					<li><a target="_blank" href="<?php echo get_admin_url(); ?>">Admin Login</a></li>
					<!-- <li><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Glossary' ) ) ); ?>">Glossary</a></li> -->
					<li><a href="<?php echo esc_url( get_permalink( get_page_by_title( 'Artifacts' ) ) ); ?>">Artifacts</a></li>
					<li><a href="#" onclick="$('.global-finder').trigger('toggle');">Search</a></li>
					<li><a href="mailto:help@duarte.com?subject=Process Site #web">Send Feedback To #WEB</a></li>
				</ul>
			</div>
		</div>
	</footer>

	<script type="text/javascript">

		require(['jquery'], function($){
			$(function(){
				$('a[href^="mailto"]').on('click', function(){
					var mail = $(this).text().trim().toLowerCase();
					var loc = document.location.pathname;
					setTimeout(function(){
						_gaq.push(['_trackEvent',  'MailTo', mail, loc]);
					}, 150);
				});
			});
		});
	</script>

	<?php wp_footer(); ?>

</body>
</html>