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
  global $wp_query;
  $dashboard_page = get_field('a1a_dashboard_page', 'option');

  if(is_page( $dashboard_page->post_name )) {

    if(!is_user_logged_in()) {
      return A1AM_DIR . '/templates/login-page.php';
    }
    
    $routes_base = (isset($wp_query->query_vars['__page']) ? explode('/', $wp_query->query_vars['__page']) : ['dashboard']);
    set_query_var( 'routes_base', $routes_base );
    $page_template = A1AM_DIR . '/templates/membership-page-template.php';
  }
  return $page_template;
}

add_action( 'a1am:dashboard__nav', 'a1am_dashboard_logo_template', 8 );
add_action( 'a1am:dashboard__nav', 'a1am_nav_main_menu_template', 10 );
add_action( 'a1am:dashboard__nav', 'a1am_nav_courses_menu_template', 15 );

// add_action( 'a1am:dashboard__entry', function() {
//   print_r(get_query_var( 'routes_base' ));
// } );

add_action( 'a1am:dashboard__entry', 'a1am_dashboard_entry_template' );