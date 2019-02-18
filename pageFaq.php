<?php
/*
Template Name: Faq
*/
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 20.05.2018
 * Time: 1:25
 */
get_header();
?>
    <div class="question_page">
        <div class="block-breadcrumb">
            <div class="container">
                <ol class="breadcrumb">
                    <li><a href="<? site_url();?>">Головна</a></li>
                    <li class="active">Часті питання</li>
                </ol>
            </div>
        </div>
        <div class="page_top">
            <div class="container">
                <h1><?php the_title();?></h1>
            </div>
        </div>
        <div class="container">
            <div class="question_content">
                <?php
                wp_reset_query();
                $team = new WP_Query( [
                    'post_type'      => 'faq',
                    'posts_per_page' => -1,
                ] );
                $i = 0;
                if ( $team->have_posts() ) :
                    while ( $team->have_posts() ) : $team->the_post();$i++;?>
                        <div class="question_block">
                            <div class="question_block_top">
                                <div class="close_question"></div>
                                <h3><?= $i ?>. <?php the_title();?></h3>
                            </div>
                            <div class="question_block_content">
                                <?php the_content();?>
                            </div>
                        </div>
                    <?php endwhile;
                else :
                endif;
                wp_reset_query();
                ?>
            </div>
        </div>
    </div>
<?php get_footer();?>