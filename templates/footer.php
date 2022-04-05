<?php 
  global $is_contact_page;
  $is_contact_page = false;

  $footer_top = get_field( 'footer_top', 'options' );    
?>
<footer class="footer <?= ( is_front_page(  ) && !is_home(  ) ) ? 'footer--mod' : ''; ?>">
  <?php if ( $footer_top && !is_wp_error( $footer_top ) && !empty($footer_top['title']) && !empty($footer_top['button']['title']) ) : ?>
    <div class="container connection__container">
      <div class="connection__wrapper">
        <h2 class="connection__title">
          <?= $footer_top['title']; ?>
        </h2>
        <a href="<?= $footer_top['button']['link']; ?>" class="connection__link">
          <?= $footer_top['button']['title']; ?>
        </a>
      </div>
    </div>
  <?php endif; ?>

  <div class="container footer__container">
    <div class="footer__wrapper">
        <a class="footer__logo logo" href="<?= get_bloginfo( 'url' ); ?>">
          <?php
            get_template_part( 'templates/logo' );
          ?>
        </a>

        <?php
          get_template_part( 'templates/menu', 'contact' );
        ?>            
    </div>

    <?php
      get_template_part( 'templates/menu', 'footer' );
    ?>  
  </div>
</footer>