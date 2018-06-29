<?php
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
