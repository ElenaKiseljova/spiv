<?php
  global $is_contact_page;

  $menu_name = 'contact';
  $locations = get_nav_menu_locations();
  
  if( $locations && isset( $locations[ $menu_name ] ) ){
  
    // получаем элементы меню
    $menu_items = wp_get_nav_menu_items( $locations[ $menu_name ] );
  }
?>

<?php if (isset($menu_items) && !empty($menu_items) && !is_wp_error( $menu_items )) : ?>  
  <address class="address <?= $is_contact_page ? 'address--contact' : ''; ?>">
    <ul class="address__list">
      <?php foreach ( (array) $menu_items as $key => $menu_item ) : ?>      
        <li class="address__item">
          <a class="address__link" href="<?= $menu_item->url; ?>"><?= $menu_item->title; ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
  </address>  
<?php endif; ?>