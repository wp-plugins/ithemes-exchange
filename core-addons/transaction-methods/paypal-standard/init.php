<?php
/**
 * Hooks for PayPal Standard (insecure) add-on
 *
 * @package IT_Exchange
 * @since 0.2.0
*/

if ( !defined( 'PAYPAL_PAYMENT_URL' ) )
	define( 'PAYPAL_PAYMENT_URL', 'https://www.paypal.com/cgi-bin/webscr' );

/**
 * Outputs wizard settings for PayPal
 *
 * @since 0.4.0
 * @todo make this better, probably
 * @param object $form Current IT Form object
 * @return void
*/
function it_exchange_print_paypal_standard_wizard_settings( $form ) {
	$IT_Exchange_PayPal_Standard_Add_On = new IT_Exchange_PayPal_Standard_Add_On();
	$settings = it_exchange_get_option( 'addon_paypal_standard', true );
	$form_values = ITUtility::merge_defaults( ITForm::get_post_data(), $settings );
	$hide_if_js =  it_exchange_is_addon_enabled( 'paypal-standard' ) ? '' : 'hide-if-js';
	?>
	<div class="field paypal-standard-wizard <?php echo $hide_if_js; ?>">
	<?php if ( empty( $hide_if_js ) ) { ?>
        <input class="enable-paypal-standard" type="hidden" name="it-exchange-transaction-methods[]" value="paypal-standard" />
    <?php } ?>
	<?php $IT_Exchange_PayPal_Standard_Add_On->get_paypal_standard_payment_form_table( $form, $form_values ); ?>
	</div>
	<?php
}
add_action( 'it_exchange_print_paypal-standard_wizard_settings', 'it_exchange_print_paypal_standard_wizard_settings' );

/**
 * Stripe URL to perform refunds
 *
 * @since 0.4.0
 *
 * @param string $url passed by WP filter.
 * @param string $url transaction URL
*/
function it_exchange_refund_url_for_paypal_standard( $url ) {

	return 'https://paypal.com/';
	
}
add_filter( 'it_exchange_refund_url_for_paypal-standard', 'it_exchange_refund_url_for_paypal_standard' );
/**
 * This proccesses a paypal transaction.
 *
 * @since 0.4.0
 *
 * @param string $status passed by WP filter.
 * @param object $transaction_object The transaction object
*/
function it_exchange_process_paypal_standard_addon_transaction( $status, $transaction_object ) {

	if ( $status ) //if this has been modified as true already, return.
		return $status;
		
	if ( !empty( $_REQUEST['it-exchange-transaction-method'] ) && 'paypal-standard' === $_REQUEST['it-exchange-transaction-method'] ) {
		
		if ( !empty( $_REQUEST['tx'] ) ) //if PDT is enabled
			$transaction_id = $_REQUEST['tx'];
		else if ( !empty( $_REQUEST['txn_id'] ) ) //if PDT is not enabled
			$transaction_id = $_REQUEST['txn_id'];
		else
			$transaction_id = NULL;
			
		if ( !empty( $_REQUEST['cm'] ) )
			$transient_transaction_id = $_REQUEST['cm'];
		else
			$transient_transaction_id = NULL;

		if ( !empty( $_REQUEST['amt'] ) ) //if PDT is enabled
			$transaction_amount = $_REQUEST['amt'];
		else if ( !empty( $_REQUEST['mc_gross'] ) ) //if PDT is not enabled
			$transaction_amount = $_REQUEST['mc_gross'];
		else
			$transaction_amount = NULL;

		if ( !empty( $_REQUEST['st'] ) ) //if PDT is enabled
			$transaction_status = $_REQUEST['st'];
		else if ( !empty( $_REQUEST['payment_status'] ) ) //if PDT is not enabled
			$transaction_status = $_REQUEST['payment_status'];
		else
			$transaction_status = NULL;
						
		if ( !empty( $transaction_id ) && !empty( $transient_transaction_id ) && !empty( $transaction_amount ) && !empty( $transaction_status ) ) {

			try {

				$general_settings = it_exchange_get_option( 'settings_general' );
				$paypal_settings = it_exchange_get_option( 'addon_paypal_standard' );

				$it_exchange_customer = it_exchange_get_current_customer();

				if ( number_format( $transaction_amount, '2', '', '' ) != number_format( $transaction_object->total, '2', '', '' ) )
					throw new Exception( __( 'Error: Amount charged is not the same as the cart total!', 'it-l10n-ithemes-exchange' ) );

				//If the transient still exists, delete it and add the official transaction
				if ( it_exchange_get_transient_transaction( 'paypal-standard', $transient_transaction_id ) ) {
					it_exchange_delete_transient_transaction( 'paypal-standard', $transient_transaction_id  );
					$ite_transaction_id = it_exchange_add_transaction( 'paypal-standard', $transaction_id, $transaction_status, $it_exchange_customer->id, $transaction_object );
					return $ite_transaction_id;
				}

			}
			catch ( Exception $e ) {

				it_exchange_add_message( 'error', $e->getMessage() );
				return false;

			}

			return it_exchange_paypal_standard_addon_get_ite_transaction_id( $transaction_id );

		}

		it_exchange_add_message( 'error', __( 'Unknown error while processing with PayPal. Please try again later.', 'it-l10n-ithemes-exchange' ) );

	}
	return false;

}
add_action( 'it_exchange_do_transaction_paypal-standard', 'it_exchange_process_paypal_standard_addon_transaction', 10, 2 );

