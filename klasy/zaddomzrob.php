<?php

include 'ZadanieDomowe.php';

abstract class Przesylka
{
	public function nadaj()
	{
		echo "nadaje przesy³kê";	
	}
	
	public function odbierz()
	{
		echo "odbieram przesy³kê";
	}

	public function edytuj()
	{
		echo "edytujê przesy³kê";
	}
}

class PrzesylkaFirmowa extends Przesylka
{
	public function nadaj()
	{
		echo "Nadajê przesy³kê firmow¹";
	}
	
	public function odbierz()
	{
		echo "Odbieram przesy³kê firmow¹";
	}
}

$PrzeFirm = new PrzesylkaFirmowa;

echo PrzeFirm;