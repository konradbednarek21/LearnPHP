<?php
function getLiczba() 
{
	$losowaLiczba = rand ( 0, 1000 );
	
	return $losowaLiczba;
}

$Liczba = getLiczba();

echo $Liczba;