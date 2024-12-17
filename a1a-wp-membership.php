<?php
/**
 * Plugin Name:       A1a Wp Membership
 * Description:       Membership.
 * Requires at least: 6.6
 * Requires PHP:      7.2
 * Version:           0.1.0
 * Author:            Mike
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       a1a-wp-membership
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

{
	/**
	 * define
	 */
	define('A1AM_VERSION', '0.1.0');
	define('A1AM_URL', plugin_dir_url( __FILE__ ));
	define('A1AM_DIR', plugin_dir_path( __FILE__ ));
}

/**
 * Inc 
 */
require_once(A1AM_DIR . '/inc/admin.php');
require_once(A1AM_DIR . '/inc/shortcode.php');
require_once(A1AM_DIR . '/inc/helpers.php');
require_once(A1AM_DIR . '/inc/hooks.php');
require_once(A1AM_DIR . '/inc/ajax.php');
require_once(A1AM_DIR . '/inc/static.php');
require_once(A1AM_DIR . '/inc/template-tags.php');