<?php

/* Remove woocommerce hook */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

/* * * Shop - Category ** */
add_action('woocommerce_before_shop_loop_item_title', 'umbala_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item_title', 'umbala_product_label', 1);
add_action('woocommerce_after_shop_loop_item', 'umbala_template_product_categories', 10);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 15);
add_action('woocommerce_after_shop_loop_item', 'umbala_template_product_title', 20);
add_action('woocommerce_after_shop_loop_item', 'umbala_template_product_sku', 30);
add_action('woocommerce_after_shop_loop_item', 'umbala_template_product_short_description', 40);
add_action('woocommerce_after_shop_loop_item', 'umbala_template_product_short_description_listview', 60);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50);
add_action('woocommerce_after_shop_loop_item', 'umbala_template_loop_add_to_cart', 70);
add_filter('loop_shop_per_page', 'umbala_change_products_per_page_shop');

/* Single page */
add_action('alus_before_product_image', 'umbala_product_label', 10);
add_action('alus_before_product_image', 'umbala_template_single_product_zoom_button', 20);
add_action('alus_before_product_image', 'umbala_template_single_product_video_button', 30);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 1);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 2);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 3);
add_action('woocommerce_single_product_summary', 'umbala_template_product_size_chart_button', 38);
add_action('woocommerce_single_product_summary', 'umbala_template_single_meta', 60);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);

add_action('woocommerce_share', 'umbala_template_product_social_sharing', 9);

if (function_exists('alus_template_loop_time_deals')) {
    add_action('woocommerce_single_product_summary', 'alus_template_loop_time_deals', 20);
}

add_filter('woocommerce_available_variation', 'umbala_variable_product_price_filter', 10, 3);
add_filter('woocommerce_product_description_heading', '__return_empty_string');
add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');

add_filter('woocommerce_output_related_products_args', 'umbala_output_related_products_args_filter');

if (!is_admin()) {
    /* Fix for WooCommerce Tab Manager plugin */
    add_filter('woocommerce_product_tabs', 'umbala_product_remove_tabs', 999);
    add_filter('woocommerce_product_tabs', 'umbala_add_product_custom_tab', 90);
}
/* * * End Product ** */

function umbala_product_label() {

    global $product, $post;
    $out_of_stock = false;
    if (!$product->is_in_stock() && !is_product()) {
        $out_of_stock = true;
    }
    ?>
    <div class="product-labels">
        <?php

    /* Sale label */
    if ($product->is_on_sale() && !$out_of_stock) {

        $percentage = '';

        if ($product->get_type() == 'variable') {

            $available_variations = $product->get_variation_prices();
            $max_percentage = 0;

            foreach ($available_variations['regular_price'] as $key => $regular_price) {
                $sale_price = $available_variations['sale_price'][$key];

                if ($sale_price < $regular_price) {
                    $percentage = round((($regular_price - $sale_price) / $regular_price) * 100);

                    if ($percentage > $max_percentage) {
                        $max_percentage = $percentage;
                    }
                }
            }

            $percentage = $max_percentage;
        } elseif ($product->get_type() == 'simple' || $product->get_type() == 'external') {
            $percentage = round((($product->get_regular_price() - $product->get_sale_price()) / $product->get_regular_price()) * 100);
        }

        if ($percentage && umbala_get_opt('alus_product_sale_percentage')) {
            echo '<span class="onsale percent">-' . $percentage . '%' . '</span>';
        } else {
            echo '<span class="onsale">' . esc_html__('Sale', 'umbala') . '</span>';
        }

    }

    /* Hot label */
    if ($product->is_featured() && !$out_of_stock && umbala_get_opt('alus_product_feature_label')) {
        echo '<span class="featured">' . esc_html__('Hot', 'umbala') . '</span>';
    }

    /* Out of stock */
    if ($out_of_stock && umbala_get_opt('alus_product_out_of_stock_label')) {
        echo '<span class="out-of-stock">' . esc_html__('Sold out', 'umbala') . '</span>';
    }
    ?>
    </div>
<?php

}

