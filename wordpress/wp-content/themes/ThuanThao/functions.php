<?php
define('THUANTHAO_THEME_VERSION', '1.0');
define('THUANTHAO_THEME_URL', get_template_directory_uri());
define('THUANTHAO_THEME_DIR', plugin_dir_url(__FILE__));
define('THUANTHAO_THEME_LANGUAGES', dirname(plugin_basename(__FILE__)) . '/languages');

require_once 'libs/thuanthao.class.php';
require_once 'wp_bootstrap_navwalker.php';
ThuanThao_theme::run();

