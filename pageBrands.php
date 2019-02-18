<?php
/*
Template Name: Бренди
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 22.08.2018
 * Time: 23:16
 */
get_header();?>
    <div class="brands_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="page_top">
            <div class="container">
                <h2>Бренди</h2>
            </div>
        </div>
<!--        <div class="brands_filter">-->
<!--            <div class="container">-->
<!--                <div class="brands_filter_txt">Всі</div>-->
<!--                <ul>-->
<!--                    <li><a href="#">а</a></li>-->
<!--                    <li><a href="#">б</a></li>-->
<!--                    <li><a href="#">д</a></li>-->
<!--                    <li><a href="#">к</a></li>-->
<!--                    <li><a href="#">л</a></li>-->
<!--                    <li><a href="#">н</a></li>-->
<!--                    <li><a href="#">о</a></li>-->
<!--                    <li><a href="#">п</a></li>-->
<!--                    <li><a href="#">у</a></li>-->
<!--                    <li><a href="#">х</a></li>-->
<!--                    <li><a href="#">ю</a></li>-->
<!--                    <li><a href="#">a</a></li>-->
<!--                    <li><a href="#">f</a></li>-->
<!--                    <li><a href="#">l</a></li>-->
<!--                    <li><a href="#">o</a></li>-->
<!--                    <li><a href="#">r</a></li>-->
<!--                    <li><a href="#">s</a></li>-->
<!--                    <li><a href="#">w</a></li>-->
<!--                    <li><a href="#">z</a></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->
        <div class="brands_content">
            <div class="container">
                <div class="row">

                    <?php
                    $category = get_terms( array(
                        'taxonomy'      => "category_produce",
                        'hide_empty'    => false,
                    ) );
                    foreach ($category as $cat) :?>
                        <?php $image = get_field('img',$cat);?>

                        <div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
                            <a href="<?= get_permalink(189) . '?idProduce=' . $cat->term_id ?>" class="brand_block">
                                <div class="brand_img">
                                    <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                                </div>
                                <p><?=$cat->name;?></p>
                            </a>
                        </div>

                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="brands_page_txt">
        <div class="container">
            <?php wp_reset_query();the_content();?>
        </div>
    </div>
<?php get_footer();?>