function umbala_product_thumbnail() {
    global $product;
    $back_image = ((int) umbala_get_opt('alus_effect_product') == 0) ? false : true;
    $back_image_style = umbala_get_opt('alus_effect_hover_product_img');

    $image_size = apply_filters('alus_loop_product_thumbnail', 'shop_catalog');
    $attachment_ids = $product->get_gallery_image_ids();

    if (!is_array($attachment_ids) || (is_array($attachment_ids) && count($attachment_ids) == 0)) {
        $back_image = false;
    }

    echo woocommerce_get_product_thumbnail($image_size);
    if ($back_image) {
        echo '<span class="hover-image has-hover image-hover-' . $back_image_style . '">';
        echo wp_get_attachment_image($attachment_ids[0], $image_size, 0, array('class' => 'product-hover-image'));
        echo '</span>';
    }
}

function umbala_template_product_title() {
    global $post, $product;
    $product_url = esc_url(get_permalink($post->ID));
    echo "<h3 class=\"product-title product-name\">";
    echo "<a href='{$product_url}'>" . esc_attr(get_the_title()) . "</a>";
    echo "</h3>";
}

function umbala_template_loop_add_to_cart() {

    if (umbala_get_opt('alus_enable_catalog_mode')) {
        return;
    }

    echo "<div class='alus-add-to-cart add-to-cart'>";
    woocommerce_template_loop_add_to_cart();
    echo "</div>";
}

function umbala_template_product_sku() {
    global $product, $post;
    echo "<span class=\"product-sku\">" . esc_attr($product->get_sku()) . "</span>";
}

function umbala_template_product_short_description() {
    global $product, $post;
    $grid_limit_words = absint(umbala_get_opt('alus_prod_cat_grid_desc_words'));
    $show_grid_desc = umbala_get_opt('alus_prod_cat_grid_desc');

    if (empty($post->post_excerpt)) {
        return;
    }

    if (!(is_tax(get_object_taxonomies('product')) || is_post_type_archive('product'))): ?>

    <div class="short-description">
        <?php umbala_the_excerpt_max_words($grid_limit_words, true, '', true); ?>
    </div>

    <?php

    elseif ($show_grid_desc): ?>
		<div class="short-description grid" style="<?php echo umbala_get_opt('alus_enable_grid_list') ? 'display: none' : ''; ?>" >
            <?php umbala_the_excerpt_max_words($grid_limit_words, true, '', true); ?>
        </div>
        <?php

    endif;
}

function umbala_template_product_short_description_listview() {
    global $product, $post;
    $list_limit_words = absint(umbala_get_opt('alus_prod_cat_list_desc_words'));
    $show_list_desc = umbala_get_opt('alus_prod_cat_list_desc');
    $is_archive = is_tax(get_object_taxonomies('product')) || is_post_type_archive('product');
    if ($show_list_desc && $is_archive): ?>
        <div class="short-description list" style="display: none" >
            <?php umbala_the_excerpt_max_words($list_limit_words, true, '', true); ?>
        </div>
        <?php

    endif;
}

function umbala_template_product_categories() {
    global $product;
    ?>

 <div class="product-categories">
     <?php

    echo wc_get_product_category_list($product->get_id(), ', ');
    ?>
 </div>

 <?php

}

function umbala_change_products_per_page_shop() {

    if (is_tax(get_object_taxonomies('product')) || is_post_type_archive('product')) {
        if (absint(umbala_get_opt("alus_prod_per_page")) > 0) {
            return absint(umbala_get_opt('alus_prod_per_page'));
        }
    }
}

