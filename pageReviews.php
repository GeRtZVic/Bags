<?php
/*
Template Name: Відгуки
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 21.07.2018
 * Time: 18:06
 */
get_header();?>
<div class="reviews_page">
    <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
    <div class="page_top">
        <div class="container">
            <h1><?php the_title();?></h1>
        </div>
    </div>
    <div class="container">
        <div class="reviews_content">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="reviews_top">
                        <p>Залишайте відгуки  — отримуйте знижки!</p>
                        <div class="review_btn">
                            <a href="#" data-toggle="modal" data-target="#popap-2">Залишити відгук</a>
                        </div>
                    </div>
                </div>
                <?php
                wp_reset_query();
                $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                $team = new WP_Query( array(
                    'post_type'      => 'reviews',
                    'posts_per_page' => -1,
                    'paged'          => $paged,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ) );
                if ( $team->have_posts() ) :
                    while ( $team->have_posts() ) : $team->the_post();
                        $stars = get_field('rating');
                        ?>
                        <div class="reviews_block clearfix">
                            <div class="col-md-2 col-lg-2">
                                <div class="reviews_left">
                                    <p class="reviews_name"><?php the_title();?></p>
                                    <p class="reviews_last_name"></p>
                                    <strong><?= get_the_date('d M Y'); ?></strong>
                                    <div class="reviews_star">
                                        <ul>
                                            <?php for ($i=1;$i<=5;$i++):?>
                                                <li class="<?= ($stars>=$i)?'star_active':'star'?>"></li>
                                            <?php endfor;?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-lg-10">
                                <div class="reviews_right">
                                    <?php the_content();?>
                                    <div class="reviews_fb">
                                        <img src="<?= get_template_directory_uri();?>/image/fb_.png" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endwhile;
                else :
                endif;
                wp_reset_query();
                ?>
<!--                <div class="col-md-12 col-lg-12">-->
<!--                    <div class="reviews_reviews">-->
<!--                        <a href="#">Показати ще 12 відгуків</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <div class="col-md-12 col-lg-12">-->
<!--                    <div class="pag_reviews">-->
<!--                        <ul>-->
<!--                            <li class="pager-prev"><a class="pager-arrow" href="#"></a></li>-->
<!--                            <li><a href="#">3</a></li>-->
<!--                            <li><a href="#">4</a></li>-->
<!--                            <li><a href="#">5</a></li>-->
<!--                            <li><p>...</p></li>-->
<!--                            <li><a href="#">13</a></li>-->
<!--                            <li class="pager-next"><a class="pager-arrow" href="#"></a></li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>
