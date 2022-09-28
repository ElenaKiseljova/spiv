

<script src="https://unpkg.com/vue@3.2.33/dist/vue.global.prod.js"></script>
<script src="https://www.youtube.com/iframe_api"></script>

<?php if ( is_front_page(  ) && !is_home(  ) ) : ?>
  <?php 
    $front_page_id = get_option( 'page_on_front' );

    $main = get_field( 'main', $front_page_id ) ?? null;

    if ( !isset($main) || is_wp_error( $main ) ) {
      return;
    }

    $mobile_bg = $main['mobile_bg'] ?? '';
    $desktop_bg = $main['desktop_bg'] ?? '';

    $mobile_bg_type = $mobile_bg['type'] ?? '';
    $desktop_bg_type = $desktop_bg['type'] ?? '';
  ?>

  <?php if (($mobile_bg_type === 'video' && !empty($mobile_bg_type)) || ($desktop_bg_type === 'video' && !empty($desktop_bg_type))) : ?>
    <script>
      const deviceWidth = window.innerWidth && document.documentElement.clientWidth ?
                        Math.min(window.innerWidth, document.documentElement.clientWidth) :
                        window.innerWidth ||
                        document.documentElement.clientWidth ||
                        document.getElementsByTagName('body')[0].clientWidth;

      const app = Vue.createApp({});

      app.component('video-autoplay', {
        template: `
        <video loop autoplay playsinline :poster="videoPoster" muted>
          <source :src="videoSrc" :type="videoType">
        </video>
        `,
        props: ['videoSrc', 'posterMobile', 'posterMobile2x', 'posterDesktop', 'posterDesktop2x'],
        data() {
          return {
            videoType: 'video/mp4',
          };
        },
        computed: {
          videoPoster() {
            // console.log(this.videoSrc, this.posterMobile, this.posterMobile2x, this.posterDesktop, this.posterDesktop2x);
            if (deviceWidth < 600) {
              if (window.devicePixelRatio > 1) {
                return this.posterMobile2x;
              }              
            } else {
              if (window.devicePixelRatio > 1) {
                return this.posterDesktop2x;
              }

              return this.posterDesktop;
            }

            return this.posterMobile;
          },
        }
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
          // console.log("onYouTubeIframeAPIReady");

          this.youTubeIframeAPIReady = 1;            
        };
      },
    });

    app.component('video-autoplay', {
      template: `
        <div class="project__video">
          <video v-if="videoSource === 'html'" autoplay playsinline controls :muted="videoMute" :loop="videoLoop">
            <source :src="videoSrc" :type="videoType">
          </video>

          <div v-else-if="videoSource === 'vimeo'" class="project__vimeo">
            <iframe :src="videoSrc" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
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
      props: ['videoSource', 'videoSrc', 'videoId', 'videoLoop', 'videoMute'],
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
          // console.log("initYoutube");

          const _ = this;

          let attr = {
            videoId: this.videoId,
            playerVars: { 
              'autoplay': 1, 
              'playsinline': 1, 
              'mute': this.videoMute,
              'loop': this.videoLoop,
              'playlist': this.videoId,
            },            
            events: {
              onReady: _.onPlayerReady,
              onStateChange: _.onPlayerStateChange
            }
          };

          this.player = new YT.Player(this.containerId, attr);    
        },
        onPlayerReady(evt) {
          // console.log("Player ready");
          evt.target.playVideo();
        },
        onPlayerStateChange(evt) {
          // console.log("Player state changed", evt);
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