add_action('woocommerce_before_shop_loop', 'umbala_gridlist_toggle_button', 10);
function umbala_gridlist_toggle_button() {

    if (!umbala_get_opt('alus_enable_grid_list')) {
        return;
    }
    ?>

    <nav class="grid_list_nav">
        <a href="#" id="grid" title="<?php esc_attr_e('Grid view', 'umbala');?>">&#8862; <span><?php esc_html_e('Grid view', 'umbala'); ?></span></a><a href="#" id="list" title="<?php esc_attr_e('List view', 'umbala'); ?>">&#8863; <span><?php esc_html_e('List view', 'umbala');?></span></a>
    </nav>

    <?php

    $std = umbala_get_opt('alus_grid_list_default');
    $default = isset($std) ? $std : 'grid';

    wp_add_inline_script('umbala-global', 'jQuery(document).ready(function(){
        "use strict";
        if ( typeof jQuery.cookie == "function" && jQuery.cookie("gridcookie") == null ) {
            jQuery("#content div.products").addClass("' . esc_js($default) . '");
            jQuery(".grid_list_nav #' . esc_js($default) . '").addClass("active");
        }

        if( typeof jQuery.cookie == "function" ){
            jQuery("#grid").on("click", function() {
                if( jQuery(this).hasClass("active") ){
                    return false;
                }
                jQuery(this).addClass("active");
                jQuery("#list").removeClass("active");
                jQuery.cookie("gridcookie","grid", { path: "/" });
                jQuery("#content div.products").fadeOut(300, function() {
                    jQuery(this).addClass("grid").removeClass("list").fadeIn(300);
                    });
                    return false;
                    });

                    jQuery("#list").on("click", function() {
                        if( jQuery(this).hasClass("active") ){
                            return false;
                        }
                        jQuery(this).addClass("active");
                        jQuery("#grid").removeClass("active");
                        jQuery.cookie("gridcookie","list", { path: "/" });
                        jQuery("#content div.products").fadeOut(300, function() {
                            jQuery(this).removeClass("grid").addClass("list").fadeIn(300);
                            });
                            return false;
                            });

                            if( jQuery.cookie("gridcookie") ){
                                jQuery("#content div.products, #grid_list_nav").addClass(jQuery.cookie("gridcookie"));
                            }

                            if( jQuery.cookie("gridcookie") == "grid" ){
                                jQuery(".grid_list_nav #grid").addClass("active");
                                jQuery(".grid_list_nav #list").removeClass("active");
                            }

                            if( jQuery.cookie("gridcookie") == "list" ){
                                jQuery(".grid_list_nav #list").addClass("active");
                                jQuery(".grid_list_nav #grid").removeClass("active");
                            }

                            jQuery("#grid_list_nav a").on("click", function(event) {
                                event.preventDefault();
                                });
                            }
                        });', 'after');
}

/* * * End Shop - Category ** */

/* * * Single Product * * */
function umbala_template_single_product_zoom_button() {
    ?>
    <div class="product-zoom-button"><a href="#"><span><?php echo esc_html_e('Zoom', 'umbala');?></span></a></div>
    <?php
}

function umbala_template_single_product_video_button() {
    global $product;
    $video_url = get_post_meta($product->get_id(), 'alus_prod_video_url', true);
    if (!empty($video_url)) {
        echo '<a class="alus-single-video" href="' . esc_url($video_url) . '"></a>';
    }
}

function umbala_template_single_navigation() {
    $next = get_next_post();
    $prev = get_previous_post();

    $next = (!empty($next)) ? wc_get_product($next->ID) : false;
    $prev = (!empty($prev)) ? wc_get_product($prev->ID) : false;
    ?>
   <div class="alus-nav-product">
    <?php if (!empty($prev)): ?>
        <a href="<?php echo esc_url($prev->get_permalink()); ?>" class="prev">
            <div class="nav-product prev-product">
                <div class="product-image">
                    <?php echo wp_kses($prev->get_image(), array('img' => array('class' => true, 'width' => true, 'height' => true, 'src' => true, 'alt' => true, 'data-src' => true))); ?>
                </div>
                <div class="product-description">
                    <span class="product-title"><?php echo esc_html($prev->get_title()); ?></span>
                    <span class="price"><?php echo wp_kses_post($prev->get_price_html()); ?></span>
                </div>
            </div>
        </a>
    <?php endif;?>
    <?php if (!empty($next)): ?>
        <a href="<?php echo esc_url($next->get_permalink()); ?>" class="next">
            <div class="nav-product next-product">
                <div class="product-image">
                    <?php echo wp_kses($next->get_image(), array('img' => array('class' => true, 'width' => true, 'height' => true, 'src' => true, 'alt' => true, 'data-src' => true))); ?>
                </div>
                <div class="product-description">
                    <span class="product-title"><?php echo esc_html($next->get_title()); ?></span>
                    <span class="price"><?php echo wp_kses_post($next->get_price_html()); ?></span>
                </div>
            </div>
        </a>
    <?php endif;?>
</div>
<?php
}

