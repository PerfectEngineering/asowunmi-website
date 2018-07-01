<?php
/**
 * Option for Template
 *
 */

add_action('wp', 'umbala_template_controls');

function umbala_template_controls() {
    global $wp_query, $post, $umbala_page_options, $umbala_opt;

    /* Metaboxes Page Options */
    if (is_page() || is_tax(get_object_taxonomies('product')) || is_post_type_archive('product')) {
        if (is_page()) {
            $page_id = $post->ID;
        }
        if (is_tax(get_object_taxonomies('product')) || is_post_type_archive('product')) {
            $page_id = get_option('woocommerce_shop_page_id', 0);
        }
        $post_custom = get_post_custom($page_id);
        if (!is_array($post_custom)) {
            $post_custom = array();
        }
        foreach ($post_custom as $key => $value) {
            if (isset($value[0])) {
                $umbala_page_options[$key] = $value[0];
            }
        }
        $default = array(
            'alus_layout' => 'default',
            'alus_page_layout' => 'full-width',
            'alus_left_sidebar' => '',
            'alus_right_sidebar' => '',
            'alus_header_top_bar' => 0,
            'alus_header_layout' => 'default',
            'alus_header_text_color' => 'default',
            'alus_menu_id' => 0,
            'alus_breadcrumb_layout' => 'default',
            'alus_bg_breadcrumbs' => '',
            'alus_logo' => '',
            'alus_breadcrumbs' => 0,
            'alus_page_title' => 0,
            'alus_page_slider' => 0,
            'alus_page_slider_position' => 'before_main_content',
            'alus_rev_slider' => 0,
        );

        $umbala_page_options = umbala_get_custom_field($default, $umbala_page_options);

        if ($umbala_page_options['alus_layout'] != 'default') {
            $umbala_opt['alus_layout'] = $umbala_page_options['alus_layout'];
        }

        if ($umbala_page_options['alus_header_top_bar']) {
            $umbala_opt['alus_header_top_bar'] = 0;
        }

        if ($umbala_page_options['alus_header_layout'] != 'default') {
            $umbala_opt['alus_header_layout'] = $umbala_page_options['alus_header_layout'];
        }

        if ($umbala_page_options['alus_page_title']) {
            $umbala_opt['alus_page_title'] = 0;
        }

        if ($umbala_page_options['alus_breadcrumbs']) {
            $umbala_opt['alus_breadcrumbs'] = 0;
        }

        if ($umbala_page_options['alus_breadcrumb_layout'] != 'default') {
            $umbala_opt['alus_breadcrumb_layout'] = $umbala_page_options['alus_breadcrumb_layout'];
        }

        if (trim($umbala_page_options['alus_bg_breadcrumbs']) != '') {
            $umbala_opt['alus_bg_breadcrumbs']['background-image'] = $umbala_page_options['alus_bg_breadcrumbs'];
        }

        if (trim($umbala_page_options['alus_logo']) != '') {
            $umbala_opt['alus_logo']['url'] = $umbala_page_options['alus_logo'];
        }

        if ($umbala_page_options['alus_menu_id']) {
            add_filter('wp_nav_menu_args', 'umbala_filter_wp_nav_menu_args');
        }
    }

    /* Archive - Category product */
    if (is_tax(get_object_taxonomies('product')) || is_post_type_archive('product')) {
        umbala_set_header_breadcrumb_layout_woocommerce_page('shop');

        add_action('wp_enqueue_scripts', 'umbala_grid_list_desc_style', 1000);

        if (is_tax('product_cat')) {
            $term = $wp_query->queried_object;
            if (!empty($term->term_id)) {
                $bg_breadcrumbs_id = get_term_meta($term->term_id, 'bg_breadcrumbs_id', true);
                $layout = get_term_meta($term->term_id, 'layout', true);
                $left_sidebar = get_term_meta($term->term_id, 'left_sidebar', true);
                $right_sidebar = get_term_meta($term->term_id, 'right_sidebar', true);

                if ($bg_breadcrumbs_id !== false) {
                    $umbala_opt['alus_bg_breadcrumbs']['background-image'] = $bg_breadcrumbs_id;
                }

                if ($layout != '') {
                    $umbala_opt['alus_prod_cat_layout'] = $layout;
                }

                if ($layout != '' && $left_sidebar != '') {
                    $umbala_opt['alus_prod_cat_left_sidebar'] = $left_sidebar;
                }

                if ($layout != '' && $right_sidebar != '') {
                    $umbala_opt['alus_prod_cat_right_sidebar'] = $right_sidebar;
                }
            }
        }

        if (isset($umbala_opt['alus_prod_cat_layout']) && $umbala_opt['alus_prod_cat_layout'] == 'full-width') {
            $umbala_opt['alus_show_sidebar_button'] = 0;
        }
    }

    /* Single Post */
    if (is_singular('post')) {

        $umbala_opt['alus_page_title'] = $umbala_opt['alus_blog_details_title'];
        $post_layout = get_post_meta($post->ID, 'alus_blog_details_layout', true);
        $post_sidebar_left = get_post_meta($post->ID, 'alus_blog_details_left_sidebar', true);
        $post_sidebar_right = get_post_meta($post->ID, 'alus_blog_details_right_sidebar', true);
        $bg_breadcrumbs = get_post_meta($post->ID, 'alus_bg_breadcrumbs', true);

        if ($post_layout != '') {
            $umbala_opt['alus_blog_details_layout'] = $post_layout;
        }
        if ($post_layout != '' && $post_sidebar_left != '') {
            $umbala_opt['alus_blog_details_left_sidebar'] = $post_sidebar_left;
        }

        if ($post_layout != '' && $post_sidebar_right != '') {
            $umbala_opt['alus_blog_details_right_sidebar'] = $post_sidebar_right;
        }

        if (trim($bg_breadcrumbs) != '') {
            $umbala_opt['alus_bg_breadcrumbs']['background-image'] = $bg_breadcrumbs;
        }

        if (get_post_meta($post->ID, 'alus_blog_details_sharing', true)) {
            $umbala_opt['alus_blog_details_sharing'] = 0;
        }

        if (get_post_meta($post->ID, 'alus_blog_details_related_posts', true)) {
            $umbala_opt['alus_blog_details_related_posts'] = 0;
        }

        if (get_post_meta($post->ID, 'alus_blog_details_comment_form', true)) {
            $umbala_opt['alus_blog_details_comment_form'] = 0;
        }
    }

    /* Single product */
    if (is_singular('product')) {
        $umbala_opt['alus_page_title'] = $umbala_opt['alus_prod_title'];
        $prod_layout = get_post_meta($post->ID, 'alus_prod_layout', true);
        $prod_sidebar_left = get_post_meta($post->ID, 'alus_prod_left_sidebar', true);
        $prod_sidebar_right = get_post_meta($post->ID, 'alus_prod_right_sidebar', true);
        if ($prod_layout != '') {
            $umbala_opt['alus_prod_layout'] = $prod_layout;
        }

        if ($prod_layout != '' && $prod_sidebar_left != '') {
            $umbala_opt['alus_prod_left_sidebar'] = $prod_sidebar_left;
        }

        if ($prod_layout != '' && $prod_sidebar_right != '') {
            $umbala_opt['alus_prod_right_sidebar'] = $prod_sidebar_right;
        }

        if (get_post_meta($post->ID, 'alus_prod_related', true)) {
            $umbala_opt['alus_prod_related'] = 0;
        }

        if (get_post_meta($post->ID, 'alus_prod_thumbnails_style', true)) {
            $umbala_opt['alus_prod_thumbnails_style'] = get_post_meta($post->ID, 'alus_prod_thumbnails_style', true);
        }

        if (get_post_meta($post->ID, 'alus_show_size_chart', true)) {
            $umbala_opt['alus_show_prod_size_chart'] = 1;
        }

        if (get_post_meta($post->ID, 'alus_prod_size_chart', true)) {
            $umbala_opt['alus_prod_size_chart']['url'] = get_post_meta($post->ID, 'alus_prod_size_chart', true);
        }

        if (!$umbala_opt['alus_prod_thumbnail']) {
            remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
        }

        if (!$umbala_opt['alus_prod_label']) {
            remove_action('alus_before_product_image', 'umbala_product_label', 10);
        }

        if (!$umbala_opt['alus_product_zoom_button']) {
            remove_action('alus_before_product_image', 'umbala_template_single_product_zoom_button', 20);
        }

        if ($umbala_opt['alus_prod_title'] && isset($umbala_opt['alus_prod_title_in_content']) && $umbala_opt['alus_prod_title_in_content']) {
            $umbala_opt['alus_prod_title'] = 0;
            add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 1);
        }

        if (!$umbala_opt['alus_prod_rating']) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 2);
        }

        if (!$umbala_opt['alus_prod_availability']) {
            add_filter('woocommerce_get_availability', '__return_empty_string', 1, 2);
        }

        if (!$umbala_opt['alus_prod_cat_grid_desc']) {
            remove_action('woocommerce_after_shop_loop_item', 'umbala_template_product_short_description', 40);
        }

        if (!$umbala_opt['alus_prod_price']) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 3);
            remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
        }

        if (!$umbala_opt['alus_prod_excerpt']) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
        }

        if (!$umbala_opt['alus_prod_count_down']) {
            remove_action('woocommerce_single_product_summary', 'alus_template_loop_time_deals', 20);
        }

        if (!$umbala_opt['alus_prod_add_to_cart'] || $umbala_opt['alus_enable_catalog_mode']) {
            $terms = get_the_terms($post->ID, 'product_type');
            $product_type = !empty($terms) ? sanitize_title(current($terms)->name) : 'simple';
            if ($product_type != 'variable') {
                remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
            } else {
                remove_action('woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20);
            }
        }

        if (!$umbala_opt['alus_prod_sharing']) {
            remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);
        }

        if (!$umbala_opt['alus_show_prod_size_chart']) {
            remove_action('woocommerce_single_product_summary', 'umbala_template_product_size_chart_button', 80);
        }

        if (!$umbala_opt['alus_prod_upsells']) {
            remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
        }

        if (!$umbala_opt['alus_prod_related']) {
            remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
        }

        if (isset($umbala_opt['alus_prod_tabs_position']) && $umbala_opt['alus_prod_tabs_position'] == 'inside_summary') {
            remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
            add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 50);
        }

        /* Breadcrumb */
        $bg_breadcrumbs = get_post_meta($post->ID, 'alus_bg_breadcrumbs', true);
        if (!empty($bg_breadcrumbs)) {
            $umbala_opt['alus_bg_breadcrumbs']['background-image'] = $bg_breadcrumbs;
        }

        if (wp_is_mobile()) {
            $umbala_opt['alus_prod_thumbnails_style'] = 'horizontal';
            $umbala_opt['alus_prod_style_tabs'] = 'accordion';
        }

    }

    /* WooCommerce - Other pages */
    if (umbala_is_woocommerce_activated()) {
        if (is_cart()) {
            umbala_set_header_breadcrumb_layout_woocommerce_page('cart');
        }

        if (is_checkout()) {
            umbala_set_header_breadcrumb_layout_woocommerce_page('checkout');
        }

        if (is_account_page()) {
            umbala_set_header_breadcrumb_layout_woocommerce_page('myaccount');
        }
        umbala_remove_woocommerce_hook();
    }
}

