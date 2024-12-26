<?php 
/**
 * Helper functions 
 */

function a1am_icon($name) {
  $icons = require( __DIR__ . '/icons.php' );
  return $icons[$name];
}

function a1am_membership_dashboard() {
  (is_user_logged_in() 
    ? a1am_membership_dashboard_template() 
    : a1am_login_form_template());
}

function a1am_user_register_send_verification_email($user_id) {
  $verify_code = get_field('a1a_user_verify_code', 'user_' . $user_id);
  $verify_url = get_site_url() . '?__userverifycode=' . $user_id . '-' . $verify_code;
  $wp_user_object = new WP_User($user_id);
  $user_email = $wp_user_object->user_email;
  $fullname = $wp_user_object->first_name . ' ' . $wp_user_object->last_name;
  $headers = ['Content-Type: text/html; charset=UTF-8'];
  $email_user_verify_temp = get_field('a1a_user_verify_email_content', 'option');

  $replace_map = [
    '{user_fullname}' => $fullname,
    '{user_verify_link}' => '<a href="'. $verify_url .'">'. $verify_url .'</a>',
  ];

  $body = str_replace(
    array_keys($replace_map), 
    array_values($replace_map), 
    $email_user_verify_temp
  ); 

  wp_mail( 
    $user_email, 
    __('Verify Account - ' . get_bloginfo( 'name' ), 'a1a'), 
    $body, 
    $headers );
}

function a1am_verify_account($user_id, $verify_code) {
  $code = get_field( 'a1a_user_verify_code', 'user_' . $user_id );
  $status = get_field( 'verify_status', 'user_' . $user_id );

  if($status == true) {
    return true;
  }

  if($code != $verify_code) {
    return false;
  } else {
    update_field( 'verify_status', true, 'user_' . $user_id );
    return true;
  }
}

function a1am_nav_main_menu() {
  return apply_filters( 'a1am:main_menu_hook', [
    'dashboard' => [
      'name' => 'Dashboard',
      'url' => '',
      'icon' => a1am_icon('home'),
    ],
    'membership_package' => [
      'name' => 'Gói thành viên',
      'url' => '',
      'icon' => a1am_icon('member_packages'),
    ],
    'notification' => [
      'name' => 'Thông báo',
      'url' => '',
      'icon' => a1am_icon('noti'),
    ],
    'support' =>[
      'name' => 'Hỗ trợ',
      'url' => '',
      'icon' => a1am_icon('help'),
    ],
  ] );
}