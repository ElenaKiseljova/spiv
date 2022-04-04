<?php 
 $main = get_field( 'main' ) ?? null;

 if ( !isset($main) || is_wp_error( $main ) ) {
   return;
 }

 $main_title = $main['title'];

 $main_type = $main['type'] ?? '';
 $main_video = $main['video'] ?? '';
 $main_image = $main['image'] ?? [];
?>

<section class="section start js-main">
  <div class="start__bg">
    <?php if ( $main_type === 'video' ) : ?>
      <video src="<?= $main_video; ?>" autoplay muted loop></video>
    <?php else : ?>
      <picture class="picture">
        <source
                media="(min-width: 600px)"
                srcset="<?= $main_image['sizes']['main_desktop'] ?? ''; ?>, <?= $main_image['sizes']['main_desktop_2x'] ?? ''; ?> 1.25x"
        />
        <img src="<?= $main_image['sizes']['main_mobile'] ?? ''; ?>" srcset="<?= $main_image['sizes']['main_mobile_2x'] ?? ''; ?> 1.25x" alt="<?= get_bloginfo( 'name' ); ?>">
      </picture>
    <?php endif; ?>
  </div>
  <div class="start__container container">
    <h1 class="start__title">
      <?= $main_title; ?>
    </h1>
  </div>
</section>