<?php
/*
Template Name: Головна
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 20.05.2018
 * Time: 1:25
 */
get_header();
?>
<?php if( have_rows('slider') ): ?>
    <div class="main_slider">
        <?php while( have_rows('slider') ): the_row();

            // vars
            $image = get_sub_field('img');
            $content = get_sub_field('content');
            $link = get_sub_field('link');

            ?>
            <div class="main_slider_block">
                <div class="container">
                    <div class="main_slider_content">
                        <div class="main_slider_txt">
                            <?php the_sub_field('text');?>
                        </div>
                        <div class="main_slider_img">
                            <img src="<?= $image['url'];?>" alt="<?= $image['alt'];?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php endif;?>
<?php if( have_rows('mainLink') ): ?>

    <div class="tovar_section">
        <div class="container">
            <div class="row">

        <?php while( have_rows('mainLink') ): the_row();

            // vars
            $cat = get_sub_field('cat');
            $img = get_field('img',$cat);

            ?>
            <?php if (get_sub_field('size') == 'small'):?>
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <a href="<?= get_term_link($cat, 'category'); ?>" class="tovar_block">
                        <div class="tovar_block_img">
                            <img src="<?= $img['url']; ?>" alt="<?= $img['alt']; ?>">
                        </div>
                        <p><?=$cat->name;?></p>
                    </a>
                </div>
            <?php else:?>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <a href="<?= get_term_link($cat, 'category'); ?>" class="tovar_block_sale">
                        <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <div class="tovar_block_sale_txt">
                                    <h5><?=$cat->name;?></h5>
                                    <p><?=$cat->description;?></p>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                                <div class="tovar_block_sale_img">
                                    <img src="<?= $img['url']; ?>" alt="<?= $img['alt']; ?>">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            <?php endif;?>

        <?php endwhile; ?>

            </div>
        </div>
    </div>

<?php wp_reset_query(); endif; ?>
<?php
wp_reset_query();
$team = new WP_Query( [
    'post_type' => 'post',
    'showposts' => 10,
    'meta_query' => [
        'key'     => 'showMain',
        'value'   => true,
    ],
    'orderby' => 'date',
    'order' => 'DESC',
] );
?>
<?php
if ( $team->have_posts() ) :?>
<div class="new_receipts_section">
    <div class="container">
        <h2><?php the_field('newProductsWord','option');?></h2>
        <div class="receipts_slider">
        <?php
        // Start the Loop.
        $j = $thumb_id = 0;
        while ( $team->have_posts() ) : $team->the_post();
            $thumb_id = get_post_thumbnail_id();
            if ($thumb_id){
                $thumbImage  = wp_get_attachment_image_src($thumb_id,'catalog-img', true);
                $thumbBasket = wp_get_attachment_image_src($thumb_id,'single-gal-small', true);
            }

            ?>
            <div class="receipts_slider_col">
                <div class="receipts_slider_b">
                    <?php if( get_field('isNew') ): ?>
                        <div class="new_plash"><?php the_field('isNewWord','option');?></div>
                    <?php endif;?>
                    <a href="<?php the_permalink();?>" class="receipts_slider_img">
                        <?php if ($thumb_id):?>
                            <img src="<?= $thumbImage[0]?>" alt="<?php the_title();?>">
                        <?php endif;?>
                    </a>
                    <div class="receipts_slider_txt">
                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                        <p class="price"><?php the_field('price');?><span> грн</span></p>
                    </div>
                    <div class="receipts_slider_btn">
                        <?php if( get_field('inStock') ): ?>
                            <a  data-id     = "<?= get_the_ID();?>"
                                data-toggle = "modal"
                                data-target = "#popap-6"
                                data-img    = "<?= $thumbBasket[0] ?>"
                                data-price  = "<?php the_field('price'); ?>"
                                data-title  = "<?php the_title();?>"
                                class=" add_basket"><?php the_field('goToCartWord','option');?></a>
                        <?php endif;?>
                    </div>
                </div>
            </div>

        <?php endwhile; ?>
        </div>
    </div>
</div>
<?php endif;?>
<?php
wp_reset_query();
$brands = get_field('brands');?>
<?php if( $brands ): ?>
<div class="brands_section">
    <div class="container">
        <?php $post = get_post(230); ?>
        <h2><?= $post->post_title; ?></h2>
        <div class="brands_slider">
            <?php foreach ($brands as $brand):?>
                <?php $image = get_field('img',$brand);?>
                <div class="brands_slider_block">
                    <a href="<?= get_permalink(189) . '?idProduce=' . $brand->term_id ?>" class="brands_slider_img">
                        <img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>">
                    </a>
                </div>
            <?php endforeach;?>

        </div>
    </div>
</div>
<?php endif;?>
<div class="reviews_section">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="reviews_left clearfix">
                    <div class="why_choose_title">
                        <h2><?php the_field('titleWhy');?></h2>
                    </div>
                    <?php wp_reset_postdata(); wp_reset_query(); if( have_rows('why') ): ?>
                    <div class="row">
                        <?php while( have_rows('why') ): the_row();
                            $img = get_sub_field('img');
                            ?>
                            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                <div class="why_choose_block">
                                    <div class="why_choose_img">
                                        <img src="<?= $img['url'];?>" alt="<?=$img['url']?>">
                                    </div>
                                    <div class="why_choose_txt">
                                        <p><?php the_sub_field('text');?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile;?>
                    </div>
                    <?php endif;?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="reviews_right clearfix">
                    <div class="reviews_block_title">
                        <?php $post = get_post(40); ?>
                        <h2><?= $post->post_title; ?></h2>
                        <a href="<?= get_permalink($post); ?>"><?php the_field('allReviewsWord','option');?></a>
                    </div>
                    <?php
                    wp_reset_query();
                    $team = new WP_Query( [
                        'post_type' => 'reviews',
                        'showposts' => 3,
                        'meta_query' => [
                            [
                                'key'     => 'showMain',
                                'value'   => true,
                            ]
                        ],
                        'orderby' => 'date',
                        'order' => 'DESC',
                    ] );
                    ?>
                    <?php
                    if ( $team->have_posts() ) :?>
                        <div class="reviews_slider">
                            <?php
                            // Start the Loop.
                            $j=0;
                            while ( $team->have_posts() ) : $team->the_post();
                                $stars      = get_field('stars');
                                $productObj = get_post( get_the_ID() ,OBJECT );
                                ?>
                                <div class="reviews_slider_block">
                                    <strong><?php the_title();?>, <?php the_field('town');?>, <?= get_the_date('d.m.Y'); ?></strong>
                                    <?php the_content();?>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="backpack_section">
    <div class="container">
        <?php wp_reset_query();the_content();?>
    </div>
</div>
<?php get_footer();?>