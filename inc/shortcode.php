<?php 
/**
 * Shortcode
 */

add_shortcode( 'a1a_membership', 'a1am_shortcode_membership_func' );

function a1am_shortcode_membership_func( $atts ) {
  $atts = shortcode_atts( [
    'custom_class' => ''
  ], $atts );

  ob_start();
  ?>
  <div class="a1a-membership a1a-membership-shortcode a1a-membership-container">
    <?php a1am_membership_dashboard(); ?>
  </div>
  <?php
  return ob_get_clean();
}