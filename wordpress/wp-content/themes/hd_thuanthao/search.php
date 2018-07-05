<?php
get_header();
$job_name = $_GET['s'];
$place = $_GET['place'];
$country = ($_GET['country'] == 1) ? "Nhật Bản" : "Đài Loan";

if (get_query_var('paged')) {
    $paged = get_query_var('paged');
} else {
    if (get_query_var('page')) {
        $paged = get_query_var('page');
    } else {
        $paged = 1;
    }
}

$args = array(
    'posts_per_page' => 8,
    'post_type' => 'recruitment',
    's' => $job_name,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
    'paged' => $paged
);
if (!empty($place)) {
    $args['meta_query'] = [
        [
            'key' => 'place',
            'value' => $place,
            'compare' => 'LIKE',
        ],
    ];
}
if (!empty($country)) {
    $args['meta_query'] = [
        [
            'key' => 'country',
            'value' => $country,
            'compare' => 'LIKE',
        ],
    ];
}

$recruitment_wp = new WP_Query($args);
$countryList = [
        'Nhật Bản',
        'Đài Loan'
];
?>
<main class="content">
    <div class="search-result">
        <form class="form-search">
            <div class="container">
                <div class="bg-white">
                    <div class="field-input">
                        <input type="text" name="s" value="<?php echo $job_name ?>" placeholder="Tên công việc">
                    </div>
                    <div class="field-input">
                        <input type="text" name="place" value="<?php echo $place ?>" placeholder="Tên địa điểm">
                    </div>
                    <div class="field-input">
                        <select name="country" class="browser-default">
                            <?php
                                foreach ($countryList as $key => $item) {
                                    $val = $key + 1;
                                    $selected = $val == $_GET['country'] ? 'selected' : '';
                                    echo '<option value="' . $val . '" ' . $selected . '>' . $item . '</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="field-input">
                        <button class="btn waves-effect waves-light" type="submit">
                            Tìm Kiếm
                        </button>
                    </div>

                </div>
            </div>
        </form>
    </div>
    <div class="container">
        <div class="_section _section--content">
            <div class="left_content">
                <div class="orders order_resutls">
                    <?php
                    if ($recruitment_wp->have_posts()) {
                        while ($recruitment_wp->have_posts()) {
                            $recruitment_wp->the_post();
                            $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
                                "search_thumbnail");
                            $data = get_post_meta(get_the_ID());
                            ?>
                            <section class="item-order">
                                <div class="thumb_img">
                                    <img src="<?php echo $image[0]; ?>" alt=""/>
                                </div>
                                <div class="thumb_ders">
                                    <p class="_title">
                                        <a href="<?php get_the_permalink(); ?>">
                                            <?php the_title(); ?>
                                        </a>
                                    </p>
                                    <p class="_date">
                                        <span><?php echo $data['company_recruiting'][0] ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
                                        <span><?php echo $data['place'][0] ?></span>&nbsp;&nbsp;|&nbsp;&nbsp;
                                        <span><?php echo $data['basic_salary'][0] ?></span>
                                    </p>
                                    <p class="_ders">
                                        <?php echo wp_trim_words(get_the_content(), 20, '...'); ?>
                                    </p>
                                </div>
                            </section>
                            <?php
                        }
                        wp_reset_query();
                    }
                    ?>

                </div>
                <div class="text-center pagi_result">
                    <ul class="pagination">
                        <?php
                        $total = $recruitment_wp->max_num_pages;
                            $arrQuery = [
                                    's' => $job_name,
                                    'place' => $place,
                                    'country' => $_GET['country'],
                            ];
                        HD_ThuanThao_theme::pagination($total, $paged, 'search', $arrQuery);
                        ?>
                    </ul>
                </div>
            </div>
            <div class="right_sidebar">
                <?php include(locate_template('sidebar-guidestudy.php')); ?>
                <?php include(locate_template('sidebar-question.php')); ?>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
