<?php 
/**
 * Ajax
 */

add_action( 'wp_ajax_a1am_user_login_ajax', 'a1am_user_login_ajax' );
add_action( 'wp_ajax_nopriv_a1am_user_login_ajax', 'a1am_user_login_ajax' );

function a1am_user_login_ajax() {
  $creds = array(
		'user_login'    => $_POST['log'],
		'user_password' => $_POST['pwd'],
		'remember'      => (isset($_POST['rememberme']) ? true : false),
	);
	
  wp_send_json(wp_signon());
}