function umbala_remove_woocommerce_hook() {
    global $umbala_opt;

    if (!$umbala_opt['alus_prod_cat_thumbnail']) {
        remove_action('woocommerce_before_shop_loop_item_title', 'umbala_product_thumbnail', 10);
    }
    if (!$umbala_opt['alus_prod_cat_label']) {
        remove_action('woocommerce_after_shop_loop_item_title', 'umbala_product_label', 1);
    }
    if (!$umbala_opt['alus_prod_cat_cat']) {
        remove_action('woocommerce_after_shop_loop_item', 'umbala_template_product_categories', 10);
    }
    if (!$umbala_opt['alus_prod_cat_title']) {
        remove_action('woocommerce_after_shop_loop_item', 'umbala_template_product_title', 20);
    }
    if (!$umbala_opt['alus_prod_cat_sku']) {
        remove_action('woocommerce_after_shop_loop_item', 'umbala_template_product_sku', 30);
    }
    if (!$umbala_opt['alus_prod_cat_rating']) {
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 15);
    }
    if (!$umbala_opt['alus_prod_cat_price']) {
        remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50);
    }
    if (!$umbala_opt['alus_prod_cat_add_to_cart']) {
        remove_action('woocommerce_after_shop_loop_item', 'umbala_template_loop_add_to_cart', 70);
        remove_action('woocommerce_after_shop_loop_item_title', 'umbala_template_loop_add_to_cart', 10006);
    }
    if (!$umbala_opt['alus_prod_cat_grid_desc']) {
        remove_action('woocommerce_after_shop_loop_item', 'umbala_template_product_short_description', 40);
    }
}

