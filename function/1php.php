<?php

/*
 * Napisz funkcj� zwracaj�c� losow� liczb� 0 - 100
 *
 */
function getDowolnaLiczba() {
	$losowaLiczba = rand ( 0, 100 );
	$losowaLiczba = $losowaLiczba + 100;
	return $losowaLiczba; ///////// "zawsze" na ko�cy return//////////
}

$text = "M�j wiek to : " . getDowolnaLiczba ();

echo $text;
