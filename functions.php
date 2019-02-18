<?php
include_once 'inc/postTypes.php';
include_once 'inc/themeSettings.php';
include_once 'inc/basketActions.php';
include_once 'inc/breadcrumbs.php';

add_action( 'wpcf7_before_send_mail', 'CF7_pre_send' );

function CF7_pre_send($cf7) {

    if ($cf7->id == 45) {

        $new_post = array(
            'ID'            => '',
            'post_author'   => 1,
            'post_type'     => 'reviews',
            'post_content'  => $_POST['textarea'],
            'post_title'    => $_POST['your-name'],
            'post_status'   => 'draft '
        );
        $id = wp_insert_post($new_post);

        update_field('email',   $_POST['your-email'],   $id);
        update_field('rating',  $_POST['stars'],        $id);
        update_field('town',    $_POST['your-town'],    $id);
        update_field('product', $_POST['id_product'],   $id);
    }
}

function register_my_widgets(){
    register_sidebar( [
        'name' => "Перемикач мов",
        'id' => 'lang-switcher',
        'description' => '',
        'before_title' => '',
        'after_title' => '',
        'before_widget' => '',
        'after_widget'  => "",
    ] );
}
add_action( 'widgets_init', 'register_my_widgets' );

function change_post_menu_label() {
    global $menu, $submenu;

    $menu[5][0] = 'Товари';
    $submenu['edit.php'][5][0] = 'Товари';
    echo '';
}
add_action( 'admin_menu', 'change_post_menu_label' );

/**
 * @param array $params
 * @return array
 */
function getArgsWpQuery(array $params)
{
    $meta_query_params = ['relation' => 'and'];
    $tax_query_params  = ['relation' => 'or'];

    $count_block = true;

    foreach ($params as $key => $value) {

        if ($key == 'type' || $key == 'room') {

            foreach ($value as $item) {

                $meta_query_params[] = [
                    'key'   => $key,
                    'value' => $item
                ];
            }

        } elseif ($key == 's_inp' || $key == 'fl_inp') {

            $meta_query_params[] = [
                'key'   => $key,
                'value' => explode(';',$value),
                'compare' => 'BETWEEN'
            ];

        } elseif ($key == 'block'){

            if ($count_block){
                $tax_query_params[] = [

                    'taxonomy' => 'category_k',
                    'field' => 'id',
                    'terms' => $value

                ];
                $count_block = false;
            }


        }

    }

    $args = [
        'post_type' => 'apartments',
        'posts_per_page' => -1,
        'tax_query' => [
            $tax_query_params
        ],
//        'meta_query' => $meta_query_params
    ];
    $i=0;
    return $args;
}

/**
 * @param string $before
 * @param string $after
 * @param bool $echo
 * @return string
 */