/**
 * Grab the paypal customer ID for a WP user
 *
 * @since 0.4.0
 *
 * @param integer $customer_id the WP customer ID
 * @return string
*/
function it_exchange_get_paypal_standard_addon_customer_id( $customer_id ) {
	return get_user_meta( $customer_id, '_it_exchange_paypal_standard_id', true );
}

/**
 * Add the paypal customer email as user meta on a WP user
 *
 * @since 0.4.0
 *
 * @param integer $customer_id the WP user ID
 * @param integer $paypal_standard_id the paypal customer ID
 * @return boolean
*/
function it_exchange_set_paypal_standard_addon_customer_id( $customer_id, $paypal_standard_id ) {
	return update_user_meta( $customer_id, '_it_exchange_paypal_standard_id', $paypal_standard_id );
}

/**
 * Grab the paypal customer email for a WP user
 *
 * @since 0.4.0
 *
 * @param integer $customer_id the WP customer ID
 * @return string
*/
function it_exchange_get_paypal_standard_addon_customer_email( $customer_id ) {
	return get_user_meta( $customer_id, '_it_exchange_paypal_standard_email', true );
}

/**
 * Add the paypal customer email as user meta on a WP user
 *
 * @since 0.4.0
 *
 * @param integer $customer_id the WP user ID
 * @param string $paypal_standard_email the paypal customer email
 * @return boolean
*/
function it_exchange_set_paypal_standard_addon_customer_email( $customer_id, $paypal_standard_email ) {
	return update_user_meta( $customer_id, '_it_exchange_paypal_standard_email', $paypal_standard_email );
}

/**
 * This is the function registered in the options array when it_exchange_register_addon was called for paypal
 *
 * It tells Exchange where to find the settings page
 *
 * @return void
*/
function it_exchange_paypal_standard_settings_callback() {
	$IT_Exchange_PayPal_Standard_Add_On = new IT_Exchange_PayPal_Standard_Add_On();
	$IT_Exchange_PayPal_Standard_Add_On->print_settings_page();
}

/**
 * This is the function prints the payment form on the Wizard Settings screen
 *
 * @return void
*/
function paypal_standard_print_wizard_settings( $form ) {
	$IT_Exchange_PayPal_Standard_Add_On = new IT_Exchange_PayPal_Standard_Add_On();
	$settings = it_exchange_get_option( 'addon_paypal_standard', true );
	?>
	<div class="field paypal_standard-wizard hide-if-js">
	<?php $IT_Exchange_PayPal_Standard_Add_On->get_paypal_standard_payment_form_table( $form, $settings ); ?>
	</div>
	<?php
}

/**
 * Saves paypal settings when the Wizard is saved
 *
 * @since 0.4.0
 *
 * @return void
*/
function it_exchange_save_paypal_standard_wizard_settings( $errors ) {
	if ( ! empty( $errors ) )
		return $errors;
	
	$IT_Exchange_PayPal_Standard_Add_On = new IT_Exchange_PayPal_Standard_Add_On();
	return $IT_Exchange_PayPal_Standard_Add_On->paypal_standard_save_wizard_settings();
}
add_action( 'it_exchange_save_paypal-standard_wizard_settings', 'it_exchange_save_paypal_standard_wizard_settings' );

