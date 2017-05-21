<?php

namespace braga\tools\tools;

/**
 * Created on 20 mar 2015 20:07:29
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class SessManager
{
	// -------------------------------------------------------------------------
	const MESSAGE_INFO = "MI";
	const MESSAGE_WARNING = "MW";
	const MESSAGE_ALERT = "MA";
	const MESSAGE_SQL = "MS";
	// -------------------------------------------------------------------------
	public static function get($key)
	{
		if(isset($_SESSION[$key]))
		{
			return $_SESSION[$key];
		}
		else
		{
			return array();
		}
	}
	// -------------------------------------------------------------------------
	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}
	// -------------------------------------------------------------------------
	public static function add($key, $value)
	{
		if(empty($_SESSION[$key]))
		{
			$_SESSION[$key] = array();
		}
		$_SESSION[$key][] = $value;
	}
	// -------------------------------------------------------------------------
	public static function isExist($key)
	{
		return isset($_SESSION[$key]);
	}
	// -------------------------------------------------------------------------
	public static function kill($key)
	{
		unset($_SESSION[$key]);
	}
	// -------------------------------------------------------------------------
	public static function nuke()
	{
		session_destroy();
	}
	// -------------------------------------------------------------------------
	public static function regen()
	{
		session_regenerate_id();
	}
	// -------------------------------------------------------------------------
}
?>