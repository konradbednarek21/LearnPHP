<?php
function getDowolnyElementTablicy() 
{
$tbl = array('PierwszyElm', 'DrugiElm', 'TrzeciElm', 'CzwartyElm'); 
$DowolnyEmementTablicy = rand(0, 3);
return $tbl[$DowolnyEmementTablicy];
}

$DowolnyElm = "Kt�ry element tablicy " . getDowolnyElementTablicy();

echo $DowolnyElm;