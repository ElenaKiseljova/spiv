

<script src="https://unpkg.com/vue@3.2.33/dist/vue.global.prod.js"></script>

<?php if ( is_front_page(  ) && !is_home(  ) ) : ?>
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

  <?php if ($main_type === 'video' && !empty($main_video)) : ?>
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
<?php elseif( is_singular( 'post' ) ) : ?>    
  <script>
    const app = Vue.createApp({
    });

    app.component('video-autoplay', {
      template: `
        <div class="project__video">
          <video v-if="videoSource === 'html'" autoplay playsinline controls muted>
            <source :src="videoSrc" :type="videoType">
          </video>

          <div v-else-if="videoSource === 'vimeo'" style="padding:62.5% 0 0 0;position:relative;">
            <iframe :src="videoSrc" style="position:absolute;top:0;left:0;width:100%;height:100%;" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
          </div>

          <div v-else-if="videoSource === 'youtube'" class="project__youtube">
            <iframe                 
                :src="videoSrc"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
              ></iframe>
            </div>
        </div>
      `,
      props: ['videoSource', 'videoSrc'],
      data() {
        return {
          videoType: 'video/mp4',
        };
      },
    });

    app.mount('#app');
  </script>
<?php endif; ?>