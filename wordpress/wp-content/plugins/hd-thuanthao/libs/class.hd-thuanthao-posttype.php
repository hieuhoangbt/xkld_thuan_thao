<?php
if (!function_exists('add_action')) {
    echo "Please go out now!";
    exit;
}

class HDThuanThaoPosttype {

    protected static $instance;

    protected function __construct() {
        
    }

    protected function __clone() {
        
    }

    public static function get_instance() {
        if (self::$instance === null) {
            self::$instance = new HDThuanThaoPosttype();
        }
        return self::$instance;
    }

    public static function run() {
        $instance = self::get_instance();
        //Register posttype
        add_action('init', function() {
            self::register_post_type();
        });

        add_action('admin_init', function() {
            self::register_meta_box();
        });

        add_action('save_post', function($post) {
            self::save_meta_box($post);
        });

        //Register scripts
        add_action('admin_enqueue_scripts', function() {
            self::register_scripts();
        });

        //Register columns
        add_filter('manage_recruitment_posts_columns', array($instance, 'register_columns_recruitment'));
        add_filter('manage_news_posts_columns', array($instance, 'register_columns_news'));
        

        //Display list product
        add_action('manage_recruitment_posts_custom_column', array($instance, 'list_recruitment'), 10, 2);
        add_action('manage_news_posts_custom_column', array($instance, 'list_news'), 10, 2);

        //Open post thumbnail
        add_action('after_setup_theme', function() {
            add_theme_support('post-thumbnails');
        });

        return $instance;
    }


