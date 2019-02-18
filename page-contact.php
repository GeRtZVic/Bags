<?php
/*
Template Name: Контакти
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 20.05.2018
 * Time: 1:25
 */
get_header();
$thumb_id       = get_post_thumbnail_id();
if ($thumb_id)
    $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>
    <div class="contact_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="page_top">
            <div class="container">
                <h1><?php the_title();?></h1>
            </div>
        </div>
        <div class="container">
            <div class="contact_content">
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="cont_block">
                            <h5>Телефон</h5>
                            <div class="tel_contact">
                                <a href="tel:<?= str_replace(['-',' ','(',')'],'',get_field('phone','option'))?>">
                                    <?php the_field('phone','option')?>
                                </a>
                            </div>
                            <h5>Графік роботи:</h5>
                            <ul class="gra_cont">
                                <li><?php the_field('workTime','option');?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="cont_block">
                            <h5>Адреса:</h5>
                            <ul class="ad_cont">
                                <li><?php the_field('address','option');?>
                                </li>
                            </ul>
                            <h5>Email</h5>
                            <div class="mail_contact">
                                <a href="mailto:<?php the_field('email','option');?>"><?php the_field('email','option');?></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4">
                        <div class="cont_block">
                            <div class="social_contact">
                                <h5>Ми в соціальних мережах</h5>
                                <ul>
                                    <li><a href="<?php the_field('fbLink','option');?>">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="11" height="19"
                                                 viewBox="0 0 11 19">
                                                <defs>
                                                    <path id="zk1la"
                                                          d="M1404.32 119.99h-3.54v-8H1399v-2.76h1.78v-1.66c0-2.25 1-3.58 3.84-3.58h2.37v2.75h-1.48c-1.11 0-1.18.39-1.18 1.11v1.38h2.67l-.31 2.76h-2.37v8z"/>
                                                </defs>
                                                <g>
                                                    <g transform="translate(-1398 -102)">
                                                        <use fill="#3498db" xlink:href="#zk1la"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php the_field('fbLink','option');?></a></li>
                                    <li><a href="<?php the_field('yuLink','option');?>">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="14" height="16"
                                                 viewBox="0 0 14 16">
                                                <defs>
                                                    <path id="ip7ta"
                                                          d="M1509.8 114.98v1.93c0 .4-.12.6-.36.6-.14 0-.28-.06-.42-.2v-2.75c.14-.13.28-.2.42-.2.24 0 .37.21.37.62zm3.17.01v.42h-.85v-.42c0-.42.14-.62.42-.62.28 0 .43.2.43.62zm1.9-2.39s.13 1.09.13 2.17v1.02c0 1.08-.14 2.17-.14 2.17s-.14.92-.56 1.33c-.53.54-1.13.54-1.4.57-1.96.14-4.9.14-4.9.14s-3.64-.03-4.76-.14c-.31-.05-1.01-.03-1.54-.57-.42-.4-.56-1.33-.56-1.33s-.14-1.09-.14-2.17v-1.02c0-1.08.14-2.17.14-2.17s.14-.92.56-1.33c.53-.54 1.12-.54 1.4-.57 1.96-.13 4.9-.13 4.9-.13s2.94 0 4.9.13c.27.03.87.03 1.4.57.42.4.56 1.33.56 1.33zm-10.79 5.6V113h1.02v-.86h-2.96v.85h1v5.2zm3.35 0v-4.51h-.85v3.44c-.19.26-.36.39-.53.39-.12 0-.18-.07-.2-.2l-.01-.31v-3.32h-.85v3.56c0 .32.03.53.08.67.08.23.27.34.54.34.31 0 .64-.19.97-.56v.5zm3.23-3.15c0-.43-.03-.73-.09-.91-.11-.34-.34-.51-.68-.51-.3 0-.6.16-.87.49v-1.98h-.85v6.05h.85v-.43c.28.34.57.5.87.5.34 0 .57-.17.68-.51.06-.2.09-.5.09-.9zm3.16 1.04v-.94c0-.48-.09-.83-.27-1.06a1.2 1.2 0 0 0-1-.46c-.43 0-.77.15-1.02.46-.18.23-.26.58-.26 1.06v1.58c0 .48.1.84.27 1.06.25.31.59.47 1.03.47.44 0 .8-.16 1.03-.5.1-.14.17-.3.2-.48l.02-.53v-.12h-.87c0 .33-.01.51-.02.56-.05.21-.17.32-.38.32-.3 0-.43-.2-.43-.62v-.8zm-8.06-5.98h-.95v-2.47a14.8 14.8 0 0 0-.58-1.94l-.62-1.7h1l.68 2.4.65-2.4h.96l-1.14 3.64zm1.23-.4c-.18-.23-.27-.59-.27-1.07v-1.6c0-.48.09-.84.27-1.07.24-.31.57-.47 1-.47.43 0 .76.16 1 .47.18.23.27.59.27 1.07v1.6c0 .48-.09.84-.27 1.07-.24.31-.57.47-1 .47-.43 0-.76-.16-1-.47zm.6-.92c0 .43.12.64.4.64s.4-.21.4-.64v-1.91c0-.42-.12-.63-.4-.63s-.4.2-.4.63zm3.94 1.32v-.5c-.35.38-.67.57-.98.57-.28 0-.47-.11-.56-.34a2.2 2.2 0 0 1-.07-.68v-3.6h.85v3.35l.01.32c.02.13.09.2.2.2.18 0 .36-.13.55-.39v-3.48h.85v4.55z"/>
                                                </defs>
                                                <g>
                                                    <g transform="translate(-1501 -104)">
                                                        <use fill="#3498db" xlink:href="#ip7ta"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php the_field('yuLink','option');?></a></li>
                                    <!-- <li><a href="<?php the_field('inLink','option');?>">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20"
                                                 viewBox="0 0 20 20">
                                                <defs>
                                                    <path id="e07va"
                                                          d="M1464 106.05v11.9c0 .56-.2 1.04-.6 1.45-.4.4-.89.6-1.45.6h-11.9c-.56 0-1.04-.2-1.45-.6-.4-.4-.6-.89-.6-1.45v-11.9c0-.56.2-1.04.6-1.45.4-.4.89-.6 1.45-.6h11.9c.56 0 1.04.2 1.45.6.4.4.6.89.6 1.45zm-11.2 5.92c0 .86.32 1.6.94 2.2.63.6 1.39.91 2.27.91.89 0 1.65-.3 2.28-.9.63-.62.94-1.35.94-2.21 0-.86-.31-1.6-.94-2.2a3.16 3.16 0 0 0-2.28-.92c-.88 0-1.64.3-2.27.91-.62.61-.94 1.35-.94 2.2zm9.39 5.55v-6.75h-1.4a4.61 4.61 0 0 1-.46 3.79 5 5 0 0 1-4.31 2.4 4.87 4.87 0 0 1-3.52-1.41 4.57 4.57 0 0 1-1.25-4.78h-1.47v6.75a.62.62 0 0 0 .64.64h11.13c.18 0 .33-.06.45-.19a.6.6 0 0 0 .19-.45zm0-11.02a.7.7 0 0 0-.21-.5.69.69 0 0 0-.51-.22h-1.81c-.2 0-.37.07-.51.21a.7.7 0 0 0-.21.5v1.73a.7.7 0 0 0 .72.72h1.8a.7.7 0 0 0 .52-.21.7.7 0 0 0 .2-.51z"/>
                                                </defs>
                                                <g>
                                                    <g transform="translate(-1446 -102)">
                                                        <use fill="#3498db" xlink:href="#e07va"/>
                                                    </g>
                                                </g>
                                            </svg>
                                            <?php the_field('inLink','option');?></a></li> -->
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div id="map"></div>
<?php get_footer();?>