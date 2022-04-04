<?php
  $menu_name = 'social';
  $locations = get_nav_menu_locations();
  
  if( $locations && isset( $locations[ $menu_name ] ) ){
  
    // получаем элементы меню
    $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );
  }
?>

<?php if (isset($menu_items) && !empty($menu_items) && !is_wp_error( $menu_items )) : ?>  
  <ul class="social">
      <?php foreach ( (array) $menu_items as $key => $menu_item ) : ?>     
        <li class="social__item">
          <a href="<?= $menu_item->url; ?>" class="social__link">
            <span class="visually-hidden"><?= $menu_item->title; ?></span>
            <svg class="social__icon">
              <use xlink:href="<?= get_template_directory_uri(  ); ?>/assets/img/sprite.svg#<?= mb_strtolower($menu_item->title); ?>"></use>
            </svg>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>
<?php endif; ?>