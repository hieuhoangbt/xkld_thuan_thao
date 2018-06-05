<?php
/*
Plugin Name: HD Thuan Thao
Plugin URI:  http://thuanthao.com
Description: Plugin create for manager website
Version:     1.0
Author:      XuanAnh
Text Domain: hdthuanthao
 */

if(!function_exists('add_action')){
    echo "Please go out now!"; exit;
}

define('PLG_VERSION', '1.0');
define('PLG_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('PLG_PLUGIN_URL', plugin_dir_url(__FILE__));
define('PLG_PLUGIN_LANGUAGES', dirname(plugin_basename(__FILE__)) . '/languages');

require_once PLG_PLUGIN_DIR.'libs/class.hd-thuanthao-posttype.php';
require_once PLG_PLUGIN_DIR.'libs/class.hd-thuanthao.php';
register_activation_hook(__FILE__, array('HDThuanThao', 'plugin_activation'));
register_deactivation_hook(__FILE__, array('HDThuanThao', 'plugin_deactivation'));

HDThuanThao::run();