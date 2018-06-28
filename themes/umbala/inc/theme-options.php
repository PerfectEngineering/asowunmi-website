<?php

/**
 * ReduxFramework Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 **/

if (!class_exists('Umbala_Redux_Framework_Option')) {
    class Umbala_Redux_Framework_Option {

        public $args = array();
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        function __construct() {
            if (!class_exists('ReduxFramework')) {
                return;
            }

            if (true == Redux_Helpers::isTheme(__FILE__)) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);
            }
        }

        function initSettings() {

            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();
            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) {
                // No errors please
                return;
            }

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css, $changed_values) {

        }

        function dynamic_section($sections) {

            return $sections;
        }

        function change_arguments($args) {

            return $args;
        }

        function change_defaults($defaults) {

            return $defaults;
        }

        function remove_demo() {

        }

        function setSections() {

            /* Default Sidebar */
            $umbala_default_sidebars = umbala_get_list_sidebars();
            $of_sidebars = array();
            if ($umbala_default_sidebars) {
                foreach ($umbala_default_sidebars as $key => $_sidebar) {
                    $of_sidebars[$_sidebar['id']] = $_sidebar['name'];
                }
            }
            $alus_layouts = array(
                'full-width' => ReduxFramework::$_url . 'assets/img/1col.png'
                , 'right-sidebar' => ReduxFramework::$_url . 'assets/img/2cr.png'
                , 'left-sidebar' => ReduxFramework::$_url . 'assets/img/2cl.png'
                , 'left-right-sidebar' => ReduxFramework::$_url . 'assets/img/3cm.png',
            );

            /* * *   General Options   * **/
            $this->sections[] = array(
                'icon' => 'el el-home',
                'title' => esc_html__('General', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_layout',
                        'type' => 'button_set',
                        'title' => esc_html__('Layout', 'umbala'),
                        'default' => 'full-width',
                        'options' => array(
                            'full-width' => esc_html__('Full width', 'umbala'),
                            'boxed' => esc_html__('Boxed', 'umbala'),
                            'wide' => esc_html__('Wide (1600 px)', 'umbala'),
                        ),
                    )
                    , array(
                        'id' => 'alus_back_to_top_button',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Back To Top Button', 'umbala'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                    )
                    , array(
                        'id' => 'alus_back_to_top_button_on_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Back To Top Button On Mobile', 'umbala'),
                        'default' => false,
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                    )
                    , array(
                        'id' => 'alus_gmap_api_key',
                        'type' => 'text',
                        'title' => esc_html__('Google API key', 'umbala'),
                        'desc' => wp_kses(__('Obtain API key <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a> to use our Google Map VC element.', 'umbala'), array(
                            'a' => array(
                                'href' => array(),
                                'target' => array(),
                            ),
                        )),
                    ),
                ),
            );

            /** Logo - Favicon **/
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Logo - Favicon', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_logo',
                        'type' => 'media',
                        'title' => esc_html__('Logo Image', 'umbala'),
                        'desc' => esc_html__('Select an image file for the main logo', 'umbala'),
                        'default' => array(
                            'url' => get_template_directory_uri() . '/assets/images/logo.png',
                        ),
                    )
                    , array(
                        'id' => 'alus_logo_sticky',
                        'type' => 'media',
                        'title' => esc_html__('Logo Image for sticky header', 'umbala'),
                        'desc' => '',
                    )
                    , array(
                        'id' => 'alus_favicon',
                        'type' => 'media',
                        'title' => esc_html__('Favicon Image', 'umbala'),
                        'desc' => esc_html__('Upload ICO, PNG files', 'umbala'),
                    )
                    , array(
                        'id' => 'alus_favicon_retina',
                        'type' => 'media',
                        'title' => esc_html__('Favicon retina image', 'umbala'),
                        'desc' => esc_html__('Upload ICO, PNG files', 'umbala'),
                    ),
                ),
            );

            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Breadcrumb', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_page_title',
                        'type' => 'switch',
                        'title' => esc_html__('Show page title', 'umbala'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                    )
                    , array(
                        'id' => 'alus_breadcrumbs',
                        'type' => 'switch',
                        'title' => esc_html__('Show breadcrumbs', 'umbala'),
                        'default' => true,
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                    )
                    , array(
                        'id' => 'alus_breadcrumb_layout',
                        'type' => 'select',
                        'title' => esc_html__('Breadcrumb Layout', 'umbala'),
                        'default' => 'layout1',
                        'options' => array(
                            'layout1' => esc_html__('Layout 1', 'umbala'),
                            'layout2' => esc_html__('Layout 2', 'umbala'),
                        ),
                    )
                    , array(
                        'id' => 'alus_bg_breadcrumbs',
                        'type' => 'background',
                        'title' => esc_html__('Breadcrumbs Background Image', 'umbala'),
                        'output' => array('.alus-breadcrumb'),
                        'desc' => esc_html__("Select a background image for Breadcrumb", "umbala"),
                        'tags' => 'breadcrumb color background breadcrumb color background bgbreadcrumb',
                    ),
                ),
            );

            /** Popup Options **/
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Popup', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_enable_popup',
                        'type' => 'switch',
                        'title' => esc_html__('Enable Popup', 'umbala'),
                        'default' => 0,
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                    ),
                    array(
                        'id' => 'alus_popup_editor',
                        'type' => 'editor',
                        'title' => esc_html__('Popup Text', 'umbala'),
                        'default' => '',
                    ),
                    array(
                        'id' => 'alus_popup_event',
                        'type' => 'select',
                        'title' => esc_html__('Popup Event', 'umbala'),
                        'default' => 'time',
                        'options' => array(
                            'time' => esc_html__('Time', 'umbala'),
                            'scroll' => esc_html__('Scroll', 'umbala'),
                        ),
                    ),
                    array(
                        'id' => 'alus_popup_timeout',
                        'type' => 'text',
                        'title' => esc_html__('Popup Delay', 'umbala'),
                        'default' => '1000',
                        'required' => array(
                            array('alus_popup_event', 'equals', 'time'),
                        ),
                    ),
                    array(
                        'id' => 'alus_popup_scroll',
                        'type' => 'slider',
                        'title' => esc_html__('Show after user scroll down the page', 'umbala'),
                        'subtitle' => esc_html__('Set the number of pixels users have to scroll down before popup opens', 'umbala'),
                        'default' => 1000,
                        "min" => 100,
                        "step" => 50,
                        "max" => 5000,
                        'display_value' => 'label',
                        'required' => array(
                            array('alus_popup_event', 'equals', 'scroll'),
                        ),
                    ),
                    array(
                        'id' => 'alus_popup_pages',
                        'type' => 'slider',
                        'title' => esc_html__('Show after number of pages visited', 'umbala'),
                        'subtitle' => esc_html__('You can choose how much pages user should change before popup will be shown.', 'umbala'),
                        'default' => 0,
                        "min" => 0,
                        "step" => 1,
                        "max" => 10,
                        'display_value' => 'label',
                    ),
                    array(
                        'id' => 'alus_popup-background',
                        'type' => 'background',
                        'title' => esc_html__('Popup background', 'umbala'),
                        'subtitle' => esc_html__('Set background image or color for promo popup', 'umbala'),
                        'output' => array('.alus-popup'),
                        'default' => array(
                            'background-color' => '#111111',
                            'background-repeat' => 'no-repeat',
                            'background-size' => 'contain',
                            'background-position' => 'left center',
                        ),
                    ),
                    array(
                        'id' => 'alus_promo_popup_hide_mobile',
                        'type' => 'switch',
                        'title' => esc_html__('Hide for mobile devices', 'umbala'),
                        'default' => 1,
                    ),
                ),
            );

