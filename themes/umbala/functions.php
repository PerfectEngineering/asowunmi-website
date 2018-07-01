<?php
/**
 *
 * The framework's functions
 *
 */
require_once get_parent_theme_file_path('/inc/functions.php');

/**
 * Enqueue scripts and styles.
 */
function umbala_enqueue_scripts() {

    wp_enqueue_style('umbala-font-google', umbala_google_font_url());

    wp_dequeue_style('font-awesome');
    wp_dequeue_style('yith-wcwl-font-awesome');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
    wp_enqueue_style('simple-line-icons', get_template_directory_uri() . '/assets/css/simple-line-icons.css');

    /* Theme stylesheet. */
    wp_enqueue_style('umbala-style', get_stylesheet_uri());

    wp_enqueue_style('umbala-default', get_template_directory_uri() . '/assets/css/default.css');

    wp_enqueue_style('umbala-responsive', get_template_directory_uri() . '/assets/css/responsive.css');

    wp_enqueue_style('umbala-shortcode', get_template_directory_uri() . '/assets/css/shortcode.css');

    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
    wp_enqueue_style('magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css');
    wp_enqueue_style('photoswipe', get_template_directory_uri() . '/assets/css/photoswipe/photoswipe.css');
    wp_enqueue_style('photoswipe-default', get_template_directory_uri() . '/assets/css/photoswipe/default-skin/default-skin.css');

    /* Enqueue scripts */
    wp_dequeue_script('flexslider');
    wp_dequeue_script('photoswipe-ui-default');
    wp_dequeue_script('prettyPhoto-init');
    wp_dequeue_style('photoswipe-default-skin');
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array(), null, true);
    wp_enqueue_script('parallax', get_template_directory_uri() . '/assets/js/jquery.parallax.js', array(), null, true);
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), null, true);
    wp_enqueue_script('photoswipe', get_template_directory_uri() . '/assets/js/photoswipe.min.js', array(), null, true);
    wp_enqueue_script('photoswipe-ui-default', get_template_directory_uri() . '/assets/js/photoswipe-ui-default.min.js', array(), null, true);
    wp_enqueue_script('fastclick', get_template_directory_uri() . '/assets/js/fastclick.js', array(), null, true);
    wp_enqueue_script('isotope', get_template_directory_uri() . '/assets/js/isotope.pkgd.min.js', array(), null, true);
    wp_enqueue_script('lazy', get_template_directory_uri() . '/assets/js/jquery.lazy.min.js', array(), null, true);
    wp_enqueue_script('bootstrap-tooltips', get_template_directory_uri() . '/assets/js/jquery.tooltips.js', array(), null, true);
    wp_enqueue_script('tween-lite', get_template_directory_uri() . '/assets/js/TweenLite.min.js', array(), null, true);
    wp_enqueue_script('tween-max', get_template_directory_uri() . '/assets/js/TweenMax.min.js', array(), null, true);
    wp_enqueue_script('panr', get_template_directory_uri() . '/assets/js/jquery.panr.js', array(), null, true);
    wp_enqueue_script('waypoint', get_template_directory_uri() . '/assets/js/jquery.waypoints.min.js', array(), null, true);
    wp_enqueue_script('countdown', get_template_directory_uri() . '/assets/js/jquery.countdown.min.js', array(), null, true);
    wp_enqueue_script('counter-up', get_template_directory_uri() . '/assets/js/jquery.counterup.min.js', array(), null, true);
    wp_enqueue_script('scroll-to', get_template_directory_uri() . '/assets/js/jquery.scrollTo.min.js', array(), null, true);
    wp_enqueue_script('easyzoom', get_template_directory_uri() . '/assets/js/easyzoom.js', array(), null, true);
    wp_enqueue_script('cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.min.js', array('jquery'), null, true);

    wp_enqueue_script('html5', get_template_directory_uri() . '/assets/js/html5.js', array(), '3.7.3');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    if (is_singular('product') && umbala_get_opt('alus_prod_thumbnails_style') == 'vertical') {
        wp_enqueue_script('slick', get_template_directory_uri() . '/assets/js/slick.min.js', array(), null, true);
    }

    wp_enqueue_script('umbala-global', get_template_directory_uri() . '/assets/js/global.js', array('jquery'), '1.0', true);

    if (defined('ICL_LANGUAGE_CODE')) {
        $ajax_uri = esc_url(admin_url('admin-ajax.php?lang=' . ICL_LANGUAGE_CODE, 'relative'));
    } else {
        $ajax_uri = esc_url(admin_url('admin-ajax.php', 'relative'));
    }

    $translations = array(
        'ajax_uri' => $ajax_uri,
        'alus_enable_ajax_search' => (int) umbala_get_opt('alus_ajax_search'),
        'alus_enable_popup' => (int) umbala_get_opt('alus_enable_popup'),
        'alus_popup_event' => umbala_get_opt('alus_popup_event'),
        'alus_popup_pages' => (int) umbala_get_opt('alus_popup_pages'),
        'alus_popup_scroll' => (int) umbala_get_opt('alus_popup_scroll'),
        'alus_popup_timeout' => (int) umbala_get_opt('alus_popup_timeout'),
        'countdown_days' => esc_html__('days', 'umbala'),
        'countdown_hours' => esc_html__('hours', 'umbala'),
        'countdown_mins' => esc_html__('mins', 'umbala'),
        'countdown_sec' => esc_html__('secs', 'umbala'),
        'cart_message' => esc_html__(' has been added to your cart.', 'umbala'),
    );
    wp_localize_script('umbala-global', 'umbala_settings', $translations);

    wp_enqueue_script('wc-add-to-cart-variation');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'umbala_enqueue_scripts', 1000);

/* * * Enqueue admin style and scripts ** */
function umbala_admin_scripts() {
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
    wp_enqueue_style('umbala-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css');
    wp_enqueue_script('umbala-admin-script', get_template_directory_uri() . '/assets/js/admin-script.js', array('jquery'), null, true);
}
add_action('admin_enqueue_scripts', 'umbala_admin_scripts');

/* * * Enqueue editor styles support for Gutenberg ** */
function umbala_editor_styles() {
    wp_enqueue_style('umbala-font-google', umbala_google_font_url());
}
add_action( 'enqueue_block_editor_assets', 'umbala_editor_styles' );

/* * * Render google font link ** */
if (!function_exists('umbala_google_font_url')) {
    function umbala_google_font_url() {
        $fonts = $font_parse = array();

        $title_font = umbala_get_opt('alus_title_font_google');
        if (umbala_get_opt('alus_title_font')) {
            $fonts[] = array(
                'name' => $title_font['font-family'],
                'bold' => '300,400,500,600,700,800,900',
            );
        }

        $second_font = umbala_get_opt('alus_body_font');
        $fonts[] = array(
            'name' => $second_font['font-family'],
            'bold' => '300,400,500,600,700,800,900',
        );

        foreach ($fonts as $font) {
            $font_parse[] = $font['name'] . ':' . $font['bold'];
        }

        $query_args = array(
            'family' => urldecode(implode('|', $font_parse)),
            'subset' => urlencode('latin,latin-ext'),
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

        return esc_url_raw($fonts_url);
    }
}
