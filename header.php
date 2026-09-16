<!doctype html>
<html lang="ru">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />

  <meta name="description"
    content="Band Digital — digital-агентство полного цикла: разработка сайтов, SEO, дизайн и интернет-маркетинг." />

  <link rel="icon" href="favicon.ico" sizes="any" />
  <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png" />
  <link rel="manifest" href="site.webmanifest" />

  <meta name="theme-color" content="#635cdb" />

  <?php wp_head(); ?>

</head>

<body>
  <a class="visually-hidden-focusable skip-link" href="#main-content">
    Перейти к основному содержимому
  </a>
  <header>

    <nav class="navbar navbar-expand-lg fixed-top trans-navigation" aria-label="Основная навигация">
      <div class="container">
        <?php
        if (has_custom_logo()) {
          echo get_custom_logo();
        }
        ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
          aria-controls="mainNav" aria-expanded="false" aria-label="Открыть меню">
          <span class="navbar-toggler-icon">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon--list" viewBox="0 0 16 16" aria-hidden="true"
              focusable="false">
              <path fill-rule="evenodd"
                d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
            </svg>
          </span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNav">
          <?php
          wp_nav_menu([
            'theme_location' => 'header',
            'container' => false,
            'menu_class' => 'navbar-nav',
            'menu_id' => false,
            'echo' => true,
            'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
            'fallback_cb' => false,
            'depth' => 2
          ]); ?>
        </div>
      </div>
    </nav>
    <!--HEADER AREA END -->
  </header>