<?php

function fb3fw_options_page() {

	if ( isset($_REQUEST['reset']) && $_REQUEST['reset'] )
		echo '<div id="message" class="updated fade"><p><strong>fancyBox 3 for WordPress settings have been reset.</strong></p></div>';

	$settings = get_option( 'fb3fw' );
	$version = get_option('fb3fw_active_version');

	?>

	<div class="wrap">

		<h1><?php printf( __('fancyBox 3 for Wordpress Settings', 'fb3fw')); ?></h1>

		<form method="post" action="options.php" id="options">

			<?php settings_fields( 'fb3fw-options' ); ?>

			<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><?php _e('Loop', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[loop]">
								<option value="false" <?php if($settings['loop'] == "false") { echo 'selected="selected"'; } ?>>False</option>
								<option value="true" <?php if($settings['loop'] == "true") { echo 'selected="selected"'; } ?>>True</option>
							</select>
							<p class="description">Should fancyBox loop?</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Margin', 'fb3fw'); ?></th>
						<td>
							<input type="text" name="fb3fw[marginWidth]" value="<?php if($settings['marginWidth'] == "") { echo '44'; } else { echo $settings['marginWidth']; } ?>" />
							<input type="text" name="fb3fw[marginHeight]" value="<?php if($settings['marginHeight'] == "") { echo '0'; } else { echo $settings['marginHeight']; } ?>" />
							<p class="description">Space around image, ignored if zoomed-in or viewport smaller than 800px. Enter values without "px".</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Gutter', 'fb3fw'); ?></th>
						<td>
							<input type="text" name="fb3fw[gutter]" value="<?php if($settings['gutter'] == "") { echo '50'; } else { echo $settings['gutter']; } ?>" />
							<p class="description">Horizontal space between slides. Enter values without "px".</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Keyboard', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[keyboard]">
								<option value="false" <?php if($settings['keyboard'] == "false") { echo 'selected="selected"'; } ?>>False</option>
								<option value="true" <?php if($settings['keyboard'] == "true") { echo 'selected="selected"'; } ?>>True</option>
							</select>
							<p class="description">Enables keyboard navation.</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Arrows', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[arrows]">
								<option value="false" <?php if($settings['arrows'] == "false") { echo 'selected="selected"'; } ?>>False</option>
								<option value="true" <?php if($settings['arrows'] == "true") { echo 'selected="selected"'; } ?>>True</option>
							</select>
							<p class="description">Display navigation arrows at the screen edges?</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Infobar', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[infobar]">
								<option value="false" <?php if($settings['infobar'] == "false") { echo 'selected="selected"'; } ?>>False</option>
								<option value="true" <?php if($settings['infobar'] == "true") { echo 'selected="selected"'; } ?>>True</option>
							</select>
							<p class="description">Display infobar (counter and arrows at the top)?</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Toolbar', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[toolbar]">
								<option value="false" <?php if($settings['toolbar'] == "false") { echo 'selected="selected"'; } ?>>False</option>
								<option value="true" <?php if($settings['toolbar'] == "true") { echo 'selected="selected"'; } ?>>True</option>
							</select>
							<p class="description">Display the toolbar?</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Buttons', 'fb3fw'); ?></th>
						<td>
							<label for="btn-slideShow">
								<input type="checkbox" name="fb3fw[btnSlideShow]" id="btn-slideShow" <?php if(isset($settings['btnSlideShow']) && $settings['btnSlideShow']) echo ' checked="yes"'; ?> />
								Slideshow &nbsp;&nbsp;
							</label>
							<label for="btn-fullScreen">
								<input type="checkbox" name="fb3fw[btnFullScreen]" id="btn-fullScreen" <?php if(isset($settings['btnFullScreen']) && $settings['btnFullScreen']) echo ' checked="yes"'; ?> />
								Full Screen &nbsp;&nbsp;
							</label>
							<label for="btn-thumbs">
								<input type="checkbox" name="fb3fw[btnThumbs]" id="btn-thumbs" <?php if(isset($settings['btnThumbs']) && $settings['btnThumbs']) echo ' checked="yes"'; ?> />
								Thumbnails &nbsp;&nbsp;
							</label>
							<label for="btn-close">
								<input type="checkbox" name="fb3fw[btnClose]" id="btn-close" <?php if(isset($settings['btnClose']) && $settings['btnClose']) echo ' checked="yes"'; ?> />
								Close &nbsp;&nbsp;
							</label>
							<p class="description">Select which buttons should be displayed.</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Idle Time', 'fb3fw'); ?></th>
						<td>
							<input type="text" name="fb3fw[idleTime]" value="<?php if($settings['idleTime'] == "") { echo '4'; } else { echo $settings['idleTime']; } ?>" />
							<p class="description">Detect "idle" time in seconds</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Protect Images', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[protect]">
								<option value="false" <?php if($settings['protect'] == "false") { echo 'selected="selected"'; } ?>>False</option>
								<option value="true" <?php if($settings['protect'] == "true") { echo 'selected="selected"'; } ?>>True</option>
							</select>
							<p class="description">Disable right-click and use simple image protection for images?</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Modal', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[modal]">
								<option value="false" <?php if($settings['modal'] == "false") { echo 'selected="selected"'; } ?>>False</option>
								<option value="true" <?php if($settings['modal'] == "true") { echo 'selected="selected"'; } ?>>True</option>
							</select>
							<p class="description">Make content "modal" - disable keyboard navigtion, hide buttons, etc?</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Animation Effect', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[animationEffect]">
								<option value="false" <?php if($settings['animationEffect'] == "false") { echo 'selected="selected"'; } ?>>Disabled</option>
								<option value="zoom" <?php if($settings['animationEffect'] == "zoom") { echo 'selected="selected"'; } ?>>Zoom</option>
								<option value="fade" <?php if($settings['animationEffect'] == "fade") { echo 'selected="selected"'; } ?>>Fade</option>
								<option value="zoom-in-out" <?php if($settings['animationEffect'] == "zoom-in-out") { echo 'selected="selected"'; } ?>>Zoom In-Out</option>
							</select>
							<p class="description">Open/close animation type</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Animation Duration', 'fb3fw'); ?></th>
						<td>
							<input type="text" name="fb3fw[animationDuration]" value="<?php if($settings['animationDuration'] == "") { echo '350'; } else { echo $settings['animationDuration']; } ?>" />
							<p class="description">Duration in ms for open/close animation</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Transition Effect', 'fb3fw'); ?></th>
						<td>
							<select name="fb3fw[transitionEffect]">
								<option value="false" <?php if($settings['transitionEffect'] == "false") { echo 'selected="selected"'; } ?>>Disabled</option>
								<option value="fade" <?php if($settings['transitionEffect'] == "fade") { echo 'selected="selected"'; } ?>>Fade</option>
								<option value="slide" <?php if($settings['transitionEffect'] == "slide") { echo 'selected="selected"'; } ?>>Slide</option>
								<option value="circular" <?php if($settings['transitionEffect'] == "circular") { echo 'selected="selected"'; } ?>>Circular</option>
								<option value="tube" <?php if($settings['transitionEffect'] == "tube") { echo 'selected="selected"'; } ?>>Tube</option>
								<option value="zoom-in-out" <?php if($settings['transitionEffect'] == "zoom-in-out") { echo 'selected="selected"'; } ?>>Zoom In-Out</option>
								<option value="rotate" <?php if($settings['transitionEffect'] == "rotate") { echo 'selected="selected"'; } ?>>Rotate</option>
							</select>
							<p class="description">Transition effect between slides</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Transition Duration', 'fb3fw'); ?></th>
						<td>
							<input type="text" name="fb3fw[transitionDuration]" value="<?php if($settings['transitionDuration'] == "") { echo '350'; } else { echo $settings['transitionDuration']; } ?>" />
							<p class="description">Duration in ms for transition animation</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Slide Class', 'fb3fw'); ?></th>
						<td>
							<input type="text" name="fb3fw[slideClass]" value="<?php echo $settings['slideClass']; ?>" />
							<p class="description">Custom CSS class for slide element</p>
						</td>
					</tr>
					<tr>
						<th scope="row"><?php _e('Base Class', 'fb3fw'); ?></th>
						<td>
							<input type="text" name="fb3fw[baseClass]" value="<?php echo $settings['baseClass']; ?>" />
							<p class="description">Custom CSS class for layout</p>
						</td>
					</tr>
				</tbody>
			</table>

			<p class="submit"><input type="submit" name="fb3fw[fb3fw_update]" class="button button-primary" value="<?php esc_attr_e( 'Save Changes', 'fb3fw' ); ?>" /></p>

		</form>

	</div>

<?php

}

?>
