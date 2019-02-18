<?php
/*
Template Name: Результати пошуку
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 17.08.2018
 * Time: 23:37
 */;
$pageId = get_the_ID();
foreach ($_GET as $key => $val) {
    ${$key} = $val;
}
if (isset($idProduce))
    $idProduce = explode(",",$idProduce);
if (isset($idLicence))
    $idLicence = explode(",",$idLicence);
get_header();

wp_reset_query();
$order  = (isset($_GET))? sanitize_text_field($_GET['order']) : 'order';
$paged  = ($_GET['page']) ? sanitize_text_field($_GET['page']) : 1;
$taxQuery = getTaxonomyQuery($_GET,true);
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
                                <p class="filter_sidebar_title">Ціна, грн</p>
                                <div class="ranch">
                                    <input type="text" id="example_id" name="example_name" value="" />
                                </div>
                            </div>
                            <?= getFilterItems('Акції','category_promo','promo',getArrayFromGet($_GET['idPromo']))?>
                        </form>
                    </div>
                </div>
                <div class="catalog_content clearfix">
                    <div class="page_top">
                        <h2><?php the_title();?></h2>
                    </div>
                    <div class="filter_top">
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
                        <div class="filter_open">фільтр...</div>
                    </div>
                    <div class="catalog_row">
                        <?php
                        if ( $team->have_posts() ) :?>
                            <?php
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
                                            <div class="new_plash">Новинка!</div>
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
                                                    class=" add_basket">До кошика</a>
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
            <h3>СЕО-текст</h3>
            <p>Ідеальний вибір рюкзака – це коли рюкзак, який подобається дитині цілком влаштовує Вас, відповідаючи усім вимогам по комфортності, надійності і зручності виробу.
                Не секрет, що для дитини найважливішим є зовнішній вигляд рюкзака, хто на ньому зображений і т.д. Саме цьому важливо обговорити з дитиною як повинен виглядати майбутній рюкзак ще перед походом до магазину. Не варто противитись уподобанням вашої дитини. Бо, якщо ви купите ранець з улюбленими героями, то з’явиться більше шансів, що він буде його берегти, із задоволенням збирати і доглядати його. Навіть, якщо така річ буде подобатись йому не довго, тому що смаки швидко змінюються.</p>
            <p>Комфорт дитини під час користування рюкзаком залежить саме від розміру і якості лямок. Головне, що  необхідно  знати про лямки рюкзака – це те, що вони повинні бути достатньо  міцними і регульованими. Чим більша ширина лямок, тім зручніше їх носити на спині, і тим меншою відчувається вага рюкзака. Рекомендована ширина 4 -5 см. Якщо буде трохи ширше – теж добре.
            </p>
        </div>
    </div>
<?php get_footer();?>