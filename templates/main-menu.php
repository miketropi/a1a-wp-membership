<?php 
/**
 * Main menu template 
 */

?>
<ul class="a1am-menu menu-main">
  <?php foreach($main_menu as $key => $item) : ?>
  <li class="a1am-menu__item">
    <a class="a1am-menu__link" href="">
      <span class="__icon"><?php echo $item['icon']; ?></span>
      <span class="__text"><?php echo $item['name']; ?></span>
    </a>
  </li>
  <?php endforeach; ?>
</ul>