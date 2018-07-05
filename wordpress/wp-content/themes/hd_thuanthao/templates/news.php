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
                    <?php include(locate_template('sidebar-question.php')); ?>
                    <?php include(locate_template('sidebar-guidestudy.php')); ?>
                    <?php include(locate_template('sidebar-advisoryjapan.php')); ?>

                </div>
            </div>
        </div>
    </main>
<?php
get_footer();
?>