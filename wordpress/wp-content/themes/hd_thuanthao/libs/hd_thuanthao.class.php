<?php

class HD_ThuanThao_theme
{

    public static function run()
    {
        add_action('after_setup_theme', function () {
            add_theme_support('post-thumbnails');
            add_image_size('share_thumbnail', 180, 180, array('center', 'center'));
            add_image_size('doctor_thumbnail', 220, 286, array('center', 'center'));
        });
        //Register menu
        add_action('init', function () {
            register_nav_menu('primary', __('HD ThuanThao Menu', 'thuanthao'));
        });
        add_action('wp_enqueue_scripts', function() {
            //Insert style
            wp_register_style('main', HD_THUANTHAO_THEME_URL . '/assets//css/main.css');
            wp_enqueue_style('main');

            //Insert script
            wp_register_script('start', HD_THUANTHAO_THEME_URL . '/assets//js/start.js');
            wp_enqueue_script('start');

            wp_register_script('slick', 'http://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js');
            wp_enqueue_script('slick');
        });

        add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);
    }

    public static function hd_thuanthao_logo() {
        printf('<a href="%s" class="brand-logo"><img src="%s" alt="%s"/></a>', get_home_url('/'), HD_THUANTHAO_THEME_URL . '/assets/images/logo.png', get_bloginfo('name'));
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
            'menu_id' => 'nav-mobile',
            'walker' => new wp_bootstrap_navwalker(),
            'echo' => false,
        ));
    }

}