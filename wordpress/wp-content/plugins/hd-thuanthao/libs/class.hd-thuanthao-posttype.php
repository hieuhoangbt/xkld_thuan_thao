<?php
if (!function_exists('add_action')) {
    echo "Please go out now!";
    exit;
}

class HDThuanThaoPosttype
{

    protected static $instance;

    protected function __construct()
    {

    }

    protected function __clone()
    {

    }

    public static function get_instance()
    {
        if (self::$instance === null) {
            self::$instance = new HDThuanThaoPosttype();
        }
        return self::$instance;
    }

    public static function run()
    {
        $instance = self::get_instance();
        //Register posttype
        add_action('init', function () {
            self::register_post_type();
        });

        add_action('admin_init', function () {
            self::register_meta_box();
        });

        add_action('save_post', function ($post) {
            self::save_meta_box($post);
        });

        //Register scripts
        add_action('admin_enqueue_scripts', function () {
            self::register_scripts();
        });

        //Register columns
        add_filter('manage_recruitment_posts_columns', array($instance, 'register_columns_recruitment'));
        add_filter('manage_information_posts_columns', array($instance, 'register_columns_information'));
        add_filter('manage_registration_form_posts_columns',
            array($instance, 'register_columns_registration_form'));


        //Display list product
        add_action('manage_recruitment_posts_custom_column', array($instance, 'list_recruitment'), 10, 2);
        add_action('manage_register_information_posts_custom_column', array($instance, 'list_information'), 10, 2);
        add_action('manage_registration_form_posts_custom_column',
            array($instance, 'list_registration_form'), 10, 2);

        //Open post thumbnail
        add_action('after_setup_theme', function () {
            add_theme_support('post-thumbnails');
        });

        return $instance;
    }

    public static function register_scripts()
    {

        wp_register_style('hdthuanthao_bootstrap_css', PLG_PLUGIN_URL . '/scripts/css/bootstrap.min.css');
        wp_enqueue_style('hdthuanthao_bootstrap_css');

        wp_enqueue_style('thickbox');

        wp_register_style('datepicker_css',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css');
        wp_enqueue_style('datepicker_css');

        wp_register_script('datepicker',
            'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/js/bootstrap-datepicker.min.js');
        wp_enqueue_script('datepicker');

        wp_register_script('hdthuanthao_function_js', PLG_PLUGIN_URL . '/scripts/js/functions.js');
        wp_enqueue_script('hdthuanthao_function_js');

        wp_register_script('hdthuanthao_bootstrap_js', PLG_PLUGIN_URL . '/scripts/js/bootstrap.min.js');
        wp_enqueue_script('hdthuanthao_bootstrap_js');

        wp_enqueue_media();
        wp_enqueue_script('tp-upload-script', PLG_PLUGIN_URL . '/scripts/js/upload.js', array('jquery'), '1.0', true);


        wp_localize_script('hdthuanthao_function_js', 'wpajax', array(
            'ajax_url' => admin_url('admin-ajax.php')
        ));
    }


    public static function register_post_type()
    {
        $instance = self::get_instance();
        //register post type recruitment
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

        //register post type Register Information
        $labels = array(
            'name' => _x('Register Information', 'Post Type General Name', 'hdthuanthao'),
            'singular_name' => _x('Register Information', 'Post Type Singular Name', 'hdthuanthao'),
            'menu_name' => __('Register Information', 'hdthuanthao'),
            'name_admin_bar' => __('Register Information', 'hdthuanthao'),
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
            'slug' => 'register-information',
            'with_front' => true,
            'pages' => true,
            'feeds' => true,
        );
        $args = array(
            'label' => __('Register Information', 'hdthuanthao'),
            'description' => __('Register Information', 'hdthuanthao'),
            'labels' => $labels,
            'supports' => array(),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-phone',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
//            'capabilities' => array(
//                'create_posts' => false
//            )
        );

        register_post_type('information', $args);

        //register post type upload registration statement
        $labels = array(
            'name' => _x('Registration Form', 'Post Type General Name', 'hdthuanthao'),
            'singular_name' => _x('Registration Form', 'Post Type Singular Name', 'hdthuanthao'),
            'menu_name' => __('Registration Form', 'hdthuanthao'),
            'name_admin_bar' => __('Registration Form', 'hdthuanthao'),
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
            'slug' => 'registration-form',
            'with_front' => true,
            'pages' => true,
            'feeds' => true,
        );
        $args = array(
            'label' => __('Registration Form', 'hdthuanthao'),
            'description' => __('Registration Form', 'hdthuanthao'),
            'labels' => $labels,
            'supports' => array('title', 'slug'),
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'menu_icon' => 'dashicons-admin-links',
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'exclude_from_search' => false,
            'publicly_queryable' => true,
            'rewrite' => $rewrite,
            'capability_type' => 'page',
        );

        register_post_type('registrationform', $args);

        flush_rewrite_rules();
        return $instance;
    }

    public static function register_meta_box()
    {
        $instance = self::get_instance();
        add_meta_box('recruitment', __('Custom Info', 'hdthuanthao'), function ($post) {
            $data = get_post_meta($post->ID);
            require_once PLG_PLUGIN_DIR . '/views/backend/recruitment.php';
        }, 'recruitment', 'normal', 'core');
        add_meta_box('registrationform', __('Custom Info', 'hdthuanthao'), function ($post) {
            $data = get_post_meta($post->ID);
            require_once PLG_PLUGIN_DIR . '/views/backend/registration-form.php';
        }, 'registrationform', 'normal', 'core');

        return $instance;
    }

    public static function register_columns_recruitment($columns)
    {
        $columns = array(
            'cb' => $columns['cb'],
            'title' => $columns['title'],
            'content' => 'Content',
            'company_name' => 'Company Name',
            'office_address' => 'Office Address',
        );
        return $columns;
    }

    public static function register_columns_information($columns)
    {
        $columns = array(
            'cb' => $columns['cb'],
            'full_name' => 'Full Name',
            'address' => 'Address',
            'phone_number' => 'Phone Number',
            'email' => 'Email',
            'introduce' => 'Introduce',
            'document' => 'Document',
        );
        return $columns;
    }

    public static function register_columns_registration_form($columns)
    {
        $columns = array(
            'cb' => $columns['cb'],
            'title' => $columns['title'],
        );
        return $columns;
    }


    public static function list_recruitment($columns, $post_id)
    {
        $data = get_post_meta($post_id);
        switch ($columns) {
            case 'content':
                echo get_the_content($post_id, 'content');
                break;
            case 'company_name':
                echo $data['company_name'][0];
                break;
            case 'office_address':
                echo $data['office_address'][0];
                break;
        }
    }

    public static function list_register_information($columns, $post_id)
    {
        $data = get_post_meta($post_id);
        switch ($columns) {
            case 'full_name':
                echo $data['full_name'][0];
                break;
            case 'address':
                echo $data['address'][0];
                break;
            case 'phone_number':
                echo $data['phone_number'][0];
                break;
            case 'email':
                echo $data['email'][0];
                break;
            case 'introduce':
                echo $data['introduce'][0];
                break;
            case 'document':
                echo '<a href="' . $data['document'][0] . '">Download Document</a>';
                break;
        }
    }


    public static function save_meta_box($post_id)
    {
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
                foreach ($data as $key => $value) {
                    update_post_meta($post_id, $key, $value);
                }
                break;
            case "registrationform":
                $data = $_POST['registrationform'];
                foreach ($data as $key => $value) {
                    update_post_meta($post_id, $key, $value);
                }
                break;
            default:
                break;
        }
    }

}