function umbala_template_product_social_sharing() {
    if (function_exists('alus_template_social_sharing')) {
        ?>
        <div class="product-share">
            <div class="product-share-title"><?php esc_html_e('Share:', 'umbala'); ?></div>
            <?php

        alus_template_social_sharing();
        ?>
        </div>
        <?php

    }
}

/* Sidebar Button */
if (!function_exists('umbala_show_sidebar_button')) {
    add_action('woocommerce_before_shop_loop', 'umbala_show_sidebar_button', 25);
    function umbala_show_sidebar_button() {
        $content_class = umbala_get_content_layout(umbala_get_opt('alus_prod_cat_layout'));
        if (umbala_get_opt('alus_show_sidebar_button')) {
            if ($content_class['left_sidebar'] && is_active_sidebar(umbala_get_opt('alus_prod_cat_left_sidebar')) || $content_class['right_sidebar'] && is_active_sidebar(umbala_get_opt('alus_prod_cat_right_sidebar'))) {
                ?>
                <div class="alus-show-sidebar-button">
                    <a href="#"><?php esc_html_e('Sidebar', 'umbala'); ?></a>
                </div>
                <?php

            }
        }
    }
}

/* Filters Button */
if (!function_exists('umbala_filters_button')) {
    add_action('woocommerce_before_shop_loop', 'umbala_filters_button', 15);
    function umbala_filters_button() {

        if (umbala_get_opt('alus_show_filters_area') && is_active_sidebar('product-filters-content')) {
            ?>
            <div class="alus-filters-button">
                <a href="#"><?php esc_html_e('Filters', 'umbala');?></a>
            </div>
            <?php

        }
    }
}

/* Filters Content */
if (!function_exists('umbala_filters_content')) {
    add_action('umbala_after_body_open', 'umbala_filters_content', 40);
    function umbala_filters_content() {

        if (umbala_get_opt('alus_show_filters_area') && is_active_sidebar('product-filters-content')) {
            ?>
            <div class="alus-filters-content">
                <div class="close-sidebar"><span><?php esc_html_e('Close', 'umbala'); ?></span></div>
                <div class="filter-content">
                    <?php dynamic_sidebar('product-filters-content'); ?>
                </div>
            </div>
            <?php

        }
    }
}

function umbala_template_single_meta() {
    global $product;

    echo '<div class="product-meta">';
    do_action('woocommerce_product_meta_start');
    if (wc_product_sku_enabled() && ($product->get_sku() || $product->is_type('variable'))) {
        echo '<div class="product-sku">' . esc_html__('Sku: ', 'umbala') . '<span class="sku" itemprop="sku">' . (($sku = $product->get_sku()) ? $sku : esc_html__('N/A', 'umbala')) . '</span></div>';
    }
    if (umbala_get_opt('alus_prod_cat')) {
        echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-single-cats"><span>' . esc_html__('Categories:', 'umbala') . '</span><span class="cat-links">', '</span></div>');
    }
    if (umbala_get_opt('alus_prod_tag')) {
        echo wc_get_product_tag_list($product->get_id(), ', ', '<div class="product-single-tags"><span>' . esc_html__('Tags:', 'umbala') . '</span><span class="tag-links">', '</span></div>');
    }
    do_action('woocommerce_product_meta_end');
    echo '</div>';
}

/* Product Size Chart*/
function umbala_template_product_size_chart_button() {
    $size_chart = umbala_get_opt('alus_prod_size_chart');
    $image_url = esc_url($size_chart['url']);
    if (umbala_get_opt('alus_show_prod_size_chart') && strlen($image_url) > 0) {
        echo '<a class="size-guide-btn" href="' . esc_url($image_url) . '"><i class="icon-chart"></i> ' . esc_html__('Size Chart', 'umbala') . '</a>';
    }
}

/* * * Product tab ** */
function umbala_product_remove_tabs($tabs = array()) {

    if (!umbala_get_opt('alus_prod_tabs')) {
        return array();
    }
    return $tabs;
}

