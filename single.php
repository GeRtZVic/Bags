<?php
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 06.08.2018
 * Time: 23:45
 */
get_header();
$thumb_id = get_post_thumbnail_id();
if ($thumb_id){
    $thumbImage  = wp_get_attachment_image_src($thumb_id,'full', true);
    $thumbBasket = wp_get_attachment_image_src($thumb_id,'thumbnail', true);
}
?>
    <div class="card_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="container">
            <div class="card_section">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <?php wp_reset_query();
                        if( have_rows('gallery') ): ?>
                            <div class="card_slider clearfix">
                            <div class="slider-for">
                            <?php
                            while( have_rows('gallery') ): the_row();
                                $img = get_sub_field('img');
                            ?>
                                <div class="big-sl">
                                    <a class="slider-big fancybox" href="<?= $img['url']; ?>" data-fancybox-group="gallery" title="<?= $img['alt']; ?>">
                                        <img class="img-responsive" src="<?= $img['url']; ?>" alt="<?= $img['alt']; ?>">
                                    </a>
                                </div>
                                <?php endwhile;?>
                            </div>
                            <div class="slider-nav">
                            <?php
                            while( have_rows('gallery') ): the_row();
                                $img = get_sub_field('img');
                                ?>
                                <div class="sm">
                                    <div class="slider-sm">
                                        <img class="img-responsive" src="<?= $img['url']; ?>" alt="<?= $img['alt']; ?>">
                                    </div>
                                </div>
                            <?php endwhile;?>
                            </div>
                        </div>
                        <?php endif;?>
                        <?php $video = get_field('video');?>
                        <?php if ($video):?>
                            <div class="card_video">
                                <?= $video; ?>
                            </div>
                        <?php endif;?>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="card_content">
                            <div class="card_content_title">
                                <h2><?php the_title();?></h2>
                                <p>Код товара: <?php the_field('vendorCode');?></p>
                            </div>
                            <div class="card_price">
                                <p><?php the_field('price');?> <span>грн</span></p>
                            </div>
                            <?php if ($price = get_field('priceOld')): ?>
                                <div class="card_old_price">
                                    <p><?= $price;?> грн</p>
                                </div>
                            <?php endif;?>

                            <?php if( get_field('inStock') ): ?>
                                <div class="availability">
                                    <span class="availability_yes">Є в наявності</span>
                                </div>
                                <div class="quantity">
                                    <p>Кількість</p>
                                    <div class="field-good-count">
                                        <div class="numbers-row">
                                            <input type="text" name="quantity" id="count-item" value="1">
                                        </div>
                                    </div>
                                    <button class       ="bag_center_btn add_basket"
                                            data-id     = "<?= get_the_ID();?>"
                                            data-toggle = "modal"
                                            data-target = "#popap-6"
                                            data-img    = "<?= $thumbBasket[0] ?>"
                                            data-price  = "<?php the_field('price'); ?>"
                                            data-title  = "<?php the_title();?>">До кошика</button>
                                </div>
                            <?php else: ?>

                                <div class="availability">
                                    <span class="availability_none">Немає в наявності</span>
                                </div>
                                <div class="card_form">
                                    <?=do_shortcode('[contact-form-7 id="173" title="Сповістити, коли буде в наявності"]');?>
                                </div>
                            <?php endif; ?>

                            <div class="card_info">
                                <?php if( have_rows('options') ): ?>
                                    <?php while( have_rows('options') ): the_row();?>
                                        <div class="card_info_item">
                                            <p><?php the_sub_field('title');?></p>
                                            <span><?php the_sub_field('value');?></span>
                                        </div>
                                    <?php endwhile;?>
                                <?php endif;?>
                                <div class="card_ifo_txt">
                                    <?php wp_reset_query();the_content();?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="offer_section">
                <div class="offer_section_top clearfix">
                    <h2>Пропозиції для вас</h2>
                </div>
                <?php
                $post_objects = get_field('propose');

                if( $post_objects ): ?>
                    <div class="receipts_slider">
                    
                        <?php foreach( $post_objects as $post):
                            setup_postdata($post);
                            $thumb_id = get_post_thumbnail_id($post_object);
                            if ($thumb_id){
                                $thumbImage  = wp_get_attachment_image_src($thumb_id,'full', true);
                                $thumbBasket = wp_get_attachment_image_src($thumb_id,'thumbnail', true);
                            }
                            $isNew = get_field('isNew');
                            ?>
                            <div class="receipts_slider_col">
                                <div class="receipts_slider_b">
                                    <?php if( get_field('isNew') ): ?>
                                        <div class="new_plash">Новинка!</div>
                                    <?php endif;?>
                                    <a href="<?php the_permalink(); ?>" class="receipts_slider_img">
                                        <?php if ($thumb_id):?>
                                            <img src="<?= $thumbImage[0]; ?>" alt="">
                                        <?php endif;?>
                                    </a>
                                    <div class="receipts_slider_txt">
                                        <a href="#"><?php the_title(); ?></a>
                                        <p class="price"><?php the_field('price'); ?><span> грн</span></p>
                                    </div>
                                    <div class="receipts_slider_btn">
                                        <?php if( get_field('inStock') ): ?>
                                            <a  data-id     = "<?= get_the_ID();?>"
                                                data-toggle = "modal"
                                                data-target = "#popap-6"
                                                data-img    = "<?= $thumbBasket[0] ?>"
                                                data-price  = "<?php the_field('price'); ?>"
                                                data-title  = "<?php the_title();?>"
                                                class=" add_basket">До кошика</a>
                                        <?php endif;?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php wp_reset_postdata(); endif;?>
            </div>
            <?php
            wp_reset_query();
            $team = new WP_Query( array(
                'post_type' => 'reviews',
                'showposts' => -1,
                'meta_query' => [
                    [
                        'key'     => 'product',
                        'value'   => get_the_ID(),
                    ]
                ],
                'orderby' => 'date',
                'order' => 'DESC',
            ) );
            ?>
            <div class="card_reviews_section">
                <div class="card_reviews_section-top clearfix">
                    <h2>Відгуки про товар <span>(<?=$team->post_count?>)</span></h2>
                </div>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="reviews_top">
                            <p>Залишайте відгуки  — отримуйте знижки!</p>
                            <div class="review_btn">
                                <a href="#" data-toggle="modal" data-target="#popap-2" data-id="<?=get_the_ID();?>" class="addProductId">Залишити відгук</a>
                            </div>
                        </div>
                    </div>
                    <?php
                    if ( $team->have_posts() ) :
                    // Start the Loop.
                    $j=0;
                    while ( $team->have_posts() ) : $team->the_post();
                    $stars      = get_field('rating');
                    $j++;
                    ?>
                    <div class="reviews_block clearfix <?php if ($j>2) echo 'reviews_hide'?>">
                        <div class="col-md-2 col-lg-2">
                            <div class="reviews_left">
                                <p class="reviews_name"><?php the_title();?></p>
                                <p class="reviews_last_name"></p>
                                <strong><?= get_the_date('d m Y'); ?></strong>
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
                                    <img src="<?=get_template_directory_uri()?>/image/fb_.png" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile;
                    else :
                    endif;
                    wp_reset_query();
                    ?>
<!--                    <div class="col-md-12 col-lg-12">-->
<!--                        <div class="reviews_reviews">-->
<!--                            <a class="show_reviews">Показати ще</a>-->
<!--                        </div>-->
<!--                    </div>-->
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>