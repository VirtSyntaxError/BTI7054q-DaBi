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
	'PRICE' => array(
		'de' => 'Preis',
		'en' => 'Price'
	),
	'CATEGORY' => array(
		'de' => 'Kategorie',
		'en' => 'Category'
	),
	'BRAND' => array(
		'de' => 'Marke',
		'en' => 'Brand'
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