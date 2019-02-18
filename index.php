<?php
/**
 * Created by PhpStorm.
 * User: GeRtZ
 * Date: 20.05.2018
 * Time: 1:25
 */
get_header();
$thumb_id       = get_post_thumbnail_id();
if ($thumb_id)
    $thumb_url = wp_get_attachment_image_src($thumb_id,'full', true);
?>
    <div class="about_page">
        <?php get_template_part( 'template-parts/breadcrumbs' ); ?>
        <div class="page_top">
            <div class="container">
                <h1><?php the_title();?></h1>
            </div>
        </div>
        <?php if ($thumb_id):?>
            <div class="about_top">
                <div class="container">
                    <div class="about_top_img">
                        <img src="<?=$thumb_url[0];?>" alt="">
                    </div>
                </div>
            </div>
        <?php endif;?>
        <div class="about_content">
            <div class="container">
                <?php wp_reset_query();the_content();?>
            </div>
        </div>
        <?php if( have_rows('infoBlock') ): ?>
            <div class="dostavka_content">
                <div class="container">
                    <div class="row">
                        <?php while( have_rows('infoBlock') ): the_row();

                            // vars
                            $image = get_sub_field('img');

                            ?>
                            <div class="dostavka_block clearfix">
                                <div class="col-md-2 col-lg-1">
                                    <?php if ($image):?>
                                        <div class="dost_img">
                                            <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt'] ?>" />
                                        </div>
                                    <?php endif;?>
                                </div>
                                <div class="col-md-10 col-lg-11">
                                    <div class="dost_txt">
                                        <?php the_sub_field('text');?>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

<?php get_footer();?>