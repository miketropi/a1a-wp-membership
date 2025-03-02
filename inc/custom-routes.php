<?php 
/**
 * Custom routes
 */

add_action( 'init', 'a1am_custom_rewrite_rule', 10, 0 );

function a1am_custom_rewrite_rule() { 
  $dashboard_page = get_field('a1a_dashboard_page', 'option');
  if(!$dashboard_page) return; 

  $dashboard_root = $dashboard_page->post_name;

  add_rewrite_rule(
    '^' . $dashboard_root . '/(.+)/?$', 
    'index.php?pagename='. $dashboard_root .'&__page=$matches[1]',
    'top' );
}

add_filter( 'query_vars', function( $vars ) {
	$vars[] = '__page';
  return $vars;
});
