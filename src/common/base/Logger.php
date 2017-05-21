<?php

/**
 * Created on 7 mar 2015 13:33:14
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
namespace braga\wordgame\common\base;

class Logger
{

	// -------------------------------------------------------------------------
	public static function erifClientLog($direction, $content)
	{
		self::log("Erif" . $direction, $content);
	}
	// -------------------------------------------------------------------------
	public static function krdClientLog($direction, $content)
	{
		self::log("KRD" . $direction, $content);
	}
	// -------------------------------------------------------------------------
	protected static function log($filePrefix, $content)
	{
		if(is_object($content) || is_array($content))
		{
			ob_start();
			var_dump($content);
			$content = ob_get_clean();
		}
		$retval = date(PHP_DATETIME_FORMAT) . ",\r\n" . $content;
		$h = fopen(LOG_DIRECTORY . $filePrefix . "." . date(PHP_DATE_FORMAT) . ".log", "a");
		fwrite($h, $retval);
		fwrite($h, "\n================================================================================\n");
		fclose($h);
	}
	// -------------------------------------------------------------------------
}
?>