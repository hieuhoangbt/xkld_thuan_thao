<?php
?>
<div class="box-content-thumb">
    <h4 class="_title">
        tuyển dụng mới
    </h4>
    <div class="orders order_resutls">
        <?php
        if ($recruitments->have_posts()) {
            while ($recruitments->have_posts()) {
                $recruitments->the_post();
                $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
                    "recruitment_thumbnail");
                ?>
                <section class="item-order">
                    <div class="thumb_img">
                        <img src="<?php echo $image[0]; ?>" alt=""/>
                    </div>
                    <div class="thumb_ders">
                        <p class="_title">
                            <a href="<?php echo get_the_permalink(); ?>">
                                <?php echo get_the_title(); ?>
                            </a>
                        </p>
                    </div>
                </section>
                <?php
            }
            wp_reset_query();
        }
        ?>
    </div>
</div>
