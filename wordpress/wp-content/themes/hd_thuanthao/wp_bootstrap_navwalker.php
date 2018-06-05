<?php

class wp_bootstrap_navwalker extends Walker_Nav_Menu {

    // add classes to ul sub-menus
    function start_lvl(&$output, $depth = 0, $args = array()) {
        $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '' ); // code indent
        $class_names = '';
        $output .= "\n" . $indent . '<ul class="drop-menu">' . "\n";
        if ($depth > 0) {
            echo $indent;
            exit;
        }
    }

    function end_lvl(&$output, $depth = 0, $args = array()) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $wp_query;
        global $wp;
        $current_url = home_url(add_query_arg(array(), $wp->request));
        $arrDept = explode("/", $current_url);
        if (count($arrDept) > 4) {
            $current_url = "";
            for ($i = 0; $i < 4; $i++) {
                $current_url .= $arrDept[$i] . "/";
            }
            $current_url = substr($current_url, 0, strlen(trim($current_url)) - 1);
        }
        $parents = array();
        if (( $locations = get_nav_menu_locations() ) && isset($locations[$args->theme_location])) {
            $menu = wp_get_nav_menu_object($locations[$args->theme_location]);
            $menu_items = wp_get_nav_menu_items($menu->term_id);
            foreach ($menu_items as $menu_item) {
                if ($menu_item->menu_item_parent != 0) {
                    $parents[] = $menu_item->menu_item_parent;
                }
            }
        }
        if (in_array($item->ID, $parents)) {
            $caret = ' <span class="caret">&nbsp;</span>';
            $collapse = ' ';
        } else {
            $caret = '';
            $collapse = '';
        }

        $cleanUrl = (substr($item->url, -1, 1) == '/') ? substr($item->url, 0, -1) : $item->url;
        $post_id = get_the_ID();
        $menu_items = wp_get_nav_menu_items($locations[$args->theme_location]);
        $parent_item_id = wp_filter_object_list($menu_items, array('object_id' => $post_id), 'and', 'menu_item_parent');

        if (!empty($parent_item_id)) {
            $parent_item_id = array_shift($parent_item_id);
            $parent_post_id = wp_filter_object_list($menu_items, array('ID' => $parent_item_id), 'and', 'object_id');

            if (!empty($parent_post_id)) {
                $parent_post_id = array_shift($parent_post_id);
                $parent_url = get_permalink($parent_post_id);
                $parent_url = (substr($parent_url, -1, 1) == '/') ? substr($parent_url, 0, -1) : $parent_url;
            }
        }else{
            $parent_url = "";
        }
        $active = "class=item_menu";
        $indent = ( $depth > 0 ? str_repeat("\t", $depth) : '');

        if ($depth == 0) {
            $output .= $indent . "<li " . $active . ">";
        } else {
            $output .= $indent . "</li>";
        }
        $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
        $attributes .=!empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
        $attributes .=!empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
        $attributes .=!empty($item->guid) ? ' href="' . esc_attr($item->guid) . '"' : '';
        if ($current_url == $cleanUrl && ($depth > 0 || $depth == 0)) {
            $attributes .= ' class="active"';
        }
        $subMn ='';
        $depth == 0 ?
            $item_output = sprintf('%1$s<a%2$s>%3$s%4$s%5$s%6$s</a>%7$s', $args->before, $attributes . $collapse, $args->link_before, apply_filters('the_title', $item->post_title, $item->ID), $args->link_after, $caret, $args->after
            ) :
            $item_output = sprintf('<li>%1$s<a%2$s>%3$s%4$s%5$s</a>%6$s%7$s</li>', $args->before, $attributes, $args->link_before, apply_filters('the_title', $item->title, $item->ID), $args->link_after, $args->after, $subMn
            );
        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

}
