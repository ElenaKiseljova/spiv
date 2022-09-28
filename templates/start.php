<?php 
 $main = get_field( 'main' ) ?? null;

 if ( !isset($main) || is_wp_error( $main ) ) {
   return;
 }

 $main_title = $main['title']; 

 $mobile_bg = $main['mobile_bg'];
 $desktop_bg = $main['desktop_bg'];

 $mobile_bg_type = $mobile_bg['type'] ?? '';
 $mobile_bg_video = $mobile_bg['video'] ?? '';
 $mobile_bg_image = $mobile_bg['image'] ?? [];

 $desktop_bg_type = $desktop_bg['type'] ?? '';
 $desktop_bg_video = $desktop_bg['video'] ?? '';
 $desktop_bg_image = $desktop_bg['image'] ?? [];
?>

<section class="section start js-main" id="app">
  <div class="start__bg start__bg--mobile">
    <?php if ( $mobile_bg_type === 'video' ) : ?>
      <video-autoplay 
        video-src="<?= $mobile_bg_video ?? ''; ?>" 
        poster-mobile="<?= $mobile_bg_image['sizes']['main_mobile'] ?? ''; ?>" 
        poster-mobile2x="<?= $mobile_bg_image['sizes']['main_mobile_2x'] ?? ''; ?>" 
        poster-desktop="<?= $mobile_bg_image['sizes']['main_desktop'] ?? ''; ?>" 
        poster-desktop2x="<?= $mobile_bg_image['sizes']['main_desktop_2x'] ?? ''; ?>"
        ></video-autoplay>
    <?php else : ?>
      <picture class="picture">
        <source
                media="(min-width: 600px)"
                srcset="<?= $mobile_bg_image['sizes']['main_desktop'] ?? ''; ?>, <?= $mobile_bg_image['sizes']['main_desktop_2x'] ?? ''; ?> 1.25x"
        />
        <img src="<?= $mobile_bg_image['sizes']['main_mobile'] ?? ''; ?>" srcset="<?= $mobile_bg_image['sizes']['main_mobile_2x'] ?? ''; ?> 1.25x" alt="<?= get_bloginfo( 'name' ); ?>">
      </picture>
    <?php endif; ?>
  </div>
  <div class="start__bg start__bg--desktop">
    <?php if ( $desktop_bg_type === 'video' ) : ?>
      <video-autoplay 
        video-src="<?= $desktop_bg_video ?? ''; ?>" 
        poster-mobile="<?= $desktop_bg_image['sizes']['main_mobile'] ?? ''; ?>" 
        poster-mobile2x="<?= $desktop_bg_image['sizes']['main_mobile_2x'] ?? ''; ?>" 
        poster-desktop="<?= $desktop_bg_image['sizes']['main_desktop'] ?? ''; ?>" 
        poster-desktop2x="<?= $desktop_bg_image['sizes']['main_desktop_2x'] ?? ''; ?>"
        ></video-autoplay>
    <?php else : ?>
      <picture class="picture">
        <source
                media="(min-width: 600px)"
                srcset="<?= $desktop_bg_image['sizes']['main_desktop'] ?? ''; ?>, <?= $desktop_bg_image['sizes']['main_desktop_2x'] ?? ''; ?> 1.25x"
        />
        <img src="<?= $desktop_bg_image['sizes']['main_mobile'] ?? ''; ?>" srcset="<?= $desktop_bg_image['sizes']['main_mobile_2x'] ?? ''; ?> 1.25x" alt="<?= get_bloginfo( 'name' ); ?>">
      </picture>
    <?php endif; ?>
  </div>
  <div class="start__container container">
    <h1 class="start__title">
      <?= $main_title; ?>
    </h1>
  </div>
</section>