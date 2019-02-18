<?php
/*
Template Name: Оформлення
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 12.08.2018
 * Time: 1:08
 */
get_header();?>
    <div class="order_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="page_top">
            <div class="container">
                <h2><?php the_title();?></h2>
            </div>
        </div>
        <div class="container">
            <div class="order_content">
                <div class="row">
                    <form onsubmit="return false;" id="orderform">
                        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
                            <div class="order_items">
                                <div class="dani_form clearfix">
                                    <h3>Дані для замовлення</h3>
                                    <div class="form-group">
                                        <label class="validate">Ім’я:</label>
                                        <input class="form-control validateInput" title="Ім’я" type="text" name="namef">
                                    </div>
                                    <div class="form-group">
                                        <label class="validate">Прізвище:</label>
                                        <input class="form-control validateInput" title="Прізвище" type="text" name="names">
                                    </div>
                                    <div class="form-group">
                                        <label class="validate">Телефон:</label>
                                        <input class="form-control validateInput" title="Телефон" type="tel" name="phone">
                                    </div>
                                    <div class="form-group">
                                        <label class="validate">Email:</label>
                                        <input class="form-control validateInput" title="Email" type="email" name="email">
                                    </div>
                                </div>
                                <div class="dost_form dani_form clearfix">
                                    <h3>Доставка</h3>
                                    <div class="radio_form">
                                        <div class="radio">
                                            <input type="radio" name="delivery" id="radio-1" value="Нова пошта">
                                            <label for="radio-1">Нова пошта <span>(від 40 грн.)</span></label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="delivery" id="radio-2" value="Укрпошта">
                                            <label for="radio-2">Укрпошта <span>(від 40 грн.)</span></label>
                                        </div>
                                        <div class="radio">
                                            <input type="radio" name="person" id="radio-3" value="Самовивіз" checked>
                                            <label for="radio-3">Самовивіз <span>(безкоштовно)</span></label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="validate">Адреса доставки:</label>
                                        <input class="form-control validateInput" title="місто, відділення НовоїПошти або Укрпошти" type="text" name="address">
                                    </div>
<!--                                    <div class="form-group">-->
<!--                                        <label class="validate">Місто:</label>-->
<!--                                        <select data-display="Select">-->
<!--                                            <option>Хмельницький</option>-->
<!--                                            <option>Дніпро</option>-->
<!--                                            <option>Київ</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
<!--                                    <div class="form-group">-->
<!--                                        <label class="validate">Відділення:</label>-->
<!--                                        <select data-display="Select">-->
<!--                                            <option>№1</option>-->
<!--                                            <option>№2</option>-->
<!--                                            <option>№3</option>-->
<!--                                        </select>-->
<!--                                    </div>-->
                                </div>
                                <div class="payment_form dani_form clearfix">
                                    <h3>Оплата</h3>
                                    <div class="form-group">
                                        <div class="radio_form">
                                            <div class="radio">
                                                <input type="radio" name="payment" id="radio-4" value="При отриманні" checked>
                                                <label for="radio-4">При отриманні</label>
                                            </div>
                                            <div class="radio">
                                                <input type="radio" name="payment" id="radio-5" value="На картку">
                                                <label for="radio-5">На картку</label>
                                            </div>
<!--                                            <div class="radio">-->
<!--                                                <input type="radio" name="payment" id="radio-6" value="">-->
<!--                                                <label for="radio-6">Накладений платіж <span>(+2% за переказ грошей)</span></label>-->
<!--                                            </div>-->
                                        </div>
<!--                                        <a href="#">Видалити коментар</a>-->
                                        <label class="control-label">Коментар:</label>
                                        <textarea name="message" class="form-control"></textarea>
                                        <p class="help-block help-block-error"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="hidden-xs hidden-sm col-md-2 col-lg-4"></div>
                        <div class="col-xs-12 col-sm-6 col-md-5 col-lg-4">
                            <div class="order_summary">
                                <div class="_summary_content">
                                    <?php the_field('resultWord','option');?></h3>
                                    <div class="_summary_item">
                                        <p><?php the_field('yourOrderWord','option');?></p>
                                        <span><?= getBasketPrice(); ?> грн.</span>
                                    </div>
<!--                                    <div class="_summary_item">-->
<!--                                        <p>Знижка за промо-кодом</p>-->
<!--                                        <span>1 000 грн.</span>-->
<!--                                    </div>-->
<!--                                    <div class="_summary_item _summary_total">-->
<!--                                        <p>Всього</p>-->
<!--                                        <span>7 000 грн.</span>-->
<!--                                    </div>-->
                                </div>
                                <a href="/basket"><?php the_field('editOrderWord','option');?></a>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <div class="order_btn">
<!--                                <button type="submit" data-toggle="modal" data-target="#popap-5">Підтверджую замовлення</button>-->
                                <button type="submit" rel="orderform" class="send_button">Підтверджую замовлення</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();?>