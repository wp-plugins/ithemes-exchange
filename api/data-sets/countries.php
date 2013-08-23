<?php
/**
 * Country data sets
 * @package IT_Exchange
 * @since 1.2.0
*/

/**
 * Returns an array of countries
 *
 * @since 1.2.0
 *
 * @return array
*/
function it_exchange_get_countries( $options=array() ) {

	// Defaults
	$defaults = array(
		'sort-by-values' => true,
	); 

	$options = ITUtility::merge_defaults( $options, $defaults );

	$countries = array(
		'AD' => __( 'Andorra', 'it-l10n-ithemes-exchange' ),
		'AE' => __( 'United Arab Emirates', 'it-l10n-ithemes-exchange' ),
		'AF' => __( 'Afghanistan', 'it-l10n-ithemes-exchange' ),
		'AG' => __( 'Antigua and Barbuda', 'it-l10n-ithemes-exchange' ),
		'AI' => __( 'Anguilla', 'it-l10n-ithemes-exchange' ),
		'AL' => __( 'Albania', 'it-l10n-ithemes-exchange' ),
		'AM' => __( 'Armenia', 'it-l10n-ithemes-exchange' ),
		'AN' => __( 'Netherlands Antilles', 'it-l10n-ithemes-exchange' ),
		'AO' => __( 'Angola', 'it-l10n-ithemes-exchange' ),
		'AP' => __( 'Asia/Pacific Region', 'it-l10n-ithemes-exchange' ),
		'AQ' => __( 'Antarctica', 'it-l10n-ithemes-exchange' ),
		'AR' => __( 'Argentina', 'it-l10n-ithemes-exchange' ),
		'AS' => __( 'American Samoa', 'it-l10n-ithemes-exchange' ),
		'AT' => __( 'Austria', 'it-l10n-ithemes-exchange' ),
		'AU' => __( 'Australia', 'it-l10n-ithemes-exchange' ),
		'AW' => __( 'Aruba', 'it-l10n-ithemes-exchange' ),
		'AX' => __( 'Aland Islands', 'it-l10n-ithemes-exchange' ),
		'AZ' => __( 'Azerbaijan', 'it-l10n-ithemes-exchange' ),
		'BA' => __( 'Bosnia and Herzegovina', 'it-l10n-ithemes-exchange' ),
		'BB' => __( 'Barbados', 'it-l10n-ithemes-exchange' ),
		'BD' => __( 'Bangladesh', 'it-l10n-ithemes-exchange' ),
		'BE' => __( 'Belgium', 'it-l10n-ithemes-exchange' ),
		'BF' => __( 'Burkina Faso', 'it-l10n-ithemes-exchange' ),
		'BG' => __( 'Bulgaria', 'it-l10n-ithemes-exchange' ),
		'BH' => __( 'Bahrain', 'it-l10n-ithemes-exchange' ),
		'BI' => __( 'Burundi', 'it-l10n-ithemes-exchange' ),
		'BJ' => __( 'Benin', 'it-l10n-ithemes-exchange' ),
		'BM' => __( 'Bermuda', 'it-l10n-ithemes-exchange' ),
		'BN' => __( 'Brunei Darussalam', 'it-l10n-ithemes-exchange' ),
		'BO' => __( 'Bolivia', 'it-l10n-ithemes-exchange' ),
		'BR' => __( 'Brazil', 'it-l10n-ithemes-exchange' ),
		'BS' => __( 'Bahamas', 'it-l10n-ithemes-exchange' ),
		'BT' => __( 'Bhutan', 'it-l10n-ithemes-exchange' ),
		'BV' => __( 'Bouvet Island', 'it-l10n-ithemes-exchange' ),
		'BW' => __( 'Botswana', 'it-l10n-ithemes-exchange' ),
		'BY' => __( 'Belarus', 'it-l10n-ithemes-exchange' ),
		'BZ' => __( 'Belize', 'it-l10n-ithemes-exchange' ),
		'CA' => __( 'Canada', 'it-l10n-ithemes-exchange' ),
		'CD' => __( 'Congo, The Democratic Republic of the', 'it-l10n-ithemes-exchange' ),
		'CF' => __( 'Central African Republic', 'it-l10n-ithemes-exchange' ),
		'CG' => __( 'Congo', 'it-l10n-ithemes-exchange' ),
		'CH' => __( 'Switzerland', 'it-l10n-ithemes-exchange' ),
		'CI' => __( 'Cote D\'Ivoire', 'it-l10n-ithemes-exchange' ),
		'CK' => __( 'Cook Islands', 'it-l10n-ithemes-exchange' ),
		'CL' => __( 'Chile', 'it-l10n-ithemes-exchange' ),
		'CM' => __( 'Cameroon', 'it-l10n-ithemes-exchange' ),
		'CN' => __( 'China', 'it-l10n-ithemes-exchange' ),
		'CO' => __( 'Colombia', 'it-l10n-ithemes-exchange' ),
		'CR' => __( 'Costa Rica', 'it-l10n-ithemes-exchange' ),
		'CU' => __( 'Cuba', 'it-l10n-ithemes-exchange' ),
		'CV' => __( 'Cape Verde', 'it-l10n-ithemes-exchange' ),
		'CY' => __( 'Cyprus', 'it-l10n-ithemes-exchange' ),
		'CZ' => __( 'Czech Republic', 'it-l10n-ithemes-exchange' ),
		'DE' => __( 'Germany', 'it-l10n-ithemes-exchange' ),
		'DJ' => __( 'Djibouti', 'it-l10n-ithemes-exchange' ),
		'DK' => __( 'Denmark', 'it-l10n-ithemes-exchange' ),
		'DM' => __( 'Dominica', 'it-l10n-ithemes-exchange' ),
		'DO' => __( 'Dominican Republic', 'it-l10n-ithemes-exchange' ),
		'DZ' => __( 'Algeria', 'it-l10n-ithemes-exchange' ),
		'EC' => __( 'Ecuador', 'it-l10n-ithemes-exchange' ),
		'EE' => __( 'Estonia', 'it-l10n-ithemes-exchange' ),
		'EG' => __( 'Egypt', 'it-l10n-ithemes-exchange' ),
		'ER' => __( 'Eritrea', 'it-l10n-ithemes-exchange' ),
		'ES' => __( 'Spain', 'it-l10n-ithemes-exchange' ),
		'ET' => __( 'Ethiopia', 'it-l10n-ithemes-exchange' ),
		'EU' => __( 'Europe', 'it-l10n-ithemes-exchange' ),
		'FI' => __( 'Finland', 'it-l10n-ithemes-exchange' ),
		'FJ' => __( 'Fiji', 'it-l10n-ithemes-exchange' ),
		'FK' => __( 'Falkland Islands (Malvinas)', 'it-l10n-ithemes-exchange' ),
		'FM' => __( 'Micronesia, Federated States of', 'it-l10n-ithemes-exchange' ),
		'FO' => __( 'Faroe Islands', 'it-l10n-ithemes-exchange' ),
		'FR' => __( 'France', 'it-l10n-ithemes-exchange' ),
		'GA' => __( 'Gabon', 'it-l10n-ithemes-exchange' ),
		'GB' => __( 'United Kingdom', 'it-l10n-ithemes-exchange' ),
		'GD' => __( 'Grenada', 'it-l10n-ithemes-exchange' ),
		'GE' => __( 'Georgia', 'it-l10n-ithemes-exchange' ),
		'GF' => __( 'French Guiana', 'it-l10n-ithemes-exchange' ),
		'GG' => __( 'Guernsey', 'it-l10n-ithemes-exchange' ),
		'GH' => __( 'Ghana', 'it-l10n-ithemes-exchange' ),
		'GI' => __( 'Gibraltar', 'it-l10n-ithemes-exchange' ),
		'GL' => __( 'Greenland', 'it-l10n-ithemes-exchange' ),
		'GM' => __( 'Gambia', 'it-l10n-ithemes-exchange' ),
		'GN' => __( 'Guinea', 'it-l10n-ithemes-exchange' ),
		'GP' => __( 'Guadeloupe', 'it-l10n-ithemes-exchange' ),
		'GQ' => __( 'Equatorial Guinea', 'it-l10n-ithemes-exchange' ),
		'GR' => __( 'Greece', 'it-l10n-ithemes-exchange' ),
		'GT' => __( 'Guatemala', 'it-l10n-ithemes-exchange' ),
		'GU' => __( 'Guam', 'it-l10n-ithemes-exchange' ),
		'GW' => __( 'Guinea-Bissau', 'it-l10n-ithemes-exchange' ),
		'GY' => __( 'Guyana', 'it-l10n-ithemes-exchange' ),
		'HK' => __( 'Hong Kong', 'it-l10n-ithemes-exchange' ),
		'HN' => __( 'Honduras', 'it-l10n-ithemes-exchange' ),
		'HR' => __( 'Croatia', 'it-l10n-ithemes-exchange' ),
		'HT' => __( 'Haiti', 'it-l10n-ithemes-exchange' ),
		'HU' => __( 'Hungary', 'it-l10n-ithemes-exchange' ),
		'ID' => __( 'Indonesia', 'it-l10n-ithemes-exchange' ),
		'IE' => __( 'Ireland', 'it-l10n-ithemes-exchange' ),
		'IL' => __( 'Israel', 'it-l10n-ithemes-exchange' ),
		'IM' => __( 'Isle of Man', 'it-l10n-ithemes-exchange' ),
		'IN' => __( 'India', 'it-l10n-ithemes-exchange' ),
		'IO' => __( 'British Indian Ocean Territory', 'it-l10n-ithemes-exchange' ),
		'IQ' => __( 'Iraq', 'it-l10n-ithemes-exchange' ),
		'IR' => __( 'Iran, Islamic Republic of', 'it-l10n-ithemes-exchange' ),
		'IS' => __( 'Iceland', 'it-l10n-ithemes-exchange' ),
		'IT' => __( 'Italy', 'it-l10n-ithemes-exchange' ),
		'JE' => __( 'Jersey', 'it-l10n-ithemes-exchange' ),
		'JM' => __( 'Jamaica', 'it-l10n-ithemes-exchange' ),
		'JO' => __( 'Jordan', 'it-l10n-ithemes-exchange' ),
		'JP' => __( 'Japan', 'it-l10n-ithemes-exchange' ),
		'KE' => __( 'Kenya', 'it-l10n-ithemes-exchange' ),
		'KG' => __( 'Kyrgyzstan', 'it-l10n-ithemes-exchange' ),
		'KH' => __( 'Cambodia', 'it-l10n-ithemes-exchange' ),
		'KI' => __( 'Kiribati', 'it-l10n-ithemes-exchange' ),
		'KM' => __( 'Comoros', 'it-l10n-ithemes-exchange' ),
		'KN' => __( 'Saint Kitts and Nevis', 'it-l10n-ithemes-exchange' ),
		'KP' => __( 'Korea, Democratic People\'s Republic of', 'it-l10n-ithemes-exchange' ),
		'KR' => __( 'Korea, Republic of', 'it-l10n-ithemes-exchange' ),
		'KW' => __( 'Kuwait', 'it-l10n-ithemes-exchange' ),
		'KY' => __( 'Cayman Islands', 'it-l10n-ithemes-exchange' ),
		'KZ' => __( 'Kazakstan', 'it-l10n-ithemes-exchange' ),
		'LA' => __( 'Lao People\'s Democratic Republic', 'it-l10n-ithemes-exchange' ),
		'LB' => __( 'Lebanon', 'it-l10n-ithemes-exchange' ),
		'LC' => __( 'Saint Lucia', 'it-l10n-ithemes-exchange' ),
		'LI' => __( 'Liechtenstein', 'it-l10n-ithemes-exchange' ),
		'LK' => __( 'Sri Lanka', 'it-l10n-ithemes-exchange' ),
		'LR' => __( 'Liberia', 'it-l10n-ithemes-exchange' ),
		'LS' => __( 'Lesotho', 'it-l10n-ithemes-exchange' ),
		'LT' => __( 'Lithuania', 'it-l10n-ithemes-exchange' ),
		'LU' => __( 'Luxembourg', 'it-l10n-ithemes-exchange' ),
		'LV' => __( 'Latvia', 'it-l10n-ithemes-exchange' ),
		'LY' => __( 'Libyan Arab Jamahiriya', 'it-l10n-ithemes-exchange' ),
		'MA' => __( 'Morocco', 'it-l10n-ithemes-exchange' ),
		'MC' => __( 'Monaco', 'it-l10n-ithemes-exchange' ),
		'MD' => __( 'Moldova, Republic of', 'it-l10n-ithemes-exchange' ),
		'ME' => __( 'Montenegro', 'it-l10n-ithemes-exchange' ),
		'MG' => __( 'Madagascar', 'it-l10n-ithemes-exchange' ),
		'MH' => __( 'Marshall Islands', 'it-l10n-ithemes-exchange' ),
		'MK' => __( 'Macedonia', 'it-l10n-ithemes-exchange' ),
		'ML' => __( 'Mali', 'it-l10n-ithemes-exchange' ),
		'MM' => __( 'Myanmar', 'it-l10n-ithemes-exchange' ),
		'MN' => __( 'Mongolia', 'it-l10n-ithemes-exchange' ),
		'MO' => __( 'Macau', 'it-l10n-ithemes-exchange' ),
		'MP' => __( 'Northern Mariana Islands', 'it-l10n-ithemes-exchange' ),
		'MQ' => __( 'Martinique', 'it-l10n-ithemes-exchange' ),
		'MR' => __( 'Mauritania', 'it-l10n-ithemes-exchange' ),
		'MS' => __( 'Montserrat', 'it-l10n-ithemes-exchange' ),
		'MT' => __( 'Malta', 'it-l10n-ithemes-exchange' ),
		'MU' => __( 'Mauritius', 'it-l10n-ithemes-exchange' ),
		'MV' => __( 'Maldives', 'it-l10n-ithemes-exchange' ),
		'MW' => __( 'Malawi', 'it-l10n-ithemes-exchange' ),
		'MX' => __( 'Mexico', 'it-l10n-ithemes-exchange' ),
		'MY' => __( 'Malaysia', 'it-l10n-ithemes-exchange' ),
		'MZ' => __( 'Mozambique', 'it-l10n-ithemes-exchange' ),
		'NA' => __( 'Namibia', 'it-l10n-ithemes-exchange' ),
		'NC' => __( 'New Caledonia', 'it-l10n-ithemes-exchange' ),
		'NE' => __( 'Niger', 'it-l10n-ithemes-exchange' ),
		'NF' => __( 'Norfolk Island', 'it-l10n-ithemes-exchange' ),
		'NG' => __( 'Nigeria', 'it-l10n-ithemes-exchange' ),
		'NI' => __( 'Nicaragua', 'it-l10n-ithemes-exchange' ),
		'NL' => __( 'Netherlands', 'it-l10n-ithemes-exchange' ),
		'NO' => __( 'Norway', 'it-l10n-ithemes-exchange' ),
		'NP' => __( 'Nepal', 'it-l10n-ithemes-exchange' ),
		'NR' => __( 'Nauru', 'it-l10n-ithemes-exchange' ),
		'NU' => __( 'Niue', 'it-l10n-ithemes-exchange' ),
		'NZ' => __( 'New Zealand', 'it-l10n-ithemes-exchange' ),
		'OM' => __( 'Oman', 'it-l10n-ithemes-exchange' ),
		'PA' => __( 'Panama', 'it-l10n-ithemes-exchange' ),
		'PE' => __( 'Peru', 'it-l10n-ithemes-exchange' ),
		'PF' => __( 'French Polynesia', 'it-l10n-ithemes-exchange' ),
		'PG' => __( 'Papua New Guinea', 'it-l10n-ithemes-exchange' ),
		'PH' => __( 'Philippines', 'it-l10n-ithemes-exchange' ),
		'PK' => __( 'Pakistan', 'it-l10n-ithemes-exchange' ),
		'PL' => __( 'Poland', 'it-l10n-ithemes-exchange' ),
		'PM' => __( 'Saint Pierre and Miquelon', 'it-l10n-ithemes-exchange' ),
		'PR' => __( 'Puerto Rico', 'it-l10n-ithemes-exchange' ),
		'PS' => __( 'Palestinian Territory, Occupied', 'it-l10n-ithemes-exchange' ),
		'PT' => __( 'Portugal', 'it-l10n-ithemes-exchange' ),
		'PW' => __( 'Palau', 'it-l10n-ithemes-exchange' ),
		'PY' => __( 'Paraguay', 'it-l10n-ithemes-exchange' ),
		'QA' => __( 'Qatar', 'it-l10n-ithemes-exchange' ),
		'RE' => __( 'Reunion', 'it-l10n-ithemes-exchange' ),
		'RO' => __( 'Romania', 'it-l10n-ithemes-exchange' ),
		'RS' => __( 'Serbia', 'it-l10n-ithemes-exchange' ),
		'RU' => __( 'Russian Federation', 'it-l10n-ithemes-exchange' ),
		'RW' => __( 'Rwanda', 'it-l10n-ithemes-exchange' ),
		'SA' => __( 'Saudi Arabia', 'it-l10n-ithemes-exchange' ),
		'SB' => __( 'Solomon Islands', 'it-l10n-ithemes-exchange' ),
		'SC' => __( 'Seychelles', 'it-l10n-ithemes-exchange' ),
		'SD' => __( 'Sudan', 'it-l10n-ithemes-exchange' ),
		'SE' => __( 'Sweden', 'it-l10n-ithemes-exchange' ),
		'SG' => __( 'Singapore', 'it-l10n-ithemes-exchange' ),
		'SI' => __( 'Slovenia', 'it-l10n-ithemes-exchange' ),
		'SK' => __( 'Slovakia', 'it-l10n-ithemes-exchange' ),
		'SL' => __( 'Sierra Leone', 'it-l10n-ithemes-exchange' ),
		'SM' => __( 'San Marino', 'it-l10n-ithemes-exchange' ),
		'SN' => __( 'Senegal', 'it-l10n-ithemes-exchange' ),
		'SO' => __( 'Somalia', 'it-l10n-ithemes-exchange' ),
		'SR' => __( 'Suriname', 'it-l10n-ithemes-exchange' ),
		'ST' => __( 'Sao Tome and Principe', 'it-l10n-ithemes-exchange' ),
		'SV' => __( 'El Salvador', 'it-l10n-ithemes-exchange' ),
		'SY' => __( 'Syrian Arab Republic', 'it-l10n-ithemes-exchange' ),
		'SZ' => __( 'Swaziland', 'it-l10n-ithemes-exchange' ),
		'TC' => __( 'Turks and Caicos Islands', 'it-l10n-ithemes-exchange' ),
		'TD' => __( 'Chad', 'it-l10n-ithemes-exchange' ),
		'TG' => __( 'Togo', 'it-l10n-ithemes-exchange' ),
		'TH' => __( 'Thailand', 'it-l10n-ithemes-exchange' ),
		'TJ' => __( 'Tajikistan', 'it-l10n-ithemes-exchange' ),
		'TK' => __( 'Tokelau', 'it-l10n-ithemes-exchange' ),
		'TM' => __( 'Turkmenistan', 'it-l10n-ithemes-exchange' ),
		'TN' => __( 'Tunisia', 'it-l10n-ithemes-exchange' ),
		'TO' => __( 'Tonga', 'it-l10n-ithemes-exchange' ),
		'TR' => __( 'Turkey', 'it-l10n-ithemes-exchange' ),
		'TT' => __( 'Trinidad and Tobago', 'it-l10n-ithemes-exchange' ),
		'TV' => __( 'Tuvalu', 'it-l10n-ithemes-exchange' ),
		'TW' => __( 'Taiwan', 'it-l10n-ithemes-exchange' ),
		'TZ' => __( 'Tanzania, United Republic of', 'it-l10n-ithemes-exchange' ),
		'UA' => __( 'Ukraine', 'it-l10n-ithemes-exchange' ),
		'UG' => __( 'Uganda', 'it-l10n-ithemes-exchange' ),
		'UM' => __( 'United States Minor Outlying Islands', 'it-l10n-ithemes-exchange' ),
		'US' => __( 'United States', 'it-l10n-ithemes-exchange' ),
		'UY' => __( 'Uruguay', 'it-l10n-ithemes-exchange' ),
		'UZ' => __( 'Uzbekistan', 'it-l10n-ithemes-exchange' ),
		'VA' => __( 'Holy See (Vatican City State)', 'it-l10n-ithemes-exchange' ),
		'VC' => __( 'Saint Vincent and the Grenadines', 'it-l10n-ithemes-exchange' ),
		'VE' => __( 'Venezuela', 'it-l10n-ithemes-exchange' ),
		'VG' => __( 'Virgin Islands, British', 'it-l10n-ithemes-exchange' ),
		'VI' => __( 'Virgin Islands, U.S.', 'it-l10n-ithemes-exchange' ),
		'VN' => __( 'Vietnam', 'it-l10n-ithemes-exchange' ),
		'VU' => __( 'Vanuatu', 'it-l10n-ithemes-exchange' ),
		'WF' => __( 'Wallis and Futuna', 'it-l10n-ithemes-exchange' ),
		'WS' => __( 'Samoa', 'it-l10n-ithemes-exchange' ),
		'YE' => __( 'Yemen', 'it-l10n-ithemes-exchange' ),
		'YT' => __( 'Mayotte', 'it-l10n-ithemes-exchange' ),
		'ZA' => __( 'South Africa', 'it-l10n-ithemes-exchange' ),
		'ZM' => __( 'Zambia', 'it-l10n-ithemes-exchange' ),
		'ZW' => __( 'Zimbabwe', 'it-l10n-ithemes-exchange' ),
	);

	// Sort by values, not keys.
	if ( ! empty( $options['sort-by-values'] ) ) {
		$sorted = array();
		foreach( $countries as $key => $value ) {
			$sorted[$value] = $value;
		}
		array_multisort( $sorted, SORT_ASC, $countries );
	}

	return apply_filters( 'it_exchange_get_countries', $countries );
}
