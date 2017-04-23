<?php
function getDowolnyElementTablicy() 
{
$tbl = array('PierwszyElm', 'DrugiElm', 'TrzeciElm', 'CzwartyElm'); 
$DowolnyEmementTablicy = rand(0, 3);
return $tbl[$DowolnyEmementTablicy];
}

$DowolnyElm = "Który element tablicy " . getDowolnyElementTablicy();

echo $DowolnyElm;