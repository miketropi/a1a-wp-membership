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

add_action( 'wp_ajax_a1am_user_register_ajax', 'a1am_user_register_ajax' );
add_action(  'wp_ajax_nopriv_a1am_user_register_ajax', 'a1am_user_register_ajax' );

function a1am_user_register_ajax() {
	$email = $_POST['email'];
	$pw = $_POST['password'];
	$rpw = $_POST['re-password'];

	if( !username_exists($email) && !email_exists($email) ) {
		
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			wp_send_json( [
				'errors' => [
					'error_message' => __('Email invalid!', 'a1a'),
				]
			] );
		}

		if($pw != $rpw) {
			wp_send_json( [
				'errors' => [
					'error_message' => __('Please re-check your re-password.!', 'a1a'),
				]
			] );
		}

		$user_id = wp_create_user( $email, $pw, $email );
		if ( is_int($user_id) ) {
			$wp_user_object = new WP_User($user_id);
			$wp_user_object->set_role('subscriber');
			$verify_code = wp_generate_password(24);
			
			update_field('a1a_user_verify_code', $verify_code, 'user_' . $user_id );
			wp_update_user([
				'ID' => $user_id, 
				'first_name' => $_POST['firstname'],
				'last_name' => $_POST['lastname'],
				'role' => 'subscriber',
			]);

			do_action( 'a1am:user_register_hook', $user_id );

			wp_send_json( [
				'success' => true,
				'message' => 'Created user successfully.'
			] );
		} else {
			wp_send_json( [
				'errors' => [
					'error_message' => __('Error with wp_insert_user. No users were created.', 'a1a')
				]
			] );
		}
	} else {
		wp_send_json( [
			'errors' => [
				'error_message' => __('This email already exists. Nothing was done.', 'a1a')
			]
		] );
	}
}