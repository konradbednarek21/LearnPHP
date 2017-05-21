<?php
/**
 * Data utworzenia 24 sie 2016
 * @author derdzinskimarek
 * @package
 *
 */
namespace braga\wordgame\common\cron;
abstract class CronBase
{
	// -------------------------------------------------------------------------
	protected $logPrefix = "common";
	// -------------------------------------------------------------------------
	abstract public function go();
	// -------------------------------------------------------------------------
	protected $logFileHandle = null;
	// -------------------------------------------------------------------------
	protected $param = null;
	// -------------------------------------------------------------------------
	protected function addLog($text)
	{
		fwrite($this->logFileHandle, date(PHP_DATETIME_FORMAT) . "," . $text . "\r\n");
	}
	// -------------------------------------------------------------------------

	function __construct($param = null)
	{
		$this->param = $param;
		if(!is_null($param))
		{
			$this->logPrefix .= str_pad($param, 2, "0", STR_PAD_LEFT);
		}
		$logFile = $this->logPrefix . "_" . date(PHP_DATE_FORMAT) . ".log";
		$logFile = str_replace("-", "-", $logFile);
		$this->logFileHandle = fopen(LOG_DIRECTORY . $logFile, "a+");
	}
	// -------------------------------------------------------------------------
}
?>