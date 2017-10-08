<?php

namespace braga\wordgame\backoffice\utils;

use braga\tools\tools\PostChecker;
use braga\wordgame\common\obj\Uzytkownik;
use braga\wordgame\common\obj\Modul;
use braga\wordgame\backoffice\views\PublicLayout;
use braga\wordgame\backoffice\controllers\StartController;

/**
 * Created on 16-10-2011 13:13:32
 *
 * @author Tomasz Gajewski
 * @package system
 *          error prefix DY:901
 */
class Perms {
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var Perms
	 */
	private static $instance = null;
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var Uzytkownik
	 */
	private $uzytkownik;
	/**
	 *
	 * @var Modul
	 */
	private $modul;
	// -------------------------------------------------------------------------
	private function __construct() {
	}
	// -------------------------------------------------------------------------
	private function __clone() {
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @param Modul $m
	 */
	public static function setCurentModul(Modul $m) {
		self::getInstance ()->modul = $m;
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @return Modul
	 */
	public static function getCurentModul() {
		return self::getInstance ()->modul;
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @param Uzytkownik $u
	 */
	public static function setCurrentUser(Uzytkownik $u) {
		self::getInstance ()->uzytkownik = $u;
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @return Uzytkownik
	 */
	public static function getCurrentUser() {
		if (self::getInstance ()->uzytkownik instanceof Uzytkownik) {
			return self::getInstance ()->uzytkownik;
		}
	}
	// -------------------------------------------------------------------------
	private static function getInstance() {
		if (empty ( self::$instance )) {
			self::$instance = new self ();
		}
		return self::$instance;
	}
	// -------------------------------------------------------------------------
	const LOGGEDIN_USERSID = "a";
	// -------------------------------------------------------------------------
	private function check($idModul) {
		if ($idModul > 0) {
			$m = Modul::get ( $idModul );
			if (! is_null ( $m )) {
				$this->modul = Modul::get ();
				if (isset ( $_SESSION [self::LOGGEDIN_USERSID] )) {
					try {
						$u = Uzytkownik::get ( $_SESSION [self::LOGGEDIN_USERSID] );
					} catch ( \Exception $e ) {
						$u = null;
						self::logout ();
					}
				} else {
					$u = $this->login ();
				}
				if (! is_null ( $u )) {
					if ($this->isHaveRights ( $u, $m )) {
						$this->modul = $m;
						$this->uzytkownik = $u;
						$_SESSION [self::LOGGEDIN_USERSID] = $u->getIdUzytkownik ();
						$this->checkPasswordExpire ( $u );
					} else {
						addAlert ( "DY:90101 Odmowa zalogowania" );
						$this->generateLoginForm ();
					}
				} else {
					$this->generateLoginForm ();
				}
			} else {
				addAlert ( "DY:90104 Moduł nie istnieje" );
				$this->generateLoginForm ();
			}
		} else {
			if (isset ( $_SESSION [self::LOGGEDIN_USERSID] )) {
				try {
					$u = Uzytkownik::get ( $_SESSION [self::LOGGEDIN_USERSID] );
				} catch ( \Exception $e ) {
					$u = null;
					self::logout ();
				}
			} else {
				$u = $this->login ();
			}
			if (! is_null ( $u )) {
				$this->modul = Modul::get ();
				$this->uzytkownik = $u;
				$_SESSION [self::LOGGEDIN_USERSID] = $u->getIdUzytkownik ();
				$this->checkPasswordExpire ( $u );
			} else {
				$this->modul = Modul::get ();
				$this->generateLoginForm ();
			}
		}
	}
	// -------------------------------------------------------------------------
	private function checkPasswordExpire(Uzytkownik $u) {
		// if($u->getPasswordExpire() < date(PHP_DATETIME_FORMAT) && $u->getCoIleDniZmianaHasla() > 0)
		// {
		// $this->generateChangePasswordForm();
		// }
		// else
		// {
		return;
		// }
	}
	// -------------------------------------------------------------------------
	public function doAction() {
		return false;
	}
	// -------------------------------------------------------------------------
	private function login() {
		if (! is_null ( PostChecker::get ( "u" ) ) && ! is_null ( PostChecker::get ( "p" ) )) {
			session_regenerate_id ( true );
			return Uzytkownik::login ( PostChecker::get ( "u" ), PostChecker::get ( "p" ) );
		} else {
			return null;
		}
	}
	// -------------------------------------------------------------------------
	private function generateLoginForm() {
		$l = new PublicLayout ();
		$l->out ();
		exit ();
	}
	// -------------------------------------------------------------------------
	private function generateChangePasswordForm() {
		$controler = new StartController();
		if (PostChecker::get ( "aktualne" ) == "") {
			addAlert ( "DY:90101 Twoje hasło wygasło i należy je zmienić aby kontynuować" );
			$controler->getActionForForceChangePassForm ();
		} else {
			$controler->getActionForForceChangePass ();
		}
	}
	// -------------------------------------------------------------------------
	private function isHaveRights(Uzytkownik $u, Modul $m) {
		if ($u->getStatus () == Uzytkownik::STATUS_OK) {
			return $u->czyPosiadaPrawo ( $m );
		}
		return false;
	}
	// -------------------------------------------------------------------------
	public static function logout() {
		session_regenerate_id ( true );
		session_destroy ();
		header ( "Location: /" );
		exit ();
	}
	// -------------------------------------------------------------------------
	public static function pageOpen($idModule = 0) {
		session_start ();
		Perms::getInstance ()->check ( $idModule );
	}
	// -------------------------------------------------------------------------
}
?>