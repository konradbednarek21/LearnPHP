<?php
function getDowolnyElementTablicy() 
{
$tbl = array('PierwszyElm', 'DrugiElm', 'TrzeciElm', 'CzwartyElm'); 
$DowolnyElementTablicy = rand(0, 4);
return $DowolnyElementTablicy;
}

$DowolnyElm = "Kt�ry element tablicy " . getDowolnyElementTablicy();

echo $DowolnyElm;