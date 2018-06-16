<?php
/*
 * Template Name: Trang chủ
 */
get_header();
$params_filter_recruitment = array(
    'posts_per_page' => 3,
    'post_type' => 'recruitment',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$recruitments = new WP_Query($params_filter_recruitment);

$params_filter_post = array(
    'posts_per_page' => 1,
    'post_type' => 'post',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$posts = new WP_Query($params_filter_post);
?>
<main class="content">
    <div class="banner_home">
        <?php echo HD_ThuanThao_theme::hd_thuanthao_banner(); ?>
        <form class="form-search">
            <div class="container">
                <div class="bg-white">
                    <div class="field-input">
                        <input type="text" placeholder="Tên công việc">
                    </div>
                    <div class="field-input">
                        <input type="text" placeholder="Tên địa điểm">
                    </div>
                    <div class="field-input">
                        <select class="browser-default">
                            <option value="1">Nhật Bản</option>
                            <option value="2">Đài Loan</option>
                        </select>
                    </div>
                    <div class="field-input">
                        <button class="btn waves-effect waves-light" type="submit" name="action">
                            Tìm Kiếm
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="_section bg-fff">
        <div class="container">
            <h2 class="header header--title">Tin Tuyển Dụng</h2>
            <div class="orders">
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
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </p>
                                <p class="_date"><?php echo get_post_time('H:i') . ' - ' . get_the_date('d-m-Y'); ?></p>
                                <p class="_ders">
                                    <?php echo wp_trim_words(get_the_content(), 50, '...'); ?>
                                </p>
                            </div>
                        </section>
                        <?php
                    }
                    wp_reset_query();
                }
                ?>
                <input type="hidden" id="recruitment-append">
            </div>
            <div class="text-center">
                <a class="btn-loadmore recruitment-load-more" href="#">xem thêm</a>
            </div>
        </div>
    </div>
    <div class="bg-gray">
        <div class="container">
            <div class="_section">
                <h2 class="header header--title">Danh Sách Công Ty Tuyển Dụng</h2>
                <div class="slide_partner">
                    <div class="item">
                        <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/prt_1280px-Dai-ichi_Life_logo.svg.png' ?>"
                             alt=""/>
                    </div>
                    <div class="item">
                        <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/prt_dentsu-X_TL.png' ?>" alt=""/>
                    </div>
                    <div class="item">
                        <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/prt_hiashi.vn_logo.png' ?>"
                             alt=""/>
                    </div>
                    <div class="item">
                        <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/prt_iso.png' ?>" alt=""/>
                    </div>
                    <div class="item">
                        <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/prt_logo-enuy-final-01.png' ?>"
                             alt=""/>
                    </div>
                    <div class="item">
                        <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/prt_1280px-Dai-ichi_Life_logo.svg.png' ?>"
                             alt=""/>
                    </div>
                    <div class="item">
                        <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/prt_logo-kobelco.png' ?>" alt=""/>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="_section bg-fff">
        <div class="container">
            <h2 class="header header--title">Tin Tức Nổi Bật</h2>
            <div class="cards">
                <?php
                if ($posts->have_posts()) {
                    while ($posts->have_posts()) {
                        $posts->the_post();
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
                                        <a href="#"><?php echo the_title(); ?></a>
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
                <input type="hidden" id="news-append">
            </div>
            <div class="text-center load_card">
                <a class="btn-loadmore news-load-more" href="#">xem thêm</a>
            </div>
        </div>
    </div>
</main>
<?php get_footer() ?>
