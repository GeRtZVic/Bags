<?php
function load_style_script(){

    wp_enqueue_script('bags-jquery',  'https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js','','',true);
    wp_enqueue_script('bags-map',  'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3aTpC-G-6Uh3xkoCHSkxm5KIotOBdxbY&callback=initMap','','',true);
    wp_enqueue_script('bags-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js','','',true);
    wp_enqueue_script('bags-slick', get_template_directory_uri() . '/js/slick.js','','',true);
    wp_enqueue_script('bags-fancybox', get_template_directory_uri() . '/js/jquery.fancybox.js','','',true);
    wp_enqueue_script('bags-mask', get_template_directory_uri() . '/js/mask.js','','',true);
    wp_enqueue_script('bags-nice-select', get_template_directory_uri() . '/js/jquery.nice-select.min.js','','',true);
    wp_enqueue_script('bags-rangeSlider', get_template_directory_uri() . '/js/ion.rangeSlider.min.js','','',true);
    wp_enqueue_script('bags-custom', get_template_directory_uri() . '/js/custom.js','','',true);
    wp_enqueue_script('bags-commonDev', get_template_directory_uri() . '/js/commonDev.js','','',true);

    wp_enqueue_style( 'bags-bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
    wp_enqueue_style( 'bags-slick', get_template_directory_uri() . '/css/slick.css' );
    wp_enqueue_style( 'bags-rangeSlider-css', get_template_directory_uri() . '/css/ion.rangeSlider.css' );
    wp_enqueue_style( 'bags-rangeSliderskinHTML5-css', get_template_directory_uri() . '/css/ion.rangeSlider.skinHTML5.css' );
    wp_enqueue_style( 'bags-fancybox', get_template_directory_uri() . '/css/jquery.fancybox.css' );
    wp_enqueue_style( 'bags-formstyler', get_template_directory_uri() . '/css/main.css' );
    wp_enqueue_style( 'bags-style', get_template_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'bags-brands', get_template_directory_uri() . '/css/brands.css' );
    wp_enqueue_style( 'bags-card', get_template_directory_uri() . '/css/card.css' );
    wp_enqueue_style( 'bags-about', get_template_directory_uri() . '/css/about.css' );
    wp_enqueue_style( 'bags-contact', get_template_directory_uri() . '/css/contact.css' );
    wp_enqueue_style( 'bags-reviews', get_template_directory_uri() . '/css/reviews.css' );
    wp_enqueue_style( 'bags-question', get_template_directory_uri() . '/css/question.css' );
    wp_enqueue_style( 'bags-dostavka', get_template_directory_uri() . '/css/dostavka.css' );
    wp_enqueue_style( 'bags-basket', get_template_directory_uri() . '/css/basket.css' );
    wp_enqueue_style( 'bags-order', get_template_directory_uri() . '/css/order.css' );
    wp_enqueue_style( 'bags-catalog', get_template_directory_uri() . '/css/catalog.css' );
    wp_enqueue_style( 'bags-fonts',  'https://fonts.googleapis.com/css?family=Playfair+Display:400,700|Roboto+Condensed:700|Roboto:300,400,700&amp;subset=cyrillic' );
    wp_enqueue_style( 'bags-theme-style', get_template_directory_uri() . '/style.css' );
}

add_action('wp_enqueue_scripts', 'load_style_script');

if( function_exists('acf_add_options_page') ) {

    acf_add_options_page(array(
        'page_title' 	=> 'Настройки сайту',
        'menu_title'	=> 'Настройки сайту',
        'menu_slug' 	=> 'option',
        'capability'	=> 'edit_posts',
        'redirect'		=> false
    ));

}

function register_my_menu() {
    register_nav_menu('top-menu',__( 'Хедер меню' ));
    register_nav_menu('main-menu',__( 'Головне меню' ));
    register_nav_menu('footer-menu',__( 'Підвал меню' ));
}
add_action( 'init', 'register_my_menu' );

if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'single-gal-big', 192, 268, true ); // 300 в ширину и без ограничения в высоту
    add_image_size( 'single-gal-small', 34, 48, true ); // Кадрирование изображения
    add_image_size( 'catalog-img', 147, 210, true ); // Кадрирование изображения
}

// using sessions in WP
add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}

## Изменяет лейблы у таксономии "Рубрики".
add_filter( 'taxonomy_labels_'.'post_tag', 'change_labels_category' );
function change_labels_category( $labels ) {

    // Запишем лейблы для изменения в виде массива для удобства
    $my_labels = array(
        'name'                  => 'Типы товара',
        'singular_name'         => 'Тип товара',
        'search_items'          => 'Поиск типов товаров',
        'all_items'             => 'Все типы товаров',
        'parent_item'           => 'Родительский тип товара',
        'parent_item_colon'     => 'Родительский тип товара:',
        'edit_item'             => 'Изменить тип товара',
        'view_item'             => 'Просмотреть тип товара',
        'update_item'           => 'Обновить тип товара',
        'add_new_item'          => 'Добавить новый тип товара',
        'new_item_name'         => 'Название новой рубрики',
        'not_found'             => 'Типы товара не найдены.',
        'no_terms'              => 'Типов товара нет',
        'items_list_navigation' => 'Навигация по списку типов товара',
        'items_list'            => 'Список типов товара',
        'back_to_items'         => '← Назад к типам товара',
        'menu_name'             => 'Типы товара',
    );

    return $my_labels;
}