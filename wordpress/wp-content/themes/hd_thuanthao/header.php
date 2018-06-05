<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <title><?php wp_title('&raquo;', true, 'right'); ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo HD_THUANTHAO_THEME_URL; ?>/favicon.ico"/>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body>
<div id="page">
    <header class="header">
        <nav>
            <div class="container">
                <div class="nav-wrapper">
                    <?php HD_ThuanThao_theme::hd_thuanthao_logo(); ?>
                    <div class="right icon_social">
                        <div class="item">
                            <a href="#">
                                Nộp Hồ Sơ
                            </a>
                        </div>
                    </div>
                    <?php echo HD_ThuanThao_theme::hd_thuanthao_menu(); ?>
                </div>
            </div>
        </nav>
    </header>
