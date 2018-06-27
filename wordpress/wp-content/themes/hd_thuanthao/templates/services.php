<?php
/*
 * Template Name: Dịch Vụ
 */
if (isset($_POST) && !empty($_POST)) {
    $nonce = $_REQUEST['_wpnonce'];
    if (!wp_verify_nonce($nonce, 'submit_register_form')) {
        $errs[] = "Form submit invalid!"; // Get out of here, the nonce is rotten!
    } else {
        $arrPost = [
                'post_author' => 1,
                'post_title' =>  'registration for ' . $_POST['full_name'],
                'post_status' =>  'publish',
                'post_type' =>  'information',
        ];
        $postId = wp_insert_post($arrPost);
        $postMeta = [
                'full_name',
                'address',
                'phone_number',
                'email',
                'introduce',
        ];
        foreach ($postMeta as $field) {
            update_post_meta($postId, $field, $_POST[$field]);
        }
    }
}

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
//Get data of study abroad
$params_filter_study_abroad = array(
    'posts_per_page' => 4,
    'post_type' => 'post',
    'category_name' => 'cam-nang-lao-dong-du-hoc-nhat-ban',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$studyAbroad = new WP_Query($params_filter_study_abroad);
//Get data of culture news
$params_filter_culture_news = array(
    'posts_per_page' => 4,
    'post_type' => 'post',
    'category_name' => 'bai-viet-dac-sac-van-hoa-nhat-ban',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$cultureNews = new WP_Query($params_filter_culture_news);
?>
<main class="content">
    <div class="container">
        <div class="_section _section--content">
            <div class="right_sidebar">
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
                <div class="box-content-thumb">
                    <h4 class="_title">
                        bài viết đặc sắc văn hóa Nhật Bản
                    </h4>
                    <ul class="collection collection--content">
                        <?php
                        if ($cultureNews->have_posts()) {
                            while ($cultureNews->have_posts()) {
                                $cultureNews->the_post();
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
            <div class="left_content">
                <div class="box-content-thumb">
                    <h4 class="_title">gửi đơn đăng ký</h4>
                    <div class="content_file_cv">
                        <form name="upload_register_file" method="post" enctype="multipart/form-data" onsubmit="return false">
                        <div class="content_file_cv--down">
                            <div class="box_dash_link" onclick="location.href='#'">
                                <img class="box_dash_link--img" src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/cloud-storage-download.png' ?>" alt=""/>
                                <p class="box_dash_link--title">Tải mẫu đơn đăng ký (Tiếng Việt)</p>
                            </div>
                            <div class="box_dash_link" onclick="location.href='#'">
                                <img class="box_dash_link--img" src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/cloud-storage-download.png' ?>" alt=""/>
                                <p class="box_dash_link--title">Tải mẫu đơn đăng ký (Tiếng Nhật)</p>
                            </div>
                        </div>
                        <p class="text_smaller">
                            - Tải mẫu đăng ký tại đây, sau khi điền đầy đủ thông tin vui lòng gửi kèm ở mục
                            [Tải lên file đăng ký ứng tuyển]
                        </p>
                        <div class="box_dash_link">
                            <input type="file" name="register_file" />
                            <img class="box_dash_link--img" src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/cloud-storage-download.png' ?>" alt=""/>
                            <p class="box_dash_link--title">Tải lên file đăng ký ứng tuyển</p>
                        </div>
                        <button class="btn waves-effect waves-light btn_submit" type="submit" name="action">
                            gửi
                        </button>
                        </form>
                    </div>
                </div>
                <div class="box-content-thumb">
                    <h4 class="_title">gửi thông tin đăng ký</h4>
                    <form class="col s12" action="<?php the_permalink(); ?>" name="register_form" method="post">
                        <div class="form_question">
                            <div class="row">
                                <div class="input-field col s3">
                                    <label for="full_name">Họ Tên <span>*</span></label>
                                </div>
                                <div class="input-field col s9">
                                    <input id="full_name" name="full_name" type="text" class="validate" placeholder="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <label for="address">Địa Chỉ<span>*</span></label>
                                </div>
                                <div class="input-field col s9">
                                    <input id="address" name="address" type="text" class="validate" placeholder="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <label for="phone_number">Điện Thoại<span>*</span></label>
                                </div>
                                <div class="input-field col s9">
                                    <input id="phone_number" name="phone_number" type="text" class="validate" placeholder="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <label for="email">Email<span>*</span></label>
                                </div>
                                <div class="input-field col s9">
                                    <input id="email" name="email" type="text" class="validate" placeholder="" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <label for="fullname">Giới thiệu bản thân</label>
                                </div>
                                <div class="input-field col s9">
                                    <textarea name="introduce" id="introduce" cols="30" rows="6"></textarea>
                                </div>
                            </div>
                            <button class="btn waves-effect waves-light btn_submit" type="submit" name="submit">
                                gửi <i class="material-icons right">send</i>
                            </button>
                        </div>
                        <?php wp_nonce_field('submit_register_form'); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>

