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
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" href="index.html" aria-current="page">
                Главная
              </a>
            </li>
            <li class="nav-item dropdown">
              <button class="nav-link dropdown-toggle" type="button" id="navbarWelcome" data-bs-toggle="dropdown"
                aria-expanded="false">
                О нас
              </button>
              <ul class="dropdown-menu" aria-labelledby="navbarWelcome">
                <li>
                  <a class="dropdown-item" href="about.html"> О компании </a>
                </li>
                <li>
                  <a class="dropdown-item" href="about.html#team">
                    Наша команда
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="service.html">Услуги</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pricing.html">Цены</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="blog.html">Журнал</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="contact.html">Контакты</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--HEADER AREA END -->
  </header>