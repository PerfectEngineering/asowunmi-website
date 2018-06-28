<?php
/* * * Mini account ** */
if (!function_exists('umbala_mini_account')) {
    function umbala_mini_account() {

     if( umbala_is_woocommerce_activated() ) {
         $account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
     } else {
         $account_link = wp_login_url();
     }

     $login_canvas = umbala_get_opt('alus_login_style') == 'canvas';
     ob_start();
     ?>
     <div class="alus-account <?php echo esc_html($login_canvas?'login-canvas':''); ?>">
        <div class="login-btn">
            <?php if( !is_user_logged_in() ): ?>
                <a class="login" href="<?php echo esc_url($account_link); ?>"><span><?php echo esc_html_e('Login / Register', 'umbala'); ?></span></a>
            <?php else: ?>
                <span>
                    <?php echo sprintf( esc_html__( 'Hello, %s', 'umbala' ), '<strong>' . esc_html( wp_get_current_user()->display_name ) . '</strong>' ); ?>
                </span>
            <?php endif; ?>
        </div>
        <?php if( !is_user_logged_in() && !is_account_page() && !$login_canvas ): ?>
            <div class="has-dropdown">
                <h3 class="login-title"><?php esc_html_e('Sign in', 'umbala'); ?></h3>
                <?php umbala_login_form(); ?>
            </div>
        <?php endif; ?>
    </div>

    <?php
    return ob_get_clean();
}
}

if (!function_exists('umbala_login_form_sidebar')) {
    function umbala_login_form_sidebar() {

      if( umbala_is_woocommerce_activated() ) {
         $account_link = get_permalink( get_option('woocommerce_myaccount_page_id') );
     } else {
         $account_link = wp_login_url();
     }
     $login_canvas = umbala_get_opt('alus_login_style') == 'canvas';

     if ( ! $login_canvas || is_user_logged_in() || is_account_page() ) return;
     ?>
     <div class="login-form-off-canvas">
        <div class="login-canvas-title">
            <h3 class="login-title"><?php esc_html_e( 'Sign in', 'umbala' ); ?></h3>
            <a href="#" class="login-close"><?php esc_html_e( 'Close', 'umbala' ); ?></a>
        </div>

        <div class="login-form">
            <?php umbala_login_form(); ?>
            <div class="register-question">
                <span class="create-account"><?php esc_html_e( 'No account yet?', 'umbala' ); ?></span>
                <a class="register-link" href="<?php echo esc_url( $account_link ); ?>"><?php esc_html_e( 'Create an Account', 'umbala' ); ?></a>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'umbala_after_body_open', 'umbala_login_form_sidebar', 20 );
}

if (!function_exists('umbala_login_form')) {
    function umbala_login_form() {
        ?>

        <form name="form-login" class="form-login" action="<?php echo esc_url(wp_login_url()); ?>" method="post">
            <p class="username">
                <label><?php esc_html_e('Username', 'umbala'); ?></label>
                <input type="text" name="log" class="input" value="">
            </p>
            <p class="password">
                <label><?php esc_html_e('Password', 'umbala'); ?></label>
                <input type="password" name="pwd" class="input" value="">
            </p>
            <p class="submit">
                <input type="submit" name="wp-submit" class="button-secondary button" value="<?php esc_html_e('Login', 'umbala'); ?>">
                <input type="hidden" name="redirect_to" value="<?php echo esc_url( ( isset( $_SERVER['HTTP_REFERER'] ) ) ? esc_url_raw( wp_unslash( $_SERVER['HTTP_REFERER'] ) ) : isset( $_SERVER['REQUEST_URI'] ) ? esc_url_raw( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '' ); ?>">
            </p>
            <p class="rememberme">
                <label for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever"> <?php esc_html_e( 'Remember Me', 'umbala' ); ?></label>
            </p>
            <p class="forgot-password"><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php esc_attr_e('Forgot Your Password?', 'umbala'); ?>"><?php esc_html_e('Forgot Your Password?', 'umbala'); ?></a></p>
        </form>  

        <?php
    }
}

/* * * Mini Cart ** */
if (!function_exists('umbala_mini_cart')) {
    function umbala_mini_cart() {

        if (!umbala_is_woocommerce_activated()) {
            return;
        }
        $cart_canvas = umbala_get_opt('alus_tiny_cart_style') == 'canvas';

        ob_start();
        ?>
        <div class="alus-shoppping-cart <?php echo esc_html($cart_canvas?'cart-canvas':''); ?>">
            <a class="alus_cart" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                <?php umbala_cart_subtotal(); ?>
            </a>
            <?php if( !$cart_canvas ): ?>
                <div class="shopping-cart-dropdown has-dropdown">
                    <div class="woocommerce widget_shopping_cart">
                        <div class="widget_shopping_cart_content">
                         <?php echo woocommerce_mini_cart(); ?>
                     </div>
                 </div>
             </div>
         <?php endif; ?>
     </div>
     <?php
     return ob_get_clean();
 }
}

if( ! function_exists( 'umbala_cart_subtotal' ) ) {
    function umbala_cart_subtotal() {
        ?>
        <span class="cart-number"> <?php echo WC()->cart->get_cart_contents_count() ?></span>
        <?php
    }
}

add_filter('woocommerce_add_to_cart_fragments', 'umbala_mini_cart_filter');
function umbala_mini_cart_filter($fragments) {
    ob_start();
    umbala_cart_subtotal();
    $subtotal = ob_get_clean();
    $fragments['span.cart-number'] = $subtotal;

    return $fragments;
}

