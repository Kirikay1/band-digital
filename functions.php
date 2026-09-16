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

    // регистрируем несколько зон (областей) меню
    register_nav_menus([
      'header' => __('Header Menu', 'band-digital'),
      'footer' => __('Footer Menu', 'band-digital'),
    ]);
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

add_filter('nav_menu_css_class', 'band_digital_menu_css_class', 10, 4);

function band_digital_menu_css_class($classes, $item, $args, $depth)
{
  if ($args->theme_location === 'header' && $depth === 0) {
    $classes[] = 'nav-item';

    if (in_array('menu-item-has-children', $classes, true)) {
      $classes[] = 'dropdown';
    }
  }

  return $classes;
}

add_filter(
  'nav_menu_submenu_css_class',
  'band_digital_nav_menu_submenu_css_class',
  10,
  2
);

function band_digital_nav_menu_submenu_css_class($classes, $args)
{
  if ($args->theme_location === 'header') {
    $classes[] = 'dropdown-menu';
  }

  return $classes;
}

add_filter(
  'nav_menu_link_attributes',
  'band_digital_nav_menu_link_attributes',
  10,
  4
);

function band_digital_nav_menu_link_attributes($atts, $item, $args, $depth)
{
  // Применяем только к меню в шапке
  if ($args->theme_location !== 'header') {
    return $atts;
  }

  if ($depth === 0) {
    $atts['class'] = trim(($atts['class'] ?? '') . ' nav-link');

    // Проверяем, есть ли у пункта вложенное меню
    if (in_array('menu-item-has-children', $item->classes, true)) {
      $atts['class'] .= ' dropdown-toggle';
      $atts['data-bs-toggle'] = 'dropdown';
      $atts['aria-expanded'] = 'false';
    }
  } else {
    $atts['class'] = trim(($atts['class'] ?? '') . ' dropdown-item');
  }

  return $atts;
}