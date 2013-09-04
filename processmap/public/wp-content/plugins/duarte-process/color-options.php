<div class="wrap">
	<?php screen_icon(); ?>
	<h2>Process Auto Keyword Highlighting</h2>

	<form method="post" action="options.php"> 
		<?php settings_fields('process-group'); ?>
		<table class="form-table">
			<?php 

				for($i=1; $i <= 8; $i++){
				 	printf('<tr valign="top"><td><input type="color" name="process-colors-%1$s" value="%2$s" /></td>', $i, get_option("process-colors-$i"));
				 	printf('<td><textarea name="process-keywords-%1$s" cols="80">%2$s</textarea></td></tr>', $i, get_option("process-keywords-$i"));
				}
			?>

		</table>
		<input type="hidden" name="action" value="update" />		
		<?php submit_button(); ?>
	</form>
</div>