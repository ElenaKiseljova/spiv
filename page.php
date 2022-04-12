<?php 
  get_header(  );
?>

<main class="main">
  <section class="section about js-main">
    <div class="container">
        <div class="about__info">
          <?php the_content(); ?>
        </div>
    </div>
  </section>
</main>

<?php 
  get_footer(  );
?>