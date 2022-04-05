<?php 
  /**
   * Template Name: Project
   */
?>

<?php 
  get_header(  );
?>

<?php 
  $members = get_field( 'members' ) ?? [];
?>

<main class="main">
  <section class="section project js-main">
    <div class="container">
      <div class="project__wrapper">
        <?= get_the_content(  ); ?>
      </div>
    </div>
  </section>
</main>

<?php 
  get_footer(  );
?>