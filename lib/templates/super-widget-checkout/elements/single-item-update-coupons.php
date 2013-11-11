<?php
/**
 * This is the default template for the
 * super-widget-checkout single-item-update-coupons element.
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package IT_Exchange
 *
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file
 * to the exchange/super-widget-checkout/elements directory
 * located in your theme.
*/
?>

<?php if ( it_exchange( 'coupons', 'accepting', array( 'type' => 'cart' ) ) || it_exchange( 'coupons', 'has-applied', array( 'type' => 'cart' ) ) ) : ?>
	<?php do_action( 'it_exchange_super_widget_checkout_before_single_item_update_coupons_action' ); ?>
	<div class="cart-action add-coupon">
		<?php it_exchange( 'checkout', 'cancel', array( 'class' => 'sw-cart-focus-coupon', 'focus' => 'coupon', 'label' => __( 'Coupons', 'it-l10n-ithemes-exchange' ) ) ); ?>
	</div>
	<?php do_action( 'it_exchange_super_widget_checkout_after_single_item_update_coupons_action' ); ?>
<?php endif; ?>
