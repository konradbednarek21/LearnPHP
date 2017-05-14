<?php

include 'zadanie.php';
abstract class Samochod
{
	public function jedz()
	{
		echo "jedz<br>";
	}
	protected function stop()
	{
		echo "stop<br>";
	}
	
	private function tankuj()
	{
		echo "tankuj<br>";
	}
}

class Audi extends Samochod
{
	public function stop()
	{
		echo "stop audi";
	}
	public static function getNewAuto()
	{
		echo "nowe auto jest Twoej";
	}
	
}

$sam = new Audi();

$nowySam = Audi::getNewAuto();
// $sam->jedz();
// $sam->stop();	
// $sam->tankuj();