function kama_pagenavi($before='', $after='', $echo=true ,$urlPage) {

    /* ================ Настройки ================ */
    $text_num_page = ''; // текст для количества страниц. {current} заменится текущей, а {last} последней. Пример: 'Страница {current} из {last}' = Страница 4 из 60
    $num_pages = 1; // сколько ссылок показывать
    $stepLink = 1; // после навигации ссылки с определенным шагом (значение = число (какой шаг) или '', если не нужно показывать). Пример: 1,2,3...10,20,30
    $dotright_text = ''; // промежуточный текст "до".
    $dotright_text2 = ''; // промежуточный текст "после".
    $backtext = '«'; // текст "перейти на предыдущую страницу". Ставим '', если эта ссылка не нужна.
    $nexttext = '»'; // текст "перейти на следующую страницу". Ставим '', если эта ссылка не нужна.
    $first_page_text = ''; // текст "к первой странице" или ставим '', если вместо текста нужно показать номер страницы.
    $last_page_text = ''; // текст "к последней странице" или пишем '', если вместо текста нужно показать номер страницы.
    /* ================ Конец Настроек ================ */

    global $team;
    /* echo "<pre>";
    print_r($team);
    echo "</pre>"; */
    $posts_per_page = (int) $team->query_vars['posts_per_page'];
    $paged = (int) $team->query_vars['paged'];

    $max_page = $team->max_num_pages;

    if($max_page <= 1 ) return false; //проверка на надобность в навигации

    if(empty($paged) || $paged == 0) $paged = 1;
// echo $paged;
    $pages_to_show = intval($num_pages);
    $pages_to_show_minus_1 = $pages_to_show-1;

    $half_page_start = floor($pages_to_show_minus_1/2); //сколько ссылок до текущей страницы
    $half_page_end = ceil($pages_to_show_minus_1/2); //сколько ссылок после текущей страницы

    $start_page = $paged - $half_page_start; //первая страница
    $end_page = $paged + $half_page_end; //последняя страница (условно)

    if($start_page <= 0) $start_page = 1;
    if(($end_page - $start_page) != $pages_to_show_minus_1) $end_page = $start_page + $pages_to_show_minus_1;
    if($end_page > $max_page) {
        $start_page = $max_page - $pages_to_show_minus_1;
        $end_page = (int) $max_page;
    }

    if($start_page <= 0) $start_page = 1;

    $out=''; //выводим навигацию <li><a href="#">1</a></li>
//     echo $paged.'asdasd';
    $out = $before;
    $st = $paged-1;

    if ($paged!=1)
        $out .= '<li class="pager-prev"><a class="pager-arrow" href="'.rtrim($urlPage . "page=$st", '/').'"></a></li>';

    for($i = 1; $i <= $max_page; $i++) {
        if($i == $paged) {
            $out.= '<li><a >'.$i.'</a></li>';
        } else {
            $out.= '<li><a href="'.rtrim($urlPage . "page=$i", '/').'">'.$i.'</a></li>';
        }
    }
    $st = $paged+1;
    if ($paged!=$max_page)
        $out.= '<li class="pager-next"><a class="pager-arrow" href="'.rtrim($urlPage . "page=$st", '/').'"></a></li>';
    $out.= $after."\n";

    if ($echo) echo $out;
    else return $out;
}

/**
 * @return string
 */
function getUrlForPagination(){
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $urlParts = explode("?",$url);
    if (count($urlParts) == 1)
        return $url."?";

    $getParts = explode("&",$urlParts[1]);
    foreach ($getParts as $key => $value){
        $pos = strripos($value, "page");
        if ($pos === false) {
        } else {
            unset($getParts[$key]);
        }
    }
    return $urlParts[0]."?".implode('&',$getParts)."&";
}

/**
 * @return string
 */
function getUrlForSorting(){
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    $urlParts = explode("?",$url);
    if (count($urlParts) == 1)
        return $url."?";

    $getParts = explode("&",$urlParts[1]);
    foreach ($getParts as $key => $value){
        $pos = strripos($value, "order");
        if ($pos === false) {
        } else {
            unset($getParts[$key]);
        }
    }
    return $urlParts[0]."?".implode('&',$getParts)."&";
}

/**
 * @param string $title
 * @param $taxonomy
 * @param $inputName
 * @param $arrayIdCheck
 * @return null|string
 */
