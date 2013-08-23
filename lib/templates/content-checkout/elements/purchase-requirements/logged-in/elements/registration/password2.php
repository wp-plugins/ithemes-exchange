<?php
/**
 * This is the default template part for the
 * password2 element in the registration loop for the 
 * purchase-requriements in the content-checkout 
 * template part.
 *
 * @since 1.2.0
 * @version 1.2.0
 * @package IT_Exchange
 * 
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file to the 
 * /exchange/content-checkout/elements/purchase-requirements/logged-in/elements/registration
 * directory located in your theme.
*/
?>
<?php do_action( 'it_exchange_content_checkout_logged_in_purchase_requirement_registration_before_password2_element' ); ?>
<div class="it-exchange-registration-password2">
	<?php it_exchange( 'registration', 'password2' ); ?>
</div>
<?php do_action( 'it_exchange_content_checkout_logged_in_purchase_requirement_registration_after_password2_element' ); ?>
