<?php
/**
 * Header layout1 file.
 *
 */
?>

<div class="header-alus header-<?php echo esc_attr(umbala_get_opt('alus_header_layout')); ?>">
    <?php if( umbala_get_opt('alus_header_top_bar') ) : ?>
        <div class="top-bar">
            <div class="container">
                <div class="top-bar-left">
                    <?php if(umbala_get_opt('alus_header_contact_information')) : ?>
                        <?php echo do_shortcode(umbala_get_opt('alus_header_contact_information')); ?>
                    <?php endif; ?>
                </div>
                <div class="top-bar-right">
                    <?php if(umbala_get_opt('alus_enable_tiny_account')): ?>
                        <div class="header-account"><?php echo umbala_mini_account(); ?></div>
                    <?php endif; ?>

                    <?php if(class_exists('YITH_WCWL') && umbala_get_opt('alus_enable_tiny_wishlist')): ?>
                        <div class="header-wishlist"><?php echo umbala_mini_wishlist(); ?></div>
                    <?php endif; ?>                 
                    
                    <?php if(umbala_get_opt('alus_header_currency')): ?>
                        <div class="header-currency"><?php umbala_woocommerce_multilingual_currency_switcher(); ?></div>
                    <?php endif; ?>

                    <?php if(umbala_get_opt('alus_header_language')): ?>
                        <div class="header-language"><?php umbala_wpml_language_selector(); ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <div class="header-content">
        <div class="container">
            <div class="header-left-wrapper">
                <?php echo umbala_header_mobile_button();  ?>
            </div>
            <div class="logo-wrap"><?php echo umbala_logo(); ?></div>
            <?php if( umbala_get_opt('alus_enable_search') ): ?>
                <div class="alus-header-search"><?php umbala_search_by_category(); ?></div>
            <?php endif; ?>

            <?php if( umbala_get_opt('alus_enable_tiny_shopping_cart')) : ?>
                <div class="alus-header-cart">
                    <?php echo umbala_mini_cart(); ?>
                </div>
            <?php endif; ?>
            
        </div>
    </div>
    <div class="navigation-wrapper">
        <div class="container">
            <div class="mega-menu-wrapper">
                <?php 
                if ( has_nav_menu( 'vertical' ) ) {
                 get_template_part( 'template-parts/navigation/navigation', 'vertical' );
             } 

             if ( has_nav_menu( 'primary' ) ) {
                 get_template_part( 'template-parts/navigation/navigation', 'primary' );
             }
             ?>
         </div>
     </div><!-- .container -->
 </div><!-- .navigation -->
</div>

