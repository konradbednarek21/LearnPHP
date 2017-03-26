<?php

function getMyName($imie,$nazwisko)
{	
	return $imie . ' ' . $nazwisko;
}

echo getMyName("Konrad","Bednarek");

echo "<br>";

echo getMyName("Bartosz","Gromowski");



