<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
?>

<?php if (umbala_get_opt('alus_enable_lazyload_product')) {
	umbala_add_lazy_load_attrs(); 
} ?>
<div class="alus-products">
	<div <?php wc_product_class( 'alus-product product' ); ?> >
		<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

		<div class="images">
			<a href="<?php the_permalink(); ?>">

				<?php
					/**
					 * woocommerce_before_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_show_product_loop_sale_flash - 10
					 * @hooked woocommerce_template_loop_product_thumbnail - 10
					 */
					do_action( 'woocommerce_before_shop_loop_item_title' );
					?>

				</a>
				<?php
					/**
					 * woocommerce_shop_loop_item_title hook.
					 *
					 * @hooked woocommerce_template_loop_product_title - 10
					 */
					do_action( 'woocommerce_shop_loop_item_title' );

					/**
					 * woocommerce_after_shop_loop_item_title hook
					 *
					 * @hooked woocommerce_template_loop_rating - 5
					 * @hooked woocommerce_template_loop_price - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item_title' );
					?>

				</div>
				<div class="item-information">
					<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
					
					<?php echo umbala_color_swatches(); ?>
				</div>

				<?php do_action( 'alus_after_shop_loop_item' ); ?>
			</div>
		</div>
		<?php if (umbala_get_opt('alus_enable_lazyload_product')) {
			umbala_remove_lazy_load_attrs(); 
		} ?>
