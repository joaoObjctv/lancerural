<?php

function theme_enqueue_styles()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('wp-block-library-theme');
    wp_dequeue_style('global-styles');

    $theme      = wp_get_theme(); // Pega o tema atual
    $version    = $theme->get('Version'); // Obtém a versão do cabeçalho do style.css
    
    wp_enqueue_style('general-css', get_template_directory_uri() . '/dist/css/general.css', array(), $version);

    if (is_home() || is_front_page()) {
        wp_enqueue_style('home-css', get_template_directory_uri() . '/dist/css/home.css', array(), $version);
        wp_enqueue_style('news-comp-css', get_template_directory_uri() . '/dist/css/components/news.css', array(), $version);
        wp_enqueue_style('swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css');
    } elseif (get_page_template_slug() == 'page-agenda.php') {
        wp_enqueue_style('schedule-css', get_template_directory_uri() . '/dist/css/agenda.css', array(), $version);
        wp_enqueue_style('auctionSwiper-css', get_template_directory_uri() . '/dist/css/components/auctionSwiper.css', array(), $version);
        wp_enqueue_style('banner-css', get_template_directory_uri() . '/dist/css/components/banner.css', array(), $version);
        wp_enqueue_style('schedule-sing-css', get_template_directory_uri() . '/dist/css/components/auctionSchedule.css', array(), $version);
        wp_enqueue_style('banner-mini-css', get_template_directory_uri() . '/dist/css/components/bannerMini.css', array(), $version);
        wp_enqueue_style('swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css');
    } elseif (get_page_template_slug() == 'page-noticias.php') {
        wp_enqueue_style('swiper-css', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.css');
        wp_enqueue_style('banner-css', get_template_directory_uri() . '/dist/css/components/banner.css', array(), $version);
        wp_enqueue_style('banner-mini-css', get_template_directory_uri() . '/dist/css/components/bannerMini.css', array(), $version);
        wp_enqueue_style('auctionSwiper-css', get_template_directory_uri() . '/dist/css/components/auctionSwiper.css', array(), $version);
        wp_enqueue_style('news-comp-css', get_template_directory_uri() . '/dist/css/components/news.css', array(), $version);
    } elseif (get_page_template_slug() == 'page-quem-somos.php') {
        wp_enqueue_style('banner-mini-css', get_template_directory_uri() . '/dist/css/components/bannerMini.css', array(), $version);
        wp_enqueue_style('banner-css', get_template_directory_uri() . '/dist/css/components/banner.css', array(), $version);
        wp_enqueue_style('about-css', get_template_directory_uri() . '/dist/css/about.css', array(), $version);
    } elseif ( is_singular('leiloes')) {
        wp_enqueue_style('socialShare-css', get_template_directory_uri() . '/dist/css/components/socialShare.css', array(), $version);
        wp_enqueue_style('banner-mini-css', get_template_directory_uri() . '/dist/css/components/bannerMini.css', array(), $version);
        wp_enqueue_style('banner-css', get_template_directory_uri() . '/dist/css/components/banner.css', array(), $version);
        wp_enqueue_style('auctionSwiper-css', get_template_directory_uri() . '/dist/css/components/auctionSwiper.css', array(), $version);
        wp_enqueue_style('schedule-sing-css', get_template_directory_uri() . '/dist/css/components/auctionSchedule.css', array(), $version);
        wp_enqueue_style('leiloes-css', get_template_directory_uri() . '/dist/css/leiloes.css', array(), $version);
    } elseif (is_page_template('page-fale-conosco.php')) {
        wp_enqueue_style('contact-css', get_template_directory_uri() . '/dist/css/contact.css', array(), $version);
        wp_enqueue_style('banner-mini-css', get_template_directory_uri() . '/dist/css/components/bannerMini.css', array(), $version);
        wp_enqueue_style('banner-css', get_template_directory_uri() . '/dist/css/components/banner.css', array(), $version);
    } elseif (is_page_template('page-app.php')) {
        wp_enqueue_style('banner-mini-css', get_template_directory_uri() . '/dist/css/components/bannerMini.css', array(), $version);
        wp_enqueue_style('banner-css', get_template_directory_uri() . '/dist/css/components/banner.css', array(), $version);
    } else if(is_single()) {
        wp_enqueue_style('banner-css', get_template_directory_uri() . '/dist/css/components/banner.css', array(), $version);
        wp_enqueue_style('socialShare-css', get_template_directory_uri() . '/dist/css/components/socialShare.css', array(), $version);
        wp_enqueue_style('banner-mini-css', get_template_directory_uri() . '/dist/css/components/bannerMini.css', array(), $version);
        wp_enqueue_style('news-css', get_template_directory_uri() . '/dist/css/components/news.css', array(), $version);
        wp_enqueue_style('sing-css', get_template_directory_uri() . '/dist/css/components/single.css', array(), $version);
        wp_enqueue_style('schedule-sing-css', get_template_directory_uri() . '/dist/css/components/auctionSchedule.css', array(), $version);
    }
}

function theme_enqueue_scripts()
{

    wp_enqueue_script('general-js', get_template_directory_uri() . '/dist/js/general.min.js', array('jquery'), null, true);
    wp_localize_script('general-js', 'meuAjax', ['ajax_url' => admin_url('admin-ajax.php')]);

    if (is_home() || is_front_page()) {
        wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js', array(), null, true);
        wp_enqueue_script('home-js', get_template_directory_uri() . '/dist/js/home.min.js', array('swiper-js'), null, true);
    } elseif (get_page_template_slug() == 'page-agenda.php') {
        wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js', array(), null, true);
        wp_enqueue_script('schedule-js', get_template_directory_uri() . '/dist/js/home.min.js', array('swiper-js'), null, true);
    } elseif (get_page_template_slug() == 'page-noticias.php') {
        wp_enqueue_script('swiper-js', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/11.0.5/swiper-bundle.min.js', array(), null, true);
        wp_enqueue_script('news-js', get_template_directory_uri() . '/dist/js/home.min.js', array('swiper-js'), null, true);
    }

    add_filter('script_loader_tag', function ($tag, $handle) {
        if ('header' !== $handle) {
            return $tag;
        }
        return str_replace(' src', ' defer src', $tag);
    }, 10, 2);
}


add_action('wp_enqueue_scripts', 'theme_enqueue_styles');
add_action('wp_enqueue_scripts', 'theme_enqueue_scripts');