function umbala_filter_wp_nav_menu_args($args) {
    global $post;
    if (is_page() && !is_admin() && !empty($args['theme_location']) && $args['theme_location'] == 'primary') {
        $menu = get_post_meta($post->ID, 'alus_menu_id', true);
        if ($menu) {
            $args['menu'] = $menu;
        }
    }
    return $args;
}

function umbala_grid_list_desc_style() {
    $custom_css = ".products.list .short-description.list{display: inline-block !important;}";
    $custom_css .= ".products.grid .short-description.grid{display: inline-block !important;}";
    wp_add_inline_style('umbala-default', $custom_css);
}

function umbala_set_header_breadcrumb_layout_woocommerce_page($page = 'shop') {
    global $umbala_opt;
    /* Header Layout */
    $header_layout = get_post_meta(wc_get_page_id($page), 'alus_header_layout', true);
    if ($header_layout != 'default' && $header_layout != '') {
        $umbala_opt['alus_header_layout'] = $header_layout;
    }

    /* Breadcrumb Layout */
    $breadcrumb_layout = get_post_meta(wc_get_page_id($page), 'alus_breadcrumb_layout', true);
    if ($breadcrumb_layout != 'default' && $breadcrumb_layout != '') {
        $umbala_opt['alus_breadcrumb_layout'] = $breadcrumb_layout;
    }
}
?>