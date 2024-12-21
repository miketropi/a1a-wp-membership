<?php
/**
 * Admin
 */

add_filter( 'manage_a1a-course_posts_columns', 'a1am_admin_custom_course_posts_columns', 0 );
function a1am_admin_custom_course_posts_columns($columns) {
  $date = $columns['date'];
  unset($columns['date']);
  $columns['caurse_tax'] = __( 'Category', 'a1am' );
  $columns['date'] = $date;
  return $columns;
}

add_action( 'manage_a1a-course_posts_custom_column' , 'a1am_admin_custom_course_column', 10, 2 );
function a1am_admin_custom_course_column( $column, $post_id ) {
  switch ( $column ) {

    case 'caurse_tax' :
      echo get_the_term_list( $post_id , 'course-tax' ); 
      break;

  }
}