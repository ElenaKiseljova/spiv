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

    add_theme_support( 'custom-logo' );
    
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
    add_image_size( 'member', 427, 260, false);
  }
endif;

// Init
add_action( 'init', 'medvoice_init_function' );
  
if (!function_exists('medvoice_init_function')) :
  function medvoice_init_function () 
  {
    /* ==============================================
    ********  //ACF опциональные страницы
    =============================================== */
    function medvoice_create_acf_pages() {
      if(function_exists('acf_add_options_page')) {
        acf_add_options_page(array(
          'page_title' 	=> 'Настройки для темы Spiv',
          'menu_title'	=> 'Настройки для темы Spiv',
          'menu_slug' 	=> 'medvoice-settings',
          'capability'	=> 'edit_posts',
          'icon_url' => 'dashicons-admin-settings',
          'position' => 23,
          'redirect'		=> false,
        ));
      }    
    }

    medvoice_create_acf_pages();
  }  
endif;
?>