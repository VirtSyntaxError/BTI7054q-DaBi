<?php
$texts = array(
	'HOME' => array(
		'de' => 'Home',
		'en' => 'Home'
	),
	'BRANDS' => array(
		'de' => 'Marken',
		'en' => 'Brands'
	),
	'CATEGORIES' => array(
		'de' => 'Kategorien',
		'en' => 'Categories'
	),
	'LOGIN' => array(
		'de' => 'Login',
		'en' => 'Login'
	),
	'WELCOME' => array(
		'de' => 'Willkommen auf unserer Seite',
		'en' => 'Welcome to our web shop.'
	),
	'SEX' => array(
		'de' => 'Geschlecht',
		'en' => 'Sex'
	),
	'ARTICLENUMBER' => array(
		'de' => 'Artikelnummer',
		'en' => 'Articlenumber'
	),
	'PRICE' => array(
		'de' => 'Preis',
		'en' => 'Price'
	),
	'CATEGORY' => array(
		'de' => 'Kategorie',
		'en' => 'Category'
	),
	'BUY' => array(
		'de' => 'Jetzt kaufen',
		'en' => 'Buy Now'
	),
	'CUSTOMIZEPROD' => array(
		'de' => 'Individualisiere dein Produkt',
		'en' => 'Customize your product'
	),
	'SUBMIT' => array(
		'de' => 'Abschicken',
		'en' => 'Submit'
	),
	'BRAND' => array(
		'de' => 'Marke',
		'en' => 'Brand'
	),
	'ENTER_DATA' => array(
		'de' => 'Bitte füllen Sie Ihre Daten ein',
		'en' => 'Please enter your data'
	),
	'NAME' => array(
		'de' => 'Name',
		'en' => 'Name'
	),
	'EMAIL' => array(
		'de' => 'E-Mail',
		'en' => 'E-Mail'
	),
	'ADDRESS' => array(
		'de' => 'Adresse',
		'en' => 'Address'
	),
	'STREET' => array(
		'de' => 'Strasse',
		'en' => 'Street'
	),
	'NUMBER' => array(
		'de' => 'Nummer',
		'en' => 'Number'
	),
	'ZIP' => array(
		'de' => 'PLZ',
		'en' => 'ZIP'
	),
	'CITY' => array(
		'de' => 'Ort',
		'en' => 'City'
	),
	'COUNTRY' => array(
		'de' => 'Land',
		'en' => 'Country'
	),
	'DE' => array(
		'de' => 'Deutschland',
		'en' => 'Germany'
	),
	'CH' => array(
		'de' => 'Schweiz',
		'en' => 'Switzerland'
	),
	'AT' => array(
		'de' => '&Ouml;sterreich',
		'en' => 'Austria'
	),
	'SHIPPING_METHOD' => array(
		'de' => 'Versandsmethode',
		'en' => 'Shipping Method'
	),
	'STANDARD' => array(
		'de' => 'Standard',
		'en' => 'Standard'
	),
	'EXPRESS' => array(
		'de' => 'Express',
		'en' => 'Express'
	),
	'PICKUP' => array(
		'de' => 'Abholung',
		'en' => 'Pickup'
	),
	'GIFT' => array(
		'de' => 'Geschenk',
		'en' => 'Gift'
	),
	'ENTER_COMMENT' => array(
		'de' => 'Hier Kommentare eingeben...',
		'en' => 'Enter comments here...'
	),
	'CONFIRMATION' => array(
		'de' => 'Best&auml;tigung',
		'en' => 'Confirmation'
	),
	'AGBTITLE' => array(
		'de' => 'Allgemeine Gesch&auml;ftsbedingungen',
		'en' => 'Conditions'
	),
	'AGB' => array(
		'de' => 'AGB deutsch',
		'en' => 'AGB english'
	),
	'WRONGPW' => array(
		'de' => 'Falscher Username und/oder Passwort',
		'en' => 'Wrong Username and/or Password'
	),
	'PLEASE_LOG_IN' => array(
		'de' => 'Bitte loggen Sie sich ein',
		'en' => 'Please log in'
	)
);

function getAvailableLanguages()
{
	return ['de', 'en'];
}

function getDefaultLanguage()
{
	return 'de';
}

function t($id)
{
	global $texts;
	if (array_key_exists($id, $texts)) {
		$values = $texts[$id];
		if (isset($_GET['lang']) && array_key_exists($_GET['lang'], $values)) {
			return $values[$_GET['lang']];
		} else {
			return $values[getDefaultLanguage()];
		}
	}
}
