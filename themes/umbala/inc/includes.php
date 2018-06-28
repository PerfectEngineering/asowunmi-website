<?php

class Umbala_Theme_File {

    public $files_include = array();
    public $woocommerce_files_include = array();
    public $third_party_plugins = array();
    public $widget_file_include = array();

    function __construct() {

        $this->files_include = array('sidebar', 'default-options', 'theme-options', 'helpers', 'controls', 'walkers');

        $this->third_party_plugins = array('tgm-plugin-activation/class-tgm-plugin-activation');

        $this->woocommerce_files_include = array('functions', 'quickview', 'hooks');

        $this->widget_file_include = array('mega-menu', 'mailchimp-subscription', 'products', 'blogs', 'recent-comments', 'product-categories', 'product-filter-by-color');

        $this->_third_party_plugins();
        $this->_include_files();
        $this->_widget_file();
        $this->_woocommerce_files();

        if (is_admin()) {
            $this->_include_admin_files();
        }

    }

    /**
     * Widget forder
     *
     */
    function _widget_file() {

        foreach ($this->widget_file_include as $file) {
            $file_path = get_parent_theme_file_path('/inc/widgets/' . $file . '.php');
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }

    }

    /**
     * Include files fron inc/ folder
     *
     */
    function _include_files() {

        foreach ($this->files_include as $file) {
            $file_path = get_parent_theme_file_path('/inc/' . $file . '.php');
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }

    }

    /**
     * Include files from woocommerce/ folder
     *
     */
    function _woocommerce_files() {

        foreach ($this->woocommerce_files_include as $file) {
            $file_path = get_parent_theme_file_path('/inc/woocommerce/' . $file . '.php');
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }

    }

    /**
     * Include files in admin area
     *
     */
    function _include_admin_files() {

        require_once get_parent_theme_file_path('/inc/custom-metaboxes.php');

    }

    /**
     * Register 3d party plugins
     *
     */
    function _third_party_plugins() {

        foreach ($this->third_party_plugins as $file) {
            $file_path = get_parent_theme_file_path('/inc/third-party/' . $file . '.php');
            if (file_exists($file_path)) {
                require_once $file_path;
            }
        }

    }

}
new Umbala_Theme_File();

?>