/**
 * Default settings for paypal_standard
 *
 * @since 0.4.0
 *
 * @param array $values
 * @return array
*/
function it_exchange_paypal_standard_addon_default_settings( $values ) {
	$defaults = array(
		'paypal-standard-live-email-address' => '',
		'paypal-standard-purchase-button-label' => __( 'Pay with PayPal', 'it-l10n-ithemes-exchange' ),
	);
	$values = ITUtility::merge_defaults( $values, $defaults );
	return $values;
}
add_filter( 'it_storage_get_defaults_exchange_addon_paypal_standard', 'it_exchange_paypal_standard_addon_default_settings' );

/**
 * Returns the button for making the PayPal faux payment button
 *
 * @since 0.4.19
 *
 * @param array $options
 * @return string HTML button
*/
function it_exchange_paypal_standard_addon_make_payment_button( $options ) {

	if ( 0 >= it_exchange_get_cart_total( false ) )
		return;
		
	$general_settings = it_exchange_get_option( 'settings_general' );
	$paypal_settings  = it_exchange_get_option( 'addon_paypal_standard' );

	$payment_form = '';

	if ( $paypal_email = $paypal_settings['paypal-standard-live-email-address'] ) {
		
		$it_exchange_customer = it_exchange_get_current_customer();

		$payment_form .= '<form action="' . get_site_url() . '/?paypal-standard-form=1" method="post">';
		$payment_form .= '<input type="submit" class="it-exchange-paypal-standard-button" name="paypal_standard_purchase" value="' . $paypal_settings['paypal-standard-purchase-button-label'] .'" />';
		$payment_form .= '</form>';
	
	}
	
	return $payment_form;
	
}
add_filter( 'it_exchange_get_paypal-standard_make_payment_button', 'it_exchange_paypal_standard_addon_make_payment_button', 10, 2 );

/**
 * Process the faux PayPal Standard form
 *
 * @since 0.4.19
 *
 * @param array $options
 * @return string HTML button
*/
function it_exchange_process_paypal_standard_form() {
	
	$paypal_settings  = it_exchange_get_option( 'addon_paypal_standard' );
	
	if ( ! empty( $_REQUEST['paypal_standard_purchase'] ) ) {
		
		if ( $paypal_email = $paypal_settings['paypal-standard-live-email-address']  ) {
			
			$it_exchange_customer = it_exchange_get_current_customer();
			$temp_id = it_exchange_create_unique_hash();
			
			$transaction_object = it_exchange_generate_transaction_object();
			
			it_exchange_add_transient_transaction( 'paypal-standard', $temp_id, $it_exchange_customer->id, $transaction_object );
			
			wp_redirect( it_exchange_paypal_standard_addon_get_payment_url( $temp_id ) );
			
		} else {
		
			it_exchange_add_message( 'error', __( 'Error processing PayPal form. Missing valid PayPal account.', 'it-l10n-ithemes-exchange' ) );
			wp_redirect( it_exchange_get_page_url( 'checkout' ) );
			
		}
	
	}
	
}
add_action( 'wp', 'it_exchange_process_paypal_standard_form' );

