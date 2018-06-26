<?php
//get data of advisory
$params_filter_advisory = array(
    'posts_per_page' => 4,
    'post_type' => 'post',
    'category_name' => 'tu-van-du-hoc-nhat-ban',
    'post_status' => 'publish',
    'orderby' => 'post_date',
    'order' => 'DESC',
);
$advisory = new WP_Query($params_filter_advisory);
?>
<div class="box-content-thumb">
    <h4 class="_title">
        tư vấn du học nhật bản
    </h4>
    <ul class="collection collection--content">
        <?php
        if ($advisory->have_posts()) {
            while ($advisory->have_posts()) {
                $advisory->the_post();
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
