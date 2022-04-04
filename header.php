<!DOCTYPE html>
<html lang="en">
  <head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <?php 
    wp_head(  );
  ?>
</head>



<body>
  <header class="header ">
    <div class="container header__container">
      <div class="header__logo logo">
        <?php
          if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
          }
        ?>
      </div>
      
      <?php
        get_template_part( 'templates/menu', 'header' );
      ?>  

      <button class="burger">
        <span class="visually-hidden">Open/close menu</span>
        <span class="burger__line"></span>
      </button>
    </div>
  </header>