<?php if ( function_exists( 'pll_the_languages' ) ) : ?>
  <?php 
    $langaages = pll_the_languages(array('raw'=>1, 'hide_current' => 1));   
  ?>
  <ul class="lang">
    <?php foreach ($langaages as $key => $langaage) : ?>
      <li class="lang__item">
        <a class="lang__link" data-text="<?= strtoupper(($langaage['slug'] === 'uk') ? 'ua' : $langaage['slug']) ; ?>" href="<?= $langaage['url']; ?>">
          <?= strtoupper(($langaage['slug'] === 'uk') ? 'ua' : $langaage['slug']) ; ?>
        </a>
      </li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>   