<?php

include 'ZadanieDomowe.php';

abstract class Przesylka
{
	public function nadaj()
	{
		echo "nadaje przesy�k�";	
	}
	
	public function odbierz()
	{
		echo "odbieram przesy�k�";
	}

	public function edytuj()
	{
		echo "edytuj� przesy�k�";
	}
}

class PrzesylkaFirmowa extends Przesylka
{
	public function nadaj()
	{
		echo "Nadaj� przesy�k� firmow�";
	}
	
	public function odbierz()
	{
		echo "Odbieram przesy�k� firmow�";
	}
}

$PrzeFirm = new PrzesylkaFirmowa;

echo PrzeFirm;