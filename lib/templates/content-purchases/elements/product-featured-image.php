<?php
/**
 * The default template part for the product featured image in
 * the content-purchases template part's product-info loop
 *
 * @since 1.1.0
 * @version 1.1.0
 * @package IT_Exchange
 * 
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, copy over this file
 * to the exchange/content-purchases/elements/ directory
 * located in your theme.
*/
?>

<?php do_action( 'it_exchange_content_purchases_before_product_featured_image_element' ); ?>
<?php it_exchange( 'transaction', 'product-featured-image' ); ?>
<?php do_action( 'it_exchange_content_purchases_after_product_featured_image_element' ); ?>