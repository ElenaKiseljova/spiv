<li class="work__item">
  <a href="<?php the_permalink(); ?>" class="work__link">
    <div class="work__wrap">
      <?php if ( has_post_thumbnail(  ) ) : ?>
        <?php 
          $project_mobile = get_the_post_thumbnail_url( get_the_ID(  ), 'project_mobile' ) ?? '';
          $project_mobile_2x = get_the_post_thumbnail_url( get_the_ID(  ), 'project_mobile_2x' ) ?? '';

          $project_desktop = get_the_post_thumbnail_url( get_the_ID(  ), 'project_desktop' ) ?? '';
          $project_desktop_2x = get_the_post_thumbnail_url( get_the_ID(  ), 'project_desktop_2x' ) ?? '';
        ?>
        <picture class="picture">                      
          <source
                  media="(min-width: 600px)"
                  srcset="<?= $project_desktop; ?>, <?= $project_desktop_2x; ?> 1.25x"
          />
          <img class="work__img" src="<?= $project_mobile; ?>" srcset="<?= $project_mobile_2x; ?> 1.25x" alt="<?= strip_tags( get_the_title(  ) ); ?>">
        </picture>
      <?php endif; ?>   
      
      <p class="work__category work__category--desktop">
        <?= get_the_excerpt(); ?>
      </p>
    </div>
    <h3 class="work__item-title">
      <?php the_title(); ?>
    </h3>  

    <p class="work__category work__category--mobile">
      <?= get_the_excerpt(); ?>
    </p>
  </a>
</li>