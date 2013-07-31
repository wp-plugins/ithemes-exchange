<?php
/**
 * This is the default template for the 
 * super-widget-cart coupons element.
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package IT_Exchange
 * 
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file
 * to the exchange/super-widget-cart/elements directory
 * located in your theme.
*/
?>

<?php
// If coupons are supported and the current focus is 'coupon', include the coupons template part
if ( it_exchange( 'coupons', 'supported', array( 'type' => 'cart' ) ) && it_exchange( 'cart', 'focus', array( 'type' => 'coupon' ) ) ) {
	?>
	<?php do_action( 'it_exchange_super_widget_cart_before_coupons_element' ); ?>
	<?php do_action( 'it_exchange_super_widget_cart_before_coupons_wrap' ); ?>
	<div class="coupons-wrapper">
		<?php
		do_action( 'it_exchange_super_widget_cart_begin_coupons_wrap' );
	
		// Include applied coupons loop if any exist
		if ( it_exchange( 'coupons', 'has-applied', array( 'type' => 'cart' ) ) )
			it_exchange_get_template_part( 'super-widget-cart/loops/applied-coupons' );
	
		// If accepting coupons, include template part
		if ( it_exchange( 'coupons', 'accepting', array( 'type' => 'cart' ) ) )
			it_exchange_get_template_part( 'super-widget-cart/elements/apply-coupon' );
	
		// Include the single-item-cart actions template part
		it_exchange_get_template_part( 'super-widget-cart/elements/single-item-cart-cancel' );
	
		do_action( 'it_exchange_super_widget_cart_end_coupons_wrap' );
		?>
	</div>
	<?php 
	
	do_action( 'it_exchange_super_widget_cart_after_coupons_wrap' );
	do_action( 'it_exchange_super_widget_cart_after_coupons_element' );
}