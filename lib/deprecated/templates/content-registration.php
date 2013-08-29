<?php
/**
 * Default template for displaying the user
 * registration page.
 * 
 * @since 0.4.0
 * @version 1.0.2
 * @link http://ithemes.com/codex/page/Exchange_Template_Updates
 * @package IT_Exchange
 * 
 * WARNING: Do not edit this file directly. To use
 * this template in a theme, simply copy over this
 * file's content to the exchange directory located
 * at your templates root.
 * 
 * Example: theme/exchange/content-registration.php
*/
?>

<div class="registration-info">
	<?php if ( is_user_logged_in() ) : ?>
		<p><?php printf( __( 'You already have an active account and are logged in. Visit your %sProfile%s', 'it-l10n-ithemes-exchange' ), '<a href="' . it_exchange_get_page_url( 'profile' ) . '">', '</a>' ); ?></p>
	<?php else : ?>
		<?php if ( it_exchange( 'registration', 'is-enabled' ) ) : ?>
			
			<?php it_exchange( 'registration', 'formopen' ); ?>
			<?php it_exchange_get_template_part( 'messages' ); ?>
			
			<div class="user-name">
				<?php it_exchange( 'registration', 'username' ); ?>
			</div>
			<div class="first-name">
				<?php it_exchange( 'registration', 'firstname' ); ?>
			</div>
			<div class="last-name">
				<?php it_exchange( 'registration', 'lastname' ); ?>
			</div>
			<div class="email-name">
				<?php it_exchange( 'registration', 'email' ); ?>
			</div>
			<div class="password1">
				<?php it_exchange( 'registration', 'password1' ); ?>
			</div>
			<div class="password2">
				<?php it_exchange( 'registration', 'password2' ); ?>
			</div>
			
			<?php it_exchange( 'registration', 'save' ); ?>
			&nbsp;<a href="<?php esc_attr_e( it_exchange_get_page_url( 'login' ) ); ?>"><?php _e( 'Log in', 'it-l10n-ithemes-exchange' ); ?></a>
			<?php it_exchange( 'registration', 'formclose' ); ?>
			
		<?php else : ?>
			<?php it_exchange( 'registration', 'disabled-message' ); ?>
		<?php endif; ?>
	<?php endif; ?>
</div>