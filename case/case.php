<?php
/**
 * Created on 26 Mar 2017 10:21:15
 * error prefix
 * @author gromula
 *
 */
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


// Napisz program który za pomoca wprowadzenia zmiennej $w = n - liczba naturalna
// Zwróci dowlony ciag znaków o dlugosci 3;
// Zwroci ciag znakow o d³ugosci 6;
// w kazdym innym przypadku dowolny ciag znakow;

$w = 3;











?>