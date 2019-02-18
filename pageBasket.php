<?php
/*
Template Name: Корзина
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 10.08.2018
 * Time: 1:12
 */
get_header();?>
    <div class="basket_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="page_top">
            <div class="container">
                <h2><?php the_title()?></h2>
            </div>
        </div>
        <div class="container">
            <div class="basket_content">
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="cared-table">
                                    <div class="table-scrol">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th><?php the_field('tovarWord','option');?></th>
                                                <th><?php the_field('priceWord','option');?></th>
                                                <th><?php the_field('countWord','option');?></th>
                                                <th><?php the_field('sumWord','option');?></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(isset($_SESSION['basket']) && is_array($_SESSION['basket']) && count($_SESSION['basket'])>0){
                                                foreach($_SESSION['basket'] as $key => $value):?>

                                                    <tr class="basket_block" id="basket-<?=$key?>">
                                                        <td>
                                                            <div class="basket_block_close remove" data-key="<?=$key?>" data-mode="basket-<?=$key?>"></div>
                                                            <a href="<?php echo get_permalink($_SESSION['basket'][$key]['id']); ?>" class="tab-pic">
                                                                <img src="<?=$_SESSION['basket'][$key]['img']?>" alt=""></a>
                                                            <p class="tab-txt"><?=$_SESSION['basket'][$key]['title']?></p>
                                                        </td>
                                                        <td><p class="tab_price"><?=$_SESSION['basket'][$key]['price']?> грн.</p></td>
                                                        <td>
                                                            <div class="field-good-count">
                                                                <div class="numbers-row">
                                                                    <input type="text" name="quantity" data-key="<?=$key?>" class="count_item_basket" value="<?=$_SESSION['basket'][$key]['count']?>">
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td><p class="tab_price itemBasket-<?=$key?>"><?=$_SESSION['basket'][$key]['count'] * $_SESSION['basket'][$key]['price']?> грн.</p></td>
                                                    </tr>
                                                <?php endforeach;}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
<!--                            <div class="col-xs-12">-->
<!--                                <div class="basket_items"></div>-->
<!--                                <div class="promo_kod">-->
<!--                                    <div class="row">-->
<!--                                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-7">-->
<!--                                            <div class="promo_kod_form">-->
<!--                                                <form>-->
<!--                                                    <div class="form-group">-->
<!--                                                        <label class="validate">Промо-код:</label>-->
<!--                                                        <input class="form-control" type="text" name="name">-->
<!--                                                    </div>-->
<!--                                                    <button type="submit" class="bag_center_btn">Застосувати</button>-->
<!--                                                    <div class="sale_block">-->
<!--                                                        <div class="filter_top_b">-->
<!--                                                            <div class="filter_tb_txt">HAPPYHOURS -10%</div>-->
<!--                                                            <div class="filter_tb_img">-->
<!--                                                                <img src="image/blue_close.png" alt="">-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                        <div class="filter_top_b">-->
<!--                                                            <div class="filter_tb_txt">SUMMER2018 -50%</div>-->
<!--                                                            <div class="filter_tb_img">-->
<!--                                                                <img src="image/blue_close.png" alt="">-->
<!--                                                            </div>-->
<!--                                                        </div>-->
<!--                                                    </div>-->
<!--                                                </form>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-5">-->
<!--                                            <div class="promo_kod_txt">-->
<!--                                                <a class="promo_kod_txt_a" href="#">Де взяти промо-код?</a>-->
<!--                                                <p>Лишайте <a href="#">відгуки про роботу магазину</a> та про товар, а також слідкуйте за нами в соцмережах щоб не пропустити публікації з промо-кодами</p>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4">
                        <div class="basket_summary">
                            <div class="_summary_content">
                                <h3><?php the_field('resultWord','option');?></h3>
                                <div class="_summary_item">
                                    <p><?php the_field('yourOrderWord','option');?></p>
                                    <span><span class="all-price"><?= getBasketPrice(); ?></span> грн.</span>
                                </div>
<!--                                <div class="_summary_item">-->
<!--                                    <p>Знижка за промо-кодом</p>-->
<!--                                    <span>1 000 грн.</span>-->
<!--                                </div>-->
<!--                                <div class="_summary_item _summary_total">-->
<!--                                    <p>Всього</p>-->
<!--                                    <span>7 000 грн.</span>-->
<!--                                </div>-->
                                <a class="bag_center_btn" href="/ordering"><?php the_field('toOrderWord','option');?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>