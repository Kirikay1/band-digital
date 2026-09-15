<?php

if (!function_exists('band_digital_setup')) {
  function band_digital_setup()
  {
    // добавляем пользовательский логотип
    add_theme_support('custom-logo', [
      'height' => 60,
      'width' => 180,
      'flex-width' => false,
      'flex-height' => false,
      'header-text' => '',
      'unlink-homepage-logo' => false, // WP 5.5
    ]);
    //добавляем динамический тег тайтл
    add_theme_support('title-tag');
  }

  add_action('after_setup_theme', 'band_digital_setup');
}

/*
Подключение стилей и скриптов
*/

// правильный способ подключить стили и скрипты
add_action('wp_enqueue_scripts', 'band_digital_scripts');

function band_digital_scripts()
{
  wp_enqueue_style('main', get_stylesheet_uri());
  // bootstrap css
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css', ['main'], null);
  // band-digital css
  wp_enqueue_style('band-digital', get_template_directory_uri() . '/css/style.css', ['bootstrap'], null);

  // bootstrap js
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.bundle.min.js', [], '1.0.0', true);
  // band-digital js
  wp_enqueue_script('band-digital', get_template_directory_uri() . '/js/custom.js', ['bootstrap'], '1.0.0', true);
}

/**
 * Регистрируем сразу несколько областей меню
 */
function band_digital_nav_menu($description)
{
  // собираем несколько зон (областей) меню
  $location = array(
    'header' => __('Header Menu', 'band-digital'),
    'footer' => __('Footer Menu', 'band-digital'),
  );
  // регистрируем области меню, которые лежат в переменной $location
  register_nav_menus($location);
}
// хук-событие
add_action('init', 'band_digital_nav_menu');