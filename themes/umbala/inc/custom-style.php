<?php 

$alus_primary_color = umbala_get_opt('alus_primary_color');
$alus_secondary_color = umbala_get_opt('alus_secondary_color');
$alus_body_background_color = umbala_get_opt('alus_body_background_color');
$alus_top_bar_bg = umbala_get_opt('alus-top-bar-bg');
$alus_top_bar_color = umbala_get_opt('alus-top-bar-color');

if( umbala_get_opt('alus_title_font') ){
    $font_title = umbala_get_opt('alus_title_font_google');
    $alus_title_font = isset($font_title['font-family'])?$font_title['font-family']:'Poppins';
}
else{
    $font_title_body = umbala_get_opt('alus_title_font_family');
    $alus_title_font = isset($font_title_body)? $font_title_body:'Arial';
}
$font_body = umbala_get_opt('alus_body_font');
$alus_body_font = isset($font_body['font-family'])?$font_body['font-family']:'Lato';
$font_size_body = umbala_get_opt('alus_font_size_body');
$alus_font_size_body = isset($font_size_body) ? $font_size_body : '14';
$line_height_body = umbala_get_opt('alus_line_height_body');
$alus_line_height_body = isset($line_height_body) ? $line_height_body : '24';

?>	

body{
line-height: <?php echo esc_html($alus_line_height_body)."px"?>;
font-size: <?php echo esc_html($alus_font_size_body)."px"?>;
}

.section-title-main,.entry-summary > .product_title,
.related products > h2 span,h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, 
.widget-title.heading-title,
.widget-title.product-title,.newletter_sub_input .button.button-secondary,
.woocommerce div.product .woocommerce-tabs ul.tabs,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tabs-container
{
	font-family: "<?php echo esc_html($alus_title_font) ?>",sans-serif;
}
html, 
body,
label,
table.compare-list td,
input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea,
.top-bar,
.info-open,
.info-phone,
.header-account .alus_login > a,
.header-account,
.header-wishlist *,
.dropdown-button span > span,p,
.wishlist-empty,
.search-form-wrapper form,
.alus-header-cart,
.product-labels,
.item-information .product-title,
.item-information .price,
.sidebar-widget ul.product-categories ul.children li a,
.sidebar-widget:not(.alus-product-categories-widget):not(.widget_product_categories):not(.alus-items-widget) :not(.widget-title),
.alus-products-tabs ul.tabs li span.title,
.woocommerce-pagination,
.woocommerce-result-count,
.woocommerce .products.list .product .price .amount,
.woocommerce-page .products.list .product .price .amount,
.products.list .short-description.list,
div.product .single_variation_wrap .amount,
div.product div[itemprop="offers"] .price .amount,
.orderby-title,
.blogs .post-info,
.blog .entry-info .entry-summary .short-content,
.single-post .entry-info .entry-summary .short-content,
.single-post article .post-info .info-category,
.single-post article .post-info .info-category,
#comments .comments-title,
#comments .comment-metadata a,
.post-navigation .nav-previous,
.post-navigation .nav-next,
.woocommerce-review-link,
.alus_feature_info,
.woocommerce div.product p.stock,
.woocommerce div.product .summary div[itemprop="description"],
.woocommerce div.product p.price,
.woocommerce div.product .woocommerce-tabs .panel,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce div.product form.cart .group_table td.price,
footer,
footer a,
.blogs article .image-eff:before,
.blogs article a.gallery .owl-item:after, .nav-link span, .button-readmore,
.summary .product-meta,
div.product .summary .compare, div.product .summary .compare:hover,
div.product .summary .yith-wcwl-add-to-wishlist,.woocommerce div.product form.cart .button,
.countdown-meta, .countdown-timer > div .number, .tooltip,
.alus-counter,.woocommerce table.shop_table_responsive tr td::before, .woocommerce-page table.shop_table_responsive tr td::before,.woocommerce .cart-content .cart-collaterals table.shop_table th,
.woocommerce-cart table.cart input.button,
.single-post .single-cats a,
.comment-content *,.tags-link, .cats-link,.author,
#yith-wcwl-popup-message,.woocommerce-message,.woocommerce-error,
.woocommerce-info, .error404  .page-content h2,.excerpt, .info,.description,
.wpb-js-composer .vc_tta.vc_general.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title>a
{
	font-family: "<?php echo esc_html($alus_body_font); ?>",sans-serif;
}
body,
.site-footer,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce .product .product-labels span,
.item-information .alus-product-buttons .yith-wcwl-add-to-wishlist a,  .item-information .alus-product-buttons .compare,
.info-company li i,
.social-icons .alus-tooltip:before,
.tagcloud a,
.product_thumbnails .owl-nav > button:before,
div.product .summary .yith-wcwl-add-to-wishlist a:before,
.pp_woocommerce div.product .summary .compare:before,
.woocommerce div.product .summary .compare:before,
.woocommerce-page div.product .summary .compare:before,
.woocommerce #content div.product .summary .compare:before,
.woocommerce-page #content div.product .summary .compare:before,
.woocommerce div.product form.cart .variations label,
.woocommerce-page div.product form.cart .variations label,
.pp_woocommerce div.product form.cart .variations label,
blockquote,
.woocommerce .widget_price_filter .price_slider_amount,
.wishlist-empty,
.woocommerce div.product form.cart .button,
.woocommerce table.wishlist_table
{
	font-size: <?php echo esc_html($alus_font_size_body) ?>px;
}

