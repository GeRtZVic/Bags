<?php get_header(); ?>
    <div class="search_result">
    <div class="catalog_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="container">
            <div class="row">
                <div class="catalog_content clearfix">
                    <div class="page_top">
                        <h2>Пошук</h2>
                    </div>
                    <div >
                        <?php
                        wp_reset_query();
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
                        $team = new WP_Query([
                            'post_type' => ['post','page'],
                            's'         => $s,
                            'paged'     => $paged,
                            'showposts' => 10,
                        ]);
                        if($team->have_posts()):?>
                            <?php while($team->have_posts()):$team->the_post();?>
                                <div class="search-box">
                                    <div class="search-head">
                                        <div class="search-top">
                                            <div class="search-title">
                                                <a href="<?php the_permalink();?>"><?php the_title(); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="search-body">
                                        <?php the_excerpt() ?>
                                    </div>
                                </div>

                            <?php endwhile;?>



                        <?php else:?>
                            <p>По вашему запросу ничего не найдено...</p>
                        <?php endif;?>
                    </div>
                    <div class="pag_reviews">
                        <?php if (function_exists('kama_pagenavi')) kama_pagenavi('<ul>','</ul>',true,getUrlForPagination()); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php get_footer();?>