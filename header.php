<!DOCTYPE html>
<html lang="uk-ua">
<head>
    <meta charset="UTF-8">
    <title><?php bloginfo('name'); if(is_front_page() || is_front_page()) {  } else { wp_title(); } ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head();?>
</head>
<body>
<header>
    <?php $price = getPriceValueForFilter(); ?>
    <span id="price-for-filter" data-min="<?= ($price[0]) ? $price[0] : 100; ?>" data-max="<?= ($price[1]) ? $price[1] : 10000; ?>"></span>
    <div class="modal popap-1" id="popap-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="close" data-dismiss="modal">
                    <img src="<?= get_template_directory_uri();?>/image/close.png" alt="">
                </button>
                <div class="modal-header">
                    <h3 class="modal-title"><?php the_field('callMeWord','option');?></h3>
                </div>
                <div class="modal-body">
                    <?=do_shortcode('[contact-form-7 id="5" title="Передзвоніть мені"]')?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal popap-2" id="popap-2">
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="close" data-dismiss="modal">
                    <img src="<?= get_template_directory_uri();?>/image/close.png" alt="">
                </button>
                <div class="modal-header">
                    <h3 class="modal-title"><?php the_field('leaveReaviewWord','option');?></h3>
                </div>
                <div class="modal-body">
                    <?=do_shortcode('[contact-form-7 id="45" title="Залишити відгук про магазин"]');?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal popap-5" id="popap-5">
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="close" data-dismiss="modal">
                    <img src="<?= get_template_directory_uri();?>/image/close.png" alt="">
                </button>
                <div class="modal-header">
                    <h3 class="modal-title">Дякуємо за замовлення!</h3>
                </div>
                <div class="modal-body">
                    <div class="popap_txt-p">
                        <p>Дані відправлені успішно, наш менеджер зв'яжеться з вами найближчим часом!</p>
                    </div>
                    <div class="modal-btn">
                        <a href="<?=site_url();?>" class="call-bt sht_btn">
                            ОК
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal popap-6" id="popap-6">
        <div class="modal-dialog">
            <div class="modal-content">
                <button class="close" data-dismiss="modal">
                    <img src="<?= get_template_directory_uri();?>/image/close.png" alt="">
                </button>
                <div class="modal-header">
                    <h3 class="modal-title"><?php the_field('productAddToCartWord','option');?></h3>
                </div>
                <div class="modal-body">
                    <div class="modal_basket">
                        <div class="popap_img">
                            <img id="product-img" src="<?= get_template_directory_uri();?>/image/basket_img.png" alt="">
                        </div>
                        <div class="popap_txt-p">
                            <p id="product-title">Рюкзак школьный каркасный Kite Rachael Hale 2 шт.</p>
                        </div>
                    </div>
                    <div class="modal-btn modal_basket_btn">
                        <a href="<?php the_permalink( 178 ); ?>" class="bascket_pass call-bt sht_btn">
                            ОК
                        </a>
                        <a href="#" class="jsContinueShopping"><?php the_field('goShopingWord','option');?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu_top">
        <div class="container">
            <div class="row">
                <div class="hidden-xs hidden-sm col-md-6 col-lg-6 menu_top_one">
                    <?php wp_nav_menu( array(
                        'theme_location'  => 'top-menu',
                        'menu'            => '',
                        'container'       => '',
                        'container_class' => '',
                        'container_id'    => '',
                        'menu_class'      => '_nav',
                        'menu_id'         => '',
                        'echo'            => true,
                        'fallback_cb'     => 'wp_page_menu',
                        'before'          => '',
                        'after'           => '',
                        'link_before'     => '',
                        'link_after'      => '',
                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        'depth'           => 0,
                        'walker'          => '',
                    ) ); ?>
                </div>
                <div class="col-xs-6 col-sm-8 col-md-4 col-lg-4">
                    <div class="tel_top">
                        <a href="tel:+380986870100">+38 098 687-01-00</a>
                    </div>
                    <div class="top_call">
                        <a href="#" data-toggle="modal" data-target="#popap-1"><?php the_field('callMeWord','option');?></a>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-1 col-lg-1">
                    <div class="lang_top">
                        <div class="btn-group" role="group">
                            <?php if ( function_exists('dynamic_sidebar') )
                                dynamic_sidebar('lang-switcher');
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-1 col-lg-1">
                    <a href="/basket" class="caret_top" >
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="23" height="32" viewBox="0 0 23 32"><defs><path id="r6h5a" d="M1494.72 44h-20.44a1.3 1.3 0 0 1-1.28-1.37l1.84-20.96c.02-.7.58-1.26 1.28-1.26h1.13a.7.7 0 0 1 .69.7c0 .39-.31.7-.7.7h-1.03l-1.42 16.27h19.42l-1.42-16.27h-.83a.7.7 0 0 1-.69-.7c0-.39.3-.7.69-.7h.92c.7 0 1.26.56 1.28 1.26l1.84 20.96v.07c0 .72-.57 1.3-1.28 1.3zm-20.33-1.4h20.22l-.27-3.11h-19.68zm13.66-20.79h-6.78a.7.7 0 0 1-.69-.7c0-.39.3-.7.69-.7h6.78a.7.7 0 0 1 .7.7c0 .39-.32.7-.7.7zm2.2 4.19a.7.7 0 0 1-.7-.7c0-7.12-2.6-11.9-5.05-11.9-2.44 0-5.06 4.78-5.06 11.9 0 .38-.3.7-.69.7a.7.7 0 0 1-.69-.7c0-7.46 2.83-13.3 6.44-13.3 3.6 0 6.44 5.84 6.44 13.3 0 .38-.31.7-.7.7z"/></defs><g><g transform="translate(-1473 -12)"><use fill="#1a1a1a" xlink:href="#r6h5a"/></g></g></svg>
                        <strong class="caret_circle all-count"><?= getBasketCount(); ?></strong>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header_middle">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-3">
                    <a class="logo_top" href="<?= site_url()?>"><img src="<?= get_template_directory_uri();?>/image/logo_top.png" alt=""></a>
                </div>
                <div class="col-xs-10 col-sm-8 col-md-6 col-lg-7">
                    <div class="search_top">
                        <form action="/">
                            <input class="white-right-btn-txt" name="s" type="text"
                                   placeholder="<?php the_field('searchOnSiteWord','option');?>">
                            <input class="lupa" type="submit">
                        </form>
                    </div>
                </div>
                <div class="hidden-xs col-sm-3 col-md-2 col-lg-2">
                    <div class="social_top">
                        <ul>
                            <?php $link = get_field('fbLink','option');?>
                            <?php if ($link):?>
                                <li>
                                    <a href="<?= $link;?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="11" height="19" viewBox="0 0 11 19"><defs><path id="zk1la" d="M1404.32 119.99h-3.54v-8H1399v-2.76h1.78v-1.66c0-2.25 1-3.58 3.84-3.58h2.37v2.75h-1.48c-1.11 0-1.18.39-1.18 1.11v1.38h2.67l-.31 2.76h-2.37v8z"/></defs><g><g transform="translate(-1398 -102)"><use fill="#a4a7a9" xlink:href="#zk1la"/></g></g></svg>
                                    </a>
                                </li>
                                <?php
                            endif;
                            $link = get_field('yuLink','option');
                            if($link):
                                ?>
                                <li>
                                    <a href="<?= $link;?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" viewBox="0 0 20 20"><defs><path id="e07va" d="M1464 106.05v11.9c0 .56-.2 1.04-.6 1.45-.4.4-.89.6-1.45.6h-11.9c-.56 0-1.04-.2-1.45-.6-.4-.4-.6-.89-.6-1.45v-11.9c0-.56.2-1.04.6-1.45.4-.4.89-.6 1.45-.6h11.9c.56 0 1.04.2 1.45.6.4.4.6.89.6 1.45zm-11.2 5.92c0 .86.32 1.6.94 2.2.63.6 1.39.91 2.27.91.89 0 1.65-.3 2.28-.9.63-.62.94-1.35.94-2.21 0-.86-.31-1.6-.94-2.2a3.16 3.16 0 0 0-2.28-.92c-.88 0-1.64.3-2.27.91-.62.61-.94 1.35-.94 2.2zm9.39 5.55v-6.75h-1.4a4.61 4.61 0 0 1-.46 3.79 5 5 0 0 1-4.31 2.4 4.87 4.87 0 0 1-3.52-1.41 4.57 4.57 0 0 1-1.25-4.78h-1.47v6.75a.62.62 0 0 0 .64.64h11.13c.18 0 .33-.06.45-.19a.6.6 0 0 0 .19-.45zm0-11.02a.7.7 0 0 0-.21-.5.69.69 0 0 0-.51-.22h-1.81c-.2 0-.37.07-.51.21a.7.7 0 0 0-.21.5v1.73a.7.7 0 0 0 .72.72h1.8a.7.7 0 0 0 .52-.21.7.7 0 0 0 .2-.51z"/></defs><g><g transform="translate(-1446 -102)"><use fill="#a4a7a9" xlink:href="#e07va"/></g></g></svg>
                                    </a>
                                </li>
                                <?php
                            endif;
                            $link = get_field('inLink','option');
                            if($link):
                                ?>
                                <li>
                                    <a href="<?= $link;?>" target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="16" viewBox="0 0 14 16"><defs><path id="ip7ta" d="M1509.8 114.98v1.93c0 .4-.12.6-.36.6-.14 0-.28-.06-.42-.2v-2.75c.14-.13.28-.2.42-.2.24 0 .37.21.37.62zm3.17.01v.42h-.85v-.42c0-.42.14-.62.42-.62.28 0 .43.2.43.62zm1.9-2.39s.13 1.09.13 2.17v1.02c0 1.08-.14 2.17-.14 2.17s-.14.92-.56 1.33c-.53.54-1.13.54-1.4.57-1.96.14-4.9.14-4.9.14s-3.64-.03-4.76-.14c-.31-.05-1.01-.03-1.54-.57-.42-.4-.56-1.33-.56-1.33s-.14-1.09-.14-2.17v-1.02c0-1.08.14-2.17.14-2.17s.14-.92.56-1.33c.53-.54 1.12-.54 1.4-.57 1.96-.13 4.9-.13 4.9-.13s2.94 0 4.9.13c.27.03.87.03 1.4.57.42.4.56 1.33.56 1.33zm-10.79 5.6V113h1.02v-.86h-2.96v.85h1v5.2zm3.35 0v-4.51h-.85v3.44c-.19.26-.36.39-.53.39-.12 0-.18-.07-.2-.2l-.01-.31v-3.32h-.85v3.56c0 .32.03.53.08.67.08.23.27.34.54.34.31 0 .64-.19.97-.56v.5zm3.23-3.15c0-.43-.03-.73-.09-.91-.11-.34-.34-.51-.68-.51-.3 0-.6.16-.87.49v-1.98h-.85v6.05h.85v-.43c.28.34.57.5.87.5.34 0 .57-.17.68-.51.06-.2.09-.5.09-.9zm3.16 1.04v-.94c0-.48-.09-.83-.27-1.06a1.2 1.2 0 0 0-1-.46c-.43 0-.77.15-1.02.46-.18.23-.26.58-.26 1.06v1.58c0 .48.1.84.27 1.06.25.31.59.47 1.03.47.44 0 .8-.16 1.03-.5.1-.14.17-.3.2-.48l.02-.53v-.12h-.87c0 .33-.01.51-.02.56-.05.21-.17.32-.38.32-.3 0-.43-.2-.43-.62v-.8zm-8.06-5.98h-.95v-2.47a14.8 14.8 0 0 0-.58-1.94l-.62-1.7h1l.68 2.4.65-2.4h.96l-1.14 3.64zm1.23-.4c-.18-.23-.27-.59-.27-1.07v-1.6c0-.48.09-.84.27-1.07.24-.31.57-.47 1-.47.43 0 .76.16 1 .47.18.23.27.59.27 1.07v1.6c0 .48-.09.84-.27 1.07-.24.31-.57.47-1 .47-.43 0-.76-.16-1-.47zm.6-.92c0 .43.12.64.4.64s.4-.21.4-.64v-1.91c0-.42-.12-.63-.4-.63s-.4.2-.4.63zm3.94 1.32v-.5c-.35.38-.67.57-.98.57-.28 0-.47-.11-.56-.34a2.2 2.2 0 0 1-.07-.68v-3.6h.85v3.35l.01.32c.02.13.09.2.2.2.18 0 .36-.13.55-.39v-3.48h.85v4.55z"/></defs><g><g transform="translate(-1501 -104)"><use fill="#a4a7a9" xlink:href="#ip7ta"/></g></g></svg>
                                    </a>
                                </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu_main">
        <div class="container">
            <div class="hamburger">
                <span class="menu-global hamburger-top"></span>
                <span class="menu-global hamburger-middle"></span>
                <span class="menu-global hamburger-bottom"></span>
            </div>
            <?php wp_nav_menu( array(
                'theme_location'  => 'main-menu',
                'menu'            => '',
                'container'       => '',
                'container_class' => '',
                'container_id'    => '',
                'menu_class'      => 'hamburger_down',
                'menu_id'         => '',
                'echo'            => true,
                'fallback_cb'     => 'wp_page_menu',
                'before'          => '',
                'after'           => '',
                'link_before'     => '',
                'link_after'      => '',
                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                'depth'           => 0,
                'walker'          => '',
            ) ); ?>
        </div>
    </div>
</header>
<main>