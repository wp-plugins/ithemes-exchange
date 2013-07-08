<?php
/**
 * Customer class for THEME API
 *
 * @since 0.4.0
*/

class IT_Theme_API_Customer implements IT_Theme_API {

	/**
	 * API context
	 * @var string $_context
	 * @since 0.4.0
	*/
	private $_context = 'customer';

	/**
	 * Current customer being viewed
	 * @var string $_customer
	 * @since 0.4.0
	*/
	private $_customer = '';

	/**
	 * Maps api tags to methods
	 * @var array $_tag_map
	 * @since 0.4.0
	*/
	public $_tag_map = array(
		'formopen'    => 'form_open',
		'username'    => 'username',
		'avatar'      => 'avatar',
		'firstname'   => 'first_name',
		'lastname'    => 'last_name',
		'email'       => 'email',
		'website'     => 'website',
		'password1'   => 'password1',
		'password2'   => 'password2',
		'save'        => 'save',
		'formclose'   => 'form_close',
		'menu'        => 'menu',
	);

	/**
	 * Constructor
	 *
	 * @since 0.4.0
	 * @todo get working for admins looking at other users profiles
	 * @return void
	*/
	function IT_Theme_API_Customer() {
		if ( is_user_logged_in() )
			$this->_customer = it_exchange_get_current_customer();
	}

	/**
	 * Returns the context. Also helps to confirm we are an iThemes Exchange theme API class
	 *
	 * @since 0.4.0
	 *
	 * @return string
	*/
	function get_api_context() {
		return $this->_context;
	}

