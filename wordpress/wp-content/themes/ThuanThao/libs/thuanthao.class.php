<?php
class ThuanThao_theme{

    public static function run() {
        add_action('after_setup_theme', function(){
           add_theme_support('post-thumbnails');
           add_image_size('share_thumbnail', 180, 180, array('center', 'center'));
            add_image_size('doctor_thumbnail', 220, 286, array('center', 'center'));
        });
        //Register menu
        add_action('init', function() {
            register_nav_menu ( 'primary', __('ThuanThao Menu', 'thuanthao') );
        });

        add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);
    }
    public static function thuanthao_logo() {
    }

    public static function thuanthao_menu() {
        return wp_nav_menu(array(
            'menu' => 'primary',
            'theme_location' => 'primary',
            'depth' => 2,
            'container' => 'ul',
            'container_class' => '',
            'menu_class' => 'list-inline list-menu',
            'menu_id' => '',
            'walker' => new wp_bootstrap_navwalker(),
            'echo' => false,
        ));
    }

}