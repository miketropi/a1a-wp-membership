<?php 
/**
 * Main menu template 
 */

list($page) = get_query_var( 'routes_base' );
?>
<div class="a1am-dashboard-block-nav">
  <h4 class="heading-text"><?php _e('Courses', 'a1a') ?></h4>
  <ul class="a1am-menu menu-courses">
    <?php foreach($courses_menu as $key => $item) : 
      $li_classes = ['a1am-menu__item'];  
    ?>
    <li class="<?php echo implode(' ', $li_classes); ?>">
      <a href="<?php echo $item->custom_url; ?>">
        <span class="__icon"><?php echo a1am_icon('document'); ?></span>
        <span class="__text"><?php echo $item->name ?> <sup>(<?php echo $item->count; ?>)</sup></span>
      </a>
      <ul class="a1am-menu--sub-menu">
        <?php foreach($item->__courses as $__i => $course) : 
          $sub_li_classes = ['a1am-menu__item'];    
        ?> 
        <li class="<?php echo implode(' ', $sub_li_classes); ?>">
          <a href="<?php echo $course->custom_url; ?>">
            <span class="__icon"><?php echo a1am_icon('arrow_child'); ?></span>
            <span class="__text"><?php echo $course->post_title; ?></span>
          </a>
        </li>
        <?php endforeach; ?>
      </ul>
    </li>
    <?php endforeach; ?>
  </ul>
</div>