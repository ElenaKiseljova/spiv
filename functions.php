<?php 
// Styles theme
add_action('wp_enqueue_scripts', 'spiv_styles', 3);
function spiv_styles () 
{
  wp_enqueue_style('g-font-style', 'https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap' );

  wp_enqueue_style('spiv-style', get_stylesheet_uri());    
}

// Scripts theme
add_action('wp_enqueue_scripts', 'spiv_scripts', 5);
function spiv_scripts () 
{    
  wp_enqueue_script('main-script', get_template_directory_uri() . '/assets/js/script.min.js', $deps = array(), $ver = null, $in_footer = true );
}

add_action( 'after_setup_theme', 'spiv_after_setup_theme_function' );

if (!function_exists('spiv_after_setup_theme_function')) :
  function spiv_after_setup_theme_function () {
    load_theme_textdomain('spiv', get_template_directory() . '/languages');

    add_theme_support( 'post-thumbnails' );
    
    /* ==============================================
    ********  //Меню
    =============================================== */
    register_nav_menu( 'header', 'Хедер' );
    register_nav_menu( 'footer', 'Футер' );
    register_nav_menu( 'social', 'Социальные сети' );
    register_nav_menu( 'contact', 'Контакты' );

    /* ==============================================
    ********  //Размеры картирок
    =============================================== */
    /* Член команды */
    add_image_size( 'member', 440, 440, false);

    /* Проект */
    add_image_size( 'project_mobile', 280, 220, false);
    add_image_size( 'project_mobile_2x', 560, 440, false);

    add_image_size( 'project_desktop', 660, 400, false);
    add_image_size( 'project_desktop_2x', 1320, 800, false);

    /* Главная - Первый экран */
    add_image_size( 'main_mobile', 320, 450, false);
    add_image_size( 'main_mobile_2x', 640, 900, false);

    add_image_size( 'main_desktop', 1440, 780, false);
    add_image_size( 'main_desktop_2x', 2880, 1560, false);
  }
endif;

// Init
add_action( 'init', 'spiv_init_function' );
  
if (!function_exists('spiv_init_function')) :
  function spiv_init_function () 
  {
    /* ==============================================
    ********  //ACF опциональные страницы
    =============================================== */
    function spiv_create_acf_pages() {
      if(function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
          'page_title' 	=> 'Настройки для темы Spiv',
          'menu_title'	=> 'Настройки для темы Spiv',
          'menu_slug' 	=> 'spiv-settings',
          'capability'	=> 'edit_posts',
          'icon_url' => 'dashicons-admin-settings',
          'position' => 23,
          'redirect'		=> false,
        ));
      }    
    }

    spiv_create_acf_pages();
  }  
endif;

/* ==============================================
********  //Класс форм
=============================================== */
add_filter( 'wpcf7_form_class_attr', 'spiv_filter_cf7_class' );

function spiv_filter_cf7_class( $class ){
  $class .= ' form';

  return $class;
}
?>