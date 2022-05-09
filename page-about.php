<?php 
  /**
   * Template Name: About
   */
?>

<?php 
  get_header(  );
?>

<?php 
  $title = get_field( 'title' ) ?? '';
  $members = get_field( 'members' ) ?? [];
?>

<main class="main">
  <section class="section about js-main">
    <div class="container">
        <div class="about__info">
          <?php the_content(); ?>
        </div>

        <?php if ( $members && !empty($members) && !is_wp_error( $members ) ) : ?>
          <div class="about__content">
            <?php if ( !empty($title) ) : ?>
              <h2 class="about__title">
                <?= $title; ?>
              </h2>
            <?php endif; ?>
            
            <ul class="about__list">
              <?php foreach ($members as $key => $member) : ?>
                <?php 
                  $name = $member['name'] ?? '';  
                  $specialization = $member['specialization'] ?? '';  
                  $image = $member['image'] ? $member['image']['sizes']['member'] : '';  
                ?>
                <li class="about__item">
                  <div class="about__img">
                    <img src="<?= $image; ?>" alt="<?= $name; ?>">
                  </div>              

                  <h3 class="about__name">
                    <?= $name; ?>
                  </h3>
                  <p class="about__prof">
                    <?= $specialization; ?>
                  </p>
                </li>
              <?php endforeach; ?>              
            </ul>
          </div>
        <?php endif; ?>       
    </div>
  </section>
</main>

<?php 
  get_footer(  );
?>