function umbala_add_product_custom_tab($tabs = array()) {
    global $post;

    $custom_tab_title = umbala_get_opt('alus_prod_custom_tab_title');

    $product_custom_tab = get_post_meta($post->ID, 'alus_prod_custom_tab', true);
    if ($product_custom_tab) {
        $custom_tab_title = get_post_meta($post->ID, 'alus_prod_custom_tab_title', true);
    }

    if (umbala_get_opt('alus_prod_custom_tab')) {
        $tabs['alus_custom'] = array(
            'title' => esc_html($custom_tab_title)
            , 'priority' => 90
            , 'callback' => "umbala_product_custom_tab_content",
        );
    }
    return $tabs;
}

function umbala_product_custom_tab_content() {
    global $post;

    $custom_tab_content = umbala_get_opt('alus_prod_custom_tab_content');

    $product_custom_tab = get_post_meta($post->ID, 'alus_prod_custom_tab', true);
    if ($product_custom_tab) {
        $custom_tab_content = get_post_meta($post->ID, 'alus_prod_custom_tab_content', true);
    }

    echo do_shortcode(stripslashes(wp_specialchars_decode($custom_tab_content)));
}

/* Related products */
function umbala_output_related_products_args_filter($args) {
    $args['posts_per_page'] = 6;
    $args['columns'] = 5;
    return $args;
}

/* Show product price */
function umbala_variable_product_price_filter($value, $object = null, $variation = null) {
    if ($value['price_html'] == '') {
        $value['price_html'] = '<span class="price">' . $variation->get_price_html() . '</span>';
    }
    return $value;
}

/* Add footer PhotoSwipe template */
add_action('wp_footer', 'umbala_photoswipe_tempalte', 1000);
function umbala_photoswipe_tempalte() {
    if (is_singular('product')) {
        get_template_part('woocommerce/single-product/photo-swipe-template');
    }
}

/* * * General hook ** */
add_action('woocommerce_after_shop_loop_item_title', 'umbala_template_loop_add_to_cart', 10006);

function umbala_product_group_button_start() {
    $num_icon = 0;

    if (!umbala_get_opt('alus_enable_catalog_mode')) {
        $num_icon++;
    }

    echo "<div class=\"alus-product-buttons\" >";
}

function umbala_product_group_button_end() {
    echo "</div>";
}

function umbala_meta_start() {
    echo "<div class='alus-product-buttons'>";
}

function umbala_meta_end() {
    echo "</div>";
}

add_action('woocommerce_after_shop_loop_item_title', 'umbala_product_group_button_start', 10000);
add_action('woocommerce_after_shop_loop_item_title', 'umbala_product_group_button_end', 10005);
add_action('woocommerce_after_shop_loop_item', 'umbala_meta_start', 69);
add_action('woocommerce_after_shop_loop_item', 'umbala_meta_end', 100);

/* Wishlist */
function umbala_wishlist_button() {
    if (class_exists('YITH_WCWL_Shortcode')) {
        echo YITH_WCWL_Shortcode::add_to_wishlist(array());
    }
}
add_action('woocommerce_after_shop_loop_item_title', 'umbala_wishlist_button', 10002);
add_action('woocommerce_after_shop_loop_item', 'umbala_wishlist_button', 80);

/* Compare */
if (class_exists('YITH_Woocompare') && get_option('yith_woocompare_compare_button_in_products_list') == 'yes') {
    global $yith_woocompare;
    $is_ajax = (defined('DOING_AJAX') && DOING_AJAX);
    if ($yith_woocompare->is_frontend() || $is_ajax) {
        if ($is_ajax) {
            if (defined('YITH_WOOCOMPARE_DIR') && !class_exists('YITH_Woocompare_Frontend')) {
                $compare_frontend_class = YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
                if (file_exists($compare_frontend_class)) {
                    require_once $compare_frontend_class;
                }
            }
            $yith_woocompare->obj = new YITH_Woocompare_Frontend();
        }
        remove_action('woocommerce_after_shop_loop_item', array($yith_woocompare->obj, 'add_compare_link'), 20);

        function umbala_compare_button() {
            if (wp_is_mobile()) {
                return;
            }

            global $yith_woocompare, $product;
            echo '<div class="alus-compare"> <a class="compare" href="' . esc_url($yith_woocompare->obj->add_product_url($product->get_id())) . '" data-product_id="' . esc_attr($product->get_id()) . '">' . get_option('yith_woocompare_button_text') . '</a></div>';
        }

        add_action('woocommerce_after_shop_loop_item_title', 'umbala_compare_button', 10003);
        add_action('woocommerce_after_shop_loop_item', 'umbala_compare_button', 70);

        add_filter('option_yith_woocompare_button_text', 'umbala_compare_button_text_filter', 99);

        function umbala_compare_button_text_filter($button_text) {
            return '<i class="icon-shuffle"></i>' . esc_html($button_text) . '';
        }

    }

    /* Compare - Add custom style */
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'yith-woocompare-view-table') {
        add_action('wp_print_styles', 'umbala_add_custom_style_compare_popup', 1000);
    }

    function umbala_add_custom_style_compare_popup() {
        wp_enqueue_style('umbala-default');
        wp_enqueue_style('umbala-style');
        wp_enqueue_style('font-awesome');

        /* Add dynamic style for iframe*/
        umbala_register_custom_css();

        /* Register google font for iframe */
        wp_enqueue_style('umbala-font-google');
    }
}

