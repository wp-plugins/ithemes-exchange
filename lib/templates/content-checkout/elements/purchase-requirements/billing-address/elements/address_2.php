<?php
/**
 * This is the default template part for the
 * address2 element in the billing-address
 * purchase-requriements in the content-checkout template part.
 *
 * @since 1.3.0
 * @version 1.4.0
 * @package IT_Exchange
 * 
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file to the 
 * /exchange/content-checkout/elements/purchase-requirements/billing-address/elements/
 * directory located in your theme.
*/
?>
<?php do_action( 'it_exchange_content_checkout_billing_address_purchase_requirement_before_address2_element' ); ?>
<div class="it-exchange-address2 it-exchange-clear-left">
	<?php it_exchange( 'billing', 'address2', array( 'label' => false ) ); ?>
</div>
<?php do_action( 'it_exchange_content_checkout_billing_address_purchase_requirement_after_address2_element' ); ?>
