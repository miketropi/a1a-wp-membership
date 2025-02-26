<?php 
@list($page, $post_slug) = get_query_var( 'routes_base' );
if(!$post_slug) return;


$the_query = new WP_Query( [
  'post_type' => 'a1a-course',
  'post_status' => 'publish',
  'name' => $post_slug,
] );
?>

<div class="course-entry">
  <?php while($the_query->have_posts()) : $the_query->the_post(); 
    
    ob_start();
    ?>
    <div class="course-heading">
      <h2><?php the_title(); ?></h2>
      <div class="course-meta">
        <div class="course-auhor">
          author: <?php echo get_the_author(); ?>
        </div>
      </div>
    </div>
    <div class="course-content"><?php the_content(); ?></div>
    <?php
    $__content = ob_get_clean();

    $require_premium_role = get_field('require_premium_role', get_the_ID());
    $passed_roles = a1am_user_has_role(['a1a_membership']);

    if($require_premium_role == true) {
      if($passed_roles == true) {
        echo $__content;
      } else {
        a1am_upgrade_user_package_template('Bạn không được phép truy cập khóa học này, ');
      }
    } else {
      echo $__content;
    }
  ?>
    
  <?php endwhile; wp_reset_postdata(); // reset the query ?>
</div>