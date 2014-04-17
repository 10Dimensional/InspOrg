<?php
if ( !defined('ABSPATH') ) {
	exit;
}

function rawhtml_get_mce_translation() {
	//At the moment, we don't have any actual i18n support.
	//Just need to pass the placeholder image URL to the TinyMCE plugin.
	$translations = array(
		'placeholder_image' => plugins_url('editor-plugin/placeholder.gif', RAWHTML_PLUGIN_FILE),
	);

	$translated = sprintf(
		"tinyMCE.addI18n(%s, %s);\n",
		json_encode(_WP_Editors::$mce_locale . '.rawhtml'),
		json_encode($translations)
	);
	return $translated;
}
$strings = rawhtml_get_mce_translation();