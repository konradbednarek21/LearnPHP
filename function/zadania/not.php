<?php 

function LosElmTbl()
{
	$tbl = array('1', '2');
	$LosElm = rand(0, 1);
	return $LosElm;
}

$Lel = LosElmTbl();

echo $Lel;