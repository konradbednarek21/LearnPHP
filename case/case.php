<?php
// Napisz program który za pomoca wprowadzenia zmiennej $w = n - liczba naturalna
// Zwróci dowlony ciag znaków o dlugosci 3;
// Zwroci ciag znakow o d³ugosci 6;
// w kazdym innym przypadku dowolny ciag znakow;



const TRZY_EL_RANDOM = 3;
const SZESC_EL_RANDOM = 6;


$iloscZnakowRandomString = 3;
switch($iloscZnakowRandomString)
{
	case TRZY_EL_RANDOM:
		getMojaFunkcja();
		break;
	
	case SZESC_EL_RANDOM:
		$string = getRandomStringByNumber(6);
		echo $string . " " . strlen($string);
		break;
		
	default:
		$string = getRandomString();
		echo $string . " " . strlen($string);
		break;
}




function getMojaFunkcja()
{
	$string = getRandomStringByNumber(3);
	echo $string . " " . strlen($string);
}

















function getRandomString()
{
	$keychars = "abcdefghijklmnopqrstuvwxyz";
	$randkey = "";
	$max = strlen($keychars) - 1;
	for($i = 0;$i < rand(1,10);$i++)
	{
		$randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;
}


function getRandomStringByNumber($dlugosc)
{
	$keychars = "abcdefghijklmnopqrstuvwxyz";
	$randkey = "";
	$max = strlen($keychars) - 1;
	for($i = 0;$i < $dlugosc;$i++)
	{
		$randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;
}













?>