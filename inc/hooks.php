<?php 
/**
 * Hooks 
 */

add_action( 'a1am:user_register_hook', 'a1am_user_register_send_verification_email', 20, 1 );

add_action( 'init', function() {
  if(isset($_GET['__userverifycode'])) {
    list($user_id, $code) = explode('-', $_GET['__userverifycode']);
    $pass = a1am_verify_account($user_id, $code);
    if($pass) {
      $dashboard_page = get_field('a1a_dashboard_page', 'option');
      $dashboard_url = get_the_permalink($dashboard_page);
      wp_redirect($dashboard_url . '?__userverifystatus=true');
    } else {
      wp_redirect($dashboard_url . '?__userverifystatus=false');
    }
  }
} );

add_action( 'a1am:login_message', 'a1am_user_verify_message' );

function a1am_user_verify_message() {
  if(!isset($_GET['__userverifystatus'])) return;
  a1am_user_verify_status_template($_GET['__userverifystatus']);
}

add_filter( 'page_template', 'a1am_dashboard_custom_page_template' );

function a1am_dashboard_custom_page_template($page_template) {
  $dashboard_page = get_field('a1a_dashboard_page', 'option');
  if(is_page( $dashboard_page->post_name )) {
    $page_template = A1AM_DIR . '/templates/membership-page-template.php';
  }
  return $page_template;
}

add_action( 'a1am:dashboard__nav', 'a1am_dashboard_logo_template', 10 );
add_action( 'a1am:dashboard__nav', 'a1am_nav_main_menu_template', 10 );