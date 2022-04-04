<?php 
  /**
   * Template Name: Contact
   */
?>

<?php 
  get_header(  );
?>

<?php 
  global $is_contact_page;
  $is_contact_page = true;
?>

<main class="main">
  <section class="section contact js-main">
    <div class="container">
      <div class="contact__wrapper">
        <h1 class="contact__title"><?= get_the_title(  ); ?></h1>

        <div class="contact__form">
          <?= do_shortcode( '[contact-form-7 id="71" title="Контактная форма"]' ); ?>
        </div>
        
        <div class="contact__wrap">
          <?php
            get_template_part( 'templates/menu', 'contact' );
          
            get_template_part( 'templates/menu', 'social' );
          ?> 
        </div>
      </div>
    </div>
  </section>
</main>

<?php 
  get_footer(  );
?>