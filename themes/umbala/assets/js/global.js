var UmbalaTheme;

(function($) {
    "use strict";

    UmbalaTheme = {
        init: function() {

            this.FastClicker();

            this.SliderShortcode();

            this.MegaMenuSetting();

            this.MobileNavigation();

            this.PopupNewletter();

            this.HeaderSticky();

            this.ShopSidebar();

            this.ShopFilters();

            this.BannerPrlxShortcode();

            this.Backtotop();

            this.BackgroundPrlx();

            this.SizeChartProductImg();

            this.SingleProductVideo();

            this.CounterUpShortcode();

            this.AjaxSearch();

            this.HoverGalleryProduct();

            this.AccordionProductTab();

            this.QuickviewAction();

            this.HideMessagePopup();

            this.WishlistAction();

            this.RecentPostWg();

            this.ProductWgSlider();

            this.CountdownTimer();

            this.BlogGallerySlider();

            this.BlogMasonryShortcode();

            this.BootrapTooltip();

            this.WooQuantity();

            this.ProductImageSetting();

            this.ProductDefaultSlider();

            this.RelatedPostSlider();

            this.loginSidebar();

            this.CartSidebar();

            this.GalleryImagesShortcode();

            this.ProductShortcode();

            this.CatMasonryShot();

            this.MessageAddtoCart();

            this.StickyProduct();

            this.LazyLoading();

            this.ColorSwatches();
        },

        FastClicker: function() {
            FastClick.attach(document.body);
        },

        SliderShortcode: function() {
            $('.alus-brand-slider-shortcode,.alus-product-categories-shortcode.layout-slider,.alus-blogs-shortcode.slider,.alus-testimonials-shortcode.layout-slider').each(function() {
                var element = $(this);
                var margin = element.data('margin');
                var columns = element.data('columns');
                var nav = element.data('nav') === 1;
                var dots = element.data('dots') === 1;
                var autoplay = element.data('autoplay') === 1;
                var slider = element.data('slider') === 1;
                var desksmini = element.data('desksmini');
                var tabletmini = element.data('tabletmini');
                var tablet = element.data('tablet');
                var mobile = element.data('mobile');
                var mobilesmini = element.data('mobilesmini');

                if (slider) {
                    var _slider_data = {
                        loop: false,
                        nav: nav,
                        dots: dots,
                        slideBy: 1,
                        navText: false,
                        rtl: $('body').hasClass('rtl'),
                        margin: margin,
                        autoplay: autoplay,
                        autoplayHoverPause: true,
                        autoplayTimeout: 5000,
                        responsive: {
                            0: {
                                items: mobilesmini
                            },
                            480: {
                                items: mobile
                            },
                            640: {
                                items: tabletmini
                            },
                            768: {
                                items: tablet
                            },
                            991: {
                                items: desksmini
                            },
                            1199: {
                                items: columns
                            }
                        },
                        onInitialized: function() {
                            element.find('.meta-slider').addClass('loaded').removeClass('loading');
                        }
                    };
                    element.find('.meta-slider > div').addClass('owl-carousel').owlCarousel(_slider_data);
                }
            });
        },

        ProductShortcode: function() {
            $('.alus-product-shortcode').each(function() {
                var element = $(this);
                var atts = element.data('atts');

                if (atts.is_slider) {
                    var nav = parseInt(atts.nav) === 1;
                    var dots = parseInt(atts.dots) === 1;
                    var autoplay = parseInt(atts.autoplay) === 1;
                    var margin = parseInt(atts.margin);
                    var desksmini = parseInt(atts.desksmini);
                    var tabletmini = parseInt(atts.tabletmini);
                    var tablet = parseInt(atts.tablet);
                    var mobile = parseInt(atts.mobile);
                    var mobilesmini = parseInt(atts.mobilesmini);
                    var columns = parseInt(atts.columns);
                    var slider_data = {
                        loop: false,
                        nav: nav,
                        navText: false,
                        dots: dots,
                        slideBy: 1,
                        rtl: $('body').hasClass('rtl'),
                        margin: margin,
                        autoplay: autoplay,
                        autoplayTimeout: 5000,
                        autoHeight: true,
                        responsive: {
                            0: {
                                items: mobilesmini
                            },
                            480: {
                                items: mobile
                            },
                            640: {
                                items: tabletmini
                            },
                            768: {
                                items: tablet
                            },
                            991: {
                                items: desksmini
                            },
                            1199: {
                                items: columns
                            }
                        },
                        onInitialized: function() {
                            element.find('.meta-slider').addClass('loaded').removeClass('loading');
                        }
                    };
                    element.find('.meta-slider > .products').addClass('owl-carousel').owlCarousel(slider_data);
                }

                var is_masonry = false;
                if (atts.is_masonry && typeof $.fn.isotope === 'function') {
                    is_masonry = true;
                }

                if (is_masonry) {
                    $(window).on('load', function() {
                        element.find('.meta-slider > .products').isotope();
                    });
                }

                if (atts.show_load_more) {
                    element.on('click', 'a.load-more', function() {
                        var button = $(this);
                        if (button.hasClass('loading')) {
                            return false;
                        }

                        button.addClass('loading');
                        var paged = button.attr('data-paged');

                        $.ajax({
                            type: 'POST',
                            timeout: 30000,
                            url: umbala_settings.ajax_uri,
                            data: { action: 'alus_products_load_items', paged: paged, atts: atts },
                            error: function(xhr, err) {

                            },
                            success: function(response) {
                                button.removeClass('loading');
                                button.attr('data-paged', ++paged);
                                if (response !== 0 && response !== '') {
                                    if (element.hasClass('is-masonry') && typeof $.fn.isotope === 'function') {
                                        element.find('.meta-slider > .products').isotope('insert', $(response));
                                        setTimeout(function() {
                                            element.find('.meta-slider > .products').isotope('layout');
                                        }, 500);
                                    } else {
                                        element.find('.meta-slider > .products').append(response);
                                    }
                                } else {
                                    button.parent().remove();
                                }
                                UmbalaTheme.BootrapTooltip();
                                UmbalaTheme.CountdownTimer();
                                UmbalaTheme.LazyLoading();
                            }
                        });

                        return false;
                    });
                }
            });
        },

        BlogMasonryShortcode: function() {
            $('.alus-blogs-shortcode.masonry').each(function() {
                var element = $(this);
                if (typeof $.fn.isotope === 'function') {
                    element.find('.blogs').isotope();
                }
            });

            $('.alus-blogs-shortcode.has-load-more').each(function() {
                var element = $(this);
                var atts = element.data('atts');
                element.on('click', 'a.load-more', function() {
                    var button = $(this);
                    if (button.hasClass('loading')) {
                        return false;
                    }

                    button.addClass('loading');
                    var paged = button.attr('data-paged');

                    $.ajax({
                        type: 'POST',
                        timeout: 30000,
                        url: umbala_settings.ajax_uri,
                        data: { action: 'alus_blogs_load_items', paged: paged, atts: atts },
                        error: function(xhr, err) {

                        },
                        success: function(response) {
                            button.removeClass('loading');
                            button.attr('data-paged', ++paged);
                            if (response !== 0 && response !== '') {
                                if (element.hasClass('masonry') && typeof $.fn.isotope === 'function') {
                                    element.find('.blogs').isotope('insert', $(response));
                                    setTimeout(function() {
                                        element.find('.blogs').isotope('layout');
                                    }, 500);
                                } else {
                                    element.find('.blogs').append(response);

                                    var columns = parseInt(atts.columns);
                                    element.find('.blogs .item').removeClass('first last');
                                    element.find('.blogs .item').each(function(index, ele) {
                                        if (index % columns === 0) {
                                            $(ele).addClass('first');
                                        }
                                        if (index % columns === columns - 1) {
                                            $(ele).addClass('last');
                                        }
                                    });
                                }
                                UmbalaTheme.BlogGallerySlider();
                                UmbalaTheme.LazyLoading();
                            } else {
                                button.parent().remove();
                            }
                        }
                    });

                    return false;
                });

            });
        },

        BootrapTooltip: function() {
            if ($(window).width() <= 1024) {
                return;
            }

            var wrapper = $('.social-sharing li a, .product-images-wrapper .product-zoom-button a');
            wrapper.tooltip({
                animation: false,
                container: 'body',
                trigger: 'hover',
                placement: 'top',
                title: function() {
                    return $(this).text();
                }
            });

            var productBtn = $('.alus-product-buttons .compare, .alus-product-buttons .yith-wcwl-add-to-wishlist a, .alus-product-buttons .quickview');
            productBtn.tooltip({
                animation: false,
                container: 'body',
                trigger: 'hover',
                placement: 'left',
                title: function() {
                    if ($(this).find('.added_to_cart').length > 0) {
                        return $(this).find('.add_to_cart_button').text();
                    }
                    return $(this).text();
                }
            });
        },

        WooQuantity: function() {
            $(document).on('click', '.plus, .minus', function() {

                var $qty = $(this).closest('.quantity').find('.qty'),
                    currentVal = parseFloat($qty.val()),
                    max = parseFloat($qty.attr('max')),
                    min = parseFloat($qty.attr('min')),
                    step = $qty.attr('step');

                if (!currentVal || currentVal === '' || currentVal === 'NaN') {
                    currentVal = 0;
                }
                if (max === '' || max === 'NaN') {
                    max = '';
                }
                if (min === '' || min === 'NaN') {
                    min = 0;
                }
                if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN') {
                    step = 1;
                }

                if ($(this).is('.plus')) {

                    if (max && (max == currentVal || currentVal > max)) {
                        $qty.val(max);
                    } else {
                        $qty.val(currentVal + parseFloat(step));
                    }

                } else {

                    if (min && (min == currentVal || currentVal < min)) {
                        $qty.val(min);
                    } else if (currentVal > 0) {
                        $qty.val(currentVal - parseFloat(step));
                    }

                }

                $qty.trigger('change');

            });
        },

        ProductImageSetting: function() {
            if ($('.single-product').length > 0) {
                $('.product-thumbnails').on('click', '.thumbnail-image a', function(e) {
                    e.preventDefault();
                });

                $('.product-images-wrapper > .images').each(function() {
                    var element = $(this);
                    element.addClass('owl-carousel').owlCarousel({
                        loop: false,
                        nav: true,
                        navText: false,
                        dots: false,
                        navSpeed: 1000,
                        slideBy: 1,
                        rtl: $('body').hasClass('rtl'),
                        margin: 0,
                        autoplayTimeout: 5000,
                        responsiveRefreshRate: 400,
                        responsive: {
                            0: {
                                items: 1
                            }
                        },
                        onInitialized: function() {
                            element.addClass('loaded').removeClass('loading');
                        }
                    });
                });
                if ($('.product-images-wrapper > .images').hasClass('has-product-lightbox') && typeof PhotoSwipe != 'undefined') {
                    ProductLightbox();

                    $('.product-images-wrapper').on('click', '.product-zoom-button', function(t) {
                        $('.product-images-wrapper > .images').find('.owl-item.active a').trigger('click');
                        t.preventDefault();
                    });
                } else {
                    $('.product-images-wrapper > .images').on('click', '.woocommerce-product-gallery__image a', function(e) {
                        e.preventDefault();
                    });
                }
                ProductThumbnailBottom();
                ProductThumbnailLeft();

                var prodZoom = $('.product-images-wrapper > .images.has-product-zoom .woocommerce-product-gallery__image').easyZoom({
                    loadingNotice: '',
                    preventClicks: false
                });
                var updateThumbnail = $('.product-thumbnails .first img').attr('data-src') ? $('.product-thumbnails .first img').attr('data-src') : $('.product-thumbnails .first img').attr('src');
                var updateZoom = prodZoom.filter('.product-images-wrapper > .images.has-product-zoom .first').data('easyZoom');
                $('form.variations_form').on('show_variation', function(e, variation, purchasable) {
                    $('.product-images-wrapper > .images').trigger('to.owl.carousel', 0);
                    updateZoom.teardown();
                    updateZoom._init();

                    var image_src = variation.image.src;
                    if (!image_src) {
                        return;
                    }
                    var $thumb = $('.thumbnails .thumbnail-image.first img');
                    if (typeof $.fn.wc_set_variation_attr === 'function') {
                        $thumb.wc_set_variation_attr('src', image_src);
                    }
                });

                $('form.variations_form').on('click', '.reset_variations', function() {
                    $('.product-thumbnails .first img').attr('src', updateThumbnail);
                    updateZoom.teardown();
                    updateZoom._init();

                    var $thumb = $('.thumbnails .thumbnail-image.first img');
                    if (typeof $.fn.wc_reset_variation_attr === 'function') {
                        $thumb.wc_reset_variation_attr('src');
                    }
                });
            }

            function ProductLightbox() {
                $('.product-images-wrapper > .images').on('click', '.woocommerce-product-gallery__image a', function(e) {
                    e.preventDefault();
                    var items = PhotoswipeItems();
                    var index = $(this).find('img').attr('data-index');
                    var pswpElement = $('.pswp')[0];
                    var options = {
                        index: parseInt(index),
                        shareEl: false,
                        closeOnScroll: false,
                        history: false,
                        hideAnimationDuration: 0,
                        showAnimationDuration: 0
                    };
                    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
                    gallery.init();
                });
            }

            function PhotoswipeItems() {
                var items = [];
                $('.product-images-wrapper > .images .woocommerce-product-gallery__image a').each(function(index, ele) {
                    if ($(ele).parents('.owl-item.cloned').length === 0) {
                        var img = $(ele).find('img');
                        var large_image_src = img.attr('data-large_image');
                        var large_image_w = img.attr('data-large_image_width');
                        var large_image_h = img.attr('data-large_image_height');
                        var item = {
                            src: large_image_src,
                            w: large_image_w,
                            h: large_image_h,
                            title: img.attr('title')
                        };
                        items.push(item);
                    }
                });

                return items;
            }

            function ProductThumbnailBottom() {
                var $thumbnail = $('.single-product .thumbnails:not(.vertical-thumbnail) .product-thumbnails');
                $thumbnail.addClass('owl-carousel').owlCarousel({
                    loop: false,
                    nav: false,
                    navText: false,
                    dots: false,
                    navSpeed: 1000,
                    rtl: $('body').hasClass('rtl'),
                    margin: 15,
                    autoplay: true,
                    responsive: {
                        0: {
                            items: 1
                        },
                        100: {
                            items: 2
                        },
                        290: {
                            items: 3
                        }
                    },
                    onInitialized: function() {
                        $thumbnail.addClass('loaded').removeClass('loading');
                    }
                });

                var $thumbSlider = $thumbnail.owlCarousel(),
                    $imageWrap = $('.product-images-wrapper > .images');

                $thumbnail.on('click', '.owl-item', function(e) {
                    var i = $(this).index();
                    $thumbSlider.trigger('to.owl.carousel', i);
                    $imageWrap.trigger('to.owl.carousel', i);
                });

                $imageWrap.on('changed.owl.carousel', function(e) {
                    var i = e.item.index;
                    $thumbSlider.trigger('to.owl.carousel', i);
                    $thumbnail.find('.is-selected').removeClass('is-selected');
                    $thumbnail.find('.thumbnail-image').eq(i).addClass('is-selected');
                });
                $thumbnail.find('.thumbnail-image').eq(0).addClass('is-selected');
            }

            function ProductThumbnailLeft() {
                var $thumbnail = $('.single-product .thumbnails.vertical-thumbnail .product-thumbnails');
                if ($thumbnail.length > 0) {
                    var _slider_data = {
                        slidesToShow: 3,
                        dot: false,
                        lazy: 'ondemand',
                        slidesToScroll: 1,
                        vertical: true,
                        verticalSwiping: true,
                        infinite: false
                    };
                    $thumbnail.slick(_slider_data);
                    $thumbnail.addClass('loaded').removeClass('loading');
                }
                var $imageWrap = $('.product-images-wrapper > .images');
                $thumbnail.on('click', '.thumbnail-image', function(e) {
                    var i = $(this).index();
                    $imageWrap.trigger('to.owl.carousel', i);
                });

                $imageWrap.on('changed.owl.carousel', function(e) {
                    var i = e.item.index;
                    $thumbnail.on('init', function() {
                        $thumbnail.slick('slickGoTo', i, true);
                    });
                    $thumbnail.find('.is-selected').removeClass('is-selected');
                    $thumbnail.find('.thumbnail-image').eq(i).addClass('is-selected');
                });
                $thumbnail.find('.thumbnail-image').eq(0).addClass('is-selected');
            }

            $('.single-product').on('click', 'a.woocommerce-review-link', function(t) {
                $.scrollTo('.reviews_tab', {
                    duration: 300,
                    offset: -150
                });
            });

            $('.variations_form').on('click', '.alus-product-attribute .variation-product__option a', function() {
                var element = $(this);
                var val = element.closest('.variation-product__option').data('variation');
                var selector = element.closest('.alus-product-attribute').siblings('select');
                if (selector.length > 0) {
                    if (selector.find('option[value="' + val + '"]').length > 0) {
                        selector.val(val).trigger('change');
                        element.closest('.alus-product-attribute').find('.variation-product__option').removeClass('selected');
                        element.closest('.variation-product__option').addClass('selected');
                    }
                }
                return false;
            });

            $('.variations_form').on('click', '.reset_variations', function() {
                $(this).closest('.variations').find('.alus-product-attribute .variation-product__option').removeClass('selected');
            });

            $('form.woocommerce-ordering ul.orderby ul a').on('click', function(e) {
                e.preventDefault();
                if ($(this).hasClass('current')) {
                    return;
                }
                $(this).closest('form.woocommerce-ordering').find('select.orderby').val($(this).attr('data-orderby'));
                $(this).closest('form.woocommerce-ordering').trigger('submit');
            });
        },

        ProductDefaultSlider: function() {
            $('.single-product .related .products, .single-product .up-sells .products, .woocommerce .cross-sells .products').each(function() {
                var element = $(this);
                element.addClass('owl-carousel').owlCarousel({
                    loop: false,
                    nav: false,
                    navText: false,
                    dots: false,
                    slideBy: 1,
                    rtl: $('body').hasClass('rtl'),
                    margin: 30,
                    autoplayTimeout: 5000,
                    responsive: {
                        0: {
                            items: 1
                        },
                        667: {
                            items: 2
                        },
                        736: {
                            items: 2
                        },
                        800: {
                            items: 3
                        },
                        1400: {
                            items: 3
                        }
                    },
                    onInitialized: function() {
                        element.addClass('loaded').removeClass('loading');
                    }
                });
            });
        },

        RelatedPostSlider: function() {
            $('.related-posts.loading .meta-slider > .blogs').each(function() {
                var element = $(this);

                element.addClass('owl-carousel').owlCarousel({
                    loop: true,
                    nav: false,
                    navText: false,
                    dots: false,
                    slideBy: 1,
                    rtl: $('body').hasClass('rtl'),
                    margin: 30,
                    autoplayTimeout: 5000,
                    responsive: {
                        0: {
                            items: 1
                        },
                        600: {
                            items: 1
                        },
                        800: {
                            items: 2
                        },
                        1400: {
                            items: 2
                        }
                    }
                });
            });
        },

        BlogGallerySlider: function() {
            $('.blog-image.gallery').each(function() {
                var element = $(this);
                element.addClass('owl-carousel').owlCarousel({
                    items: 1,
                    loop: true,
                    nav: false,
                    dots: true,
                    navText: false,
                    slideBy: 1,
                    rtl: $('body').hasClass('rtl'),
                    margin: 0,
                    autoplay: true,
                    autoplayTimeout: 5000,
                    autoHeight: true,
                    responsive: {
                        0: {
                            items: 1
                        }
                    },
                    onInitialized: function() {
                        element.addClass('loaded').removeClass('loading');
                    }

                });

            });
        },

        CountdownTimer: function() {
            $('.countdown-timer').each(function() {
                var time = $(this).data('countdown');
                $(this).countdown(time, function(event) {
                    $(this).html(event.strftime('' +
                        '<div class="days"><span class="number">%-D </span><div class="countdown-meta">' + umbala_settings.countdown_days + '</div></div> ' +
                        '<div class="hours"><span class="number">%H </span><div class="countdown-meta">' + umbala_settings.countdown_hours + '</div></div> ' +
                        '<div class="minutes"><span class="number">%M </span><div class="countdown-meta">' + umbala_settings.countdown_mins + '</div></div> ' +
                        '<div class="sec"><span class="number">%S </span><div class="countdown-meta">' + umbala_settings.countdown_sec + '</div></div>'));
                });
            });
        },

        ProductWgSlider: function() {
            $('.alus-product-items-widget.slider').each(function() {
                var element = $(this);
                var nav = element.data('nav') === 1;
                var autoplay = element.data('auto_play') === 1;
                var columns = element.data('columns');
                var margin = element.data('margin');

                element.addClass('owl-carousel').owlCarousel({
                    loop: true,
                    items: 1,
                    nav: nav,
                    navText: false,
                    dots: false,
                    slideBy: 1,
                    rtl: $('body').hasClass('rtl'),
                    columns: columns,
                    margin: margin,
                    autoplay: autoplay,
                    autoplayTimeout: 5000,
                    responsive: {
                        0: {
                            items: columns
                        }
                    },
                    onInitialized: function() {
                        element.addClass('loaded').removeClass('loading');
                    }
                });
            });
        },

        RecentPostWg: function() {
            var element = $('.alus_recent_comments.is-slider, .alus_blog_widget.is-slider');
            var nav = element.data('nav') === 1;
            var autoplay = element.data('autoplay') === 1;

            element.addClass('owl-carousel').owlCarousel({
                loop: false,
                items: 1,
                margin: 10,
                nav: nav,
                navText: false,
                dots: false,
                slideBy: 1,
                rtl: $('body').hasClass('rtl'),
                autoplay: autoplay,
                autoplayTimeout: 5000,
                responsive: {
                    0: {
                        items: 1
                    }
                }
            });
        },

        WishlistAction: function() {
            $('body').on('click', '.add_to_wishlist', function() {
                $(this).parent().addClass('loading');
            });
            $('body').on('added_to_wishlist', function() {
                WishlistButton();
                $('.yith-wcwl-wishlistaddedbrowse.show, .yith-wcwl-wishlistexistsbrowse.show').closest('.yith-wcwl-add-to-wishlist').removeClass('loading').addClass('added');
            });
            var WishlistButton = function() {
                var wishlist = $('.header-wishlist');
                if (wishlist.length === 0) {
                    return;
                }

                wishlist.addClass('loading');
                $.ajax({
                    type: 'POST',
                    url: umbala_settings.ajax_uri,
                    data: { action: 'update_tini_wishlist' },
                    success: function(response) {
                        var first_icon = wishlist.children('i.fa:first');
                        wishlist.html(response);
                        if (first_icon.length > 0) {
                            wishlist.prepend(first_icon);
                        }
                        wishlist.removeClass('loading');
                    }
                });
            };

            $(document).on('click', '#yith-wcwl-form table tbody tr td a.remove, #yith-wcwl-form table tbody tr td a.add_to_cart_button', function() {
                var old_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
                var count = 1;
                var time_interval = setInterval(function() {
                    count++;
                    var new_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
                    if (old_num_product != new_num_product || count === 20) {
                        clearInterval(time_interval);
                        WishlistButton();
                    }
                }, 500);
            });
        },

        HideMessagePopup: function() {
            var wrapper = '#yith-wcwl-popup-message';
            $('body').on('click', wrapper, function() {
                $(wrapper).addClass('hidden-message');
            });
        },

        QuickviewAction: function() {
            $(document).on('click', '.quickview', function(e) {
                e.preventDefault();

                var id = $(this).data('id'),
                    prev = '',
                    next = '',
                    btn = $(this);
                btn.addClass('loading');

                $.ajax({
                    url: umbala_settings.ajax_uri,
                    data: {
                        id: id,
                        action: 'load_quickshop_content'
                    },
                    type: 'POST',
                    success: function(data) {
                        $.magnificPopup.open({
                            items: {
                                src: '<div class="quick-view-popup">' + data + '</div>',
                                type: 'inline'
                            },
                            tClose: '',
                            tLoading: '',
                            removalDelay: 500,
                            callbacks: {
                                beforeOpen: function() {
                                    this.st.mainClass = 'mfp-move-horizontal' + ' quick-view-wrapper woocommerce';
                                },
                                open: function() {

                                    $('.quick-view-popup').find('form.variations_form').wc_variation_form();
                                    $('.quick-view-popup').find('form.variations_form .variations select').trigger('change');
                                    $('body').trigger('wc_fragments_loaded');

                                    $('.quick-view-popup .variations_form').on('click', '.reset_variations', function() {
                                        $(this).closest('.variations').find('.alus-product-attribute .option').removeClass('selected');
                                    });
                                }
                            },
                        });

                        var element = $('.alus-quickshop-wrapper .images-slider-wrapper');
                        if (element.find('.woocommerce-product-gallery__image').length <= 1) {
                            return;
                        }

                        var owl = element.find('.image-items').addClass('owl-carousel').owlCarousel({
                            items: 1,
                            loop: true,
                            nav: true,
                            navText: false,
                            dots: true,
                            slideBy: 1,
                            rtl: $('body').hasClass('rtl'),
                            margin: 0,
                            autoplay: false,
                            autoplayTimeout: 5000,
                            onInitialized: function() {
                                element.addClass('loaded').removeClass('loading');
                            }
                        });

                    },
                    complete: function() {
                        btn.removeClass('loading');
                    },
                    error: function() {},
                });
            });
        },

        AccordionProductTab: function() {
            if ($('.woocommerce-tabs.accordion-product-tabs').length > 0) {
                $('a.woocommerce-review-link').on('click', function() {
                    var reviews = $('#reviews').parents('.vc_tta-panel-body').siblings('.vc_tta-panel-heading');
                    $('.vc_tta-accordion .vc_tta-panel').removeClass('vc_active');
                    reviews.parents('.vc_tta-panel').addClass('vc_active');
                    if (!reviews.parents('.vc_tta-panel').hasClass('vc_active')) {
                        setTimeout(function() {
                            reviews.trigger('click');
                            reviews.find('.vc_tta-panel-title a').trigger('click');
                        }, 100);
                    }
                });
            }
        },

        HoverGalleryProduct: function() {
            $('body').on('mouseenter mouseleave', '.alus_thumb_list_hover', function() {
                $(this).closest('.alus-product').find('.images a img').attr('src', $(this).attr('data-hover'));
            });
        },

        AjaxSearch: function() {
            if (typeof umbala_settings.alus_enable_ajax_search === 'undefined' || umbala_settings.alus_enable_ajax_search != 1) {
                return;
            }
            $('.alus_search_products').append('<div class="alus-live-search-results"></div>');
            var results = $('.alus-live-search-results'),
                form = $('.alus_search_products'),
                click = false,
                request = false;

            form.on('keyup', 'input[type="text"]', function(e) {
                results.hide();
                var thisForm = $(this).parents('.searchform'),
                    s = thisForm.find('input[type="text"]').val();

                if (s.length < 2) {
                    form.removeClass('loading');
                    return;
                }

                var cat = '';
                var select_cat = $(this).parents('.alus_search_products').siblings('.select-category');
                if (select_cat.length > 0) {
                    cat = select_cat.find(':selected').val();
                }

                request && request.abort();

                request = $.ajax({
                    url: umbala_settings.ajax_uri,
                    method: 'POST',
                    data: {
                        'action': 'umbala_ajax_search',
                        's': s,
                        'cat': cat
                    },
                    dataType: 'json',
                    beforeSend: function() {
                        form.addClass('loading');
                        results.hide();
                    },
                    complete: function() {
                        form.removeClass('loading');
                        results.on('click', '.view-all a', function(e) {
                            e.preventDefault();
                            form.parents('form').trigger('submit');
                        });
                        click = true;
                    },
                    success: function(response) {
                        results.html(response.html).show();
                    },
                    error: function() {}
                });

                $('body').on('click', function(event) {
                    if (!$(event.target).is('.search-form-wrapper') && $(event.target).closest('.search-form-wrapper').length) {
                        return;
                    }
                    results.hide();
                });
                $('.search-form-wrapper').on('change', 'select.select-category', function() {
                    $(this).parents('.search-form-wrapper').find('.alus_search_products input[type="text"]').trigger('keyup');
                });

            });
        },

        CounterUpShortcode: function() {
            $('.alus-counter .number').counterUp({
                delay: 10,
                time: 1000,
                formatter: function(n) {
                    return n.replace(/,/g, '.');
                }
            });
        },

        SingleProductVideo: function() {
            $('a.alus-single-video').magnificPopup({
                type: 'iframe',
                preloader: false,
                fixedContentPos: false
            });
        },

        SizeChartProductImg: function() {
            $('a.size-guide-btn').magnificPopup({
                type: 'image',
                closeOnContentClick: false,
                mainClass: 'mfp-img-mobile',
                image: {
                    verticalFit: true
                },
                zoom: {
                    enable: true
                }
            });
        },

        GalleryImagesShortcode: function() {
            $('.lightbox.alus-images-shortcode a').parent().magnificPopup({
                delegate: 'a',
                type: 'image',
                closeBtnInside: false,
                tLoading: '<div class="loading"></div>',
                removalDelay: 300,
                gallery: {
                    enabled: true,
                    navigateByImgClick: true,
                    arrowMarkup: '<button class="mfp-arrow mfp-arrow-%dir%" title="%title%"><i class="icon-angle-%dir%"></i></button>',
                    preload: [0, 1]
                },
                image: {
                    tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                    verticalFit: false
                },
                zoom: {
                    enabled: true,
                    duration: 300
                }
            });
            $('.layout-masonry.alus-images-shortcode').each(function() {
                if (typeof($.fn.isotope) === 'undefined') {
                    return;
                }
                var $container = $(this).find('.images-gallery');
                $container.isotope({
                    gutter: 0,
                    isOriginLeft: !$('body').hasClass('rtl'),
                    itemSelector: '.images-gallery-item'
                });
            });
            $('.layout-slider.alus-images-shortcode').each(function() {
                var element = $(this);
                var margin = element.data('margin');
                var columns = element.data('columns');
                var nav = element.data('nav') === 1;
                var dots = element.data('dots') === 1;
                var autoplay = element.data('autoplay') === 1;
                var desksmini = element.data('desksmini');
                var tabletmini = element.data('tabletmini');
                var tablet = element.data('tablet');
                var mobile = element.data('mobile');
                var mobilesmini = element.data('mobilesmini');
                var _slider_data = {
                    loop: false,
                    nav: nav,
                    dots: dots,
                    slideBy: 1,
                    navText: false,
                    navRewind: false,
                    rtl: $('body').hasClass('rtl'),
                    margin: margin,
                    autoplay: autoplay,
                    autoplayTimeout: 5000,
                    responsive: {
                        0: {
                            items: mobilesmini
                        },
                        480: {
                            items: mobile
                        },
                        640: {
                            items: tabletmini
                        },
                        768: {
                            items: tablet
                        },
                        991: {
                            items: desksmini
                        },
                        1199: {
                            items: columns
                        }
                    }
                };
                element.find('.images-gallery').addClass('owl-carousel').owlCarousel(_slider_data);
            });
        },

        BackgroundPrlx: function() {
            if ($(window).width() <= 1024) {
                return;
            }
            $('.alus-prlx-background').each(function() {
                $(this).parallax('50%', 0.3);
            });
        },

        MegaMenuSetting: function() {
            var mainMenu = $('.main-navigation').find('ul.menu'),
                activeMega = mainMenu.find(' > li.menu-item-sized, li.menu-item-full-width');
            mainMenu.on('mouseenter mouseleave', ' > li.menu-item-sized, li.menu-item-full-width', function(e) {
                setOffset($(this));
            });
            var setOffset = function(li) {

                var dropdown = li.find(' > .sub-menu-dropdown'),
                    styleID = 'arrow-offset',
                    $header = $('.header-alus'),
                    siteWrapper = $('#wrapper');

                dropdown.attr('style', '');

                var submenuWidth = dropdown.outerWidth(),
                    submenuOffset = dropdown.offset(),
                    windowWidth = $(window).width(),
                    bodyRight = siteWrapper.outerWidth() + siteWrapper.offset().left,
                    viewportWidth = ($('body').hasClass('wrapper-layout-boxed')) ? bodyRight : windowWidth,
                    extraSpace = (li.hasClass('menu-item-full-width')) ? 0 : 10;

                var submenuOffsetRight = windowWidth - submenuOffset.left - submenuWidth;

                if (submenuOffset.left + submenuWidth >= viewportWidth && (li.hasClass('menu-item-sized') || li.hasClass('menu-item-full-width'))) {

                    var toRight = submenuOffset.left + submenuWidth - viewportWidth;

                    dropdown.css({
                        left: -toRight - extraSpace
                    });
                }

            };

            activeMega.each(function() {
                setOffset($(this));
            });
        },

        MobileNavigation: function() {
            $('.alus-mobile-navigation .menu-item-has-children').append('<span class="sub-menu-icon"></span>');
            $('.alus-mobile-navigation').on('click', '.sub-menu-icon', function(e) {
                e.preventDefault();

                if ($(this).parent().hasClass('active')) {
                    $(this).parent().removeClass('active').find('> ul').slideUp(200);
                    $(this).parent().removeClass('active').find('.sub-menu-dropdown .container > ul, .sub-menu-dropdown > ul').slideUp(200);
                    $(this).parent().find('> .icon-sub-menu').removeClass('up-icon');
                } else {
                    $(this).parent().addClass('active').find('> ul').slideDown(200);
                    $(this).parent().addClass('active').find('.sub-menu-dropdown .container > ul, .sub-menu-dropdown > ul').slideDown(200);
                    $(this).parent().find(' > .icon-sub-menu').addClass('up-icon');
                }
            });
            $('body').on('click', '.mobile-nav', function(e) {
                e.preventDefault();
                if ($('body').hasClass('has-mobile-menu')) {
                    $('body').removeClass('has-mobile-menu');
                } else {
                    $('body').addClass('has-mobile-menu');
                }
            });
            $('body').on('click touchstart', '.alus-close-popup', function() {
                $('body').removeClass('has-mobile-menu');
            });
        },

        HeaderSticky: function() {
            if ($('body').hasClass('has_sticky_header')) {
                var headerSticky = $('.sticky-header'),
                    headerHeight = $('.site-header').outerHeight() + 100;

                $(window).on('scroll', function() {
                    if ($(this).scrollTop() > headerHeight) {
                        headerSticky.addClass('is-sticky');
                    } else {
                        headerSticky.removeClass('is-sticky');
                    }
                });
            }
        },

        PopupNewletter: function() {

            if (typeof umbala_settings.alus_enable_popup === 'undefined' || umbala_settings.alus_enable_popup != 1 || $(window).width() < 768) {
                return;
            }
            var popup = $('.alus-popup'),
                show = false,
                pages = $.cookie('umbala_show_popup');

            if (!pages) {
                pages = 0;
            }

            if (pages < umbala_settings.alus_popup_pages) {
                pages++;
                $.cookie('umbala_show_popup', pages, { expires: 7, path: '/' });
                return false;
            }

            var showPopup = function() {
                $.magnificPopup.open({
                    items: {
                        src: '.alus-popup'
                    },
                    type: 'inline',
                    removalDelay: 500,
                    callbacks: {
                        beforeOpen: function() {
                            this.st.mainClass = 'mfp-move-horizontal' + ' promo-popup-wrapper';
                        },
                        open: function() {},
                        close: function() {
                            $.cookie('umbala_popup_show', 'show', { expires: 7, path: '/' });
                        }
                    }
                });
            };

            if ($.cookie('umbala_popup_show') != 'show') {
                if (umbala_settings.alus_popup_event === 'scroll') {
                    $(window).on('scroll', function() {
                        if (show) {
                            return false;
                        }
                        if ($(document).scrollTop() >= umbala_settings.alus_popup_scroll) {
                            showPopup();
                            show = true;
                        }
                    });
                } else {
                    setTimeout(function() {
                        showPopup();
                    }, umbala_settings.alus_popup_timeout);
                }
            }
        },

        Backtotop: function() {
            if ($('.back-to-top').length > 0) {
                $(window).on('scroll', function() {
                    if ($(this).scrollTop() > 100) {
                        $('.back-to-top').addClass('show');
                    } else {
                        $('.back-to-top').removeClass('show');
                    }
                });
                $('.back-to-top').on('click', '.scroll-button', function() {
                    $('body, html').animate({
                        scrollTop: '0px'
                    }, 800);
                    return false;
                });
            }
        },

        BannerPrlxShortcode: function() {
            $('.has-hover.image-hover-parallax .image').panr({
                sensitivity: 20,
                scale: false,
                scaleOnHover: true,
                scaleTo: 1.12,
                scaleDuration: 0.34,
                panY: true,
                panX: true,
                panDuration: 0.5,
                resetPanOnMouseLeave: true
            });
        },

        ShopSidebar: function() {
            $('body').on('click', '.alus-show-sidebar-button', function(e) {
                e.preventDefault();
                if ($('.shop-sidebar').hasClass('show-hidden-sidebar')) {
                    hideSidebar();
                } else {
                    showSidebar();
                }
            });
            $('body').on('click touchstart', '.alus-close-popup, .close-sidebar', function() {
                hideSidebar();
            });
            var showSidebar = function() {
                $('.shop-sidebar').addClass('show-hidden-sidebar');
                $('body').addClass('show-shop-sidebar');
                $('.alus-show-sidebar-button').addClass('shown');
            };
            var hideSidebar = function() {
                $('.alus-show-sidebar-button').removeClass('shown');
                $('.shop-sidebar').removeClass('show-hidden-sidebar');
                $('body').removeClass('show-shop-sidebar');
            };
        },

        ShopFilters: function() {
            $('body').on('click', '.alus-filters-button', function(e) {
                e.preventDefault();
                if ($('.alus-filters-content').hasClass('show-filter-content')) {
                    hideSidebar();
                } else {
                    showSidebar();
                }
            });
            $('body').on('click touchstart', '.alus-close-popup, .close-sidebar', function() {
                hideSidebar();
            });
            var showSidebar = function() {
                $('body').addClass('show-filter');
                $('.alus-filters-content').addClass('show-filter-content');
                $('.alus-filters-button').addClass('shown');
            };
            var hideSidebar = function() {
                $('.alus-filters-button').removeClass('shown');
                $('.alus-filters-content').removeClass('show-filter-content');
                $('body').removeClass('show-filter');
            };
        },

        loginSidebar: function() {
            var body = $('body');
            $('.login-canvas').on('click', '.login', function(e) {
                e.preventDefault();
                if (isOpened()) {
                    hideLogin();
                } else {
                    setTimeout(function() {
                        showLogin();
                    }, 10);
                }
            });

            body.on('click touchstart', '.alus-close-popup, .login-close', function() {
                if (isOpened()) hideLogin();
            });

            var hideLogin = function() {
                body.removeClass('has-login-form');
            };

            var showLogin = function() {
                body.addClass('has-login-form');
            };

            var isOpened = function() {
                return body.hasClass('has-login-form');
            };
        },

        CartSidebar: function() {
            var body = $('body');
            $('.cart-canvas').on('click', '.alus_cart', function(e) {
                e.preventDefault();
                if (isOpened()) {
                    hideCartSidebar();
                } else {
                    setTimeout(function() {
                        showCartSidebar();
                    }, 10);
                }
            });

            $('body').on('click', '.added-to-cart-message', function(e) {
                $('.added-to-cart-message').hide();
                $('.cart-canvas').find('.alus_cart').trigger('click');
                e.preventDefault();
            });

            body.on('click touchstart', '.alus-close-popup, .close-cart', function() {
                if (isOpened()) hideCartSidebar();
            });

            var hideCartSidebar = function() {
                body.removeClass('has-cart-sidebar');
            };

            var showCartSidebar = function() {
                if ($('body').hasClass('woocommerce-checkout') || $('body').hasClass('woocommerce-cart')) {
                    return false;
                }
                body.addClass('has-cart-sidebar');
            };

            var isOpened = function() {
                return body.hasClass('has-cart-sidebar');
            };
        },

        CatMasonryShot: function() {
            var element = $('.alus-product-categories-shortcode.layout-masonry'),
                is_masonry = false;
            if (typeof $.fn.isotope === 'function') {
                is_masonry = true;
            }

            if (is_masonry) {
                $(window).on('load', function() {
                    element.find('.meta-slider > .products').isotope();
                });
            }
        },

        MessageAddtoCart: function() {
            var src,
                title,
                message = false;

            $('body').on('click', '.ajax_add_to_cart', function() {
                $('.woocommerce-message').remove();
                if ($('body').hasClass('woocommerce-wishlist')) {
                    src = $(this).parents('tr').find('img.attachment-woocommerce_thumbnail').attr('src');
                    title = $(this).parents('tr').find('.product-name').html();
                } else {
                    src = $(this).parents('div.alus-product').find('img.attachment-shop_catalog').attr('src');
                    title = $(this).parents('div.alus-product').find('.product-title').html();
                }

                if (typeof src !== 'undefined' && typeof title !== 'undefined') {
                    message = '<div class="added-to-cart-message"><div class="product_message_wrapper"><div class="product_message_image"><img src="' + src + '" alt></div><div class="product_notification_text">' + title + umbala_settings.cart_message + '</div></div></div>';
                }
            });

            $(document).on('added_to_cart', function(event, data) {
                if (message !== false) {
                    $('body').prepend(message);
                }
            });
        },

        StickyProduct: function() {
            var productSticky = $('.umbala_product_sticky');
            $('.product-single-wrapper').waypoint({
                handler: function(d) {
                    productSticky.toggleClass('shown', d === 'down');
                }
            });

            productSticky.on('click', '.alus-add-to-cart a:not(".ajax_add_to_cart, .added_to_cart")', function(e) {
                e.preventDefault();
                $.scrollTo('.product-single-wrapper', {
                    duration: 300,
                    offset: -150
                });
            });
        },

        LazyLoading: function() {
            $('img.lazyload').Lazy();
        },

        ColorSwatches: function() {
            $('body').on('click', '.color-swatch', function() {
                var src,
                    imageSrc = $(this).data('src'),
                    product = $(this).parents('.alus-product'),
                    image = product.find('.images > a > img'),
                    currentSrc = image.data('current-src');

                if (typeof imageSrc === 'undefined') {
                    return;
                }

                if (typeof currentSrc === 'undefined') {
                    currentSrc = image.data('current-src', image.attr('src'));
                }

                if ($(this).hasClass('chosen')) {
                    src = currentSrc;
                    $(this).removeClass('chosen');
                } else {
                    $(this).parent().find('.chosen').removeClass('chosen');
                    src = imageSrc;
                    $(this).addClass('chosen');
                }

                if (image.attr('src') === src) {
                    return;
                }

                image.attr('src', src);

            });
        },

    };

    $(document).ready(function() {
        UmbalaTheme.init();
    });

})(jQuery);