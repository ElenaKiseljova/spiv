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

        <form action="#" class="form">
            <div class="form__wrap">
                <label for="name"></label>
                <input type="text" id="name" class="form__input" placeholder="name" autocomplete="off">
            </div>

            <div class="form__wrap">
                <label for="email"></label>
                <input type="email" id="email" class="form__input" placeholder="email" autocomplete="off">
            </div>

            <div class="form__wrap">
                <label for="phone"></label>
                <input type="tel" id="phone" class="form__input" placeholder="phone" autocomplete="off">
            </div>

            <div class="form__wrap">
                <textarea class="form__textarea" name="textarea" id="textarea" autocomplete="off"
                          placeholder="comment"></textarea>
            </div>

            <button class="btn btn__send">Send</button>
        </form>

        <div class="contact__wrap">
            <!-- <address class="address address--contact">
                <ul class="address__list">
                    <li class="address__item"><a class="address__link" href="mailto:contact@spiv.com">contact@spiv.com</a>
                    </li>
                    <li class="address__item"><a class="address__link" href="tel:+38 097 999 99 99">+38 097 999 99
                        99</a>
                    </li>
                </ul>
            </address> -->

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