function getFilterItems($title = '', $taxonomy, $inputName, $arrayIdCheck, $categoryId = null){
    $html = "<div class='filter_sidebar'>
                <p class='filter_sidebar_title'>{$title}</p>";
    $checkedText = "";
    
    if ($taxonomy){
        $category = get_terms( array(
            'taxonomy'      => sanitize_text_field($taxonomy),
            'hide_empty'    => false,
        ) );
        foreach ($category as $cat) {

            if (isset($arrayIdCheck) && is_array($arrayIdCheck)){
                if (in_array($cat->term_id,$arrayIdCheck)){
                    $checkedText = "checked";
                }else{
                    $checkedText = "";
                }
            }

            if (is_null($categoryId)){
                $countPosts = $cat->count;
            }else{
                $bags = new WP_Query( [
                    'post_type' => 'post',
                    'showposts' => -1,
                    'tax_query' => [
                        'relation' => 'AND',
                        [
                            'taxonomy' => 'category',
                            'field'    => 'id',
                            'terms'    => $categoryId
                        ],
                        [
                            'taxonomy' => sanitize_text_field($taxonomy),
                            'field'    => 'id',
                            'terms'    => $cat->term_id
                        ],
                    ],
                    'meta_query'=> getMetaArgsWpQuery($_GET),
                ] );
                $countPosts = $bags->post_count;
                wp_reset_query();
            }

            $html .= "<div class='radio'>
                        <input type='checkbox' $checkedText class='filter-item' name='$inputName' id='radio-$cat->term_id' value='$cat->term_id'>
                        <label for='radio-$cat->term_id'> $cat->name  <span>( $countPosts )</span></label>
                    </div>";
        }
    }else{
        return null;
    }
    $html .= '</div>';

    return $html;
}

/**
 * @param $requestString
 * @return array|null
 */
function getArrayFromGet($requestString){
    $request = sanitize_text_field($requestString);

    if (isset($request)){

        $arrayId = explode(",",$request);
        foreach ($arrayId as $key => $id){
            if (!is_numeric($id))
                unset($arrayId[$key]);
        }

        return $arrayId;
    }else
        return null;
}

/**
 * @param array $Request
 * @return array|null
 */
function getMetaArgsWpQuery(array $Request){
    if (empty($Request['price']))
        return null;

    $priceRange = explode(';',sanitize_text_field($Request['price']));
    if (count($priceRange)!=2)
        return null;

    return [
        [
            'key'     => 'price',
            'value'   => $priceRange,
            'type'    => 'numeric',
            'compare' => 'BETWEEN'
        ]
    ];
}

/**
 * @param $Request
 * @param bool $forCategory
 * @return array|null
 */
function getTaxonomyQuery($Request,$forCategory = false){
    if (empty($Request))
        return null;
    $produce    = getArrayFromGet($Request['idProduce']);
    $licence    = getArrayFromGet($Request['idLicence']);
    $sex        = getArrayFromGet($Request['idSex']);
    $promo      = getArrayFromGet($Request['idPromo']);

    $taxonomyArr = $taxQuery = [];

    if ($produce != null){
        $taxonomyArr[] = [
            'taxonomy'  => 'category_produce',
            'field'     => 'id',
            'terms'     => $produce
        ];
    }

    if ($licence != null){
        $taxonomyArr[] = [
            'taxonomy'  => 'category_licence',
            'field'     => 'id',
            'terms'     => $licence
        ];
    }

    if ($sex != null){
        $taxonomyArr[] = [
            'taxonomy'  => 'category_sex',
            'field'     => 'id',
            'terms'     => $sex
        ];
    }

    if ($promo != null){
        $taxonomyArr[] = [
            'taxonomy'  => 'category_promo',
            'field'     => 'id',
            'terms'     => $promo
        ];
    }

    if (count($taxonomyArr)>1 || $forCategory){
        $taxQuery['relation'] = 'AND';
    }else{
        return $taxonomyArr;
    }

    foreach ($taxonomyArr as $arr){
        $taxQuery[] = $arr;
    }

    return $taxQuery;
}

/**
 * @return mixed|null|void
 */
function getTextSorting(){
    $order = isset( $_GET['order'] ) ? trim( $_GET['order'] ) : '';
    switch ($order){
        case 'DESC':
            return get_field('fromExpensiveToCheapWord','option');
        case 'ASC':
            return get_field('fromCheapToExpensiveWord','option');
        default :
            return get_field('fromCheapToExpensiveWord','option');
    }
    return null;
}

/**
 * @return string
 */
function getPriceValueForFilter(){
    return isset($_GET['price']) ? explode(';', trim($_GET['price'])) : '';
}