    public static function register_post_type() {
        $instance = self::get_instance();
        $labels = array(
            'name' => _x('Recruitment', 'Post Type General Name', 'hdthuanthao'),
            'singular_name' => _x('Recruitment', 'Post Type Singular Name', 'hdthuanthao'),
            'menu_name' => __('Recruitment', 'hdthuanthao'),
            'name_admin_bar' => __('Recruitment', 'hdthuanthao'),
            'archives' => __('Item Archives', 'hdthuanthao'),
            'parent_item_colon' => __('Parent Item:', 'hdthuanthao'),
            'all_items' => __('All Items', 'hdthuanthao'),
            'add_new_item' => __('Add New Item', 'hdthuanthao'),
            'add_new' => __('Add New', 'hdthuanthao'),
            'new_item' => __('New Item', 'hdthuanthao'),
            'edit_item' => __('Edit Item', 'hdthuanthao'),
            'update_item' => __('Update Item', 'hdthuanthao'),
            'view_item' => __('View Item', 'hdthuanthao'),
            'search_items' => __('Search Item', 'hdthuanthao'),
            'not_found' => __('Not found', 'hdthuanthao'),
            'not_found_in_trash' => __('Not found in Trash', 'hdthuanthao'),
            'featured_image' => __('Featured Image', 'hdthuanthao'),
            'set_featured_image' => __('Set featured image', 'hdthuanthao'),
            'remove_featured_image' => __('Remove featured image', 'hdthuanthao'),
            'use_featured_image' => __('Use as featured image', 'hdthuanthao'),
            'insert_into_item' => __('Insert into item', 'hdthuanthao'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'hdthuanthao'),
            'items_list' => __('Items list', 'hdthuanthao'),
            'items_list_navigation' => __('Items list navigation', 'hdthuanthao'),
            'filter_items_list' => __('Filter items list', 'hdthuanthao'),
        );
        $rewrite = array(
            'slug' => 'recruitment',
            'with_front' => true,
            'pages' => true,
            'feeds' => true,
        );
        $args = array(
            'label' => __('Recruitment', 'hdthuanthao'),
            'description' => __('Recruitment information', 'hdthuanthao'),
            'labels' => $labels,
            'supports' => array('title', 'editor', 'thumbnail', 'slug',),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-money',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
        );

        register_post_type('recruitment', $args);


        $labels = array(
            'name' => _x('News', 'Post Type General Name', 'hdthuanthao'),
            'singular_name' => _x('News', 'Post Type Singular Name', 'hdthuanthao'),
            'menu_name' => __('News', 'hdthuanthao'),
            'name_admin_bar' => __('News', 'hdthuanthao'),
            'archives' => __('Item Archives', 'hdthuanthao'),
            'parent_item_colon' => __('Parent Item:', 'hdthuanthao'),
            'all_items' => __('All Items', 'hdthuanthao'),
            'add_new_item' => __('Add New Item', 'hdthuanthao'),
            'add_new' => __('Add New', 'hdthuanthao'),
            'new_item' => __('New Item', 'hdthuanthao'),
            'edit_item' => __('Edit Item', 'hdthuanthao'),
            'update_item' => __('Update Item', 'hdthuanthao'),
            'view_item' => __('View Item', 'hdthuanthao'),
            'search_items' => __('Search Item', 'hdthuanthao'),
            'not_found' => __('Not found', 'hdthuanthao'),
            'not_found_in_trash' => __('Not found in Trash', 'hdthuanthao'),
            'featured_image' => __('Featured Image', 'hdthuanthao'),
            'set_featured_image' => __('Set featured image', 'hdthuanthao'),
            'remove_featured_image' => __('Remove featured image', 'hdthuanthao'),
            'use_featured_image' => __('Use as featured image', 'hdthuanthao'),
            'insert_into_item' => __('Insert into item', 'hdthuanthao'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'hdthuanthao'),
            'items_list' => __('Items list', 'hdthuanthao'),
            'items_list_navigation' => __('Items list navigation', 'hdthuanthao'),
            'filter_items_list' => __('Filter items list', 'hdthuanthao'),
        );
        $rewrite = array(
            'slug' => 'news',
            'with_front' => true,
            'pages' => true,
            'feeds' => true,
        );
        $args = array(
            'label' => __('News', 'hdthuanthao'),
            'description' => __('News', 'hdthuanthao'),
            'labels' => $labels,
            'supports' => array('editor'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-media-spreadsheet',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
        );


        register_post_type('news', $args);

        flush_rewrite_rules();
        return $instance;
    }

    public static function register_meta_box() {
        $instance = self::get_instance();
        add_meta_box('recruitment', __('Custom Info', 'hdthuanthao'), function($post) {
            $data = get_post_meta($post->ID, 'recruitment')[0];
            require_once PLG_PLUGIN_DIR . '/views/backend/recruitment.php';
        }, 'recruitment', 'normal', 'core');
        add_meta_box('news', __('Custom Info', 'hdthuanthao'), function($post) {
            $data = get_post_meta($post->ID, 'news')[0];
            require_once PLG_PLUGIN_DIR . '/views/backend/news.php';
        }, 'news', 'normal', 'core');

        return $instance;
    }

    public static function register_columns_recruitment($columns) {
        $columns = array(
            'cb' => $columns['cb'],
            'title' => $columns['title'],
            'post_thumb' => 'Image',
            'date' => $columns['date'],
        );
        return $columns;
    }

    public static function register_columns_news($columns) {
        $columns = array(
            'cb' => $columns['cb'],
            'question' => 'Question',
            'answer' => 'Answer',
            'highlight' => 'Highlight homepage',
            'date' => $columns['date'],
        );
        return $columns;
    }


    public static function register_scripts() {
        wp_register_style('hdthuanthao_admin_css', PLG_PLUGIN_URL . '/scripts/css/admin-style.css');
        wp_enqueue_style('hdthuanthao_admin_css');

        wp_register_script('hdthuanthao_admin_js', PLG_PLUGIN_URL . '/scripts/js/admin-js.js');
        wp_enqueue_script('hdthuanthao_admin_js');

        wp_register_script('hdthuanthao_function_js', PLG_PLUGIN_URL . '/scripts/js/functions.js');
        wp_enqueue_script('hdthuanthao_function_js');

        wp_localize_script('hdthuanthao_function_js', 'wpajax', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }

    public static function list_recruitment($columns, $post_id) {
        $data = get_post_meta($post_id, 'recruitment')[0];

    }

    public static function list_news($columns, $post_id) {
        $data = get_post_meta($post_id, 'news')[0];

    }


    public static function save_meta_box($post_id) {
        if (!isset($_POST['hdthuanthao_security'])) {
            return;
        }
        if (!wp_verify_nonce($_POST['hdthuanthao_security'], $post_id)) {
            return;
        }
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }
        if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return;
            }
        } else {
            if (!current_user_can('edit_post', $post_id)) {
                return;
            }
        }
        switch ($_POST['post_type']) {
            case "recruitment":
                $data = $_POST['recruitment'];
                update_post_meta($post_id, 'recruitment', $data);
                break;
            case "news":
                $data = $_POST['news'];
                update_post_meta($post_id, 'news', $data);
                break;
        }
    }

}
