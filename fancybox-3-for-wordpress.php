<?php
/*
Plugin Name: fancyBox 3 for Wordpress
Plugin URI: https://wordpress.org/plugins/fancybox-3-for-wordpress/
Description: Enables fancyBox 3 functionality in Wordpress.
Version: 1.0.0
Author: w3dev
Author URI: https://w3dev.me/
*/


define( 'fb3fw_VERSION', '1.0.0' );
define( 'fb3fw_PATH', plugin_dir_path(__FILE__) );
define( 'fb3fw_URL', plugin_dir_url(__FILE__) );

function fb3fw_defaults() {

	$defaults_array = array(

		'loop'					=> 'false',

		'marginWidth'			=> '44',
		'marginHeight'			=> '0',
		'gutter'				=> '50',

		'keyboard'				=> 'true',
		'arrows'				=> 'true',
		'infobar'				=> 'false',
		'toolbar'				=> 'true',

		'btnSlideShow'			=> 'on',
		'btnFullScreen'			=> 'on',
		'btnThumbs'				=> 'on',
		'btnClose'				=> 'on',

		'idleTime'				=> '4',
		'protect'				=> 'false',
		'modal'					=> 'false',

		'animationEffect'		=> 'zoom',
		'animationDuration'		=> '350',

		'transitionEffect'		=> 'fade',
		'transitionDuration'	=> '350',

		'slideClass'			=> '',
		'baseClass'				=> '',

	);

	return $defaults_array;
}



function fb3fw_install() {

	$defaults_array = fb3fw_defaults();
	add_option( 'fb3fw', $defaults_array );
	update_option( 'fb3fw_active_version', fb3fw_VERSION );

}
register_activation_hook( __FILE__, 'fb3fw_install' );


function fb3fw_uninstall() {
	$settings = get_option( 'fb3fw' );
	delete_option( 'fb3fw' );
	delete_option( 'fb3fw_active_version' );
}
register_deactivation_hook( __FILE__, 'fb3fw_uninstall' );


function fb3fw_register_scripts() {

	wp_register_script('fancybox', fb3fw_URL . 'fancybox/jquery.fancybox.min.js', 'jquery', '3.1.25', true );

}
add_action( 'init', 'fb3fw_register_scripts' );

function fb3fw_scripts() {

	$settings = get_option( 'fb3fw' );
	wp_enqueue_script( 'fancybox' );

}
add_action( 'wp_enqueue_scripts', 'fb3fw_scripts' );


function fb3fw_styles() {

	$settings = get_option( 'fb3fw' );
	wp_enqueue_style( 'fancybox', fb3fw_URL . 'fancybox/jquery.fancybox.min.css' );

}
add_action( 'wp_enqueue_scripts', 'fb3fw_styles' );


function fb3fw_textdomain() {

	if ( function_exists('load_plugin_textdomain') ) {
		load_plugin_textdomain( 'fb3fw', fb3fw_URL . 'languages', 'fancybox-3-for-wordpress/languages' );
	}

}
add_action( 'init', 'fb3fw_textdomain' );


function fb3fw_admin_options() {

	$settings = get_option( 'fb3fw' );
	register_setting( 'fb3fw-options', 'fb3fw' );

}
add_action( 'admin_init', 'fb3fw_admin_options' );


function fb3fw_admin_menu() {

	require fb3fw_PATH . 'fancybox-3-for-wordpress-admin.php';

	$fb3fwadmin = add_submenu_page( 'options-general.php', 'fancyBox 3 for WordPress Options', 'fancyBox 3', 'manage_options', 'fancybox-3-for-wordpress', 'fb3fw_options_page' );

	add_action( 'admin_print_styles-' . $fb3fwadmin, 'fb3fw_admin_styles' );
	add_action( 'admin_print_scripts-' . $fb3fwadmin, 'fb3fw_admin_scripts' );

}
add_action('admin_menu', 'fb3fw_admin_menu');