/* * * End General hook ** */

/* * * Cart - Checkout hooks ** */
remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10);
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display', 10);

add_action('woocommerce_proceed_to_checkout', 'umbala_cart_continue_shopping_button', 20);

/* Continue Shopping button */
function umbala_cart_continue_shopping_button() {
    echo '<a href="' . esc_url(wc_get_page_permalink('shop')) . '" class="button button-secondary">' . esc_html__('Continue Shopping', 'umbala') . '</a>';
}
/**
 * ------------------------------------------------------------------------------------------------
 * My account remove logout link
 * ------------------------------------------------------------------------------------------------
 */
if (!function_exists('umbala_remove_my_account_logout')) {
    function umbala_remove_my_account_logout($items) {
        unset($items['customer-logout']);
        return $items;
    }
    add_filter('woocommerce_account_menu_items', 'umbala_remove_my_account_logout', 10);
}
/**
 * ------------------------------------------------------------------------------------------------
 * My account wrapper
 * ------------------------------------------------------------------------------------------------
 */
if (!function_exists('umbala_my_account_wrapp_start')) {
    function umbala_my_account_wrapp_start() {
        echo '<div class="woocommerce-my-account-inner">';
    }
    add_action('woocommerce_account_navigation', 'umbala_my_account_wrapp_start', 1);
}

if (!function_exists('umbala_my_account_wrapp_end')) {
    function umbala_my_account_wrapp_end() {
        echo '</div><!-- .woocommerce-my-account-inner -->';
    }
    add_action('woocommerce_account_content', 'umbala_my_account_wrapp_end', 10000);
}
/**
 * ------------------------------------------------------------------------------------------------
 * My account dashboard links
 * ------------------------------------------------------------------------------------------------
 */
if (!function_exists('umbala_my_account_dashboard_links')) {
    function umbala_my_account_dashboard_links() {
        ?>
        <div class="my-account-dashboard-links">
            <?php foreach (wc_get_account_menu_items() as $endpoint => $label): ?>
                <div class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>-link">
                    <a href="<?php echo esc_url(wc_get_account_endpoint_url($endpoint)); ?>"><?php echo esc_html($label); ?></a>
                </div>
            <?php endforeach;?>
            <?php if (class_exists('YITH_WCWL')): ?>
                <?php $wishlist_page_id = yith_wcwl_object_id(get_option('yith_wcwl_wishlist_page_id'));?>
                <div class="wishlist-link">
                    <a href="<?php echo YITH_WCWL()->get_wishlist_url(); ?>"><?php echo get_the_title($wishlist_page_id); ?></a></li>
                </div>
            <?php endif;?>
        </div>
        <?php

    }
    add_action('woocommerce_account_dashboard', 'umbala_my_account_dashboard_links', 10);
}

