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
  <?php while($the_query->have_posts()) : $the_query->the_post(); ?>
    <div class="course-heading">
      <h2><?php the_title(); ?></h2>
      <div class="course-meta">
        <div class="course-auhor">
          author: <?php echo get_the_author(); ?>
        </div>
      </div>
    </div>
    <div class="course-content"><?php the_content(); ?></div>
  <?php endwhile; wp_reset_postdata(); // reset the query ?>
</div>