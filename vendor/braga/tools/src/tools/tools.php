<?php
use braga\tools\tools\Message;
use braga\tools\tools\SessManager;

/**
 *
 * @author Tomasz.Gajewski
 * @package system
 * Created on 2008-07-14 12:22:24
 * error_prexix EM:903
 * klasa odpowiedzialna za sprawdzanie danych przychodzących z przeglądarki
 */
// =============================================================================
function getmicrotime()
{
	list($usec, $sec) = explode(" ", microtime());
	return ((float)$usec + (float)$sec);
}
// =============================================================================
function addAlert($text)
{
	addErrorLog($text);
	$m = Message::import(htmlspecialchars($text, ENT_QUOTES));
	if(!is_null($m))
	{
		SessManager::add(SessManager::MESSAGE_ALERT, $m);
	}
}
// =============================================================================
function addSQLError($text)
{
	addErrorLog($text);
	$m = Message::import(htmlspecialchars($text, ENT_QUOTES));
	if(!is_null($m))
	{
		SessManager::add(SessManager::MESSAGE_SQL, $m);
	}
}
// =============================================================================
function addMsg($text)
{
	$m = Message::import(htmlspecialchars($text, ENT_QUOTES));
	if(!is_null($m))
	{
		SessManager::add(SessManager::MESSAGE_INFO, $m);
	}
}
// =============================================================================
function addWarn($text)
{
	$m = Message::import(htmlspecialchars($text, ENT_QUOTES));
	if(!is_null($m))
	{
		SessManager::add(SessManager::MESSAGE_WARNING, $m);
	}
}
// =============================================================================
function addErrorLog($text)
{
	if(is_object($text) || is_array($text))
	{
		$text = var_export($text, true);
	}

	$retval = date("Y-m-d H:i:s") . "," . $text . "\r\n";
	$filename = INSTALL_DIRECTORY . "log/Error." . date(PHP_DATE_FORMAT) . ".log";
	file_put_contents($filename, $retval, FILE_APPEND);
}
// =============================================================================
function addDebugInfo($text)
{
	if(is_object($text) || is_array($text))
	{
		$text = var_export($text, true);
	}
	$retval = date("Y-m-d H:i:s") . "," . $text;
	$h = fopen(INSTALL_DIRECTORY . "log/Debug.log", "a");
	fwrite($h, $retval, mb_strlen($retval));
	fwrite($h, "\r\n", 2);
	fclose($h);
}
// =============================================================================
function getRandomStringLetterOnly($dlugosc)
{
	$keychars = "abcdefghijklmnopqrstuvwxyz";
	$randkey = "";
	$max = strlen($keychars) - 1;
	for($i = 0; $i < $dlugosc; $i++)
	{
		$randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;
}
// =============================================================================
function getRandomString($dlugosc)
{
	$keychars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	$randkey = "";
	$max = strlen($keychars) - 1;
	for($i = 0; $i < $dlugosc; $i++)
	{
		$randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;
}
// =============================================================================
function plCharset($string)
{
	$string = mb_strtolower($string);
	$polskie = array(
			',',
			' ',
			' ',
			'ę',
			'Ę',
			'ó',
			'Ó',
			'Ą',
			'ą',
			'Ś',
			's',
			'ł',
			'Ł',
			'ż',
			'Ż',
			'Ź',
			'ź',
			'ć',
			'Ć',
			'ń',
			'Ń',
			'-',
			"'",
			"/",
			"?",
			'"',
			":",
			'ś',
			'!',
			'.',
			'&',
			'&amp;',
			'#',
			';',
			'[',
			']',
			'(',
			')',
			'`',
			'%',
			'”',
			'„',
			'…');
	$miedzyn = array(
			'-',
			'-',
			'-',
			'e',
			'e',
			'o',
			'o',
			'a',
			'a',
			's',
			's',
			'l',
			'l',
			'z',
			'z',
			'z',
			'z',
			'c',
			'c',
			'n',
			'n',
			'-',
			"",
			"",
			"",
			"",
			"",
			's',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'',
			'');
	$string = str_replace($polskie, $miedzyn, $string);

	// usuń wszytko co jest niedozwolonym znakiem
	$string = preg_replace('/[^0-9a-z\-]+/', '', $string);

	// zredukuj liczbę myślników do jednego obok siebie
	$string = preg_replace('/[\-]+/', '-', $string);

	// usuwamy możliwe myślniki na początku i końcu
	$string = trim($string, '-');

	$string = stripslashes($string);

	// // na wszelki wypadek
	// $string = urlencode($string);

	return $string;
}
// =============================================================================
function formatMonney($kwota)
{
	if(!empty($kwota))
	{
		return number_format($kwota, 2, ",", " ");
	}
}
// =============================================================================
function formatDate($date)
{
	if(!empty($date))
	{
		return date(PHP_DATE_FORMAT, strtotime($date));
	}
}
// =============================================================================
function formatDateForRaport($date)
{
	if(!empty($date))
	{
		return '="' . $date . '"';
	}
}
// =============================================================================
function formatDateTime($time)
{
	if(!empty($time))
	{
		return date(PHP_DATETIME_FORMAT, strtotime($time));
	}
}
// =============================================================================
function formatBoolean($b)
{
	if($b)
	{
		return "Tak";
	}
	else
	{
		return "Nie";
	}
}
// =============================================================================
function formatBytes($bytes)
{
	if($bytes > 0)
	{
		$unit = intval(log($bytes, 1024));
		$units = array(
				'B',
				'kiB',
				'MiB',
				'GiB');

		if(array_key_exists($unit, $units) === true)
		{
			return round($bytes / pow(1024, $unit), 1) . " " . $units[$unit];
		}
	}
	return $bytes;
}
// =============================================================================
function formatNrb($numer)
{
	// from http://forum.php.pl/index.php?showtopic=118827
	$suma = substr($numer, 0, 2); // 2 cyfry
	$nr_roz1 = substr($numer, 2, 4); // pierwsze 4 cyfry
	$nr_roz2 = substr($numer, 6, 4); // drugie 4 cyfry
	$nr_rach1 = substr($numer, 10, 4); // pierwsze 4 cyfry
	$nr_rach2 = substr($numer, 14, 4); // drugie 4 cyfry
	$nr_rach3 = substr($numer, 18, 4); // trzecie 4 cyfry
	$nr_rach4 = substr($numer, 22, 4); // czwarte 4 cyfry

	return $suma . ' ' . $nr_roz1 . ' ' . $nr_roz2 . ' ' . $nr_rach1 . ' ' . $nr_rach2 . ' ' . $nr_rach3 . ' ' . $nr_rach4;
}
// =============================================================================
function formatText($text)
{
	return nl2br($text, true);
}
// =============================================================================
function sortByLength($a, $b)
{
	if($a == $b)
		return 0;
	return (mb_strlen($a) > mb_strlen($b) ? 1 : -1);
}
// =============================================================================
function reverseSortByLength($a, $b)
{
	if($a == $b)
		return 0;
	return (mb_strlen($a) > mb_strlen($b) ? -1 : 1);
}
// =============================================================================
function stripUrl($url)
{
	$url = preg_replace("/(https?:\/\/)/i", "", $url);
	return "http://" . $url;
}
// =============================================================================
function getMonthName($nr)
{
	$m = array();
	$m[1] = "Styczeń";
	$m[2] = "Luty";
	$m[3] = "Marzec";
	$m[4] = "Kwiecień";
	$m[5] = "Maj";
	$m[6] = "Czerwiec";
	$m[7] = "Lipiec";
	$m[8] = "Sierpień";
	$m[9] = "Wrzesień";
	$m[10] = "Październik";
	$m[11] = "Listopad";
	$m[12] = "Grudzień";
	return $m[$nr];
}
// =============================================================================
function groupCollection(Iterator $collection, $groupFunctionName)
{
	$retval = array();
	foreach($collection as $key => $value)
	{
		$groupKey = call_user_func(array(
				$value,
				$groupFunctionName));
		$retval[$groupKey][$key] = $value;
	}
	return $retval;
}
// =============================================================================
function checkNIP($str)
{
	$str = preg_replace("/[^0-9]+/", "", $str);
	if(strlen($str) != 10)
	{
		return false;
	}

	$arrSteps = array(
			6,
			5,
			7,
			2,
			3,
			4,
			5,
			6,
			7);
	$intSum = 0;
	for($i = 0; $i < 9; $i++)
	{
		$intSum += $arrSteps[$i] * $str[$i];
	}
	$int = $intSum % 11;

	$intControlNr = ($int == 10) ? 0 : $int;
	if($intControlNr == $str[9])
	{
		return true;
	}
	return false;
}
// =============================================================================
function checkTime($time)
{
	return preg_match("/(2[0-3]|[01][0-9]):([0-5][0-9])/", $time);
}
// =============================================================================
function checkREGON($str)
{
	if(strlen($str) == 9)
	{
		$arrSteps = array(
				8,
				9,
				2,
				3,
				4,
				5,
				6,
				7);
		$intSum = 0;
		for($i = 0; $i < 8; $i++)
		{
			$intSum += $arrSteps[$i] * $str[$i];
		}
		$int = $intSum % 11;
		$intControlNr = ($int == 10) ? 0 : $int;
		if($intControlNr == $str[8])
		{
			return true;
		}
		return false;
	}
	elseif(strlen($str) == 14)
	{
		$arrSteps = array(
				2,
				4,
				8,
				5,
				0,
				9,
				7,
				3,
				6,
				1,
				2,
				4,
				8);
		$intSum = 0;
		for($i = 0; $i < 13; $i++)
		{
			$intSum += $arrSteps[$i] * $str[$i];
		}
		$int = $intSum % 11;
		$intControlNr = ($int == 10) ? 0 : $int;
		if($intControlNr == $str[13])
		{
			return true;
		}
		return false;
	}
	else
	{
		return false;
	}
}
// =============================================================================
function sizeFileFormat($bytes)
{
	if($bytes > 0)
	{
		$unit = intval(log($bytes, 1024));
		$units = array(
				'B',
				'kiB',
				'MiB',
				'GiB');

		if(array_key_exists($unit, $units) === true)
		{
			return round($bytes / pow(1024, $unit), 1) . " " . $units[$unit];
		}
	}
	return $bytes;
}
// =============================================================================
function getHashPass($pass, $idUzytkownik = null)
{
	return hash(HASH_ALGORYTM, $pass . $idUzytkownik);
}
// =============================================================================
function formatKodPocztowy($kod)
{
	$kod = substr(preg_replace("/[^0-9]+/", "", $kod), 0, 5);
	return substr($kod, 0, 2) . "-" . substr($kod, 2, 3);
}
// =============================================================================
function isEmail($email)
{
	return (bool)(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email));
}
// -----------------------------------------------------------------------------
function isMobile($mobile)
{
	if(!preg_match("/^[5-8]{1}[0-9]{8}$/", $mobile))
	{
		return false;
	}
	$pref = (int)substr($mobile, 0, 3);
	// źródło: http://www.uke.gov.pl/tablice/NumerPlmn-list.do?execution=e1s1
	if($pref < 500)
	{
		return false;
	}
	if($pref >= 520 && $pref <= 529)
	{
		return false;
	}
	if($pref >= 540 && $pref <= 569)
	{
		return false;
	}
	if($pref >= 580 && $pref <= 599)
	{
		return false;
	}
	if($pref >= 610 && $pref <= 659)
	{
		return false;
	}
	if($pref >= 700 && $pref <= 719)
	{
		return false;
	}
	if($pref >= 740 && $pref <= 779)
	{
		return false;
	}
	if($pref >= 800 && $pref <= 879)
	{
		return false;
	}
	if($pref >= 890)
	{
		return false;
	}
	return true;
}
// =============================================================================
function addMonth($date, $countOfMonth)
{
	$day = date("d", $date);
	$month = date("m", $date);
	$year = date("Y", $date);
	$dateOut = mktime(0, 0, 0, $month + $countOfMonth, $day, $year);

	$monthOut = date("m", $dateOut);
	$yearOut = date("Y", $dateOut);

	$m = ($month + $countOfMonth) % 12;
	if($m == 0)
	{
		$m = 12;
	}
	if($m != $monthOut)
	{
		if($year != $yearOut)
		{
			$lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $m, $yearOut);
			$dateOut = mktime(0, 0, 0, $m, $lastDayOfMonth, $yearOut);
		}
		else
		{
			$lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month + $countOfMonth, $year);
			$dateOut = mktime(0, 0, 0, $month + $countOfMonth, $lastDayOfMonth, $year);
		}
	}

	return date(PHP_DATE_FORMAT, $dateOut);
}
// =============================================================================
?>