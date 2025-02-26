<?php 
@list($page, $term_name) = get_query_var( 'routes_base' );
if(!$term_name) return;

$term = get_term_by('slug', $term_name, 'course-tax');
if(!$term) return;

// print_r($term);
$banner = get_field('banner', 'course-tax_' . $term->term_id); 
$meta_content = get_field('meta_content', 'course-tax_' . $term->term_id);
?>
<div class="term-heading">
  <div class="banner-layer" style="background: url('<?php echo $banner ?>') no-repeat center center / cover, #333"></div>
  <div class="heading-entry">
    <h2 class="term-title"><?php echo $term->name; ?></h2>
    <?php echo wpautop(term_description($term)) ?>
  </div>
</div>

<div class="term-content">
  <?php echo $meta_content ?>

  <?php a1am_courses_list_template($term->term_id); ?>
</div>