.header-currency:hover .alus-currency > a,
.woocommerce a.remove:hover,
.has-dropdown .alus_cart_check > a.button.view-cart:hover,
.header-account .alus_login > a:hover,
.dropdown-button span:hover,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab.vc_active > a,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a:hover,
.woocommerce .products .product .price,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating,
.star-rating:before,
div.product div[itemprop="offers"] .price .amount,
div.product .single_variation_wrap .amount,
.pp_woocommerce .star-rating:before,
.woocommerce .star-rating:before,
.woocommerce-page .star-rating:before,
.woocommerce-product-rating .star-rating span,
ins .amount,
.alus-meta-widget .price ins,
.alus-meta-widget .star-rating,
.ul-style.circle li:before,
.woocommerce form .form-row .required,
.blogs .comment-count i,
.blog .comment-count i,
.single-post .comment-count i,
.single-post article .post-info .info-category,
.single-post article .post-info .info-category .cat-links a,
.single-post article .post-info .info-category .vcard.author a,
.breadcrumb-title-inner .breadcrumbs-content,
.breadcrumb-title-inner .breadcrumbs-content span.current,
.breadcrumb-title-inner .breadcrumbs-content a:hover,
.woocommerce .product   .item-information .alus-product-buttons a:hover,
.woocommerce-page .product   .item-information .alus-product-buttons a:hover,
.alus-meta-widget.item-information .alus-product-buttons a:hover,
.alus-meta-widget.item-information .alus-product-buttons .yith-wcwl-add-to-wishlist a:hover,
.grid_list_nav a.active,
.alus-quickshop-wrapper .owl-nav > button.owl-next:hover,
.alus-quickshop-wrapper .owl-nav > button.owl-prev:hover,
.shortcode-icon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-color-orange .vc_icon_element-icon,
.comment-reply-link .icon,
body table.compare-list tr.remove td > a .remove:hover:before,
a:hover,
a:focus,
.vc_toggle_title h4:hover,
.vc_toggle_title h4:before,
.blogs article h3.product-title a:hover,
article .post-info a:hover,
article .comment-content a:hover,
.main-navigation li li.focus > a,
.main-navigation li li:focus > a,
.main-navigation li li:hover > a,
.main-navigation li li a:hover,
.main-navigation li li a:focus,
.main-navigation li li.current_page_item a:hover,
.main-navigation li li.current-menu-item a:hover,
.main-navigation li li.current_page_item a:focus,
.main-navigation li li.current-menu-item a:focus,.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a, article .post-info .cat-links a,article .post-info .tags-link a,
.vcard.author a,article .entry-header .caalus-link .cat-links a,.woocommerce-page .products.list .product h3.product-name a:hover,
.woocommerce .products.list .product h3.product-name a:hover,.alus-feature-box .feature_icon,.entry-content a, .comment-content a, .blogs  .date-time i, .blogs .entry-title a:hover,
.star-rating, div.product .summary .yith-wcwl-add-to-wishlist a:hover,
.woocommerce #content div.product .summary .compare:hover,.woocommerce .products .product .price,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating,
.star-rating:before,
div.product div[itemprop="offers"] .price .amount,
div.product .single_variation_wrap .amount,
.pp_woocommerce .star-rating:before,
.woocommerce .star-rating:before,
.woocommerce-page .star-rating:before,
.woocommerce-product-rating .star-rating span,
ins .amount,
.alus-meta-widget .price ins,
.alus-meta-widget .star-rating,
.ul-style.circle li:before,
.woocommerce form .form-row .required,
.blogs .comment-count i,
.blog .comment-count i,
.single-post .comment-count i,
.single-post article .post-info .info-category,
.single-post article .post-info .info-category .cat-links a,
.single-post article .post-info .info-category .vcard.author a,
.breadcrumb-title-inner .breadcrumbs-content,
.breadcrumb-title-inner .breadcrumbs-content span.current,
.breadcrumb-title-inner .breadcrumbs-content a:hover,.woocommerce a.remove:hover,
body table.compare-list tr.remove td > a .remove:hover:before,.newer-posts:hover .post-title,
.newer-posts:hover i,.order-posts:hover .post-title, .order-posts:hover i,.alus-recent-comments-widget .on_post a, .entry-content .date-time i, .blog .blockquote-meta .date-time i,.error404 .page-header h2,
.woocommerce-info .showcoupon,.woocommerce-info .showlogin,
body .sticky-header .navigation-wrapper .main-navigation .menu > li.item-level-0 > a:hover,
body .sticky-header .navigation-wrapper .main-navigation .menu > li.item-level-0 > a:hover:after,
.woocommerce .products .product .images a:hover, .alus-section-title .before-title,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.author-link
{
	color: <?php echo esc_html($alus_primary_color) ?>;
}
.has-dropdown .alus_cart_check > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
body input.wpcf7-submit:hover,
#yith-wcwl-popup-message,
.woocommerce .products.list .product .item-information .add-to-cart a:hover,
.woocommerce .products.list .product .item-information .button-in a:hover,
.woocommerce .products.list .product .item-information .alus-product-buttons  a:not(.quickview):hover,
.woocommerce .products.list .product .item-information .quickview i:hover,
.countdown-timer > div,
.tp-bullets .tp-bullet:after,
.woocommerce .product .product-labels .onsale,
.woocommerce #respond input#submit:hover, 
.woocommerce a.button:hover,
.woocommerce button.button:hover, 
.woocommerce input.button:hover,
.woocommerce .products .product  .images .button-in:hover a:hover,
.vc_color-orange.vc_message_box-solid,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a.next:hover,
.woocommerce-page nav.woocommerce-pagination ul li a.next:hover,
.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce .form-row input.button:hover,
.load-more-wrapper .button:hover,
body .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab:hover,
body .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active,
.woocommerce div.product form.cart .button:hover,
.woocommerce div.product div.summary p.cart a:hover,
.woocommerce .wc-proceed-to-checkout a.button.alt:hover,
.woocommerce .wc-proceed-to-checkout a.button:hover,
.woocommerce-cart table.cart input.button:hover,
.owl-dots > .owl-dot span:hover,
.owl-dots > .owl-dot.active span,
footer .style-3 .newletter_sub .button.button-secondary.transparent,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
body .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
body .vc_tta.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
body div.pp_details a.pp_close:hover:before,
.vc_toggle_title h4:after,
body.error404 .page-header a,
body .button.button-secondary,
.pp_woocommerce div.product form.cart .button,
.shortcode-icon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-background-color-orange.vc_icon_element-background,
.style1 .alus-countdown .countdown-timer > div,
.style2 .alus-countdown .countdown-timer > div,
.style3 .alus-countdown .countdown-timer > div,
#cboxClose:hover,
body > h1,
table.compare-list .add-to-cart td a:hover,
.vc_progress_bar.wpb_content_element > .vc_general.vc_single_bar > .vc_bar,
div.product.vertical-thumbnail .product-gallery .owl-controls div.owl-prev:hover,
div.product.vertical-thumbnail .product-gallery .owl-controls div.owl-next:hover,
ul > .page-numbers.current,
ul > .page-numbers:hover,.text_service a,.vc_toggle_title h4:before,.vc_toggle_active .vc_toggle_title h4:before,
.post-item.sticky .post-info .entry-info .sticky-post,
.woocommerce .products.list .product   .item-information .compare.added:hover,.vertical-menu-heading, .cart-number, .header-layout1 .navigation-wrapper, .alus-section-title b,.alus-section-title .sub-title,
.owl-nav > button:hover, .button-readmore:before, .mc4wp-form input[type=submit], .woocommerce .button.single_add_to_cart_button.alt,.woocommerce .button.single_add_to_cart_button.alt.disabled,
.product_thumbnails .owl-nav .owl-prev:hover,
.product_thumbnails .owl-nav .owl-next:hover,
.single-post .single-cats a,.comment-form .form-submit input[type="submit"],
.alus-pagination ul li span.current, .page-numbers.current,
.alus-pagination ul li .page-numbers:hover, #to-top a:hover,
.woocommerce .wc-proceed-to-checkout a.button.alt, .woocommerce .wc-proceed-to-checkout a.checkout-button,
.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,
.woocommerce div.product div.summary p.cart a,.widget_tag_cloud .tagcloud a.tag-cloud-link:hover,
.alus-mega-menu-shortcode .widgettitle,.header-layout3 .navigation-wrapper,
body .woocommerce.widget_shopping_cart .widget_shopping_cart_content .buttons > a.checkout,
body .woocommerce.widget_shopping_cart .widget_shopping_cart_content .buttons > a:hover,
.page-links > span:not(.page-links-title),
.widget_calendar #wp-calendar #today,.alus-button-shortcode.color-primary a,
.button.is-underline:before,
.umbala_product_sticky .container .alus-add-to-cart a,
.woocommerce .images > div.alus-add-to-cart a,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after,
.woocommerce .products.list .product .item-information .add-to-cart a
{
	background-color: <?php echo esc_html($alus_primary_color) ?>;
}
.has-dropdown .alus_cart_check > a.button.view-cart:hover,
.has-dropdown .alus_cart_check > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
body input.wpcf7-submit:hover,
.countdown-timer > div,
.woocommerce .products .product:hover ,
.woocommerce-page .products .product:hover ,
#right-sidebar .product_list_widget:hover li,
.woocommerce .product   .item-information .alus-product-buttons a:hover,
.woocommerce-page .product   .item-information .alus-product-buttons a:hover,
.alus-meta-widget.item-information .alus-product-buttons a:hover,
.alus-meta-widget.item-information .alus-product-buttons .yith-wcwl-add-to-wishlist a:hover,
.woocommerce .products .product:hover ,
.woocommerce-page .products .product:hover ,
.alus-products-tabs ul.tabs li:hover,
.alus-products-tabs ul.tabs li.current,
body .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
body .vc_tta.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
body div.pp_details a.pp_close:hover:before,
body .button.button-secondary,
.alus-quickshop-wrapper .owl-nav > button.owl-next:hover,
.alus-quickshop-wrapper .owl-nav > button.owl-prev:hover,
#cboxClose:hover, .woocommerce-account .woocommerce-MyAccount-navigation li.is-active,
.alus-product-items-widget .alus-meta-widget.item-information .alus-product-buttons .compare:hover,
.alus-product-items-widget .alus-meta-widget.item-information .alus-product-buttons .add_to_cart_button a:hover,
.woocommerce .product   .item-information .alus-product-buttons .add-to-cart a:hover,
.alus-meta-widget.item-information .alus-product-buttons .add-to-cart a:hover, .alus-products-tabs .tabs-header .tab-item.current, .alus-products-tabs .tabs-header .tab-item:hover,.newer-posts:hover i,
.order-posts:hover i, #to-top a:hover,
.woocommerce-account .woocommerce-my-account-navigation li:hover a:after, .woocommerce-account .woocommerce-my-account-navigation li.is-active a:after,.widget_tag_cloud .tagcloud a.tag-cloud-link:hover,
.button-style-outline a
{
	border-color: <?php echo esc_html($alus_primary_color) ?>;
}
.woocommerce .products.list .product:hover  .item-information:after,
.woocommerce-page .products.list .product:hover  .item-information:after
{
	border-left-color: <?php echo esc_html($alus_primary_color) ?>;
}
footer#footer .alus-footer .widget-title:before,
.woocommerce div.product .woocommerce-tabs ul.tabs,
#customer_login h2 span:before,
.cart_totals  h2 span:before
{
	border-bottom-color: <?php echo esc_html($alus_primary_color) ?>;
}
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a{
	border-top-color: <?php echo esc_html($alus_primary_color) ?>;
}

