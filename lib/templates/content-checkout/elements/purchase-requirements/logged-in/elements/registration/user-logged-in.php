<?php
/**
 * This is the default template part for the
 * user-logged-in element in the registration loop for the 
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
<?php do_action( 'it_exchange_content_checkout_logged_in_purchase_requirement_registration_before_user_logged_in_element' ); ?>
<p class="it-exchange-registration-logged-in">
	<?php printf( __( 'You already have an active account and are logged in. Visit your %sProfile%s', 'it-l10n-ithemes-exchange' ), '<a href="' . it_exchange_get_page_url( 'profile' ) . '">', '</a>' ); ?>
</p>
<?php do_action( 'it_exchange_content_checkout_logged_in_purchase_requirement_registration_after_user_logged_in_element' ); ?>
