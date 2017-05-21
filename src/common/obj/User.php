<?php

namespace braga\wordgame\common\obj;

use braga\db\DAO;
use braga\db\mysql\DB;
use braga\db\Collection;
use braga\wordgame\common\dao\UserDAO;

/**
 * Created on 16-01-2017 08:01:01
 * tabela user
 * error prefix WG:657
 * max error WG:65704
 * @author gromula
 * @package WG
 */
class User extends UserDAO implements DAO
{
	const UZYTKOWNIKID = "U";
	const STATUS_OK = "1";
	const STATUS_BLOCK = "2";
	const STATUS_OFF = "3";
	const STATUS_DELETED = "4";
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var User
	 */
	protected static $currentUzytkownik = null;
	// -------------------------------------------------------------------------
	public static function setCurrent(User $user)
	{
		self::$currentUzytkownik = $user;
	}
	// -------------------------------------------------------------------------
	public static function getCurrent()
	{
		return self::$currentUzytkownik;
	}
	// -------------------------------------------------------------------------
	protected function check()
	{
		return true;
	}
	// -------------------------------------------------------------------------
	public function save()
	{
		if($this->check())
		{
			if($this->isReaded())
			{
				return $this->update();
			}
			else
			{
				return $this->create();
			}
		}
		else
		{
			return false;
		}
	}
	// -------------------------------------------------------------------------
	public function kill()
	{
		return $this->destroy();
	}
	// -------------------------------------------------------------------------
	public function getLogin()
	{
		$array = explode("@", $this->getEmail());
		return $array[0];

	}
	// -------------------------------------------------------------------------
	public static function getAll()
	{
		$db = new DB();
		$sql = "SELECT * ";
		$sql .= "WHERE " . ORA_SCHEMA . ".user ";
		$db->query($sql);
		return new Collection($db, self::get());
	}
	// -------------------------------------------------------------------------
	public static function retrieveByUserName($nazwaUzytkownika)
	{
		$db = new DB();
		$sql = "SELECT * FROM " . ORA_SCHEMA . ".user ";
		$sql .= "WHERE email = :NAZWA_UZYTKOWNIKA ";
		$db->setParam("NAZWA_UZYTKOWNIKA", $nazwaUzytkownika);
		$db->query($sql);
		if($db->nextRecord())
		{
			return self::getByDataSource($db);
		}
		else
		{
			throw new \Exception("SV:11013 Konto nie istnieje");
		}
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @param string $email
	 * @param string $password
	 * @return Uzytkownik
	 */
	public static function login($userName, $password)
	{
		if($password != "")
		{
			try
			{
				$uzytkownik = self::retrieveByUserName($userName);
				try
				{
					// * @var $uzytkownik User */
					$password = htmlspecialchars_decode($password);
					if($password == $uzytkownik->getPass())
					{
						// $uzytkownik->zapiszPoprawneZalogowanie();
						return $uzytkownik;
					}
					else
					{
						// $uzytkownik->zapiszBledneZalogowanie();
						addAlert("WG:10918 Odmowa zalogowania: Użytkownik podaje złe hasło lub niezgodnę ze standardem aplikacji. ", 10918);
					}
				}
				catch(\Exception $e)
				{
					// $uzytkownik->zapiszBledneZalogowanie();
					addAlert("WG:10920 Odmowa zalogowania", 10920);
				}
			}
			catch(\Exception $e)
			{
				addAlert("WG:10922 Odmowa zalogowania: Podano zły login lub nie odnaleziono użytkownika w aplikacji.", 10922);
			}
		}
		else
		{
			addAlert("WG:10923 Odmowa zalogowania: Nie podano hasła.", 10923);
		}
		throw new \Exception("WG:10924 Odmowa zalogowania", 10924);
	}
	// -------------------------------------------------------------------------
}
?>