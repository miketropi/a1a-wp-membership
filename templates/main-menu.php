<?php 
/**
 * Main menu template 
 */

list($page) = get_query_var( 'routes_base' );
?>
<div class="a1am-dashboard-block-nav">
  <h4 class="heading-text"><?php _e('Main menu', 'a1a') ?></h4>
  <ul class="a1am-menu menu-main">
    <?php foreach($main_menu as $key => $item) : 
    
      if(isset($item['nav_item_display']) && $item['nav_item_display'] === false) {
        continue;
      } 
      $li_classes = ['a1am-menu__item', 'menu-' . $key, ($key == $page ? 'menu-item-active' : '')];  
    ?>
    <li class="<?php echo implode(' ', $li_classes); ?>">
      <a class="a1am-menu__link" href="<?php echo $item['url']; ?>">
        <span class="__icon"><?php echo $item['icon']; ?></span>
        <span class="__text"><?php echo $item['name']; ?></span>
      </a>
    </li>
    <?php endforeach; ?>
  </ul>
</div>