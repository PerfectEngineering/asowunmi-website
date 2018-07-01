<?php
/**
 *  Header template
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> >
<head>
	<?php global $umbala_page_options; ?>
    <meta charset="<?php bloginfo('charset');?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url');?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php do_action('umbala_after_body_open'); ?>

    <div id="wrapper">
        <?php if (!is_page_template('blank.php')): ?>
            <?php if (is_page()): ?>
                <?php if ($umbala_page_options['alus_page_slider'] && $umbala_page_options['alus_page_slider_position'] == 'before_header'): ?>
                    <div class="page-slider-wrap">
                        <div class="show-slider">
                            <?php umbala_show_page_slider(); ?>
                        </div>
                    </div>
                <?php endif;?>
            <?php endif;?>
            <?php if (umbala_get_opt('alus_enable_sticky_header')): ?>
                <div class="sticky-header header-mobile-<?php echo umbala_get_opt('alus_header_mobile_layout'); ?>">
                    <div class="container">
                        <div class="header-wrapper">
                            <div class="header-left-wrapper">
                                <?php echo umbala_header_mobile_button(); ?>
                            </div>
                            <div class="logo-wrap"><?php echo umbala_logo(); ?></div>
                            <div class="navigation-wrapper">
                            <?php if (has_nav_menu('primary')): ?>
                                <?php get_template_part('template-parts/navigation/navigation', 'primary'); ?>
                             <?php endif;?>
                         </div>
                         <?php if (umbala_get_opt('alus_enable_tiny_shopping_cart')): ?>
                            <div class="alus-header-cart">
                                <?php echo umbala_mini_cart(); ?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        <?php endif;?>
        <header id="header" class="site-header header-mobile-<?php echo umbala_get_opt('alus_header_mobile_layout'); ?>">
            <?php echo umbala_get_header_template(); ?>
        </header><!-- #header -->
    <?php endif;?>

    <main id="main" class="site-main">
