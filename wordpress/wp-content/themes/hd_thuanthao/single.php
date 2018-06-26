<?php
$post_id = get_the_ID();
$paramsExceptCurrentFilter = array(
    'posts_per_page' => 2,
    'post__not_in' => [$post_id],
    'category_name' => get_the_category($post_id)[0]->slug,
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$listPostExceptCurrent = new WP_Query($paramsExceptCurrentFilter);

$params_filter_recruitment = array(
    'posts_per_page' => 8,
    'post_type' => 'recruitment',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$recruitments = new WP_Query($params_filter_recruitment);

//get data of advisory
$params_filter_advisory = array(
    'posts_per_page' => 4,
    'post_type' => 'post',
    'category_name' => 'tu-van-du-hoc-nhat-ban',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$advisory = new WP_Query($params_filter_advisory);
get_header();
?>

<main class="content">
    <div class="container">
        <div class="_section _section--content">
            <div class="left_content">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <div class="box-content-thumb">
                        <h4 class="_title">
                            <?php the_title(); ?>
                        </h4>
                        <div class="detail_ders">
                            <?php the_content(); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
                <?php endif; ?>
                <div class="box-content-thumb">
                    <h4 class="_title">
                        tin tức cùng chuyên mục
                    </h4>
                    <div class="cards_result">
                        <div class="cards">
                            <?php
                            if ($listPostExceptCurrent->have_posts()) {
                                while ($listPostExceptCurrent->have_posts()) {
                                    $listPostExceptCurrent->the_post();
                                    $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
                                        "highlight_thumbnail");
                                    ?>
                                    <div class="item">
                                        <div class="card">
                                            <div class="card-image">
                                                <img src="<?php echo $image[0]; ?>">
                                            </div>
                                            <div class="card-content">
                                            <span class="card-title">
                                                <a href="<?php echo the_permalink(); ?>"><?php echo the_title(); ?></a>
                                            </span>
                                                <p>
                                                    <?php echo wp_trim_words(get_the_content(), 40, '...'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                wp_reset_query();
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="right_sidebar">
                <?php include(locate_template('sidebar-newsrecruitment.php')); ?>
                <?php echo HD_ThuanThao_theme::hd_thuanthao_question_and_answer(); ?>
                <?php include(locate_template('sidebar-advisoryjapan.php')); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
