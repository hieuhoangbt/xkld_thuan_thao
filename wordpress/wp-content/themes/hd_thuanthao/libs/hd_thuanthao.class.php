<?php

class HD_ThuanThao_theme
{

    public static function run()
    {
        add_action('after_setup_theme', function () {
            add_theme_support('post-thumbnails');
            add_image_size('recruitment_thumbnail', 168, 126, array('center', 'center'));
            add_image_size('highlight_thumbnail', 356, 267, array('center', 'center'));
            add_image_size('news_thumbnail', 737, 458, array('center', 'center'));
            add_image_size('search_thumbnail', 144, 33, array('center', 'center'));
        });
        //Register menu
        add_action('init', function () {
            register_nav_menu('primary', __('HD ThuanThao Menu', 'thuanthao'));
        });


        add_action('wp_enqueue_scripts', function () {
            //Insert style
            wp_enqueue_style('main', HD_THUANTHAO_THEME_URL . '/assets/css/main.css');

            wp_enqueue_style('slick_css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');

            //Insert script
            wp_enqueue_script('jquery');
            wp_register_script('start', HD_THUANTHAO_THEME_URL . '/assets/js/start.js');
            wp_enqueue_script('start');

            wp_register_script('slick', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
            wp_enqueue_script('slick');

            wp_register_script('xkld-script', HD_THUANTHAO_THEME_URL . '/assets/js/xkld-script.js');
            wp_localize_script('xkld-script', 'ajax_recruitment', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'noposts' => __('No older posts found', 'xkld-script'),
            ));
            wp_localize_script('xkld-script', 'ajax_post', array(
                'ajaxurl' => admin_url('admin-ajax.php'),
                'noposts' => __('No older posts found', 'xkld-script'),
            ));
            wp_enqueue_script('xkld-script');
        });


        add_action('wp_ajax_nopriv_more_recruitment_ajax', 'more_recruitment_ajax');
        add_action('wp_ajax_more_recruitment_ajax', 'more_recruitment_ajax');

        add_action('wp_ajax_nopriv_more_post_ajax', 'more_post_ajax');
        add_action('wp_ajax_more_post_ajax', 'more_post_ajax');


        add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);
    }

    public static function hd_thuanthao_logo()
    {
        printf('<a href="%s" class="brand-logo"><img src="%s" alt="%s"/></a>', get_home_url('/'),
            HD_THUANTHAO_THEME_URL . '/assets/images/logo.png', get_bloginfo('name'));
    }

    public static function hd_thuanthao_facebook_logo()
    {
        printf('<a href="%s"><img src="%s" alt="%s"/></a>',
            "#", HD_THUANTHAO_THEME_URL . '/assets/images/facebook-logo-button.svg',
            get_bloginfo('name'));
    }

    public static function hd_thuanthao_banner()
    {
        printf('<img class="banner_home--thumb" src="%s" alt="%s"/>',
            HD_THUANTHAO_THEME_URL . '/assets/images/banner.jpg',
            get_bloginfo('name'));
    }

    public static function hd_thuanthao_instagram_logo()
    {
        printf('<a href="%s"><img src="%s" alt="%s"/></a>',
            "#", HD_THUANTHAO_THEME_URL . '/assets/images/instagram-logo.svg',
            get_bloginfo('name'));
    }

    public static function hd_thuanthao_question_and_answer()
    {
        printf('<div class="box-content-thumb"><h4 class="_title">hỏi đáp & tư vấn</h4><div class="icon_asw"><a href="#"><img src="%s" alt="%s"/></a></div></div>',
            HD_THUANTHAO_THEME_URL . '/assets/images/hoidap.png',
            get_bloginfo('name'));
    }


    public static function hd_thuanthao_menu()
    {
        return wp_nav_menu(array(
            'menu' => 'primary',
            'theme_location' => 'primary',
            'depth' => 1,
            'container' => 'ul',
            'container_class' => '',
            'menu_class' => 'right hide-on-med-and-down',
            'menu_id' => 'nav - mobile',
            'walker' => new wp_bootstrap_navwalker(),
            'echo ' => false,
        ));
    }

    public static function pagination($total, $paged, $link = null, $query = null)
    {
        if ($total > 1) {
            $next = $paged + 1;
            $pre = $paged - 1;
            $firstPaged = 1;
            $lastPaged = $total;
            $displayLastPage = true;
            $link = $link ? $link : get_permalink();
            if ($link == 'search') {
                $link = '';
            }
            if ($query) {
                $query = '&' . http_build_query($query);
            }
            //Pre button
            if ($paged > 1) {
                echo '<li><a href=" ' . $link . '?page=' . $pre . $query . '"><i class="material-icons">chevron_left</i></a></li>';
            }
            /**
             * Paging
             */
            if ($total < 5) {
                for ($i = 1; $i <= $total; $i++) {
                    if ($i == $paged) {
                        echo '<li class="active"><a>' . $i . '</a></li>';
                    } else {
                        echo '<li class="waves-effect"><a href=" ' . $link . '?page=' . $i . $query .'">' . $i . '</a></li>';
                    }
                }
            } else {
                if ($paged >= 1) {
                    if ($firstPaged == $paged) {
                        echo '<li class="active"><a>' . $firstPaged . '</a></li>';
                    } else {
                        echo '<li class="waves-effect"><a href=" ' . $link . '?page=' . $firstPaged . $query . '">' . $firstPaged . '</a></li>';
                    }
                }
                if ($paged > 2) {
                    $u = $paged - 1;
                } else {
                    $u = 2;
                }
                $p = $u + 2;
                if ($paged >= $total - 1) {
                    $p--;
                    $u = $p - 2;
                    if ($paged == $total) {
                        $displayLastPage = false;
                    }
                }
                if ($u > 2) {
                    echo "<li><a>...</a></li>";
                }
                for ($i = $u; $i <= $p; $i++) {
                    if ($i == $paged) {
                        echo '<li class="active"><a>' . $i . '</a></li>';
                    } else {
                        echo '<li class="waves-effect"><a href=" ' . $link . '?page=' . $i . $query . '">' . $i . '</a></li>';
                    }
                }
                if ($p < $lastPaged - 1) {
                    echo "<li><a>...</a></li>";
                }
                if ($paged <= $lastPaged && $displayLastPage) {
                    if ($lastPaged == $paged) {
                        echo '<li class="active"><a>' . $lastPaged . '</a></li>';
                    } else {
                        echo '<li class="waves-effect"><a href=" ' . $link . '?page=' . $lastPaged . $query . '">' . $lastPaged . '</a></li>';
                    }
                }
            }
            //Next button
            if ($paged < $total) {
                echo '<li><a href="' . $link . '?page=' . $next . $query. '" aria-label="Next"><i class="material-icons">chevron_right</i></a></li>';
            }
        }
    }
}

