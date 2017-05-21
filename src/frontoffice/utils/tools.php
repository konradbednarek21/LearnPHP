<?php

namespace braga\wordgame\frontoffice\utils;

/**
 *
 * @author Tomasz.Gajewski
 * @package system
 *          Created on 2008-07-14 12:22:24
 *          error_prexix OR:401
 *          klasa odpowiedzialna za sprawdzanie danych przychodzących z przeglądarki
 */
use braga\tools\html\BaseTags;

// =============================================================================
function HiddenField($name = "no_name", $value = "") {
	return BaseTags::input ( "type='hidden' id='" . $name . "' name='" . $name . "' value='" . $value . "'" );
}
// =============================================================================
function sizeFileFormat($bytes) {
	if ($bytes > 0) {
		$unit = intval ( log ( $bytes, 1024 ) );
		$units = array (
				'B',
				'kiB',
				'MiB',
				'GiB'
		);

		if (array_key_exists ( $unit, $units ) === true) {
			return round ( $bytes / pow ( 1024, $unit ), 1 ) . " " . $units [$unit];
		}
	}
	return $bytes;
}
// =============================================================================
function getTitleBox($title, $href, $atributes) {
	return Tags::div ( $title . Tags::ajaxLink ( Tags::span ( "", 'class="' . $atributes . '"' ), $href ) );
}
// =============================================================================
function getToolTip($text) {
	return "onmouseover='\$(this).tooltip(\"show\");' title='" . $text . "' data-toggle='tooltip' data-placement='top'";
}
// =============================================================================
function enableTinyMCE()
{
	return BaseTags::script("initTinyMCE();");
}


?>