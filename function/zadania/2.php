<?php
function getLiczba() {
	$Liczba = rand ( 0, 20 );
	$Liczba = $Liczba;
	return $Liczba;
}

$Liczba = getLiczba ();

echo $Liczba;