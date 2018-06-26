<?php
/*
 * Template Name: Tin Tức
 */
if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else {
    if (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
}
get_header();
$params_filter_news_and_event = array(
    'posts_per_page' => 7,
    'post_type' => 'post',
    'category_name' => 'tin-tuc-va-su-kien',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
    'paged' => $paged
);
$newsEvent = new WP_Query($params_filter_news_and_event);
//Get data of study abroad
$params_filter_study_abroad = array(
    'posts_per_page' => 5,
    'post_type' => 'post',
    'category_name' => 'cam-nang-lao-dong-du-hoc-nhat-ban',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$studyAbroad = new WP_Query($params_filter_study_abroad);
//get data of advisory
$params_filter_advisory = array(
    'posts_per_page' => 5,
    'post_type' => 'post',
    'category_name' => 'tu-van-du-hoc-nhat-ban',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$advisory = new WP_Query($params_filter_advisory);
?>
    <main class="content">
        <div class="container">
            <div class="_section _section--content">
                <div class="left_content">
                    <div class="box-content-thumb">
                        <h4 class="_title">tin tức & sự kiện</h4>
                        <div class="cards_result">
                            <?php
                            if ($newsEvent->have_posts()) {
                                $postCount = 1;
                                $outputList = '';
                                $output = '';
                                while ($newsEvent->have_posts()) {
                                    $newsEvent->the_post();
                                    if ($postCount == 1) {
                                        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
                                            "news_thumbnail");

                                        $output .= '<div class="card-hightlight">';
                                        $output .= '<div class="item">';
                                        $output .= '<div class="card">';
                                        $output .= '<div class="card-image">';
                                        $output .= '<img src="' . $image[0] . '">';
                                        $output .= '</div>';
                                        $output .= '<div class="card-content">';
                                        $output .= '<span class="card-title">';
                                        $output .= ' <a href="'. get_the_permalink().'">';
                                        $output .= get_the_title();
                                        $output .= '</a>';
                                        $output .= '</span>';
                                        $output .= '<p>';
                                        $output .= wp_trim_words(get_the_content(), 50, '...');
                                        $output .= '</div>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                        $output .= '</div>';
                                    } else {
                                        $imageList = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
                                            "highlight_thumbnail");
                                        $outputList .= '<div class="item">';
                                        $outputList .= '<div class="card">';
                                        $outputList .= '<div class="card-image" >';
                                        $outputList .= '<img src = "' . $imageList[0] . '" >';
                                        $outputList .= '</div >';
                                        $outputList .= '<div class="card-content" >';
                                        $outputList .= '<span class="card-title" >';
                                        $outputList .= '<a href = "'. get_the_permalink().'" >' . get_the_title() . '</a ></span >';
                                        $outputList .= '<p >';
                                        $outputList .= wp_trim_words(get_the_content(), 50, '...');
                                        $outputList .= '</p >';
                                        $outputList .= '</div >';
                                        $outputList .= '</div >';
                                        $outputList .= '</div >';
                                    }
                                    $postCount++;
                                }
                                wp_reset_query();
                            }
                            echo $output;
                            ?>
                            <div class="cards">
                                <?php echo $outputList; ?>
                            </div>
                        </div>
                        <div class="text-center pagi_result">
                            <ul class="pagination">
                                <?php
                                $total = $newsEvent->max_num_pages;
                                HD_ThuanThao_theme::pagination($total, $paged);
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="right_sidebar">
                    <div class="box-content-thumb">
                        <h4 class="_title">
                            hỏi đáp & tư vấn
                        </h4>
                        <div class="icon_asw">
                            <a href="#">
                                <img src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/hoidap.png' ?>" alt=""/>
                            </a>
                        </div>
                    </div>
                    <div class="box-content-thumb">
                        <h4 class="_title">
                            cẩm nang lao động du học nhật bản
                        </h4>
                        <ul class="collection collection--content">
                            <?php
                            if ($studyAbroad->have_posts()) {
                                while ($studyAbroad->have_posts()) {
                                    $studyAbroad->the_post();
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
                    <?php include(locate_template('sidebar-advisoryjapan.php')); ?>

                </div>
            </div>
        </div>
    </main>
<?php
get_footer();
?>