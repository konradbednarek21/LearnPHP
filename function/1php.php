<?php

/*
 * Napisz funkcjê zwracaj¹c¹ losow¹ liczbê 0 - 100
 *
 */
function getDowolnaLiczba() {
	$losowaLiczba = rand ( 0, 100 );
	$losowaLiczba = $losowaLiczba + 100;
	return $losowaLiczba; ///////// "zawsze" na koñcy return//////////
}

$text = "Mój wiek to : " . getDowolnaLiczba ();

echo $text;
