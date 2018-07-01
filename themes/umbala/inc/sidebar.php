<?php
/**
 * Register sidebar
 *
 */

if (!function_exists('umbala_get_list_sidebars')) {
    function umbala_get_list_sidebars() {
        $sidebars = array(
            array(
                'name' => esc_html__('Blog Sidebar', 'umbala'),
                'id' => 'blog-sidebar',
                'description' => esc_html__('Add widgets in your blog.', 'umbala'),
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title-wrap"><h4 class="widget-title">',
                'after_title' => '</h4></div>',
            )
            , array(
                'name' => esc_html__('Blog Detail Sidebar', 'umbala'),
                'id' => 'blog-detail-sidebar',
                'description' => esc_html__('Add widgets in your blog detail.', 'umbala'),
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title-wrap"><h4 class="widget-title">',
                'after_title' => '</h4></div>',
            )
            , array(
                'name' => esc_html__('Product Category Sidebar', 'umbala'),
                'id' => 'product-category-sidebar',
                'description' => esc_html__('Add widgets in product category page.', 'umbala'),
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title-wrap"><h4 class="widget-title">',
                'after_title' => '</h4></div>',
            )
            , array(
                'name' => esc_html__('Product Filters Area Content', 'umbala'),
                'id' => 'product-filters-content',
                'description' => esc_html__('Add widgets in product filters content.', 'umbala'),
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title-wrap"><h4 class="widget-title">',
                'after_title' => '</h4></div>',
            )
            , array(
                'name' => esc_html__('Product Detail Sidebar', 'umbala'),
                'id' => 'product-detail-sidebar',
                'description' => esc_html__('Add widgets in product detail page.', 'umbala'),
                'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<div class="widget-title-wrap"><h4 class="widget-title">',
                'after_title' => '</h4></div>',
            ),
        );

        $custom_sidebars = umbala_get_custom_sidebar();
        if (is_array($custom_sidebars)) {
            foreach ($custom_sidebars as $name) {
                $sidebars[] = array(
                    'name' => '' . $name . '',
                    'id' => sanitize_title($name),
                    'class' => 'umbala_custom_sidebar',
                    'before_widget' => '<div id="%1$s" class="sidebar-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title' => '<div class="widget-title-wrap"><h4 class="widget-title">',
                    'after_title' => '</h4></div>',
                );
            }
        }

        return $sidebars;
    }
}

if (!function_exists('umbala_get_footer_widget')) {
    function umbala_get_footer_widget() {
        $footerwg = array(
            array(
                'name' => esc_html__('Footer Top', 'umbala'),
                'id' => 'footer-top',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'description' => esc_html__('Add widgets in your footer.', 'umbala'),
            )
            , array(
                'name' => esc_html__('Footer Middle', 'umbala'),
                'id' => 'footer-middle',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'description' => esc_html__('Add widgets in your footer.', 'umbala'),
            )
            , array(
                'name' => esc_html__('Footer Bottom', 'umbala'),
                'id' => 'footer-bottom',
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget' => '</div>',
                'description' => esc_html__('Add widgets in your footer.', 'umbala'),
            ),
        );
        return $footerwg;
    }
}

function umbala_register_widget_area() {
    $umbala_default_sidebars = umbala_get_list_sidebars();
    $umbala_footer_widget = umbala_get_footer_widget();
    $sidebars = array_merge($umbala_default_sidebars, $umbala_footer_widget);
    foreach ($sidebars as $sidebar) {
        register_sidebar($sidebar);
    }
}
add_action('widgets_init', 'umbala_register_widget_area');

/**
 * Add Custom Sidebar
 */

if (!function_exists('umbala_add_sidebar_action')) {
    function umbala_add_sidebar_action() {
        if (!wp_verify_nonce($_GET['_wpnonce_umbala_widgets'], 'umbala-add-sidebar-widgets')) {
            die('Security check');
        }

        if ($_GET['umbala_sidebar_name'] == '') {
            die('Empty Name');
        }

        $option_name = 'umbala_custom_sidebars';
        if (!get_option($option_name) || get_option($option_name) == '') {
            delete_option($option_name);
        }

        $new_sidebar = $_GET['umbala_sidebar_name'];

        $result = umbala_add_sidebar($new_sidebar);

        if ($result) {
            die($result);
        } else {
            die('error');
        }

    }
}

if (!function_exists('umbala_add_sidebar')) {
    function umbala_add_sidebar($name) {
        $option_name = 'umbala_custom_sidebars';
        if (get_option($option_name)) {
            $custom_sidebars = umbala_get_custom_sidebar();
            $custom_sidebars[] = trim($name);
            $result = update_option($option_name, $custom_sidebars);
        } else {
            $custom_sidebars[] = $name;
            $result2 = add_option($option_name, $custom_sidebars);
        }
        if ($result) {
            return 'Updated';
        } elseif ($result2) {
            return 'added';
        } else {
            die('error');
        }

    }
}

/**
 * Delete Custom sidebar
 */

if (!function_exists('umbala_delete_sidebar')) {
    function umbala_delete_sidebar() {
        $option_name = 'umbala_custom_sidebars';
        $delete_sidebar = trim($_GET['umbala_sidebar_name']);

        if (get_option($option_name)) {
            $custom_sidebars = umbala_get_custom_sidebar();

            foreach ($custom_sidebars as $key => $value) {
                if ($value == $delete_sidebar) {
                    unset($custom_sidebars[$key]);
                }
            }

            $result = update_option($option_name, $custom_sidebars);
        }

        if ($result) {
            die('Deleted');
        } else {
            die('error');
        }

    }
}

/**
 * Get Custom sidebar
 */

if (!function_exists('umbala_get_custom_sidebar')) {
    function umbala_get_custom_sidebar() {
        $option_name = 'umbala_custom_sidebars';
        return get_option($option_name);
    }
}

/**
 * Add form Custom sidebar
 */

if (!function_exists('umbala_sidebar_form')) {
    function umbala_sidebar_form() {
        ?>
		<form action="<?php echo esc_url(admin_url('widgets.php')); ?>" method="post" id="umbala_add_sidebar_form">
			<h2><?php echo esc_html_e('Custom Sidebar', 'umbala'); ?></h2>
			<?php wp_nonce_field('umbala-add-sidebar-widgets', '_wpnonce_umbala_widgets', false); ?>
			<input type="text" name="umbala_sidebar_name" id="umbala_sidebar_name" />
			<button type="submit" class="button-primary" value="add-sidebar"><?php esc_html_e('Add Sidebar', 'umbala'); ?></button>
		</form>
		<?php

    }
}
add_action('sidebar_admin_page', 'umbala_sidebar_form', 30);
add_action('wp_ajax_umbala_add_sidebar', 'umbala_add_sidebar_action');
add_action('wp_ajax_umbala_delete_sidebar', 'umbala_delete_sidebar');

?>