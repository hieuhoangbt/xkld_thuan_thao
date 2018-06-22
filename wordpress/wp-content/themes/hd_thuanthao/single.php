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
                <div class="box-content-thumb">
                    <h4 class="_title">
                        tuyển dụng mới
                    </h4>
                    <div class="orders order_resutls">
                        <?php
                        if ($recruitments->have_posts()) {
                            while ($recruitments->have_posts()) {
                                $recruitments->the_post();
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
                                    "recruitment_thumbnail");
                                ?>
                                <section class="item-order">
                                    <div class="thumb_img">
                                        <img src="<?php echo $image[0]; ?>" alt=""/>
                                    </div>
                                    <div class="thumb_ders">
                                        <p class="_title">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_title(); ?>
                                            </a>
                                        </p>
                                    </div>
                                </section>
                                <?php
                            }
                            wp_reset_query();
                        }
                        ?>
                    </div>
                </div>

                <div class="box-content-thumb">
                    <h4 class="_title">
                        hỏi đáp & tư vấn
                    </h4>
                    <div class="icon_asw">
                        <a href="#">
                            <img src="<?php echo HD_THUANTHAO_THEME_URL. '/assets/images/hoidap.png' ?>" alt=""/>
                        </a>
                    </div>
                </div>
                <div class="box-content-thumb">
                    <h4 class="_title">
                        tư vấn du học nhật bản
                    </h4>
                    <ul class="collection collection--content">
                        <?php
                        if ($advisory->have_posts()) {
                            while ($advisory->have_posts()) {
                                $advisory->the_post();
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
                                    "recruitment_thumbnail");
                                ?>
                                <li class="collection-item avatar">
                                    <img src="<?php echo $image[0]; ?>" alt="" class="circle">
                                    <span class="title">
                                    <a href="<?php echo the_permalink(); ?>">
                                        <?php echo get_the_title(); ?>
                                    </a>
                                </span>
                                    <p class="ders">
                                        <?php echo wp_trim_words(get_the_content(), 15, '...'); ?>
                                    </p>
                                </li>
                                <?php
                            }
                            wp_reset_query();
                        }
                        ?>
                    </ul>
                </div>

            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
