<?php

/**
 * Created on 16-10-2011 13:13:32
 * @author Tomasz Gajewski
 * @package orion
 * error prefix OR:400
 */
namespace braga\wordgame\frontoffice\utils;

use braga\wordgame\common\exceptions\PermNoUserNameException;
use braga\wordgame\frontoffice\controles\PublicWebControler;
use braga\tools\tools\SessManager;
use braga\tools\tools\CookieManager;
use braga\tools\tools\PostChecker;
use braga\wordgame\common\obj\User;

class Perms
{
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var Perms
	 */
	private static $instance;
	// -------------------------------------------------------------------------
	private function __construct()
	{
		if(SessManager::isExist(User::UZYTKOWNIKID))
		{
			try
			{
				self::setLoggedIn(User::get(SessManager::get(User::UZYTKOWNIKID)));
				return;
			}
			catch(\Exception $e)
			{
				self::logout();
			}
		}
		elseif(CookieManager::isExist(User::UZYTKOWNIKID))
		{
			try
			{
				self::setLoggedIn(User::get(CookieManager::get(User::UZYTKOWNIKID)));
				return;
			}
			catch(\Exception $e)
			{
				self::logout();
			}
		}
		try
		{
			$opiekun = $this->login();
			SessManager::regen();
			self::setLoggedIn($opiekun);
		}
		catch(PermNoUserNameException $e)
		{
			self::logout();
		}
		catch(\Exception $e)
		{
			self::logout();
		}
	}

	// -------------------------------------------------------------------------
	protected static function setLoggedIn(User $user)
	{
		SessManager::set(User::UZYTKOWNIKID, $user->getIdUser());
		User::setCurrent($user);
	}
	// -------------------------------------------------------------------------
	protected function login()
	{
		if(!is_null(PostChecker::get("u")))
		{
			return User::login(PostChecker::get("u"), PostChecker::get("p"));
		}
		else
		{
			throw new PermNoUserNameException("OR:40001 Błąd zalogowania", 40001);
		}
	}
	// -------------------------------------------------------------------------
	static function logout()
	{
		SessManager::nuke();
		CookieManager::kill(User::UZYTKOWNIKID);
		$c = new PublicWebControler();
		$c->doAction();
		exit();
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @return Perms
	 */
	public static function getInstance()
	{
		if(empty(self::$instance))
		{
			self::$instance = new Perms();
		}
		return self::$instance;
	}
	// -------------------------------------------------------------------------
	public static function startSession()
	{
		session_start();
		return self::getInstance();
	}
	// -------------------------------------------------------------------------
}
?>