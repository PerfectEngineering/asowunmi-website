<?php

require_once(get_stylesheet_directory() . '/SectionTitleShortcode.php');

add_action( 'wp_enqueue_scripts', 'umbala_child_enqueue_styles', 1000 );

function umbala_child_enqueue_styles() {

wp_enqueue_style( 'umbala-style', get_template_directory_uri() . '/style.css', array('font-awesome') );
wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('font-awesome') );
}

add_shortcode( 'aso_section_title', 'asoSectionTitle' );

add_filter( 'woocommerce_checkout_fields' , 'asoRemoveBillingPostCode' );
function asoRemoveBillingPostCode( $fields ) {
  unset($fields['billing']['billing_postcode']);
  return $fields;
}

// add_action('wp_enqueue_scripts', 'asoUmbalaGlobalScriptFix', 1001);
// function asoUmbalaGlobalScriptFix()
// {
//     wp_dequeue_script('umbala-global');
//     // bugfix version of global
//     wp_enqueue_script('umbala-child-global', get_stylesheet_directory_uri().'/js/global.js', array('jquery'), '1.1');
// }

add_filter('og_og_description_meta', 'asoOverrideOgDescription');
function asoOverrideOgDescription($title) {
    if ( is_home() ) {
      // override the description for home
        return '<meta property="og:description" content="Asowunmi is a female fashion apparel brand that offers bespoke services and ready to wear pieces." />';
    }
    return $title;
}

add_filter('og_twitter_description_meta', 'asoOverrideTwitterDescription');
function asoOverrideTwitterDescription($title) {
    if ( is_home() ) {
      // override the description for home
        return '<meta property="twitter:description" content="Asowunmi is a female fashion apparel brand that offers bespoke services and ready to wear pieces." />';
    }
    return $title;
}