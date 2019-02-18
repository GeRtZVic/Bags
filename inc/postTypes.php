<?php
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 21.07.2018
 * Time: 18:02
 */
$labels = [
    'name' => 'Відгуки',
];
$args = [
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'menu_icon'             => 'dashicons-universal-access',
    'show_ui'               => true,
    'show_in_menu'          => true,
    'query_var'             => true,
    'rewrite'               => true,
    'capability_type'       => 'post',
    'has_archive'           => true,
    'hierarchical'          => false,
    'menu_position'         => null,
    'supports' => [
        'title',
        'editor'
    ]
];
register_post_type('reviews',$args);

$labels = [
    'name' => 'Часті питання',
];
$args = [
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'menu_icon'             => 'dashicons-lightbulb',
    'show_ui'               => true,
    'show_in_menu'          => true,
    'query_var'             => true,
    'rewrite'               => true,
    'capability_type'       => 'post',
    'has_archive'           => true,
    'hierarchical'          => false,
    'menu_position'         => null,
    'supports' => [
        'title',
        'editor'
    ]
];
register_post_type('faq',$args);

$labels = [
    "name"          => __( "Виробники", "" ),
    "singular_name" => __( "Виробники", "" ),
];

$args = [
    "label"                 => __( "Виробники", "" ),
    "labels"                => $labels,
    "public"                => true,
    "hierarchical"          => true,
    "show_ui"               => true,
    "show_in_menu"          => true,
    "show_in_nav_menus"     => true,
    "query_var"             => true,
    "rewrite"               => [
        'slug'          => 'category_produce',
        'with_front'    => true,
    ],
    "show_admin_column"     => false,
    "show_in_rest"          => false,
    "rest_base"             => "category_produce",
    "show_in_quick_edit"    => false,
];
register_taxonomy( "category_produce", [ "post" ], $args );

$labels = [
    "name"          => __( "Ліцензія", "" ),
    "singular_name" => __( "Категорія", "" ),
];

$args = [
    "label"                 => __( "Ліцензія", "" ),
    "labels"                => $labels,
    "public"                => true,
    "hierarchical"          => true,
    "show_ui"               => true,
    "show_in_menu"          => true,
    "show_in_nav_menus"     => true,
    "query_var"             => true,
    "rewrite"               => [
        'slug'          => 'category_licence',
        'with_front'    => true,
    ],
    "show_admin_column"     => false,
    "show_in_rest"          => false,
    "rest_base"             => "category_licence",
    "show_in_quick_edit"    => false,
];
register_taxonomy( "category_licence", [ "post" ], $args );

$labels = [
    "name"          => __( "Акції", "" ),
    "singular_name" => __( "Категорія", "" ),
];

$args = [
    "label"                 => __( "Акції", "" ),
    "labels"                => $labels,
    "public"                => true,
    "hierarchical"          => true,
    "show_ui"               => true,
    "show_in_menu"          => true,
    "show_in_nav_menus"     => true,
    "query_var"             => true,
    "rewrite"               => [
        'slug'          => 'category_promo',
        'with_front'    => true,
    ],
    "show_admin_column"     => false,
    "show_in_rest"          => false,
    "rest_base"             => "category_promo",
    "show_in_quick_edit"    => false,
];
register_taxonomy( "category_promo", [ "post" ], $args );

$labels = [
    "name"          => __( "Стать", "" ),
    "singular_name" => __( "Категорія", "" ),
];

$args = [
    "label"                 => __( "Стать", "" ),
    "labels"                => $labels,
    "public"                => true,
    "hierarchical"          => true,
    "show_ui"               => true,
    "show_in_menu"          => true,
    "show_in_nav_menus"     => true,
    "query_var"             => true,
    "rewrite"               => [
        'slug'          => 'category_sex',
        'with_front'    => true,
    ],
    "show_admin_column"     => false,
    "show_in_rest"          => false,
    "rest_base"             => "category_sex",
    "show_in_quick_edit"    => false,
];
register_taxonomy( "category_sex", [ "post" ], $args );

$labels = array(
    'name' => 'Замовлення',
    'singular_name' => 'Замовлення',

);
$args = [
    'labels'                => $labels,
    'public'                => true,
    'publicly_queryable'    => true,
    'menu_icon'             => 'dashicons-cart',
    'show_ui'               => true,
    'show_in_menu'          => true,
    'query_var'             => true,
    'rewrite'               => true,
    'capability_type'       => 'post',
    'has_archive'           => true,
    'hierarchical'          => false,
    'menu_position'         => null,
    'supports'              => array('title','editor')
];
register_post_type('orders',$args);