/**
 * Returns the button for making the PayPal real payment button
 *
 * @since 0.4.19
 *
 * @param string $temp_id Temporary ID we reference late with IPN
 * @return string HTML button
*/
function it_exchange_paypal_standard_addon_get_payment_url( $temp_id ) {

	if ( 0 >= it_exchange_get_cart_total( false ) )
		return;
		
	$general_settings = it_exchange_get_option( 'settings_general' );
	$paypal_settings  = it_exchange_get_option( 'addon_paypal_standard' );

	$paypal_payment_url = '';

	if ( $paypal_email = $paypal_settings['paypal-standard-live-email-address'] ) {
		
		$it_exchange_customer = it_exchange_get_current_customer();
		
		remove_filter( 'the_title', 'wptexturize' ); // remove this because it screws up the product titles in PayPal
		
		$query = array(
			'cmd'           => '_xclick',
			'business'      => $paypal_email,
			'item_name'     => it_exchange_get_cart_description(),
			'amount'        => number_format( it_exchange_get_cart_total( false ), 2, '.', '' ),
			'return'        => it_exchange_get_page_url( 'transaction' ) . '?it-exchange-transaction-method=paypal-standard',
			'currency_code' => $general_settings['default-currency'],
			'notify_url'    => get_site_url() . '/?' . it_exchange_get_webhook( 'paypal-standard' ) . '=1',
			'quantity'      => '1',
			'no_note'       => '1',
			'no_shipping'   => '1',
			'shipping'      => '0',
			'email'         => $it_exchange_customer->data->user_email,
			'rm'            => '2',
			'cancel_return' => it_exchange_get_page_url( 'cart' ),
			'custom'        => $temp_id,
		);
				
		$paypal_payment_url = PAYPAL_PAYMENT_URL . '?' .  http_build_query( $query ); 
			
	} else {
	
		it_exchange_add_message( 'error', __( 'ERROR: Invalid PayPal Setup' ) );
		$paypal_payment_url = it_exchange_get_page_url( 'cart' );
		
	}
	
	return $paypal_payment_url;
	
}

/**
 * Adds the paypal webhook to the global array of keys to listen for
 *
 * @since 0.4.0
 *
 * @param array $webhooks existing
 * @return array
*/
function it_exchange_paypal_standard_addon_register_webhook() {
	$key   = 'paypal-standard';
	$param = apply_filters( 'it_exchange_paypal-standard_webhook', 'it_exchange_paypal-standard' );
	it_exchange_register_webhook( $key, $param );
}
add_filter( 'init', 'it_exchange_paypal_standard_addon_register_webhook' );

/**
 * Processes webhooks for PayPal Web Standard
 *
 * @since 0.4.0
 * @todo actually handle the exceptions
 *
 * @param array $request really just passing  $_REQUEST
 */
function it_exchange_paypal_standard_addon_process_webhook( $request ) {

	$general_settings = it_exchange_get_option( 'settings_general' );
	$settings = it_exchange_get_option( 'addon_paypal_standard' );
	
	// for extra security, retrieve from the Stripe API
	if ( ! empty( $request['txn_id'] ) ) {
		
		if ( !empty( $request['transaction_subject'] ) && $transient_data = it_exchange_get_transient_transaction( 'paypal-standard', $request['transaction_subject'] ) ) {
			it_exchange_delete_transient_transaction( 'paypal-standard', $request['transaction_subject']  );
			$ite_transaction_id = it_exchange_add_transaction( 'paypal-standard', $request['txn_id'], $request['payment_status'], $transient_data['customer_id'], $transient_data['transaction_object'] );
			return $ite_transaction_id;
		}

		try {

			switch( $request['payment_status'] ) :

				case 'Completed' :
					it_exchange_paypal_standard_addon_update_transaction_status( $request['txn_id'], $request['payment_status'] );
					break;
				case 'Refunded' :
					it_exchange_paypal_standard_addon_update_transaction_status( $request['parent_txn_id'], $request['payment_status'] );
					it_exchange_paypal_standard_addon_add_refund_to_transaction( $request['parent_txn_id'], $request['mc_gross'] );
				case 'Reversed' :
					it_exchange_paypal_standard_addon_update_transaction_status( $request['parent_txn_id'], $request['reason_code'] );
					break;

			endswitch;

		} catch ( Exception $e ) {

			// What are we going to do here?

		}
	}

}
add_action( 'it_exchange_webhook_it_exchange_paypal-standard', 'it_exchange_paypal_standard_addon_process_webhook' );

/**
 * Gets iThemes Exchange's Transaction ID from PayPal Standard's Transaction ID
 *
 * @since 0.4.19
 *
 * @param integer $paypal_standard_id id of paypal transaction
 * @return integer iTheme Exchange's Transaction ID
*/
function it_exchange_paypal_standard_addon_get_ite_transaction_id( $paypal_standard_id ) {
	$transactions = it_exchange_paypal_standard_addon_get_transaction_id( $paypal_standard_id );
	foreach( $transactions as $transaction ) { //really only one
		return $transaction->ID;
	}
}

