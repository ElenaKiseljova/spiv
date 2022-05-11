

<script src="https://unpkg.com/vue@3.2.33/dist/vue.global.prod.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>

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
      data() {
        return {
          youTubeIframeAPIReady: 0,
          componentIndex: 0,
        };
      },
      provide() {
        return {
          youTubeIframeAPIReady: () => this.youTubeIframeAPIReady,
          componentIndex: () => this.getComponentIndex,
        };        
      },
      methods: {
        getComponentIndex() {
          this.componentIndex++;

          return this.componentIndex;
        }
      },
      mounted() {
        window.onYouTubeIframeAPIReady = () => {
          console.log("onYouTubeIframeAPIReady");

          this.youTubeIframeAPIReady = 1;            
        };
      },
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

          <div v-else-if="videoSource === 'youtube'" class="project__youtube" ref="youtubePlaerContaiber">
            <!--<iframe                 
                :src="videoSrc"
                title="YouTube video player"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen
              ></iframe>-->

              <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
              <div :id="containerId"></div>
            </div>
        </div>
      `,
      props: ['videoSource', 'videoSrc', 'videoId'],
      inject: ['youTubeIframeAPIReady', 'componentIndex'],
      data() {
        return {
          player: null,
          videoType: 'video/mp4',
          containerId: 'player',
        };
      },
      methods: {
        initYoutube() {
          console.log("initYoutube");

          const _ = this;

          this.player = new YT.Player(this.containerId, {
            videoId: this.videoId,
            playerVars: { 'autoplay': 1, 'playsinline': 1, 'mute': 1 },            
            events: {
              onReady: _.onPlayerReady,
              onStateChange: _.onPlayerStateChange
            }
          });    
        },
        onPlayerReady(evt) {
          console.log("Player ready");
          evt.target.playVideo();
        },
        onPlayerStateChange(evt) {
          console.log("Player state changed", evt);
        }      
      },
      computed: {
        getStatusYouTubeIframeAPIReady() {
          return this.youTubeIframeAPIReady();
        },
        getComponentIndex() {
          return this.componentIndex(); 
        }        
      },
      watch: {
        getStatusYouTubeIframeAPIReady() {
          if (this.getStatusYouTubeIframeAPIReady === 1 && this.videoSource === 'youtube') {
            this.initYoutube();
          }          
        },        
      },
      mounted() {
        this.containerId = 'player-' + this.getComponentIndex();
      },
    });

    app.mount('#app');    
  </script>
<?php endif; ?>