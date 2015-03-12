<?php
/*
Plugin Name: WP Admin Theme Enhanced
Plugin URI: 
Description: WP Admin Theme Enhanced - Upload and Activate.  This is a very basic admin theme which adds an admin css file and a custom footer.
Author: Lou King (was David Smith)
Version: 1.0
Author URI: http://www.lousbrews.info
*/

/**
 * Add admin menu
 * @return
 */
function add_menu() {
	add_option('wp_admin_theme_enh_footer');
	add_options_page('WP Admin Theme Enhanced', 'WP Admin Theme Enhanced', 'manage_options', 'wp-admin-theme-enh', 'wp_admin_theme_enh_options');
}

/**
 * Sanitize options
 * @return
 */
function wp_admin_theme_enh_options_validate($input) {
	return $input;
}

/**
 * Include options page
 * @return
 */
function wp_admin_theme_enh_options() {
	include 'wp-admin-theme-enh-options.php';
}

/**
 * Add CSS file link
 */
function wb_admin_css() {
	$url = plugins_url('/wp-admin.css', __FILE__);
    echo '
    <link rel="stylesheet" type="text/css" href="' . $url . '" />
    ';
}

/**
 * Add custom footer
 */
function wp_admin_theme_enh_footer($content) {
	$content = stripslashes(get_option('wp_admin_theme_enh_footer'));
	return $content;
}


add_action('admin_menu', 'add_menu');
//Priority is set to 1000 to make sure CSS is added after all others so you can override other css files used by other plugins etc.
add_action('admin_head','wb_admin_css', 1000);
add_filter('admin_footer_text', 'wp_admin_theme_enh_footer');

?>