/**
 * Grab a transaction from the paypal transaction ID
 *
 * @since 0.4.0
 *
 * @param integer $paypal_standard_id id of paypal transaction
 * @return transaction object
*/
function it_exchange_paypal_standard_addon_get_transaction_id( $paypal_standard_id ) {
	$args = array(
		'meta_key'    => '_it_exchange_transaction_method_id',
		'meta_value'  => $paypal_standard_id,
		'numberposts' => 1, //we should only have one, so limit to 1
	);
	return it_exchange_get_transactions( $args );
}

/**
 * Updates a paypals transaction status based on paypal ID
 *
 * @since 0.4.0
 *
 * @param integer $paypal_standard_id id of paypal transaction
 * @param string $new_status new status
 * @return void
*/
function it_exchange_paypal_standard_addon_update_transaction_status( $paypal_standard_id, $new_status ) {
	$transactions = it_exchange_paypal_standard_addon_get_transaction_id( $paypal_standard_id );
	foreach( $transactions as $transaction ) { //really only one
		$current_status = it_exchange_get_transaction_status( $transaction );
		if ( $new_status !== $current_status )
			it_exchange_update_transaction_status( $transaction, $new_status );
	}
}

/**
 * Adds a refund to post_meta for a stripe transaction
 *
 * @since 0.4.0
*/
function it_exchange_paypal_standard_addon_add_refund_to_transaction( $paypal_standard_id, $refund ) {
	$transactions = it_exchange_paypal_standard_addon_get_transaction_id( $paypal_standard_id );
	foreach( $transactions as $transaction ) { //really only one
		it_exchange_add_refund_to_transaction( $transaction, number_format( abs( $refund ), '2', '.', '' ) );
	}

}

/**
 * Gets the interpretted transaction status from valid paypal transaction statuses
 *
 * @since 0.4.0
 *
 * @param string $status the string of the paypal transaction
 * @return string translaction transaction status
*/
function it_exchange_paypal_standard_addon_transaction_status_label( $status ) {

	switch ( strtolower( $status ) ) {

		case 'completed':
		case 'success':
		case 'canceled_reversal':
		case 'processed' :
			return __( 'Paid', 'it-l10n-ithemes-exchange' );
			break;
		case 'refunded':
		case 'refund':
			return __( 'Refund', 'it-l10n-ithemes-exchange' );
			break;
		case 'reversed':
			return __( 'Reversed', 'it-l10n-ithemes-exchange' );
			break;
		case 'buyer_complaint':
			return __( 'Buyer Complaint', 'it-l10n-ithemes-exchange' );
			break;
		case 'denied' :
			return __( 'Denied', 'it-l10n-ithemes-exchange' );
			break;
		case 'expired' :
			return __( 'Expired', 'it-l10n-ithemes-exchange' );
			break;
		case 'failed' :
			return __( 'Failed', 'it-l10n-ithemes-exchange' );
			break;
		case 'pending' :
			return __( 'Pending', 'it-l10n-ithemes-exchange' );
			break;
		case 'voided' :
			return __( 'Voided', 'it-l10n-ithemes-exchange' );
			break;
		default:
			return __( 'Unknown', 'it-l10n-ithemes-exchange' );
	}

}
add_filter( 'it_exchange_transaction_status_label_paypal-standard', 'it_exchange_paypal_standard_addon_transaction_status_label' );

/**
 * Returns a boolean. Is this transaction a status that warrants delivery of any products attached to it?
 *
 * @since 0.4.2
 *
 * @param boolean $cleared passed in through WP filter. Ignored here.
 * @param object $transaction
 * @return boolean
*/
function it_exchange_paypal_standard_transaction_is_cleared_for_delivery( $cleared, $transaction ) { 
    $valid_stati = array( 
		'completed',
		'success',
		'canceled_reversal',
		'processed',
	);
    return in_array( strtolower( it_exchange_get_transaction_status( $transaction ) ), $valid_stati );
}
add_filter( 'it_exchange_paypal-standard_transaction_is_cleared_for_delivery', 'it_exchange_paypal_standard_transaction_is_cleared_for_delivery', 10, 2 );

/**
 * Class for Stripe
 * @since 0.4.0
*/
class IT_Exchange_PayPal_Standard_Add_On {

	/**
	 * @var boolean $_is_admin true or false
	 * @since 0.4.0
	*/
	var $_is_admin;

	/**
	 * @var string $_current_page Current $_GET['page'] value
	 * @since 0.4.0
	*/
	var $_current_page;

