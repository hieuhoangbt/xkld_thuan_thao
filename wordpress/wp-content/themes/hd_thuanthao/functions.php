<?php
define('HD_THUANTHAO_THEME_VERSION', '1.0');
define('HD_THUANTHAO_THEME_URL', get_template_directory_uri());
define('HD_THUANTHAO_THEME_DIR', plugin_dir_url(__FILE__));
define('HD_THUANTHAO_THEME_LANGUAGES', dirname(plugin_basename(__FILE__)) . '/languages');

require_once 'libs/hd_thuanthao.class.php';
require_once 'wp_bootstrap_navwalker.php';
HD_ThuanThao_theme::run();

