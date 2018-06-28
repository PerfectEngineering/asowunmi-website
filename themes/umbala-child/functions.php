<?php

add_action( 'wp_enqueue_scripts', 'umbala_child_enqueue_styles', 1000 );

function umbala_child_enqueue_styles() {

wp_enqueue_style( 'umbala-style', get_template_directory_uri() . '/style.css', array('font-awesome') );
wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('font-awesome') );

}