	/**
	 * @var string $_current_add_on Current $_GET['add-on-settings'] value
	 * @since 0.4.0
	*/
	var $_current_add_on;

	/**
	 * @var string $status_message will be displayed if not empty
	 * @since 0.4.0
	*/
	var $status_message;

	/**
	 * @var string $error_message will be displayed if not empty
	 * @since 0.4.0
	*/
	var $error_message;

	/**
	 * Class constructor
	 *
	 * Sets up the class.
	 * @since 0.4.0
	 * @return void
	*/
	function IT_Exchange_PayPal_Standard_Add_On() {
		$this->_is_admin       = is_admin();
		$this->_current_page   = empty( $_GET['page'] ) ? false : $_GET['page'];
		$this->_current_add_on = empty( $_GET['add-on-settings'] ) ? false : $_GET['add-on-settings'];

		if ( ! empty( $_POST ) && $this->_is_admin && 'it-exchange-addons' == $this->_current_page && 'paypal-standard' == $this->_current_add_on ) {
			$this->save_settings();
		}

	}

	function print_settings_page() {
		$settings = it_exchange_get_option( 'addon_paypal_standard', true );
		$form_values  = empty( $this->error_message ) ? $settings : ITForm::get_post_data();
		$form_options = array(
			'id'      => apply_filters( 'it_exchange_add_on_paypal-standard', 'it-exchange-add-on-paypal-standard-settings' ),
			'enctype' => apply_filters( 'it_exchange_add_on_paypal-standard_settings_form_enctype', false ),
			'action'  => 'admin.php?page=it-exchange-addons&add-on-settings=paypal-standard',
		);
		$form         = new ITForm( $form_values, array( 'prefix' => 'it-exchange-add-on-paypal_standard' ) );

		if ( ! empty ( $this->status_message ) )
			ITUtility::show_status_message( $this->status_message );
		if ( ! empty( $this->error_message ) )
			ITUtility::show_error_message( $this->error_message );

		?>
		<div class="wrap">
			<?php screen_icon( 'it-exchange' ); ?>
			<h2><?php _e( 'PayPal Standard Settings - Basic', 'it-l10n-ithemes-exchange' ); ?></h2>

			<?php do_action( 'it_exchange_paypal-standard_settings_page_top' ); ?>
			<?php do_action( 'it_exchange_addon_settings_page_top' ); ?>

			<?php $form->start_form( $form_options, 'it-exchange-paypal-standard-settings' ); ?>
				<?php do_action( 'it_exchange_paypal-standard_settings_form_top' ); ?>
				<?php $this->get_paypal_standard_payment_form_table( $form, $form_values ); ?>
				<?php do_action( 'it_exchange_paypal-standard_settings_form_bottom' ); ?>
				<p class="submit">
					<?php $form->add_submit( 'submit', array( 'value' => __( 'Save Changes', 'it-l10n-ithemes-exchange' ), 'class' => 'button button-primary button-large' ) ); ?>
				</p>
			<?php $form->end_form(); ?>
			<?php do_action( 'it_exchange_paypal-standard_settings_page_bottom' ); ?>
			<?php do_action( 'it_exchange_addon_settings_page_bottom' ); ?>
		</div>
		<?php
	}
	