body,
.alus-shoppping-cart a.alus_cart:hover,
#mega_main_menu.primary ul li .mega_dropdown > li.sub-style > .item_link .link_text,
.woocommerce a.remove,
body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab,
.woocommerce .products .star-rating.no-rating,
.woocommerce-page .products .star-rating.no-rating,
.star-rating.no-rating:before,
.pp_woocommerce .star-rating.no-rating:before,
.woocommerce .star-rating.no-rating:before,
.woocommerce-page .star-rating.no-rating:before,
.woocommerce .product .images .alus-product-buttons > a, 
.vc_progress_bar .vc_single_bar .vc_label,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline-custom,
.style1 .alus-countdown .countdown-timer > div .countdown-meta,
.style2 .alus-countdown .countdown-timer > div .countdown-meta,
.style3 .alus-countdown .countdown-timer > div .countdown-meta,
.style4 .alus-countdown .countdown-timer > div .number,
.style4 .alus-countdown .countdown-timer > div .countdown-meta,
body table.compare-list tr.remove td > a .remove:before,
.woocommerce-page .products.list .product h3.product-name a
{
	color: <?php echo esc_html($alus_secondary_color) ?>;
}
.has-dropdown .alus_cart_check > a.button.checkout,
.pp_woocommerce div.product form.cart .button:hover,
.info-company li i,
body .button.button-secondary:hover,
.alus-button-shortcode.color-secondary a
{
	background-color: <?php echo esc_html($alus_secondary_color) ?>;
}
.has-dropdown .alus_cart_check > a.button.checkout,
.pp_woocommerce div.product form.cart .button:hover,
body .button.button-secondary:hover,
#cboxClose
{
	border-color: <?php echo esc_html($alus_secondary_color) ?>;
}

body
{
	background-color: <?php echo esc_html($alus_body_background_color) ?>;
}

.top-bar{
	background-color: <?php echo esc_html($alus_top_bar_bg) ?>;
}
.top-bar, .top-bar a{
	color: <?php echo esc_html($alus_top_bar_color) ?>;
}