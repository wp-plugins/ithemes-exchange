<?php
/**
 * This is the default template for the 
 * super-widget-checkout single-item-update-quantity element.
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

<?php if ( it_exchange_get_global( 'can_edit_purchase_quantity' ) ) : ?>
	<?php do_action( 'it_exchange_super_widget_checkout_before_single_item_update_quantity_element' ); ?>
	<div class="cart-action update-quantity">
		<?php it_exchange( 'checkout', 'cancel', array( 'class' => 'sw-cart-focus-quantity', 'focus' => 'quantity', 'label' => __( 'Quantity', 'it-l10n-ithemes-exchange' ) ) ); ?>
	</div>
	<?php do_action( 'it_exchange_super_widget_checkout_after_single_item_update_quantity_element' ); ?>
<?php endif; ?>
