<?php
function getDowolnyElementTablicy() 
{
$tbl = array('PierwszyElm', 'DrugiElm', 'TrzeciElm', 'CzwartyElm'); 
$DowolnyElementTablicy = rand(0, 4);
return $DowolnyElementTablicy;
}

$DowolnyElm = "Który element tablicy " . getDowolnyElementTablicy();

echo $DowolnyElm;