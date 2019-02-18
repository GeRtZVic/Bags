<div class="filter_sidebar">
    <ul class="sidebar_ul">
        <?php
        wp_reset_query();
        $category = get_categories( array(
            'taxonomy'      => 'category',
            'hide_empty'    => false,
            'parent'        => 0,
            'exclude'       => 1,
        ) );
        foreach ($category as $cat) {?>
            <li class="sidebar_li_title">
                <a class="_li_title_a" href="<?= get_term_link($cat); ?>"><?= $cat->name ?></a>
                <?php
                $subCategory = get_terms( array(
                    'taxonomy'      => 'category',
                    'parent'        => $cat->term_id,
                    'hide_empty'    => false,
                ) );
                if (isset($subCategory)):
                ?>
                <ul class="sidebar_li_toggle">
                    <?php foreach ($subCategory as $subCat):?>
                        <li><a href="<?= get_term_link($subCat); ?>"><?= $subCat->name ?> </a><span>(<?= $subCat->count ?>)</span></li>
                    <?php endforeach;?>
                </ul>
                <?php endif;?>
            </li>
        <?php } ?>
    </ul>
</div>