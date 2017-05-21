<?php

/**
 * Created on 12 sty 2014 17:35:45
 * error prefix
 * @author Tomasz Gajewski
 * @package frontoffice
 */
namespace braga\wordgame\common\base;

class CookieManager
{
	// -------------------------------------------------------------------------
	const UZYTKOWNIKID = "U";
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var int
	 * @staticvar 30*24*60*60
	 */
	const LIFETIME = 2592000;
	// -------------------------------------------------------------------------
	public static function set($key, $value)
	{
		if(!headers_sent())
		{
			return setcookie($key, $value, time() + self::LIFETIME, "/");
		}
		else
		{
			return false;
		}
	}
	// -------------------------------------------------------------------------
	public static function kill($key)
	{
		return setcookie($key, null, 0, "/");
	}
	// -------------------------------------------------------------------------
	public static function get($key)
	{
		if(isset($_COOKIE[$key]))
		{
			return $_COOKIE[$key];
		}
		else
		{
			return null;
		}
	}
	// -------------------------------------------------------------------------
	public static function isExist($key)
	{
		return isset($_COOKIE[$key]);
	}
	// -------------------------------------------------------------------------
}
?>