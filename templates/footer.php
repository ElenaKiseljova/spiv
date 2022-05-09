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

<?php 
  $front_page_id = get_option( 'page_on_front' );

  $main = get_field( 'main', $front_page_id ) ?? null;

  if ( !isset($main) || is_wp_error( $main ) ) {
    return;
  }

  $main_type = $main['type'] ?? '';
  $main_video = $main['video'] ?? '';
  $main_image = $main['image'] ?? '';
?>
<?php if ( is_front_page(  ) && !is_home(  ) && $main_type === 'video' && !empty($main_video) ) : ?>
  <script src="https://unpkg.com/vue@3.2.33/dist/vue.global.prod.js"></script>
  <script>
    const deviceWidth = window.innerWidth && document.documentElement.clientWidth ?
                      Math.min(window.innerWidth, document.documentElement.clientWidth) :
                      window.innerWidth ||
                      document.documentElement.clientWidth ||
                      document.getElementsByTagName('body')[0].clientWidth;

    let src = '<?= $main_image['sizes']['main_mobile'] ?? ''; ?>';

    if (window.devicePixelRatio > 1) {
      src = '<?= $main_image['sizes']['main_mobile_2x'] ?? ''; ?>';
    }

    if (deviceWidth >= 600) {
      src = '<?= $main_image['sizes']['main_desktop'] ?? ''; ?>';

      if (window.devicePixelRatio > 1) {
        src = '<?= $main_image['sizes']['main_desktop_2x'] ?? ''; ?>';
      }
    }

    const app = Vue.createApp({
      data() {
        return {

        }
      }
    });

    app.component('video-autoplay', {
      template: `
      <video v-if="isVideo" loop autoplay playsinline :poster="videoPoster" muted>
        <source :src="videoSrc" :type="videoType">
      </video>
      `,
      data() {
        return {
          isVideo: true,
          videoSrc: '<?= $main_video; ?>',
          videoType: 'video/mp4',
          videoPoster: src
        };
      },
    });

    app.mount('#app');
  </script>
<?php endif; ?>