<?php
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 20.05.2018
 * Time: 1:25
 */
get_header();
$queried_object = get_queried_object();
$term_id        = $queried_object->term_id;
wp_reset_query();
$order  = (isset($_GET))? sanitize_text_field($_GET['order']) : 'order';
$paged  = ($_GET['page']) ? sanitize_text_field($_GET['page']) : 1;
$taxQuery = getTaxonomyQuery($_GET,true);
if ($taxQuery != null)
    $taxQuery[] = [
        'taxonomy' => 'category',
        'field'    => 'id',
        'terms'    => $queried_object->term_id
    ];
else
    $taxQuery[] = [
        'taxonomy' => 'category',
        'field'    => 'id',
        'terms'    => $queried_object->term_id
    ];

$team   = new WP_Query( [
    'post_type' => 'post',
    'showposts' => 12,
    'paged'     => $paged,
    'tax_query' => $taxQuery,
    'meta_query'=> getMetaArgsWpQuery($_GET),
    'orderby'   => 'meta_value_num',
    'meta_key'  => 'price',
    'order'     => $order,
] );
?>

    <div class="catalog_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="container">
            <div class="row">
                <div class="catalog_sidebar clearfix">
                    <div class="filter_open"></div>
                    <div class="col_sidebar">
                        <form>
                            <?php get_template_part( 'template-parts/filterSidebar' ); ?>
                            <div class="filter_sidebar">
                                <p class="filter_sidebar_title"><?php the_field('priceWord','option');?>, грн</p>
                                <div class="ranch">
                                    <input type="text" id="example_id" name="example_name" value="" />
                                </div>
                            </div>
                            <?= getFilterItems(get_field('actionsTaxNameWord','option'),'category_promo','promo',getArrayFromGet($_GET['idPromo']))?>
                        </form>
                    </div>
                </div>
                <div class="catalog_content clearfix">
                    <div class="page_top">
                        <h2><?= $queried_object->name; ?></h2>
                    </div>
                    <div class="filter_top">
                        <div class="catalog_top_block">
                            <div class="filter_top_b">
                                <div class="filter_tb_txt"><?= $queried_object->name; ?></div>
                                <a href="<?php the_permalink('189')?>" class="filter_tb_img">
                                    <img src="<?=get_template_directory_uri()?>/image/blue_close.png" alt="">
                                </a>
                            </div>
                        </div>
                        <div class="catalog_filter_reset">
                            <div class="catalog_filter_reset_l">
                                <p><?php the_field('pickedWord','option');?> <?= $team->post_count;?> <?php the_field('tovarWord','option');?> </p>
                                <a href="<?php the_permalink(189)?>"><?php the_field('filterResetWord','option');?></a>
                            </div>
                            <div class="catalog_filter_reset_r">
                                <p><?php the_field('sortWord','option');?></p>
                                <a ><?= getTextSorting();?></a>
                                <div class="cat_filtr_r_drop">
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn_lang dropdown-toggle" data-toggle="dropdown"
                                                aria-expanded="false">
                                            <span></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu">
                                            <li>
                                                <a href="<?= getUrlForSorting().'order=ASC';?>"><?php the_field('fromCheapToExpensiveWord','option');?></a>
                                            </li>
                                            <li>
                                                <a href="<?= getUrlForSorting().'order=DESC';?>"><?php the_field('fromExpensiveToCheapWord','option');?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="filter_open"><?php the_field('filterWord','option');?>...</div>
                    </div>
                    <div class="catalog_row">
                        <?php
                        if ( $team->have_posts() ) :
                            // Start the Loop.
                            $j = $thumb_id = 0;
                            while ( $team->have_posts() ) : $team->the_post();
                                $thumb_id = get_post_thumbnail_id();
                                $priceOld = get_field('priceOld');
                                if ($thumb_id){
                                    $thumbImage  = wp_get_attachment_image_src($thumb_id,'full', true);
                                    $thumbBasket = wp_get_attachment_image_src($thumb_id,'single-gal-small', true);
                                }

                                ?>
                                <div class="col_catalog">
                                    <div class="catalog_block">
                                        <?php if( get_field('isNew') ): ?>
                                            <div class="new_plash"><?php the_field('isNewWord','option');?></div>
                                        <?php endif;?>
                                        <a class="catalog_block_img" href="<?php the_permalink();?>">
                                            <?php if ($thumb_id):?>
                                                <img src="<?= $thumbImage[0]?>" alt="<?php the_title();?>">
                                            <?php endif;?>
                                        </a>
                                        <div class="catalog_block_content">
                                            <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                            <p class="price"><?php the_field('price');?><span> грн</span></p>
                                            <?php if (!empty($priceOld)): ?>
                                                <strong class="old_price"><?php the_field('priceOld'); ?> грн</strong>
                                            <?php endif; ?>
                                        </div>
                                        <div class="catalog_block_btn">
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
                        <?php endif;?>
                    </div>
                    <div class="pag_reviews">
                        <?php if (function_exists('kama_pagenavi')) kama_pagenavi('<ul>','</ul>',true,getUrlForPagination()); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="brands_page_txt">
        <div class="container">
            <?= $queried_object->desc; ?>
        </div>
    </div>

<?php get_footer();?>