/* Mini cart sidebar */
if( !function_exists('umbala_mini_cart_sidebar') ) {

    function umbala_mini_cart_sidebar(){
        if ( !umbala_is_woocommerce_activated() ) {
            return;
        } 

        if( umbala_get_opt('alus_enable_tiny_shopping_cart')) { 
            if( umbala_get_opt('alus_tiny_cart_style') == 'canvas' ) {
                ?>
                <div class="cart-popup">
                    <div class="cart-popup-title">
                        <h3 class="title-cart"><?php esc_html_e('Shopping cart', 'umbala'); ?></h3>
                        <a href="#" class="close-cart"><?php esc_html_e('Close', 'umbala'); ?></a>
                    </div>
                    <div class="woocommerce widget_shopping_cart">
                        <div class="widget_shopping_cart_content">
                         <?php echo woocommerce_mini_cart(); ?>
                     </div>
                 </div>
             </div>
             <?php
         }  
     } 
 }
 add_action( 'umbala_after_body_open', 'umbala_mini_cart_sidebar', 30 );

}

/* Tini Check out */
function umbala_tini_checkout() {
   if (!(umbala_is_woocommerce_activated())){
    return;
}
ob_start();
?>
<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="alus-checkout-menu"><?php esc_html_e('Checkout', 'umbala'); ?></a>
<?php
$tini_checkout = ob_get_clean();
return $tini_checkout;
}

/** Mini wishlist * */
function umbala_mini_wishlist() {
    if (!(umbala_is_woocommerce_activated() && class_exists('YITH_WCWL'))) {
        return;
    }

    ob_start();

    $wishlist_page_id = get_option('yith_wcwl_wishlist_page_id');
    if (function_exists('wpml_object_id_filter')) {
        $wishlist_page_id = wpml_object_id_filter($wishlist_page_id, 'page', true);
    }
    $wishlist_page = get_permalink($wishlist_page_id);

    $count = yith_wcwl_count_products();
    ?>

    <a title="<?php esc_attr_e('Wishlist', 'umbala'); ?>" href="<?php echo esc_url($wishlist_page); ?>" class="tini-wishlist">
        <?php esc_html_e('Wishlist', 'umbala'); ?> <?php echo '(' . ($count > 0 ? zeroise($count, 2) : '0') . ')'; ?>
    </a>

    <?php
    $tini_wishlist = ob_get_clean();
    return $tini_wishlist;
}

function umbala_update_tini_wishlist() {
    die(umbala_mini_wishlist());
}

add_action('wp_ajax_update_tini_wishlist', 'umbala_update_tini_wishlist');
add_action('wp_ajax_nopriv_update_tini_wishlist', 'umbala_update_tini_wishlist');

if( !function_exists('umbala_woocommerce_multilingual_currency_switcher') ){
    function umbala_woocommerce_multilingual_currency_switcher(){
        if( class_exists('woocommerce_wpml') && class_exists('WooCommerce') && class_exists('SitePress') ){
            global $sitepress, $woocommerce_wpml;
            
            if( !isset($woocommerce_wpml->multi_currency) ){
                return;
            }
            
            $settings = $woocommerce_wpml->get_settings();
            
            $format = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template']:'%code%';
            $wc_currencies = get_woocommerce_currencies();
            if( !isset($settings['currencies_order']) ){
                $currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
            }else{
                $currencies = $settings['currencies_order'];
            }
            
            $selected_html = '';
            foreach( $currencies as $currency ){
                if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
                    
                    if( $currency == $woocommerce_wpml->multi_currency->get_client_currency() ){
                        $selected_html = '<a href="javascript: void(0)" class="wcml_selected_currency">'.$currency_format.'</a>';
                        break;
                    }
                }
            }
            
            echo '<div class="wcml_currency_switcher">';
            echo  $selected_html;
            echo '<ul>';
            
            foreach( $currencies as $currency ){
                if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
                    echo '<li rel="' . $currency . '" >' . $currency_format . '</li>';
                }
            }
            
            echo '</ul>';
            echo '</div>';
        }
        else if( class_exists('WOOCS') && class_exists('WooCommerce') ){ /* Support WooCommerce Currency Switcher */
            global $WOOCS;
            $currencies = $WOOCS->get_currencies();
            if( !is_array($currencies) ){
                return;
            }
            ?>
            <div class="wcml_currency_switcher">
                <a href="javascript: void(0)" class="wcml_selected_currency"><?php echo esc_html($WOOCS->current_currency); ?></a>
                <ul>
                    <?php 
                    foreach( $currencies as $key => $currency ){
                        $link = add_query_arg('currency', $currency['name']);
                        echo '<li rel="'.$currency['name'].'"><a href="'.esc_url($link).'">'.esc_html($currency['name']).'</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <?php
        }else{/* Demo html */
            ?>
            <div class="wcml_currency_switcher">
                <a href="javascript: void(0)" class="wcml_selected_currency">USD</a>
                <ul>
                    <li rel="USD">USD</li>
                    <li rel="EUR">EUR</li>
                    <li rel="AUD">AUD</li>
                </ul>
            </div>
            <?php
        }
    }
}

if( !function_exists('umbala_wpml_language_selector') ){
    function umbala_wpml_language_selector(){
        if( class_exists('SitePress') ){
            global $sitepress;
            if( method_exists($sitepress, 'get_mobile_language_selector') ){
                echo  $sitepress->get_mobile_language_selector();
            }
        }
        else{ /* Demo html */
            ?>
            <div id="lang_sel_click" class="lang_sel_click">
                <ul>
                    <li>
                        <a href="#" class="lang_sel_sel icl-en">English</a>
                        <ul class="lang-dropdown">
                            <li class="icl-fr"><a rel="alternate" href="#"><span class="icl_lang_sel_native">French</span></a></li>
                            <li class="icl-de"><a rel="alternate" href="#"><span class="icl_lang_sel_native">German</span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
        }
    }
}
?>