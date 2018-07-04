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
            'post_title' => 'registration for ' . $_POST['full_name'],
            'post_status' => 'publish',
            'post_type' => 'information',
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
//get register form
$params_filter_register_form_vn = array(
    'post_type' => 'registrationform',
    'name' => 'tai-mau-don-dang-ki-tieng-viet',
    'post_status' => 'publish',
    'orderby' => 'post_date',
);
$registerFormVn = new WP_Query($params_filter_register_form_vn);

$params_filter_register_form_jp = array(
    'post_type' => 'registrationform',
    'name' => 'tai-mau-don-dang-ki-tieng-nhat',
    'post_status' => 'publish',
    'orderby' => 'post_date',
);
$registerFormJp = new WP_Query($params_filter_register_form_jp);

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
?>
<main class="content">
    <div class="container">
        <div class="_section _section--content">
            <div class="right_sidebar">
                <?php include(locate_template('sidebar-guidestudy.php')); ?>
                <?php include(locate_template('sidebar-culturenews.php')); ?>
            </div>
            <div class="left_content">
                <div class="box-content-thumb">
                    <h4 class="_title">gửi đơn đăng ký</h4>
                    <div class="content_file_cv">
                        <form name="upload_register_file" method="post" enctype="multipart/form-data"
                              onsubmit="return false">
                            <div class="content_file_cv--down">

                                <?php if ($registerFormVn->have_posts()) {
                                    while ($registerFormVn->have_posts()) {
                                        $registerFormVn->the_post();

                                    $dataRegisterFormVn = get_post_meta(get_the_ID());
                                    ?>
                                    <div class="box_dash_link"
                                         onclick="location.href='<?php echo $dataRegisterFormVn['registration_form_file_url'][0] ?>'">
                                        <img class="box_dash_link--img"
                                             src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/cloud-storage-download.png' ?>"
                                             alt=""/>
                                        <p class="box_dash_link--title">Tải mẫu đơn đăng ký (Tiếng Việt)</p>
                                    </div>
                                <?php }
                                    wp_reset_query();
                                } ?>

                                <?php if ($registerFormJp->have_posts()) {
                                while ($registerFormJp->have_posts()) {
                                    $registerFormJp->the_post();

                                $dataRegisterFormJp = get_post_meta(get_the_ID());
                                ?>
                                <div class="box_dash_link" onclick="location.href='<?php echo $dataRegisterFormJp['registration_form_file_url'][0] ?>'">
                                    <img class="box_dash_link--img"
                                         src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/cloud-storage-download.png' ?>"
                                         alt=""/>
                                    <p class="box_dash_link--title">Tải mẫu đơn đăng ký (Tiếng Nhật)</p>
                                </div>
                                <?php }
                                    wp_reset_query();
                                } ?>

                            </div>
                            <p class="text_smaller">
                                - Tải mẫu đăng ký tại đây, sau khi điền đầy đủ thông tin vui lòng gửi kèm ở mục
                                [Tải lên file đăng ký ứng tuyển]
                            </p>
                            <div class="box_dash_link">
                                <img class="box_dash_link--img"
                                     src="<?php echo HD_THUANTHAO_THEME_URL . '/assets/images/cloud-storage-download.png' ?>"
                                alt=""/>
                                <p class="box_dash_link--title">Tải lên file đăng ký ứng tuyển</p>
                                <input type="file" name="register_file" class="file_uploader"/>
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
                                    <input id="full_name" name="full_name" type="text" class="validate" placeholder=""
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <label for="address">Địa Chỉ<span>*</span></label>
                                </div>
                                <div class="input-field col s9">
                                    <input id="address" name="address" type="text" class="validate" placeholder=""
                                           required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s3">
                                    <label for="phone_number">Điện Thoại<span>*</span></label>
                                </div>
                                <div class="input-field col s9">
                                    <input id="phone_number" name="phone_number" type="text" class="validate"
                                           placeholder="" required>
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

