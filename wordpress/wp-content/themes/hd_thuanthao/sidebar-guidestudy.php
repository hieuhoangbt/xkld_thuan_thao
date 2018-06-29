<?php
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
?>
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
