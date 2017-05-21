<?php

/**
 * Klasa utworzona na potrzeby zorganizowania kodu do przechwytywania i logownaia błędów.
 * Nie należy jej używać w kodzie oprócz metody ::setErrorHandler
 * we wczesnej fazie wykonywania skryptu (np. base.php, config.php, ...).
 * Data utworzenia 7 lip 2016
 * @author KlewinowskiKarol
 * @package core
 * @maxerror 20646
 */
namespace braga\wordgame\common\base;

class ErrorHandler
{
	// -------------------------------------------------------------------------
	const BIND_PARAMETERS_ERROR_NUMBER = '[HY093]';
	// -------------------------------------------------------------------------
	private function __construct()
	{
		;
	}
	// -------------------------------------------------------------------------
	/**
	 * Metoda do ustawienia przechwytywania i logowania błędów.
	 * Nie nalezy jej używać nigdzie oprócz base.php
	 */
	public static function setErrorHandler()
	{
		register_shutdown_function(array(
										'Braga\ErrorHandler',
										'fatalErrorHandler' ));
		set_error_handler(array(
								'Braga\ErrorHandler',
								'errorHandler' ));
		set_exception_handler(array(
									'Braga\ErrorHandler',
									'exceptionHandler' ));
	}
	// -------------------------------------------------------------------------
	/**
	 * Nie używać metody poza jej klasą!!!
	 */
	public static function errorHandler($errno, $errstr, $errfile, $errline)
	{
		$retval = date(PHP_DATETIME_FORMAT);
		$retval .= ";" . $errno;
		$retval .= ";" . $errstr;
		$retval .= ";" . $errfile;
		$retval .= ";" . $errline;
		$retval .= "\n";
		// $retval .= getCallStack(); //FIXME: USUNAC PRZED WDROZENIEM TE LINIE
		$retval .= "\n";

		switch($errno)
		{
			case E_ERROR:
				$filePrefix = "error";
				break;
			case E_WARNING:
				$filePrefix = "warn";
				break;
			case E_PARSE:
				$filePrefix = "parse";
				break;
			case E_NOTICE:
				$filePrefix = "notice";
				break;
			case E_CORE_ERROR:
				$filePrefix = "core_error";
				break;
			case E_CORE_WARNING:
				$filePrefix = "core_warn";
				break;
			case E_COMPILE_ERROR:
				$filePrefix = "compile_error";
				break;
			case E_COMPILE_WARNING:
				$filePrefix = "compile_warn";
				break;
			case E_USER_ERROR:
				$filePrefix = "user_error";
				break;
			case E_USER_WARNING:
				$filePrefix = "user_warn";
				break;
			case E_USER_NOTICE:
				$filePrefix = "user_notice";
				break;
			case E_STRICT:
				$filePrefix = "strict";
				break;
			case E_RECOVERABLE_ERROR:
				/**
				 * BUG 9013
				 * Ze względu na to, że przechwytujemy E_RECOVERABLE_ERROR swoim handlerem,
				 * kod przy tym błędzie nie jest zatrzymywany i try-catch nie działały jak powinny.
				 * Naprawa polega na rzuceniu wyjątkiem przy tym błędzie.
				 */
				$filePrefix = "recoverable_error";
				self::saveErrorToLogFile($filePrefix, $retval);
				throw new \Exception($errstr, $errno);
				break;
			case E_DEPRECATED:
				$filePrefix = "deprec";
				break;
			case E_USER_DEPRECATED:
				$filePrefix = "deprec_error";
				break;
			case E_ALL:
				$filePrefix = "all_error";
				break;
			default :
				$filePrefix = "unknow";
				break;
		}
		self::saveErrorToLogFile($filePrefix, $retval);
		return false;
	}
	// -----------------------------------------------------------------------------
	/**
	 * Nie używać metody poza jej klasą!!!
	 */
	public static function exceptionHandler(\Exception $exception)
	{
		/**
		 * Osobna obsługa błędu związanego z brakiem zbindowania
		 * wszystkich parametrów w zapytaniu SQL
		 */
		if(basename($exception->getFile()) == "DB.php" && strpos($exception->getMessage(), self::BIND_PARAMETERS_ERROR_NUMBER) !== false)
		{
			$retval = self::getRetvalForSqlWarningsParameters($exception->getCode(), $exception->getMessage());
			$filePrefix = "SQL.Warnings.Parameters";
			self::saveErrorToLogFile($filePrefix, $retval);
		}
		$filePrefix = "exception";
		$retval = date(PHP_DATETIME_FORMAT);
		$retval .= ";" . $exception->getCode();
		$retval .= ";" . $exception->getMessage();
		$retval .= ";" . $exception->getFile();
		$retval .= ";" . $exception->getLine();
		$retval .= "\n";
		self::saveErrorToLogFile($filePrefix, $retval);
		return false;
	}
	// -----------------------------------------------------------------------------
	/**
	 * Nie używać metody poza jej klasą!!!
	 */
	public static function fatalErrorHandler()
	{
		$error = error_get_last();
		if($error !== null)
		{
			switch($error["type"])
			{
				case E_ERROR:
				case E_PARSE:
				case E_CORE_ERROR:
				case E_COMPILE_ERROR:
				case E_USER_ERROR:
					self::errorHandler($error["type"], $error["message"], $error["file"], $error["line"]);
					exit();
					break;
			}
		}
	}
	// -----------------------------------------------------------------------------
	private static function getRetvalForSqlWarningsParameters($errno, $errstr)
	{
		$t = str_repeat("=", 71) . "\n";
		$text = "Error nr: " . $errno . ", Error string: " . $errstr . "\n";
		$retval = date(PHP_DATETIME_FORMAT) . "\n" . $text . getCallStack() . $t;
		return $retval;
	}
	// -----------------------------------------------------------------------------
	/**
	 * Funkcja do zapisu plików *.log w katalogu LOG_DIRECTORY
	 * @param string $filePrefix
	 * @param string $retval
	 */
	private static function saveErrorToLogFile($filePrefix, $retval)
	{
		$file = LOG_DIRECTORY . $filePrefix . "." . date(PHP_DATE_FORMAT) . ".log";
		file_put_contents($file, $retval, FILE_APPEND);
	}
}