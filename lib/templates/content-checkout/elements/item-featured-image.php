<?php
/**
 * The main template file for the Featured Image
 * detail in the cart-items element for content-checkout
 * template part.
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package IT_Exchange
 * 
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file
 * to the exchange/content-checkout/elements/
 * directory located in your theme.
*/
?>

<?php do_action( 'it_exchange_content_checkout_before_item_featured_image_element' ); ?>
<div class="it-exchange-cart-item-thumbnail it-exchange-table-column">
	<?php do_action( 'it_exchange_content_checkout_begin_item_featured_image_element' ); ?>
	<div class="it-exchange-table-column-inner">
		<?php it_exchange( 'cart-item', 'featured-image' ); ?>
	</div>
	<?php do_action( 'it_exchange_content_checkout_end_item_featured_image_element' ); ?>
</div>
<?php do_action( 'it_exchange_content_checkout_after_item_featured_image_element' ); ?>