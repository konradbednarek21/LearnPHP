<?php
namespace braga\tools\tools;
use braga\tools\html\BaseControler;

/**
 * Created on 17-10-2011 22:01:45
 * @author Tomasz Gajewski
 * @package common
 * error prefix EM:107
 */
class PostChecker
{
	// -------------------------------------------------------------------------
	private static $instance = null;
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var PostLogger
	 */
	private static $logger = null;
	// -------------------------------------------------------------------------
	public static function setLogger(PostLogger $l)
	{
		self::$logger = $l;
	}
	// -------------------------------------------------------------------------
	static function get($key)
	{
		if(empty(self::$instance))
		{
			self::setInstance();
		}
		if(isset(self::$instance[$key]))
		{
			return self::$instance[$key];
		}
		else
		{
			return null;
		}
	}
	// -------------------------------------------------------------------------
	static function set($key, $value)
	{
		self::$instance[$key] = $value;
	}
	// -------------------------------------------------------------------------
	public function checkPost(BaseControler $controler)
	{
		$this->setInstance();
		if(isset(self::$instance["js"]))
		{
			$controler->js = true;
		}
	}
	// -------------------------------------------------------------------------
	protected static function setInstance()
	{
		$daneGET = self::preCheckVal($_REQUEST, "GET");
		$danePOST = self::preCheckVal($_POST, "POST");

		if(is_array($daneGET) && is_array($danePOST))
		{
			$request = array_merge($daneGET, $danePOST);
		}
		else if(is_array($daneGET))
		{
			$request = $daneGET;
		}
		else if(is_array($danePOST))
		{
			$request = $danePOST;
		}
		else
		{
			$request = null;
		}

		self::$instance = $request;
		if(!empty(self::$logger))
		{
			self::$logger->save(self::$instance);
		}
	}
	// -------------------------------------------------------------------------
	protected static function preCheckVal($array, $argName)
	{
		$retval = array();
		foreach($array as $name => $val)
		{
			$name = strtolower($name);
			$retval[$name] = self::checkVal($val, $argName . "[" . $name . "]");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected static function checkVal($argumentValue, $argumentName)
	{
		$retval = "";
		if(!is_array($argumentValue))
		{
			$retval = preg_replace('/[[:cntrl:]]/', '', $retval);
			$retval = htmlspecialchars($argumentValue, ENT_QUOTES, "UTF-8");
			$retval = trim($retval);
		}
		else
		{
			foreach($argumentValue as $klucz => $wartosc)
			{
				$klucz = strtolower($klucz);
				$retval[$klucz] = self::checkVal($wartosc, $argumentName);
			}
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>