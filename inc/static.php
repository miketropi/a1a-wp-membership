<?php 
/**
 * Static
 */

add_action( 'wp_enqueue_scripts', 'a1am_enqueue_scripts' );

function a1am_enqueue_scripts() {
  wp_enqueue_style( 'a1am-css', A1AM_URL . '/dist/css/a1a-membership.bundle.css', false, A1AM_VERSION );
  wp_enqueue_script( 'a1am-js', A1AM_URL . '/dist/a1a-membership.bundle.js', ['jquery'], A1AM_VERSION, true );

  wp_localize_script( 'a1am-js', 'A1AM_PHP_DATA', [
    'ajax_url' => admin_url('admin-ajax.php'),
    'lang' => [],
  ] );
}