	/**
	 *
	 * @todo verify video link
	 *
	 */
	function get_paypal_standard_payment_form_table( $form, $settings = array() ) {

		$general_settings = it_exchange_get_option( 'settings_general' );

		if ( ! empty( $_GET['page'] ) && 'it-exchange-setup' == $_GET['page'] ) : ?>
			<h3><?php _e( 'PayPal Standard - Basic (Fastest Setup)', 'it-l10n-ithemes-exchange' ); ?></h3>
		<?php endif;

		if ( !empty( $settings ) )
			foreach ( $settings as $key => $var )
				$form->set_option( $key, $var );

		?>
		<div class="it-exchange-addon-settings it-exchange-paypal-addon-settings">
            <p>
				<?php _e( 'This is the simple and fast version to get PayPal setup for your store. You might use this version just to get your store going, but we highly suggest you switch to the PayPal Standard Secure option. To get PayPal set up for use with Exchange, you\'ll need to add the following information from your PayPal account.', 'it-l10n-ithemes-exchange' ); ?><br /><br />
				<?php _e( 'Video:', 'it-l10n-ithemes-exchange' ); ?>&nsbp;<a href="http://ithemes.com/tutorials/setting-up-paypal-standard-basic/" target="_blank"><?php _e( 'Setting Up PayPal Standard Basic', 'it-l10n-ithemes-exchange' ); ?></a>
			</p>
			<p><?php _e( 'Don\'t have a PayPal account yet?', 'it-l10n-ithemes-exchange' ); ?> <a href="http://paypal.com" target="_blank"><?php _e( 'Go set one up here', 'it-l10n-ithemes-exchange' ); ?></a>.</p>
            <h4><?php _e( 'What is your PayPal email address?', 'it-l10n-ithemes-exchange' ); ?></h4>
			<p>
				<label for="paypal-standard-live-email-address"><?php _e( 'PayPal Email Address', 'it-l10n-ithemes-exchange' ); ?> <span class="tip" title="<?php _e( 'We need this to tie payments to your account.', 'it-l10n-ithemes-exchange' ); ?>">i</span></label>
				<?php $form->add_text_box( 'paypal-standard-live-email-address' ); ?>
			</p>
			<p>
				<label for="paypal-standard-purchase-button-label"><?php _e( 'Purchase Button Label', 'it-l10n-ithemes-exchange' ); ?> <span class="tip" title="<?php _e( 'This is the text inside the button your customers will press to purchase with PayPal Standard', 'it-l10n-ithemes-exchange' ); ?>">i</span></label>
				<?php $form->add_text_box( 'paypal-standard-purchase-button-label' ); ?>
			</p>
		</div>
		<?php
	}

	/**
	 * Save settings
	 *
	 * @since 0.4.0
	 * @return void
	*/
	function save_settings() {
		$defaults = it_exchange_get_option( 'addon_paypal_standard' );
		$new_values = wp_parse_args( ITForm::get_post_data(), $defaults );

		// Check nonce
		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'it-exchange-paypal-standard-settings' ) ) {
			$this->error_message = __( 'Error. Please try again', 'it-l10n-ithemes-exchange' );
			return;
		}

		$errors = apply_filters( 'it_exchange_add_on_paypal_standard_validate_settings', $this->get_form_errors( $new_values ), $new_values );
		if ( ! $errors && it_exchange_save_option( 'addon_paypal_standard', $new_values ) ) {
			ITUtility::show_status_message( __( 'Settings saved.', 'it-l10n-ithemes-exchange' ) );
		} else if ( $errors ) {
			$errors = implode( '<br />', $errors );
			$this->error_message = $errors;
		} else {
			$this->status_message = __( 'Settings not saved.', 'it-l10n-ithemes-exchange' );
		}
		
		do_action( 'it_exchange_save_add_on_settings_paypal-standard' );

	}

	function paypal_standard_save_wizard_settings() {
		if ( empty( $_REQUEST['it_exchange_settings-wizard-submitted'] ) )
			return;

		$paypal_standard_settings = array();

		$fields = array(
			'paypal-standard-live-email-address',
			'paypal-standard-purchase-button-label',
		);
		$default_wizard_paypal_standard_settings = apply_filters( 'default_wizard_paypal-standard_settings', $fields );
		
		foreach( $default_wizard_paypal_standard_settings as $var ) {

			if ( isset( $_REQUEST['it_exchange_settings-' . $var] ) ) {
				$paypal_standard_settings[$var] = $_REQUEST['it_exchange_settings-' . $var];
			}

		}

		$settings = wp_parse_args( $paypal_standard_settings, it_exchange_get_option( 'addon_paypal_standard' ) );
		
		if ( $error_msg = $this->get_form_errors( $settings ) ) {

			return $error_msg;

		} else {
			it_exchange_save_option( 'addon_paypal_standard', $settings );
			$this->status_message = __( 'Settings Saved.', 'it-l10n-ithemes-exchange' );
		}
		
		return;

	}

	/**
	 * Validates for values
	 *
	 * Returns string of errors if anything is invalid
	 *
	 * @since 0.4.0
	 * @return void
	*/
	function get_form_errors( $values ) {

		$errors = array();
		if ( empty( $values['paypal-standard-live-email-address'] ) )
			$errors[] = __( 'Please include your PayPal Email Address', 'it-l10n-ithemes-exchange' );

		return $errors;
	}
}