function more_recruitment_ajax()
{

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    $params_filter_recruitment = array(
        'posts_per_page' => $ppp,
        'post_type' => 'recruitment',
        'post_status' => 'publish',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'paged' => $page
    );
    $recruitments = new WP_Query($params_filter_recruitment);

    $out = '';

    if ($recruitments->have_posts()) : while ($recruitments->have_posts()) : $recruitments->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
            "recruitment_thumbnail");
        $link = get_the_permalink();
        $title = get_the_title();
        $out .= '<section class="item-order">';
        $out .= '<div class="thumb_img">';
        $out .= '<img src="' . $image[0] . '" alt=""/>';
        $out .= '</div>';
        $out .= '<div class="thumb_ders">';
        $out .= '<p class="_title">';
        $out .= '<a href="' . $link . '">' . $title . '</a>';
        $out .= '</p>';
        $out .= '<p class="_date">' . get_post_time('H:i') . ' - ' . get_the_date('d - m - Y') . '</p>';
        $out .= '<p class="_ders">';
        $out .= wp_trim_words(get_the_content(), 50, '...');
        $out .= '</p>';
        $out .= '</div>';
        $out .= '</section>';

    endwhile;
    endif;
    wp_reset_postdata();
    wp_die($out);
}

function more_post_ajax()
{

    $ppp = (isset($_POST["ppp"])) ? $_POST["ppp"] : 3;
    $page = (isset($_POST['pageNumber'])) ? $_POST['pageNumber'] : 0;

    $params_filter_post = array(
        'posts_per_page' => $ppp,
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'paged' => $page
    );
    $posts = new WP_Query($params_filter_post);

    $out = '';

    if ($posts->have_posts()) : while ($posts->have_posts()) : $posts->the_post();
        $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),
            "highlight_thumbnail");
        $out .= '<div class="item">';
        $out .= '<div class="card">';
        $out .= '<div class="card-image">';
        $out .= '<img src="' . $image[0] . '">';
        $out .= '</div>';
        $out .= '<div class="card-content">';
        $out .= '<span class="card-title">';
        $out .= '<a href="#">' . get_the_title() . '</a>';
        $out .= '</span>';
        $out .= '<p>';
        $out .= wp_trim_words(get_the_content(), 40, '...');
        $out .= '</p >';
        $out .= '</div ></div ></div >';

    endwhile;
    endif;
    wp_reset_postdata();
    wp_die($out);
}

