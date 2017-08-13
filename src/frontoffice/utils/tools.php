<?php


/**
 *
 * @author Tomasz.Gajewski
 * @package system
 *          Created on 2008-07-14 12:22:24
 *          error_prexix OR:401
 *          klasa odpowiedzialna za sprawdzanie danych przychodzących z przeglądarki
 */

// =============================================================================
function getTitleBox($title, $href, $atributes) {
	return Tags::div ( $title . Tags::ajaxLink ( Tags::span ( "", 'class="' . $atributes . '"' ), $href ) );
}
// =============================================================================
