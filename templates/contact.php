<?php
/**
 * Template Name: Страница «Контакты»
 * Template Post Type: page
 */

get_header();
?>

<main id="main-content">
  <!--MAIN BANNER AREA START -->
  <div class="page-banner-area page-contact" id="page-banner">
    <div class="overlay dark-overlay"></div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
          <div class="banner-content content-padding">
            <h1 class="text-white">
              Давайте обсудим работу над&nbsp;вашим проектом
            </h1>
            <p>Напишите нам и вам ответит проектный менеджер</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--MAIN HEADER AREA END -->
  <!--  Contact START  -->
  <section id="contact" class="section-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-12">
          <div class="mb-5">
            <h2 class="mb-2">Напишите нам</h2>
            <p>
              Обычно, мы видим заявку сразу, а перезваниваем или пишем в ответ
              в течение часа. Иногда ответ может занять до одного дня.
            </p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-7 col-sm-12">
          <form class="contact__form" method="post">
            <!-- form message -->
            <div class="row">
              <div class="col-12">
                <div class="alert alert-info contact__msg" role="status" aria-live="polite" aria-atomic="true">
                  Отправка формы пока недоступна. Свяжитесь с нами по
                  телефону или email.
                </div>
              </div>
            </div>
            <!-- end message -->
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="contact-name" class="form-label">Имя</label>
                <input id="contact-name" name="name" type="text" class="form-control" autocomplete="name" required />
              </div>
              <div class="col-md-6 mb-3">
                <label for="contact-email" class="form-label">Email</label>
                <input id="contact-email" name="email" type="email" class="form-control" autocomplete="email"
                  required />
              </div>
              <div class="col-md-12 mb-3">
                <label for="contact-phone" class="form-label">Телефон</label>
                <input id="contact-phone" name="phone" type="tel" class="form-control" autocomplete="tel" required />
              </div>
              <div class="col-12 mb-3">
                <label for="contact-message" class="form-label">Сообщение</label>
                <textarea id="contact-message" name="message" class="form-control" rows="6" required></textarea>
              </div>
              <div class="col-12 mt-4">
                <button type="submit" class="btn btn-hero btn-circled">
                  Отправить
                </button>
              </div>
            </div>
          </form>
        </div>

        <section class="contact-details col-lg-5 ps-4 mt-4 mt-lg-0">
          <h2 class="visually-hidden">Контактные данные</h2>
          <h3 class="h4">Адрес офиса</h3>
          <address class="mb-3">Москва, Россия</address>
          <h3 class="h4">Телефон</h3>
          <p class="mb-3">
            <span>+7&nbsp;(000)&nbsp;000&#8209;00&#8209;00</span>
          </p>
          <h3 class="h4">Email</h3>
          <p class="mb-3">
            <a href="#">hello@band-digital.example</a>
          </p>
        </section>
      </div>
    </div>
  </section>
  <!--  CONTACT END  -->
</main>

<?php get_footer(); ?>