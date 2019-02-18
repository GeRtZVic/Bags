<?php
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 10.08.2018
 * Time: 0:25
 */


add_action('wp_ajax_add_basket', 'add_basket');
add_action('wp_ajax_nopriv_add_basket', 'add_basket');

function add_basket(){

    foreach ($_GET as $key => $val) {
        ${$key} = $val;
    }

    $count=(int)$count;
    $array_id='-1';

    if(isset($_SESSION['basket']) && is_array($_SESSION['basket'])>0){
        foreach($_SESSION['basket'] as $key => $value){
            if($value['id']==$id && $value['title']==$title && $value['price'] == $price && $value['weight']==$weight && $value['img']==$img){
                $count=$value['count']+$count;
                $array_id=$key;
                break;
            }
        }
    }

    if($array_id=='-1'){
        $_SESSION['basket'][]=array('id'=>$id,'title'=>$title,'price'=>$price,'weight'=>$weight,'img'=>$img,'count'=>$count);
    }else{
        $_SESSION['basket'][$key]['count']=$count;
    }
    echo (json_encode(array('basket_count'=>getBasketCount(),'basket_price'=>getBasketPrice())));
//    echo get_basket();
    wp_die();
}

add_action('wp_ajax_del_item', 'del_item');
add_action('wp_ajax_nopriv_del_item', 'del_item');

function del_item(){
    foreach ($_GET as $key => $val) {
        ${$key} = $val;
    }
    unset($_SESSION['basket'][$key]);
    echo (json_encode(array('basket_count'=>getBasketCount(),'basket_price'=>getBasketPrice())));
    // echo get_basket();number_format($basket_price, 0, ',', ' ')
    wp_die();
}

add_action('wp_ajax_change_count', 'change_count');
add_action('wp_ajax_nopriv_change_count', 'change_count');

function change_count(){
    foreach ($_GET as $key => $val) {
        ${$key} = $val;
    }
    $_SESSION['basket'][$key]['count'] = (int)$count_new;
    $new_price = (int)$_SESSION['basket'][$key]['price']*(int)$_SESSION['basket'][$key]['count'];
    echo (json_encode([
        'basket_count'  => getBasketCount(),
        'basket_price'  => getBasketPrice(),
        'item_price'    => $new_price,
    ]));
    wp_die();
}


add_action('wp_ajax_create_order', 'create_order');
add_action('wp_ajax_nopriv_create_order', 'create_order');

function create_order(){
    foreach ($_GET as $key => $val) {
        ${$key} = $val;
    }
    $today = date("d-m-Y");

    /*формування таблиці замовлення*/
    $table_order = '<table class="order">
						<tr>
							<td colspan="6"><b>Замовлення від '.$today.'</b></td>
						</tr>
						<tr>
							<td>Номер позиції</td>
							<td>Зображення</td>
							<td>Назва</td>
							<td>Кількість</td>
							<td>Ціна</td>
							<td>Сума</td>
						</tr>';
    if(isset($_SESSION['basket']) && is_array($_SESSION['basket'])){
        $i = 0;
        foreach($_SESSION['basket'] as $key => $value){
            $i++;
            $item_count = (int)$_SESSION['basket'][$key]['count'];
            $item_price = (int)$_SESSION['basket'][$key]['price'];
            $price_all += $item_count*$item_price;
            $item_sum = $item_count*$item_price;
            $table_order .= '<tr>
									<td>'.$i.'</td>
									<td><span class="order_img"><img src="'.$_SESSION['basket'][$key]['img'].'" height="35" alt=""/></span></td>
									<td>'.$_SESSION['basket'][$key]['title'].'</td>';
//									<td>'.get_field('numb',$_SESSION['basket'][$key]['id']).'</td>';

            $table_order .= '<td>'.$_SESSION['basket'][$key]['count'].'</td>
									<td>'.$_SESSION['basket'][$key]['price'].' грн</td>
									<td>'.($item_count*$item_price).' грн</td>
							</tr>';
        };



        $table_order .= "</tbody></table>
							<table align='right'>
							<tbody><tr>
							<td align='right'>Разом</td>
							<td align='right' width='80'>$price_all,0</td>
							</tr>
							<tr>
							<td align='right'>Доставка</td>
							<td align='right' width='80'>$delivery</td>
							</tr>
							</tbody></table>";

        //$price_all += $delprice;
        $table_order .= "
            Ім'я: $namef<br>
            Прізвище: $names<br>
            Телефон: $phone<br>
            Email: $email<br>";
        $post_title = "Замовлення від - $today";
        $new_post = array(
            'ID' => '',
            'post_author' => 1,
            'post_type' => 'orders',
            'post_content' => $table_order,
            'post_title' => $post_title,
            'post_status' => 'draft '
        );
        $id = wp_insert_post($new_post);
        update_field('status', 'новий', $id);
        $headers  = "Content-type: text/html; charset=utf-8 \r\n";
        $headers .= "From: <info@bags.com>\r\n";
        $to  = "<$email>" ;
        $subject = "Нове замовлення (info@bags.com) \r\n";
        $bool = mail($to, $subject, $table_order, $headers);
        unset($_SESSION['basket']);
        echo "Дякуємо за замовлення";
    }
    wp_die();
}

/**
 * @return int
 */
function getBasketCount(){
    if(isset($_SESSION['basket']) && is_array($_SESSION['basket']) && count($_SESSION['basket'])>0){
        $basketCount = 0;
        foreach($_SESSION['basket'] as $key => $value){
            $basketCount += $_SESSION['basket'][$key]['count'];
        }
        return $basketCount;
    }else
        return 0;
}

/**
 * @return int
 */
function getBasketPrice(){
    if(isset($_SESSION['basket']) && is_array($_SESSION['basket']) && count($_SESSION['basket'])>0){
        $basket_price = 0;
        foreach($_SESSION['basket'] as $key => $value){
            $basket_price += $_SESSION['basket'][$key]['count']*$_SESSION['basket'][$key]['price'];
        }
        return $basket_price;
    }else
        return 0;
}