	/**
	 * Outputs the profile page start of form
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function form_open( $options=array() ) {
		$output = '<form action="" method="post" >';
		$output .= '<input type="hidden" name="user_id" value="' . $this->_customer->data->ID . '" >';
		return $output;
	}

	/**
	 * Outputs the customer's username data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function username( $options=array() ) {
		$defaults = array(
			'format' => 'html',
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_value = $this->_customer->data->user_login;
		$label = '<label>' . $field_value . '</label>';

		switch( $options['format'] ) {

			case 'label':
				$output = $label;

			case 'html':
			default:
				$output = $label;

		}

		return $output;
	}

	/**
	 * Outputs the customer's avatar data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function avatar( $options=array() ) {
		return get_avatar( $this->_customer->data->ID, apply_filters( 'it_exchange_avatar_size', '128' ), apply_filters( 'it_exchange_default_avatar', 'blank' ) );
	}

	/**
	 * Outputs the customer's first name data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function first_name( $options=array() ) {
		$defaults = array(
			'format' => 'html',
			'label'  => __( 'First Name', 'it-l10n-ithemes-exchange' ),
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_id = 'first_name';
		$field_name = $field_id;
		$field_value = $this->_customer->data->first_name;

		switch( $options['format'] ) {

			case 'field-id':
				$output = $field_id;

			case 'field-name':
				$output = $field_name;

			case 'field-value':
				$output = $field_value;

			case 'label':
				$output = $options['label'];

			case 'html':
			default:
				$output = '<label for="' . $field_id. '">' . $options['label'] . '</label>';
				$output .= '<input type="text" id="' . $field_id. '" name="' . $field_name. '" value="' . $field_value . '" />';

		}

		return $output;
	}

	/**
	 * Outputs the customer's last name data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function last_name( $options=array() ) {
		$defaults = array(
			'format' => 'html',
			'label'  => __( 'Last Name', 'it-l10n-ithemes-exchange' ),
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_id = 'last_name';
		$field_name = $field_id;
		$field_value = $this->_customer->data->last_name;

		switch( $options['format'] ) {

			case 'field-id':
				$output = $field_id;

			case 'field-name':
				$output = $field_name;

			case 'field-value':
				$output = $field_value;

			case 'label':
				$output = $options['label'];

			case 'html':
			default:
				$output = '<label for="' . $field_id. '">' . $options['label'] . '</label>';
				$output .= '<input type="text" id="' . $field_id. '" name="' . $field_name. '" value="' . $field_value . '" />';

		}

		return $output;
	}

	/**
	 * Outputs the customer's email data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function email( $options=array() ) {
		$defaults = array(
			'format' => 'html',
			'label'  => __( 'Email', 'it-l10n-ithemes-exchange' ),
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_id = 'email';
		$field_name = $field_id;
		$field_value = $this->_customer->data->user_email;

		switch( $options['format'] ) {

			case 'field-id':
				$output = $field_id;

			case 'field-name':
				$output = $field_name;

			case 'field-value':
				$output = $field_value;

			case 'label':
				$output = $options['label'];

			case 'html':
			default:
				$output = '<label for="' . $field_id. '">' . $options['label'] . '</label>';
				$output .= '<input type="text" id="' . $field_id. '" name="' . $field_name. '" value="' . $field_value . '" />';

		}

		return $output;
	}

	/**
	 * Outputs the customer's website data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function website( $options=array() ) {
		$defaults = array(
			'format' => 'html',
			'label'  => __( 'Website', 'it-l10n-ithemes-exchange' ),
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_id = 'url';
		$field_name = $field_id;
		$field_value = $this->_customer->data->user_url;

		switch( $options['format'] ) {

			case 'field-id':
				$output = $field_id;

			case 'field-name':
				$output = $field_name;

			case 'field-value':
				$output = $field_value;

			case 'label':
				$output = $options['label'];

			case 'html':
			default:
				$output = '<label for="' . $field_id. '">' . $options['label'] . '</label>';
				$output .= '<input type="text" id="' . $field_id. '" name="' . $field_name. '" value="' . $field_value . '" />';

		}

		return $output;
	}

	/**
	 * Outputs the customer's password(1) input data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function password1( $options=array() ) {
		$defaults = array(
			'format' => 'html',
			'label'  => __( 'Password', 'it-l10n-ithemes-exchange' ),
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_id = 'pass1';
		$field_name = $field_id;

		switch( $options['format'] ) {

			case 'field-id':
				$output = $field_id;

			case 'field-name':
				$output = $field_name;

			case 'label':
				$output = $options['label'];

			case 'html':
			default:
				$output = '<label for="' . $field_id. '">' . $options['label'] . '</label>';
				$output .= '<input type="password" id="' . $field_id. '" name="' . $field_name. '" value="" />';

		}

		return $output;
	}

	/**
	 * Outputs the customer's password(2) input data
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function password2( $options=array() ) {
		$defaults = array(
			'format' => 'html',
			'label'  => __( 'Confirm Password', 'it-l10n-ithemes-exchange' ),
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_id = 'pass2';
		$field_name = $field_id;

		switch( $options['format'] ) {

			case 'field-id':
				$output = $field_id;

			case 'field-name':
				$output = $field_name;

			case 'label':
				$output = $options['label'];

			case 'html':
			default:
				$output = '<label for="' . $field_id. '">' . $options['label'] . '</label>';
				$output .= '<input type="password" id="' . $field_id. '" name="' . $field_name. '" value="" />';

		}

		return $output;
	}

	/**
	 * Outputs the profile page save button
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function save( $options=array() ) {
		$defaults = array(
			'format' => 'html',
			'label'  =>  __( 'Save Profile', 'it-l10n-ithemes-exchange' ),
		);
		$options = ITUtility::merge_defaults( $options, $defaults );

		$field_id = 'it-exchange-save-profile';
		$field_name = $field_id;

		switch( $options['format'] ) {

			case 'field-id':
				$output = $field_id;

			case 'field-name':
				$output = $field_name;

			case 'label':
				$output = $options['label'];

			case 'html':
			default:
				$output = '<input type="submit" id="' . $field_id. '" name="' . $field_name. '" value="' . $options['label'] . '" />';

		}

		return $output;
	}

	/**
	 * Outputs the profile page end of form
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function form_close( $options=array() ) {
		return '</form>';
	}

	/**
	 * Outputs the customer menu
	 * Default: profile / purchases / downloads
	 *
	 * @since 0.4.0
	 * @return string
	*/
	function menu( $options=array() ) {
		
		$defaults = array(
			'format' => 'html',
			'pages'  => 'profile,purchases,downloads',
		);
		$options = ITUtility::merge_defaults( $options, $defaults );
		
		$nav  = '<ul id="it-exchange-customer-menu">';
		
		foreach( explode( ',', $options['pages'] ) as $page_slug ) {
			
			$page_slug = trim( $page_slug );
			$class = it_exchange_is_page( $page_slug ) ? ' class="current"' : '';
		
			$nav .= '<li' . $class . '><a href="' . it_exchange_get_page_url( $page_slug ) . '">' . it_exchange_get_page_name( $page_slug ) . '</a>';
		
		}
		
		$nav .= '</ul>';
		
		return $nav;
		
	}
}