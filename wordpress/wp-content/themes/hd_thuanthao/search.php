<?php
get_header();
$job_name = $_GET['s'];
$place = $_GET['place'];
$country = ($_GET['country'] == 1) ? "Nhật Bản" : "Đài Loan";

$args = array(
    'post_type' => 'recruitment',
    's' => $job_name,
    'post_status' => 'publish',
    'orderby' => 'title',
    'order' => 'ASC',
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
?>
<main class="content">
    <div class="search-result">
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
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                    </ul>
                </div>
            </div>
            <div class="right_sidebar">
                <div class="box-content-thumb">
                    <h4 class="_title">
                        cẩm nang lao động du học nhật bản
                    </h4>
                    <ul class="collection collection--content">
                        <li class="collection-item avatar">
                            <img src="images/Layer%2019%20copy%202.png" alt="" class="circle">
                            <span class="title">
                                    <a href="">
                                        Du học sinh tại Nhật Bản sẽ bị quản lý giờ làm thêm?
                                    </a>
                                </span>
                            <p class="ders">
                                Cục Xuất nhập cảnh Nhật Bản đã quy định
                                giờ làm thêm tối đa đối với du học sinh...
                            </p>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/Layer%2019%20copy%202.png" alt="" class="circle">
                            <span class="title">
                                    <a href="#">
                                        Du học sinh tại Nhật Bản sẽ bị quản lý giờ làm thêm?
                                    </a>
                                </span>
                            <p class="ders">
                                Cục Xuất nhập cảnh Nhật Bản đã quy định
                                giờ làm thêm tối đa đối với du học sinh...
                            </p>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/Layer%2019%20copy%202.png" alt="" class="circle">
                            <span class="title">
                                    <a href="">
                                        Du học sinh tại Nhật Bản sẽ bị quản lý giờ làm thêm?
                                    </a>
                                </span>
                            <p class="ders">
                                Cục Xuất nhập cảnh Nhật Bản đã quy định
                                giờ làm thêm tối đa đối với du học sinh...
                            </p>
                        </li>
                        <li class="collection-item avatar">
                            <img src="images/Layer%2019%20copy%202.png" alt="" class="circle">
                            <span class="title">
                                    <a href="">
                                        Du học sinh tại Nhật Bản sẽ bị quản lý giờ làm thêm?
                                    </a>
                                </span>
                            <p class="ders">
                                Cục Xuất nhập cảnh Nhật Bản đã quy định
                                giờ làm thêm tối đa đối với du học sinh...
                            </p>
                        </li>
                    </ul>
                </div>
                <div class="box-content-thumb">
                    <h4 class="_title">
                        hỏi đáp & tư vấn
                    </h4>
                    <div class="icon_asw">
                        <a href="#">
                            <img src="images/hoidap.png" alt=""/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php get_footer(); ?>
