<?php
/**
 * Dont Update the Theme
 * https://gist.github.com/jaredatch/f406d6b2ca543cdb4898
 */
if (!function_exists('umbala_dont_update_theme')) {
    function umbala_dont_update_theme( $r, $url ) {
        if ( 0 !== strpos( $url, 'https://api.wordpress.org/themes/update-check/1.1/' ) )
            return $r; // Not a theme update request. Bail immediately.
        $themes = json_decode( $r['body']['themes'] );
        $child = get_option( 'stylesheet' );
        unset( $themes->themes->$child );
        $r['body']['themes'] = json_encode( $themes );
        return $r;
     }
    add_filter( 'http_request_args', 'umbala_dont_update_theme', 5, 2 );
}

/*
 * Adds custom classes to the array of body classes.
 */
function umbala_body_classes($classes) {

    if (!is_singular()) {
        $classes[] = 'hfeed';
    }
    if (is_customize_preview()) {
        $classes[] = 'has-customizer';
    }
    if ('blank' === get_header_textcolor()) {
        $classes[] = 'title-tagline-hidden';
    }
    if (umbala_get_opt('alus_show_sidebar_button')) {
        $classes[] = 'off-canvas-shop-sidebar';
    }
    if (umbala_get_opt('alus_enable_sticky_header')) {
        $classes[] = 'has_sticky_header';
    }
    $layout_width = umbala_get_opt('alus_layout');
    if ($layout_width) {
        $classes[] = 'wrapper-layout-' . $layout_width;
    }

    return $classes;
}
add_filter('body_class', 'umbala_body_classes');

/* * * Theme Setup * * */
function umbala_setup() {

    $GLOBALS['content_width'] = 1200;

    add_editor_style();

    load_theme_textdomain('umbala');

    /** Add theme support. */
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('audio', 'gallery', 'quote', 'video'));
    add_theme_support('html5', array('comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('custom-background');
    add_theme_support('woocommerce');
    add_theme_support('custom-header');

    /* Support for Gutenberg */ 
    add_theme_support( 'align-wide' );

    /* Translation */
    load_theme_textdomain('umbala', get_template_directory() . '/languages');

    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if (is_readable($locale_file)) {
        require_once $locale_file;
    }

/* Register theme location. */
    register_nav_menus(array(
        'primary' => esc_html__('Primary Navigation', 'umbala'),
        'vertical' => esc_html__('Vertical Navigation', 'umbala'),
        'mobile' => esc_html__('Mobile Navigation', 'umbala'),
    ));

    $starter_content = array(
        'widgets' => array(
            'blog-sidebar' => array(
                'text_business_info',
                'text_about',
            ),

            'blog-detail-sidebar' => array(
                'text_business_info',
            ),
        ),
    );
    $starter_content = apply_filters('umbala_starter_content', $starter_content);
    add_theme_support('starter-content', $starter_content);
}

add_action('after_setup_theme', 'umbala_setup');

/* * * Check if WooCommerce is Active ** */
if (!function_exists('umbala_is_woocommerce_activated')) {
    function umbala_is_woocommerce_activated() {
        return class_exists('woocommerce') ? true : false;
    }
}

/**
 * Load all files
 */
require_once get_parent_theme_file_path('/inc/includes.php');

/* * * Visual Composer plugin ** */
if (class_exists('Vc_Manager') && class_exists('WPBakeryVisualComposerAbstract')) {
    $file_names = array('vc-map', 'vc-config');
    foreach ($file_names as $file) {
        $file_path = get_template_directory() . '/inc/vc-element/' . $file . '.php';
        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }
}

/* Install Required Plugins */
add_action('tgmpa_register', 'umbala_register_required_plugins');

function umbala_register_required_plugins() {
    $plugin_dir_path = get_template_directory() . '/inc/plugins/';
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        array(
            'name' => 'Alura Studio',
            'slug' => 'alura-studio',
            'source' => $plugin_dir_path . 'alura-studio.zip',
            'required' => true,
            'version' => '1.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        )
        , array(
            'name' => 'Redux Framework',
            'slug' => 'redux-framework',
            'required' => true,
        )
        , array(
            'name' => 'CMB2',
            'slug' => 'cmb2',
            'required' => true,
        )
        , array(
            'name' => 'WooCommerce',
            'slug' => 'woocommerce',
            'required' => false,
        )
        , array(
            'name' => 'WPBakery Visual Composer',
            'slug' => 'js_composer',
            'source' => $plugin_dir_path . 'js_composer.zip',
            'required' => true,
            'version' => '5.4.7',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        )
        , array(
            'name' => 'Revolution Slider',
            'slug' => 'revslider',
            'source' => $plugin_dir_path . 'revslider.zip',
            'required' => false,
            'version' => '5.4.7.1',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        )
        , array(
            'name' => 'Umbala Importer',
            'slug' => 'umbala_importer',
            'source' => $plugin_dir_path . 'umbala_importer.zip',
            'required' => true,
            'version' => '1.0.0',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => '',
        )
        , array(
            'name' => 'Contact Form 7',
            'slug' => 'contact-form-7',
            'required' => false,
        )
        , array(
            'name' => 'YITH WooCommerce Wishlist',
            'slug' => 'yith-woocommerce-wishlist',
            'required' => false,
        )
        , array(
            'name' => 'YITH WooCommerce Compare',
            'slug' => 'yith-woocommerce-compare',
            'required' => false,
        )
        , array(
            'name' => 'Mailchimp for WordPress',
            'slug' => 'mailchimp-for-wp',
            'required' => false,
        ),
    );

    $config = array(
        'id' => 'tgmpa', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php', // Parent menu slug.
        'capability' => 'edit_theme_options', // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => true, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}
?>