<?php 
  /**
   * Template Name: Project
   */
?>

<?php 
  get_header(  );
?>

<main class="main">
  <section class="section project js-main">
    <div class="container">
      <div class="project__wrapper">
        <?php the_content(); ?>
      </div>
    </div>
  </section>
</main>

<?php 
  get_footer(  );
?>