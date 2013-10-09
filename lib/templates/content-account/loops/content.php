<?php
/**
 * This is the default template part for the
 * content loop in the content-account
 * template part.
 *
 * @since 1.4.0
 * @version 1.4.0
 * @package IT_Exchange
 * 
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file
 * to the exchange/content-account/loops/ directory
 * located in your theme.
*/
?>

<?php do_action( 'it_exchange_content_account_before_content_loop' ); ?>
	<div class="it-exchange-customer-info">
	<?php do_action( 'it_exchange_content_account_begin_content_loop' ); ?>
		<?php foreach ( it_exchange_get_template_part_elements( 'content_account', 'content', array( 'welcome', ) ) as $element ) : ?>
			<?php
			/** 
			 * Theme and add-on devs should add code to this loop by 
			 * hooking into it_exchange_get_template_part_elements filter
			 * and adding the appropriate template file to their theme or add-on
			*/
			it_exchange_get_template_part( 'content-account/elements/' . $element );
			?>
		<?php endforeach; ?>
	<?php do_action( 'it_exchange_content_account_end_content_loop' ); ?>
	</div>
<?php do_action( 'it_exchange_content_account_after_content_loop' ); ?>