/* Product Sticky Bar */
if (!function_exists('umbala_sticky_product')) {
    function umbala_sticky_product() {
        if (umbala_is_woocommerce_activated() && is_product() && umbala_get_opt('alus_product_sticky_bar')) {
            global $post;

            $product = wc_get_product($post->ID);
            if ($product->is_in_stock()) {
                $image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()), 'shop_thumbnail');
                ?>
                <div class="umbala_product_sticky">
                    <div class="container">
                        <?php if (umbala_get_opt('alus_show_product_sticky_image')): ?>
                            <span class="product_sticky_image"><img src="<?php echo has_post_thumbnail() ? ($image[0]) : wc_placeholder_img_src(); ?>" alt="<?php echo wp_kses_post($product->get_name()); ?>"></span>
                        <?php endif;?>
                        <div class="product_sticky_detail">
                            <?php if (umbala_get_opt('alus_show_product_sticky_name')): ?>
                                <span><?php echo wp_kses_post($product->get_name()); ?></span>
                            <?php endif;?>
                            <?php if (umbala_get_opt('alus_product_sticky_rating')): ?>
                                <?php woocommerce_template_loop_rating(); ?>
                            <?php endif;?>
                        </div>
                        <?php if (umbala_get_opt('alus_product_sticky_price')): ?>
                            <p class="price"><?php echo wp_kses_post($product->get_price_html()); ?></p>
                        <?php endif;?>
                        <?php if (umbala_get_opt('alus_product_sticky_cart')): ?>
                            <?php umbala_template_loop_add_to_cart(); ?>
                        <?php endif;?>
                    </div>
                </div>
                <?php

            }
        }
    }
    add_action('umbala_after_body_open', 'umbala_sticky_product', 50);
}

/* Swatches */
if (!function_exists('umbala_color_swatches')) {
    function umbala_color_swatches($attribute_name = 'pa_color') {
        global $product;

        $id = $product->get_id();

        if (empty($id) || !$product->is_type('variable') || !umbala_get_opt('alus_enable_color_swatches')) {
            return false;
        }

        $variations = $product->get_available_variations();

        if (empty($variations)) {
            return false;
        }

        $swatches = umbala_get_variations($attribute_name, $variations, $id);

        if (empty($swatches)) {
            return false;
        }

        $output = '<div class="color-swatches">';

        foreach ($swatches as $key => $swatch) {
            $style = $class = '';

            if (!empty($swatch['color'])) {
                $style = 'background-color:' . $swatch['color'];
            } else if (!empty($swatch['image'])) {
                $style = 'background-image: url(' . $swatch['image'] . ')';
            } else {
                $class .= 'color-text ';
            }

            $data = '';

            if (isset($swatch['image_src'])) {
                $data .= 'data-src="' . $swatch['image_src'] . '"';

                if (umbala_get_opt('alus_color_swatches_images')) {
                    $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id($swatch['variation_id']), 'shop_thumbnail');
                    if (!empty($thumbnail)) {
                        $style = 'background-image: url(' . $thumbnail[0] . ')';
                        $class .= ' swatch-is-image';
                    }
                }

            }

            $term = get_term_by('slug', $key, $attribute_name);

            $output .= '<div class="color-swatch ' . esc_attr($class) . '" style="' . esc_attr($style) . '" ' . $data . '>' . $term->name . '</div>';
        }

        $output .= '</div>';

        return $output;

    }
}

if (!function_exists('umbala_get_variations')) {
    function umbala_get_variations($attribute_name, $variations, $product_id = false) {
        $swatches = array();
        foreach ($variations as $key => $variation) {
            $option = array();
            $attr_key = 'attribute_' . $attribute_name;
            if (!isset($variation['attributes'][$attr_key])) {
                return;
            }

            $value = $variation['attributes'][$attr_key];

            if (!empty($variation['image']['src'])) {
                $option = array(
                    'variation_id' => $variation['variation_id'],
                    'image_src' => $variation['image']['src'],
                );
            }

            $swatch = umbala_get_swatch($product_id, $attribute_name, $value);

            $swatches[$value] = array_merge($swatch, $option);

        }

        return $swatches;

    }
}

if (!function_exists('umbala_get_swatch')) {
    function umbala_get_swatch($id, $attr_name, $value) {
        $swatches = array();

        $color = $image = '';

        $term = get_term_by('slug', $value, $attr_name);
        if (is_object($term)) {
            $color = get_term_meta($term->term_id, 'color_color', true);
            $image = get_term_meta($term->term_id, 'color_image', true);
        }

        if ($color != '') {
            $swatches['color'] = $color;
        }

        if ($image != '') {
            $swatches['image'] = $image;
        }

        return $swatches;
    }
}

?>