function fb3fw_admin_styles() {
	wp_enqueue_style( 'fancybox-admin', fb3fw_URL . 'css/fancybox-admin.css' );
}


function fb3fw_admin_scripts() {
	wp_enqueue_script( 'fancybox-admin', fb3fw_URL . 'js/admin.js', array('jquery') );
}


function fb3fw_plugin_action_links($links, $file) {

	static $this_plugin;
	if ( ! $this_plugin ) $this_plugin = plugin_basename( __FILE__ );

	if ( $file == $this_plugin ){
		$settings_link = '<a href="options-general.php?page=fancybox-3-for-wordpress">' . __( 'Settings', 'fb3fw' ) . '</a>';
		array_unshift( $links, $settings_link );
	}

	return $links;

}
add_filter( 'plugin_action_links', 'fb3fw_plugin_action_links', 10, 2 );


function fb3fw_init() {

	$settings = get_option( 'fb3fw' );

	$margin 	= '['.$settings['marginWidth'].', '.$settings['marginHeight'].']';

	$buttons 	= '[';
		if(isset($settings['btnSlideShow']) && $settings['btnSlideShow'] == 'on') { $buttons .= '"slideShow", '; }
		if(isset($settings['btnFullScreen']) && $settings['btnFullScreen'] == 'on') { $buttons .= '"fullScreen", '; }
		if(isset($settings['btnThumbs']) && $settings['btnThumbs'] == 'on') { $buttons .= '"thumbs", '; }
		if(isset($settings['btnClose']) && $settings['btnClose'] == 'on') { $buttons .= '"close"'; }
	$buttons	.= ']';

echo "\n<!-- fancyBox 3 for Wordpress -->"; ?>

<script type="text/javascript">
jQuery(function(){

	jQuery.fn.getTitle = function() {
		var arr = jQuery("a.fancybox");
		jQuery.each(arr, function() {
			var title = jQuery(this).children("img").attr("title");
			var caption = jQuery(this).children("img").attr("alt");
			jQuery(this).attr('title',title).attr('data-caption',caption);
		})
	}

	var images 	= jQuery("a:has(img)").not(".nolightbox").filter( function() { return /\.(jpe?g|png|gif|bmp)$/i.test(jQuery(this).attr('href')) });
	images.addClass("fancybox").getTitle();

	var gallery = jQuery(".gallery-item a:has(img)").not(".nolightbox").filter( function() { return /\.(jpe?g|png|gif|bmp)$/i.test(jQuery(this).attr('href')) });
	gallery.attr("data-fancybox","gallery");


	jQuery("a.fancybox").fancybox({
		'loop': <?php echo $settings['loop']; ?>,
		'margin': <?php echo $margin; ?>,
		'gutter': <?php echo $settings['gutter']; ?>,
		'keyboard': <?php echo $settings['keyboard']; ?>,
		'arrows': <?php echo $settings['arrows']; ?>,
		'infobar': <?php echo $settings['infobar']; ?>,
		'toolbar': <?php echo $settings['toolbar']; ?>,
		'buttons': <?php echo $buttons; ?>,
		'idleTime': <?php echo $settings['idleTime']; ?>,
		'protect': <?php echo $settings['protect']; ?>,
		'modal': <?php echo $settings['modal']; ?>,
		'animationEffect': "<?php echo $settings['animationEffect']; ?>",
		'animationDuration': <?php echo $settings['animationDuration']; ?>,
		'transitionEffect': "<?php echo $settings['transitionEffect']; ?>",
		'transitionDuration': <?php echo $settings['transitionDuration']; ?>,
		<?php if($settings['slideClass'] != '') { ?>'slideClass': <?php echo $settings['slideClass']; ?>, <?php } ?>
		<?php if($settings['baseClass'] != '') { ?>'baseClass': <?php echo $settings['baseClass']; ?>, <?php } ?>
	});

});

</script>

<?php
echo "<!-- END fancyBox 3 for Wordpress -->\n\n";
}
add_action( 'wp_head', 'fb3fw_init' );
