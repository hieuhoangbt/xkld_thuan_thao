<?php
get_header();
$post_id = get_the_ID();
$data = get_post_meta($post_id);

//Get news recruitment
$recruitmentPerPage = 8;
$params_filter_recruitment = array(
    'posts_per_page' => $recruitmentPerPage,
    'post__not_in' => [$post_id],
    'post_type' => 'recruitment',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$recruitments = new WP_Query($params_filter_recruitment);
?>
<main class="content">
    <div class="container">
        <div class="_section _section--content">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <div class="left_content">
                    <div class="box-content-thumb">
                        <h4 class="_title color-title">
                            <?php the_title(); ?>
                        </h4>
                        <div class="detail_ders">
                            <?php the_content(); ?>
                            <div class="content_reponsive">
                                <table class="table_detail striped">
                                    <tbody>
                                    <tr>
                                        <td>Ngày phỏng vấn</td>
                                        <td><?php echo date_format(date_create($data['date_interview'][0]), 'd/m/Y'); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Công việc cụ thể</td>
                                        <td>
                                            <?php echo $data['specific_work'][0] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Thời hạn hợp đồng</td>
                                        <td><?php echo $data['life_of_contract'][0] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Địa điểm</td>
                                        <td><?php echo $data['place'][0] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Quốc gia</td>
                                        <td><?php echo $data['country'][0] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Thời gian làm việc</td>
                                        <td><?php echo $data['time_to_work'][0] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Mức Lương cơ bản</td>
                                        <td><?php echo $data['basic_salary'][0] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Yêu cầu</td>
                                        <td>
                                            <?php echo nl2br($data['require'][0]); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Số Lượng Tuyển</td>
                                        <td>
                                            <?php echo $data['total'][0] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày nghỉ</td>
                                        <td>
                                            <?php echo $data['day_off'][0] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Phúc lợi khác</td>
                                        <td>
                                            <?php echo $data['benefit'][0] ?>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p>
                                <b>Trung tâm tư vấn du học và việc làm Nhật Bản - Đài Loan</b>
                            </p>
                            <p>
                                Liên hệ đăng ký tham gia tuyển dụng lao động:
                            </p>
                            <p>
                                Văn phòng công ty: <b><?php echo $data['company_name'][0]; ?></b>
                            </p>
                            <p>
                                Địa chỉ: <b><?php echo $data['office_address'][0]; ?></b>
                            </p>
                            <p>
                                Số Điện Thoại: <b><?php echo $data['company_phone'][0]; ?></b>
                            </p>

                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
            <div class="right_sidebar">
                <?php include(locate_template('sidebar-newsrecruitment.php')); ?>
                <?php echo HD_ThuanThao_theme::hd_thuanthao_question_and_answer(); ?>
                <?php include(locate_template('sidebar-advisoryjapan.php')); ?>

            </div>
        </div>
    </div>
</main>

<?php get_footer() ?>
