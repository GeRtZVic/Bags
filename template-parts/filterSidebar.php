<?php get_template_part( 'template-parts/filterCategory' ); ?>
<?php
$quriedObject = get_queried_object();
if (is_category($quriedObject)){
    $catId = $quriedObject->term_id;
}else{
    $catId = null;
}
?>
<?= getFilterItems(get_field('producerTaxNameWord','option'),'category_produce','produce',getArrayFromGet($_GET['idProduce']),$catId)?>
<?= getFilterItems(get_field('licenceTaxNameWord','option'),'category_licence','licence',getArrayFromGet($_GET['idLicence']),$catId)?>
<?= getFilterItems(get_field('sexTaxNameWord','option'),'category_sex','sex',getArrayFromGet($_GET['idSex']),$catId)?>