/** Header Options **/
            $this->sections[] = array(
                'icon' => 'el el-arrow-up',
                'title' => esc_html__('Header', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_header_layout',
                        'type' => 'image_select',
                        'full_width' => true,
                        'title' => esc_html__('Header Layout', 'umbala'),
                        'subtitle' => esc_html__('This header style will be showed only in inner pages, please go to Pages > Homepage to change header for front page.', 'umbala'),
                        'options' => array(
                            'layout1' => array(
                                'title' => 'Layout 1',
                                'img' => get_template_directory_uri() . '/assets/images/header/layout1.jpg',
                            ),
                            'layout2' => array(
                                'title' => 'Layout 2',
                                'img' => get_template_directory_uri() . '/assets/images/header/layout2.jpg',
                            ),
                            'layout3' => array(
                                'title' => 'Layout 3',
                                'img' => get_template_directory_uri() . '/assets/images/header/layout3.jpg',
                            ),
                            'layout4' => array(
                                'title' => 'Layout 4',
                                'img' => get_template_directory_uri() . '/assets/images/header/layout4.jpg',
                            ),
                        ),
                        'default' => 'layout1',
                    ),
                    array(
                        'id' => 'alus_header_mobile_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Header on mobile devices', 'umbala'),
                        'subtitle' => esc_html__('Set your header design for mobile devices', 'umbala'),
                        'options' => array(
                            'center' => array(
                                'title' => 'Logo center',
                                'img' => get_template_directory_uri() . '/assets/images/header/header-mobile-center.png',
                            ),
                            'left' => array(
                                'title' => 'Mobile menu left',
                                'img' => get_template_directory_uri() . '/assets/images/header/header-mobile-left.png',
                            ),
                            'right' => array(
                                'title' => 'Mobile menu right',
                                'img' => get_template_directory_uri() . '/assets/images/header/header-mobile-right.png',
                            ),
                        ),
                        'default' => 'center',
                        'tags' => 'mobile header',
                    ),
                    array(
                        'id' => 'alus_enable_sticky_header',
                        'type' => 'switch',
                        'title' => esc_html__('Sticky header', 'umbala'),
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                        'default' => 1,
                    ),
                    array(
                        'id' => 'alus_header_top_bar',
                        'type' => 'switch',
                        'title' => esc_html__('Show Top bar', 'umbala'),
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                        'default' => 1,
                    ),
                    array(
                        'id' => 'alus-top-bar-color',
                        'type' => 'color',
                        'title' => esc_html__('Top bar Text Color', 'umbala'),
                        'default' => '#999999',
                        'transparent' => false,
                        'required' => array(
                            array('alus_header_top_bar', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus-top-bar-bg',
                        'type' => 'color',
                        'title' => esc_html__('Top bar Background', 'umbala'),
                        'default' => '#ffffff',
                        'transparent' => false,
                        'required' => array(
                            array('alus_header_top_bar', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_header_contact_information',
                        'type' => 'editor',
                        'title' => esc_html__('Top bar left', 'umbala'),
                        'required' => array(
                            array('alus_header_top_bar', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_middle_header_content',
                        'type' => 'editor',
                        'title' => esc_html__('Header Content - Information (Header-layout3)', 'umbala'),
                    ),
                    array(
                        'id' => 'alus_header_currency',
                        'type' => 'switch',
                        'title' => esc_html__('Header Currency', 'umbala'),
                        'default' => 0,
                        'on' => esc_html__('Enable', 'umbala'),
                        'off' => esc_html__('Disable', 'umbala'),
                        'required' => array(
                            array('alus_header_top_bar', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_header_language',
                        'type' => 'switch',
                        'title' => esc_html__('Header Language', 'umbala'),
                        'desc' => esc_html__("If you don't install WPML plugin, it will display demo html", "umbala"),
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                        'default' => 0,
                        'required' => array(
                            array('alus_header_top_bar', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_enable_tiny_account',
                        'type' => 'switch',
                        'title' => esc_html__('My Account', 'umbala'),
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                        'default' => 1,
                        'required' => array(
                            array('alus_header_top_bar', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_login_style',
                        'type' => 'select',
                        'title' => esc_html__('My Account Type', 'umbala'),
                        'default' => 'dropdown',
                        'options' => array(
                            'dropdown' => esc_html__('Dropdown', 'umbala'),
                            'canvas' => esc_html__('Off-Canvas', 'umbala'),
                        ),
                        'required' => array(
                            array('alus_enable_tiny_account', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_enable_tiny_wishlist',
                        'type' => 'switch',
                        'title' => esc_html__('Wishlist', 'umbala'),
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                        'default' => 1,
                        'required' => array(
                            array('alus_header_top_bar', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_enable_tiny_shopping_cart',
                        'type' => 'switch',
                        'title' => esc_html__('Shopping Cart', 'umbala'),
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                        'default' => 1,
                    ),
                    array(
                        'id' => 'alus_tiny_cart_style',
                        'type' => 'select',
                        'title' => esc_html__('Shopping Cart Type', 'umbala'),
                        'default' => 'dropdown',
                        'options' => array(
                            'dropdown' => esc_html__('Dropdown', 'umbala'),
                            'canvas' => esc_html__('Off-Canvas', 'umbala'),
                        ),
                        'required' => array(
                            array('alus_enable_tiny_shopping_cart', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_enable_search',
                        'type' => 'switch',
                        'title' => esc_html__('Search Bar', 'umbala'),
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                        'default' => 1,
                    ),
                    array(
                        'title' => esc_html__("Enable Ajax Search", "umbala"),
                        'desc' => "",
                        'id' => "alus_ajax_search",
                        'default' => "1",
                        'type' => "switch",
                        'required' => array(
                            array('alus_enable_search', 'equals', true),
                        ),
                    ),
                    array(
                        'title' => esc_html__("Number Of Results", "umbala"),
                        'desc' => esc_html__("Input -1 to show all results", "umbala"),
                        'id' => "alus_ajax_search_number_result",
                        'default' => 3,
                        'type' => "text",
                        'required' => array(
                            array('alus_enable_search', 'equals', true),
                        ),
                    ),
                ),
            );

/* * *  Typography  * * */
            $this->sections[] = array(
                'icon' => 'el el-brush',
                'icon_class' => 'icon',
                'title' => esc_html__('Styling', 'umbala'),
                'fields' => array(
                ),
            );

/** Color Scheme Options  * */
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Color Scheme', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_primary_color',
                        'type' => 'color',
                        'title' => esc_html__('Primary Color', 'umbala'),
                        'subtitle' => esc_html__('Select a main color for your site.', 'umbala'),
                        'default' => '#ed3f46',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'alus_secondary_color',
                        'type' => 'color',
                        'title' => esc_html__('Secondary Color', 'umbala'),
                        'default' => '#444444',
                        'transparent' => false,
                    ),
                    array(
                        'id' => 'alus_body_background_color',
                        'type' => 'color',
                        'title' => esc_html__('Body Background Color', 'umbala'),
                        'default' => '#ffffff',
                        'transparent' => false,
                    ),
                ),
            );

/** Typography Config    **/
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Typography', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_title_font',
                        'type' => 'switch',
                        'title' => esc_html__('Title Font - Enable Google Font', 'umbala'),
                        'default' => 1,
                        'on' => esc_html__('Yes', 'umbala'),
                        'off' => esc_html__('No', 'umbala'),
                    ),
                    array(
                        'id' => 'alus_title_font_family',
                        'type' => 'select',
                        'title' => esc_html__('Title Font - Family Font', 'umbala'),
                        'default' => 'Arial',
                        'options' => array(
                            "Arial" => "Arial"
                            , "Advent Pro" => "Advent Pro"
                            , "Verdana" => "Verdana, Geneva"
                            , "Trebuchet" => "Trebuchet"
                            , "Georgia" => "Georgia"
                            , "Times New Roman" => "Times New Roman"
                            , "Tahoma, Geneva" => "Tahoma, Geneva"
                            , "Palatino" => "Palatino"
                            , "Helvetica" => "Helvetica",
                        ),
                        'required' => array(
                            array('alus_title_font', 'equals', false),
                        ),
                    ),
                    array(
                        'id' => 'alus_title_font_google',
                        'type' => 'typography',
                        'title' => esc_html__('Title Font - Google Font', 'umbala'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'font-size' => false,
                        'line-height' => false,
                        'text-align' => false,
                        'color' => false,
                        'default' => array(
                            'color' => "#000000",
                            'google' => true,
                            'font-family' => 'Lato',

                        ),
                        'preview' => array(
                            "text" => esc_html__("This is my font preview!", "umbala")
                            , "size" => "30px",
                        ),
                        'required' => array(
                            array('alus_title_font', 'equals', true),
                        ),
                    ),
                    array(
                        'id' => 'alus_body_font',
                        'type' => 'typography',
                        'title' => esc_html__('Body Font - Google Font', 'umbala'),
                        'google' => true,
                        'subsets' => false,
                        'font-style' => false,
                        'font-weight' => false,
                        'font-size' => false,
                        'line-height' => false,
                        'text-align' => false,
                        'color' => false,
                        'default' => array(
                            'color' => "#000000",
                            'google' => true,
                            'font-family' => 'Lato',
                        ),
                        'preview' => array(
                            "text" => esc_html__("This is my font preview!", "umbala")
                            , "size" => "30px",
                        ),
                    ),
                    array(
                        'id' => 'alus_font_size_body',
                        'type' => 'slider',
                        'title' => esc_html__('Body Font Size', 'umbala'),
                        'desc' => esc_html__("In pixels. Default is 14px", "umbala"),
                        'min' => '10',
                        'step' => '1',
                        'max' => '50',
                        'default' => '14',
                    ),
                    array(
                        'id' => 'alus_line_height_body',
                        'type' => 'slider',
                        'title' => esc_html__('Body Font Line Heigh', 'umbala'),
                        'desc' => esc_html__("In pixels. Default is 24px", "umbala"),
                        'min' => '10',
                        'step' => '1',
                        'max' => '50',
                        'default' => '24',
                    ),
                ),
            );

/*** WooCommerce Config     ** */
            if (class_exists('Woocommerce')) {
                $this->sections[] = array(
                    'icon' => 'el el-shopping-cart',
                    'title' => esc_html__('Woocommerce', 'umbala'),
                    'fields' => array(
                        array(
                            'title' => esc_html__("Enable Back Image", "umbala")
                            , 'desc' => esc_html__("Show back on hover. It will show an image from Product Gallery", "umbala")
                            , 'id' => "alus_effect_product"
                            , 'default' => "1"
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Hover Back Image Style", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_effect_hover_product_img"
                            , 'default' => "zoom-long"
                            , 'type' => "select"
                            , 'options' => array(
                                'zoom-long' => esc_html__('Zoom Long', 'umbala')
                                , 'zoom-fade' => esc_html__('Zoom Fade', 'umbala')
                                , 'fade-in' => esc_html__('Fade In', 'umbala')
                                , 'fade-out' => esc_html__('Fade Out', 'umbala'),
                            ),
                        ),
                        array(
                            'title' => esc_html__("Number Of Gallery Product Image", "umbala")
                            , 'id' => "alus_product_gallery_number"
                            , 'default' => 3
                            , 'type' => "text",
                        ),
                        array(
                            'title' => esc_html__("Quickshop", "umbala")
                            , 'desc' => ""
                            , 'id' => "quickshop_options"
                            , "icon" => true
                            , 'type' => "info",
                        ),
                        array(
                            'title' => esc_html__("Activate Quickshop", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_enable_quickshop"
                            , 'default' => "1"
                            , 'type' => "switch",
                        ),
                         array(
                            'title' => esc_html__("Lazy Loading", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_lazy_loading"
                            , "icon" => true
                            , 'type' => "info",
                        ),
                        array(
                            'title' => esc_html__("Enable Lazy Loading", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_enable_lazyload_product"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Catalog Mode", "umbala")
                            , 'desc' => ""
                            , 'id' => "introduction_catalog_mode"
                            , "icon" => true
                            , 'type' => "info",
                        ),
                        array(
                            'title' => esc_html__("Enable Catalog Mode", "umbala")
                            , 'desc' => esc_html__("Hide all Add To Cart buttons on your site. You can also hide Shopping cart by going to Header tab > turn Shopping Cart option off", "umbala")
                            , 'id' => "alus_enable_catalog_mode"
                            , 'default' => "0"
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Label", "umbala")
                            , 'id' => "product_label"
                            , 'type' => "info",
                        ),
                        array(
                            'title' => esc_html__('Product Sale in Percentage', 'umbala')
                            , 'desc' => ''
                            , 'id' => "alus_product_sale_percentage"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Feature Label", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_product_feature_label"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Out Of Stock Label", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_product_out_of_stock_label"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                    ),
                );

                /*** Product Category ***/
                $this->sections[] = array(
                    'title' => esc_html__('Product Category', 'umbala'),
                    'icon' => 'el-icon-tags',
                    'fields' => array(
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Layout', 'umbala'),
                    'fields' => array(
                        array(
                            'id' => 'alus_prod_cat_layout',
                            'type' => 'image_select',
                            'title' => esc_html__('Product Category Layout', 'umbala'),
                            'des' => esc_html__('Select main content and sidebar alignment.', 'umbala'),
                            'options' => $alus_layouts,
                            'default' => 'full-width',
                        ),
                        array(
                            'title' => esc_html__("Left Sidebar", "umbala")
                            , 'id' => "alus_prod_cat_left_sidebar"
                            , 'default' => "product-category-sidebar"
                            , 'type' => "select"
                            , 'options' => $of_sidebars,
                        ),
                        array(
                            'title' => esc_html__("Right Sidebar", "umbala")
                            , 'id' => "alus_prod_cat_right_sidebar"
                            , 'default' => "product-category-sidebar"
                            , 'type' => "select"
                            , 'options' => $of_sidebars,
                        ),
                        array(
                            'title' => esc_html__("Off Canvas Sidebar on Mobile", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_show_sidebar_button"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Color Swatches', 'umbala'),
                    'fields' => array(
                        array(
                            'title' => esc_html__('Show Color Swatches', 'umbala')
                            , 'desc' => esc_html__('Show List of Color Swatches', 'umbala')
                            , 'id' => 'alus_enable_color_swatches'
                            , 'default' => 1
                            , 'on' => esc_html__('Show', 'umbala')
                            , 'off' => esc_html__('Hide', 'umbala')
                            , 'type' => 'switch',
                        ),
                        array(
                            'title' => esc_html__('Color Swatches use Variation Images', 'umbala'),
                            'desc' => esc_html__('Display Images Variation for Color Swatches', 'umbala'),
                            'id' => 'alus_color_swatches_images',
                            'type' => 'switch',
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Grid, List View', 'umbala'),
                    'fields' => array(
                        array(
                            'title' => esc_html__('Show Grid, List view', 'umbala')
                            , 'desc' => esc_html__('Show product in grid or list view', 'umbala')
                            , 'id' => 'alus_enable_grid_list'
                            , 'default' => 1
                            , 'on' => esc_html__('Show', 'umbala')
                            , 'off' => esc_html__('Hide', 'umbala')
                            , 'type' => 'switch',
                        ),
                        array(
                            'title' => esc_html__('Default catalog view', 'umbala'),
                            'desc' => esc_html__('Display products in grid or list view by default', 'umbala'),
                            'id' => 'alus_grid_list_default',
                            'type' => 'select',
                            'default' => 'grid',
                            'options' => array(
                                'grid' => esc_html__('Grid', 'umbala'),
                                'list' => esc_html__('List', 'umbala'),
                            ),
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Data Setting', 'umbala'),
                    'fields' => array(
                        array(
                            'title' => esc_html__("Show Filters Area", "umbala")
                            , 'id' => "alus_show_filters_area"
                            , 'default' => 0
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Columns", "umbala")
                            , 'id' => "alus_prod_cat_columns"
                            , 'default' => "3"
                            , 'type' => "select"
                            , 'options' => array(
                                3 => 3
                                , 4 => 4
                                , 5 => 5
                                , 6 => 6,
                            ),
                        ),
                        array(
                            'title' => esc_html__("Products Per Page", "umbala")
                            , 'desc' => esc_html__("Number of products per page", "umbala")
                            , 'id' => "alus_prod_per_page"
                            , 'default' => 9
                            , 'type' => "text",
                        ),
                        array(
                            'title' => esc_html__("Product Thumbnail", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_thumbnail"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Label", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_label"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Categories", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_cat"
                            , 'default' => 0
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Title", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_title"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product SKU", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_sku"
                            , 'default' => 0
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Rating", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_rating"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Price", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_price"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Add To Cart Button", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat_add_to_cart"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Short Description - Grid View", "umbala")
                            , 'desc' => esc_html__("Show product description on grid view", "umbala")
                            , 'id' => "alus_prod_cat_grid_desc"
                            , 'default' => 0
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Grid View - Limit Words", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_prod_cat_grid_desc_words"
                            , 'default' => 8
                            , 'type' => "text"
                            , 'required' => array(array('alus_prod_cat_grid_desc', 'equals', 1)),
                        ),
                        array(
                            'title' => esc_html__("Product Short Description - List View", "umbala")
                            , 'desc' => esc_html__("Show product description on list view", "umbala")
                            , 'id' => "alus_prod_cat_list_desc"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("List View - Limit Words", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_prod_cat_list_desc_words"
                            , 'default' => 50
                            , 'type' => "text"
                            , 'required' => array(array('alus_prod_cat_list_desc', 'equals', 1)),
                        ),
                    ),
                );
/* Product Details Config  */
                $this->sections[] = array(
                    'icon' => 'el el-icon-indent-left',
                    'icon_class' => 'icon',
                    'title' => esc_html__('Product Details', 'umbala'),
                    'fields' => array(
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Layout', 'umbala'),
                    'fields' => array(
                        array(
                            'id' => 'alus_prod_layout',
                            'type' => 'image_select',
                            'title' => esc_html__('Product Detail Layout', 'umbala'),
                            'des' => esc_html__('Select main content and sidebar alignment.', 'umbala'),
                            'options' => $alus_layouts,
                            'default' => 'full-width',
                        ),
                        array(
                            'title' => esc_html__("Left Sidebar", "umbala")
                            , 'id' => "alus_prod_left_sidebar"
                            , 'default' => "product-detail-sidebar"
                            , 'type' => "select"
                            , 'options' => $of_sidebars,
                        ),
                        array(
                            'title' => esc_html__("Right Sidebar", "umbala")
                            , 'id' => "alus_prod_right_sidebar"
                            , 'default' => "product-detail-sidebar"
                            , 'type' => "select"
                            , 'options' => $of_sidebars,
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Data Setting', 'umbala'),
                    'fields' => array(
                        array('title' => esc_html__("Product Variation Color Swatches", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_prod_variation_swatches"
                            , 'default' => 0
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Label", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_label"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Navigation", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_show_prod_navigation"
                            , 'default' => 0
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Title", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_title"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Title In Content", "umbala")
                            , 'desc' => esc_html__("Display the product title in the page content instead of above the breadcrumbs", "umbala")
                            , 'id' => "alus_prod_title_in_content"
                            , 'default' => 0
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Rating", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_rating"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product SKU", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_sku"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Availability", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_availability"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Short Description", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_excerpt"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Count Down Timer", "umbala")
                            , 'desc' => esc_html__("You have to activate Alura-Studio plugin", "umbala")
                            , 'id' => "alus_prod_count_down"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Price", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_price"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Add To Cart Button", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_add_to_cart"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Categories", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_cat"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Tags", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_tag"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Sharing", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_sharing"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Product Images', 'umbala'),
                    'fields' => array(
                        array(
                            'title' => esc_html__("Product Zoom", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_product_zoom"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product PhotoSwipe Lightbox", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_product_lightbox"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Product Zoom Button", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_product_zoom_button"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Thumbnail", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_thumbnail"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Thumbnails Style", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_thumbnails_style"
                            , 'default' => "horizontal"
                            , 'type' => "select"
                            , 'options' => array(
                                'vertical' => esc_html__('Vertical', 'umbala')
                                , 'horizontal' => esc_html__('Horizontal', 'umbala'),
                            ),
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Sticky Product Bar', 'umbala'),
                    'fields' => array(
                        array(
                            'title' => esc_html__("Enable Sticky Product Bar", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_product_sticky_bar"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Show Sticky Product Image", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_show_product_sticky_image"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Show Sticky Product name", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_show_product_sticky_name"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array(
                            'title' => esc_html__("Show Sticky Product Rating", "umbala")
                            , 'desc' => ''
                            , 'id' => "alus_product_sticky_rating"
                            , 'default' => 1
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Show Sticky Product Price", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_product_sticky_price"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Show Sticky Product Add to cart Button", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_product_sticky_cart"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Size Chart', 'umbala'),
                    'fields' => array(

                        array('title' => esc_html__("Product Size Chart", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_show_prod_size_chart"
                            , 'default' => 0
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Size Chart Image", "umbala")
                            , 'desc' => esc_html__("Select an image file for all Product", "umbala")
                            , 'id' => "alus_prod_size_chart"
                            , 'default' => array('url' => get_template_directory_uri() . '/assets/images/size-chart.jpg')
                            , 'type' => "media",
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Product Tab', 'umbala'),
                    'fields' => array(
                        array('title' => esc_html__("Product Tabs", "umbala")
                            , 'desc' => esc_html__("Enable Product Tabs", "umbala")
                            , 'id' => "alus_prod_tabs"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Tabs Style", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_style_tabs"
                            , 'default' => 'default'
                            , 'type' => "select"
                            , 'options' => array(
                                'default' => esc_html__('Default', 'umbala')
                                , 'accordion' => esc_html__('Accordion', 'umbala')
                                , 'vertical' => esc_html__('Vertical', 'umbala'),
                            ),
                        ),
                        array('title' => esc_html__("Product Tabs Position", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_tabs_position"
                            , 'default' => "after_summary"
                            , "fold" => "alus_prod_tabs"
                            , 'type' => "select"
                            , 'options' => array(
                                'after_summary' => esc_html__('After Summary', 'umbala')
                                , 'inside_summary' => esc_html__('Inside Summary', 'umbala'),
                            ),
                        ),
                        array('title' => esc_html__("Product Custom Tab", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_custom_tab"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , "fold" => "alus_prod_tabs"
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Product Custom Tab Title", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_custom_tab_title"
                            , 'default' => "Custom tab"
                            , "fold" => "alus_prod_tabs"
                            , 'type' => "text",
                        ),
                        array('title' => esc_html__("Product Custom Tab Content", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_custom_tab_content"
                            , 'default' => "You can add the content for product"
                            , "fold" => "alus_prod_tabs"
                            , 'type' => "textarea",
                        ),
                    ),
                );
                $this->sections[] = array(
                    'subsection' => true,
                    'title' => esc_html__('Upsell, Related Product', 'umbala'),
                    'fields' => array(
                        array('title' => esc_html__("Up-Sell Products", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_upsells"
                            , 'default' => 0
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                        array('title' => esc_html__("Related Products", "umbala")
                            , 'desc' => ""
                            , 'id' => "alus_prod_related"
                            , 'default' => 1
                            , "on" => esc_html__("Show", "umbala")
                            , "off" => esc_html__("Hide", "umbala")
                            , 'type' => "switch",
                        ),
                    ),
                );

            };

/* Blog Settings */
            $this->sections[] = array(
                'icon' => 'el el-file-edit',
                'icon_class' => 'icon',
                'title' => esc_html__('Blog', 'umbala'),
                'fields' => array(
                ),
            );

            // Blog
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_blog_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Blog Layout', 'umbala'),
                        'des' => esc_html__('Select main content and sidebar alignment.', 'umbala'),
                        'options' => $alus_layouts,
                        'default' => 'full-width',
                    ),
                    array('title' => esc_html__("Left Sidebar", "umbala")
                        , 'id' => "alus_blog_left_sidebar"
                        , 'default' => "blog-sidebar"
                        , 'type' => "select"
                        , 'options' => $of_sidebars,
                    ),
                    array('title' => esc_html__("Right Sidebar", "umbala")
                        , 'id' => "alus_blog_right_sidebar"
                        , 'default' => "blog-sidebar"
                        , 'type' => "select"
                        , 'options' => $of_sidebars,
                    ),
                    array('title' => esc_html__("Blog Thumbnail", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_thumbnail"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Lazy Loading", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_lazyload"
                        , 'default' => 1
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Date", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_date"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Title", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_title"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Author", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_author"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Comment", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_comment"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Count View", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_count_view"
                        , 'default' => 0
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Read More Button", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_read_more"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Categories", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_categories"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Tags", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_tags"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Excerpt", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_excerpt"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Excerpt Strip All Tags", "umbala")
                        , 'desc' => esc_html__("Strip all html tags in Excerpt", "umbala")
                        , 'id' => "alus_blog_excerpt_strip_tags"
                        , 'default' => 0
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Excerpt Max Words", "umbala")
                        , 'desc' => esc_html__("Input -1 to show full excerpt", "umbala")
                        , 'id' => "alus_blog_excerpt_max_words"
                        , 'default' => "-1"
                        , 'type' => "text",
                    ),
                ),
            );

/** Blog Detail **/
            $this->sections[] = array(
                'subsection' => true,
                'title' => esc_html__('Blog Details', 'umbala'),
                'fields' => array(
                    array(
                        'id' => 'alus_blog_details_layout',
                        'type' => 'image_select',
                        'title' => esc_html__('Blog Detail Layout', 'umbala'),
                        'des' => esc_html__('Select main content and sidebar alignment.', 'umbala'),
                        'options' => $alus_layouts,
                        'default' => 'full-width',
                    ),
                    array('title' => esc_html__("Left Sidebar", "umbala")
                        , 'id' => "alus_blog_details_left_sidebar"
                        , 'default' => "blog-detail-sidebar"
                        , 'type' => "select"
                        , 'options' => $of_sidebars,
                    ),
                    array('title' => esc_html__("Right Sidebar", "umbala")
                        , 'id' => "alus_blog_details_right_sidebar"
                        , 'default' => "blog-detail-sidebar"
                        , 'type' => "select"
                        , 'options' => $of_sidebars,
                    ),
                    array('title' => esc_html__("Blog Thumbnail", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_thumbnail"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Date", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_date"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Title", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_title"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Content", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_content"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Categories", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_categories"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Tags", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_tags"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Sharing", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_sharing"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Navigation", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_navigation"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Author Box", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_author_box"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Related Posts", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_related_posts"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                    array('title' => esc_html__("Blog Comment Form", "umbala")
                        , 'desc' => ""
                        , 'id' => "alus_blog_details_comment_form"
                        , 'default' => 1
                        , "on" => esc_html__("Show", "umbala")
                        , "off" => esc_html__("Hide", "umbala")
                        , 'type' => "switch",
                    ),
                ),
            );
        }
        function setHelpTabs() {

        }
        function setArguments() {

            $theme = wp_get_theme();
            $this->args = array(
                'opt_name' => 'umbala_opt',
                'menu_type' => 'menu',
                'display_name' => $theme->get('Name'),
                'display_version' => $theme->get('Version'),
                'allow_sub_menu' => true,
                'menu_title' => esc_html__('Theme Options', 'umbala'),
                'page_title' => esc_html__('Theme Options', 'umbala'),
                'templates_path' => get_template_directory_uri() . '/inc/third-party/options-framework/',
                'google_api_key' => '',
                'google_update_weekly' => false,
                'disable_google_fonts_link' => true,
                'async_typography' => false,
                'admin_bar' => true,
                'admin_bar_icon' => 'fa fa-cogs',
                'admin_bar_priority' => 50,
                'global_variable' => '',
                'dev_mode' => false,
                'update_notice' => true,
                'customizer' => true,
                'page_priority' => 61,
                'page_parent' => 'themes.php',
                'page_permissions' => 'manage_options',
                'menu_icon' => get_template_directory_uri() . '/assets/images/icon_option.png',
                'last_tab' => '',
                'page_icon' => 'icon-themes',
                'page_slug' => '_options',
                'save_defaults' => true,
                'default_show' => false,
                'default_mark' => '',
                'show_import_export' => true,
                'show_options_object' => false,
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true,
                'output_tag' => true,
                'footer_credit' => 'v1.0',
                'database' => '',
                'system_info' => false,
                'hints' => array(
                    'icon' => 'el el-question-sign',
                    'icon_position' => 'right',
                    'icon_color' => 'lightgray',
                    'icon_size' => 'normal',
                    'tip_style' => array(
                        'color' => 'light',
                        'shadow' => true,
                        'rounded' => false,
                        'style' => '',
                    ),
                    'tip_position' => array(
                        'my' => 'top left',
                        'at' => 'bottom right',
                    ),
                    'tip_effect' => array(
                        'show' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'mouseover',
                        ),
                        'hide' => array(
                            'effect' => 'slide',
                            'duration' => '500',
                            'event' => 'click mouseleave',
                        ),
                    ),
                ),
            );
        }
    }

    global $redux_umbala_settings;
    $redux_umbala_settings = new Umbala_Redux_Framework_Option();
}
function umbala_removeDemoModeLink() {
    // Be sure to rename this function to something more unique
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2);
    }
    if (class_exists('ReduxFrameworkPlugin')) {
        remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
    }
}
add_action('init', 'umbala_removeDemoModeLink');
