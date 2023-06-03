<?php
$terms = [];
$projects_list = [];

$is_blog = is_home() && !is_front_page();

$is_front_page = is_front_page() && !is_home();

if ($is_front_page) {
  $projects = get_field('projects') ?? null;

  if (!isset($projects) || is_wp_error($projects)) {
    return;
  }

  $projects_title = $projects['title'] ?? '';

  $projects_list = $projects['list'] ?? [];
  $projects_link = $projects['link'] ?? '';
} else if ($is_blog) {
  $terms = get_terms('category');

  if (!isset($terms) || !is_array($terms) || empty($terms) || is_wp_error($terms)) {
    return;
  }
}
?>

<section class="section work <?= $is_blog ? 'js-main work--mod' : ''; ?>">
  <div class="container">
    <?php if ($is_front_page) : ?>
      <h2 class="work__title"><?= $projects_title; ?></h2>
    <?php elseif ($is_blog) : ?>
      <div class="tabs__list">
        <?php foreach ($terms as $key => $term) : ?>
          <?php
          if (!is_a($term, 'WP_Term')) {
            continue;
          }
          ?>
          <button class="tabs__item <?= $key === 0 ? 'active' : '' ?>"><?= $term->name; ?></button>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ($is_front_page) : ?>
      <?php if ($projects_list && !empty($projects_list) && !is_wp_error($projects_list)) : ?>
        <ul class="work__list">
          <?php foreach ($projects_list as $key => $post) : ?>
            <?php
            setup_postdata($post);

            get_template_part('templates/work', 'item');
            ?>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    <?php elseif ($is_blog) : ?>
      <div class="work__wrapper">
        <?php foreach ($terms as $key => $term) : ?>
          <?php
          if (!is_a($term, 'WP_Term')) {
            continue;
          }

          $args = [
            'category' => $term->term_id,
            'post_type'      => 'post',
            'numberposts' => -1,
            'orderby' => 'menu_order',
          ];

          $posts = get_posts($args);

          if (!isset($posts) || !is_array($posts) || is_wp_error($posts)) {
            return;
          }
          ?>
          <ul class="work__list work__list--mod  <?= $key === 0 ? 'active' : '' ?>">
            <?php foreach ($posts as $key => $post) : ?>
              <?php
              setup_postdata($post);

              get_template_part('templates/work', 'item');
              ?>
            <?php endforeach; ?>
          </ul>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

    <?php if ($is_front_page) : ?>
      <a href="<?= get_post_type_archive_link('post'); ?>" class="work__see"><?= $projects_link; ?></a>
    <?php endif; ?>
  </div>
</section>