<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wc_print_notices();

?>
<div class="checkout-login-coupon-wrapper">
	<?php
	do_action( 'woocommerce_before_checkout_form', $checkout );
	?>
</div>
<?php

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->enable_signup && ! $checkout->enable_guest_checkout && ! is_user_logged_in() ) {
	echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', esc_html__( 'You must be logged in to checkout.', 'umbala' ) );
	return;
}

// filter hook for include new pages inside the payment method
$get_checkout_url = apply_filters( 'woocommerce_get_checkout_url', wc_get_checkout_url() ); ?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( $get_checkout_url ); ?>" enctype="multipart/form-data">

	<div class="row">
		<div class="col-md-7">
			<?php if ( sizeof( $checkout->checkout_fields ) > 0 ) : ?>

				<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

				<div id="customer_details">
					<div class="clear">

						<?php do_action( 'woocommerce_checkout_billing' ); ?>

					</div>
					<div class="clear">

						<?php do_action( 'woocommerce_checkout_shipping' ); ?>

					</div>
				</div>

				<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>
			<?php endif; ?>
		</div>

		<div class="col-md-5">
			<div class="checkout-order-review">
				<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'umbala' ); ?></h3>

				<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

				<div id="order_review" class="woocommerce-checkout-review-order">
					<?php do_action( 'woocommerce_checkout_order_review' ); ?>
				</div>

				<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>
			</div>
		</div>
	</div>

</form>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>