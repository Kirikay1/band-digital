<?php

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