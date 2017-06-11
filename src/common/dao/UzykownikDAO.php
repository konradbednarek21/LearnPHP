<?php
namespace braga\wordgame\common\dao;
use braga\db\DAO;
use braga\db\DataSource;
use braga\db\mysql\DB;
/**
 * Created on 11-06-2017 09:54:12
 * @author Konrad Bednarek
 * @package FizWeb
 * error prefix FW:102
 * Genreated by SimplePHPDAOClassGenerator ver 2.2.0
 * https://sourceforge.net/projects/simplephpdaogen/ 
 * Designed by schama CRUD http://wikipedia.org/wiki/CRUD
 * class generated automatically, please do not modify under pain of 
 * OVERWRITTEN WITHOUT WARNING 
 */
class UzykownikDAO implements DAO
{
	// -------------------------------------------------------------------------
	protected static $instance = array();
	// -------------------------------------------------------------------------
	protected $idUzytkownik = null;
	protected $email = null;
	protected $haslo = null;
	protected $imie = null;
	protected $nazwisko = null;
	protected $status = null;
	protected $readed = false;
	// -------------------------------------------------------------------------
	/**
	 * @param int $idUzytkownik
	 */
	protected function __construct($idUzytkownik = null)
	{
		if(!is_null($idUzytkownik))
		{
			if(!$this->retrieve($idUzytkownik))
			{
				throw new \Exception("FW:10201 " . DB_SCHEMA . ".uzykownik(" . $idUzytkownik . ")  does not exists");
			}
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param int $idUzytkownik
	 * @return \braga\wordgame\common\obj\Uzykownik
	 */
	static function get($idUzytkownik = null)
	{
		if(count(self::$instance) > 100)
		{
			self::$instance = array();
		}
		if(is_numeric($idUzytkownik))
		{
			if(!isset(self::$instance[$idUzytkownik]))
			{
				self::$instance[$idUzytkownik] = new static($idUzytkownik);
			}
			return self::$instance[$idUzytkownik];
		}
		else
		{
			return self::$instance["\$".count(self::$instance)] = new static();
		}
	}
	// -------------------------------------------------------------------------
	protected static function updateFactoryIndex(UzykownikDAO $uzykownik)
	{
		$key = array_search($uzykownik,self::$instance,true);
		if($key !== false)
		{
			if($key !== $uzykownik->getIdUzytkownik())
			{
				unset(self::$instance[$key]);
				self::$instance[$uzykownik->getIdUzytkownik()] = $uzykownik;
			}
		}
		else
		{
			self::$instance[$uzykownik->getIdUzytkownik()] = $uzykownik;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param DataSource $db
	 * @return \braga\wordgame\common\obj\Uzykownik
	 */
	static function getByDataSource(DataSource $db)
	{
		$key = $db->f("iduzytkownik");
		if(!isset(self::$instance[$key]))
		{
			self::$instance[$key] = new static();
			self::$instance[$key]->setAllFromDB($db);
		}
		return self::$instance[$key];
	}
	// -------------------------------------------------------------------------
	protected function isReaded()
	{
		return $this->readed;
	}
	// -------------------------------------------------------------------------
	protected function setReaded()
	{
		$this->readed = true;
	}
	// -------------------------------------------------------------------------
	public function setIdUzytkownik($idUzytkownik)
	{
		if(is_numeric($idUzytkownik))
		{
			$this->idUzytkownik = round($idUzytkownik,0);
		}
		else
		{
			$this->idUzytkownik = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setEmail($email)
	{
		if(empty($email))
		{
			$this->email = null;
		}
		else
		{
			$this->email = mb_substr($email,0,255);
		}
	}
	// -------------------------------------------------------------------------
	public function setHaslo($haslo)
	{
		if(empty($haslo))
		{
			$this->haslo = null;
		}
		else
		{
			$this->haslo = mb_substr($haslo,0,128);
		}
	}
	// -------------------------------------------------------------------------
	public function setImie($imie)
	{
		if(empty($imie))
		{
			$this->imie = null;
		}
		else
		{
			$this->imie = mb_substr($imie,0,255);
		}
	}
	// -------------------------------------------------------------------------
	public function setNazwisko($nazwisko)
	{
		if(empty($nazwisko))
		{
			$this->nazwisko = null;
		}
		else
		{
			$this->nazwisko = mb_substr($nazwisko,0,255);
		}
	}
	// -------------------------------------------------------------------------
	public function setStatus($status)
	{
		$this->status = $status;
	}
	// -------------------------------------------------------------------------
	public function getIdUzytkownik()
	{
		return $this->idUzytkownik;
	}
	// -------------------------------------------------------------------------
	public function getEmail()
	{
		return $this->email;
	}
	// -------------------------------------------------------------------------
	public function getHaslo()
	{
		return $this->haslo;
	}
	// -------------------------------------------------------------------------
	public function getImie()
	{
		return $this->imie;
	}
	// -------------------------------------------------------------------------
	public function getNazwisko()
	{
		return $this->nazwisko;
	}
	// -------------------------------------------------------------------------
	public function getStatus()
	{
		return $this->status;
	}
	// -------------------------------------------------------------------------
	public function getKey()
	{
		return $this->getIdUzytkownik();
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods returns colection of objects Artykul
	 * @return Collection &lt;Artykul&gt; 
	 */
	public function getArtykulsForUzytkownik()
	{
		return \braga\wordgame\common\obj\Artykul::getAllByUzytkownik($this);
	}
	// -------------------------------------------------------------------------
	/**
	 * Method read object of class Uzykownik you can read all of atrib by get...() function
	 * select record from table uzykownik
	 * @return boolean
	 */
	protected function retrieve($idUzytkownik)
	{
		$db = new DB();
		$sql  = "SELECT * FROM " . DB_SCHEMA . ".uzykownik ";
		$sql .= "WHERE iduzytkownik = :IDUZYTKOWNIK ";
		$db->setParam("IDUZYTKOWNIK", $idUzytkownik);
		$db->query($sql);
		if($db->nextRecord())
		{
			$this->setAllFromDB($db);
			return true;
		}
		else
		{
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods add object of class Uzykownik
	 * insert record into table uzykownik
	 * @return boolean
	 */
	protected function create()
	{
		$db = new DB();
		$sql  = "INSERT INTO " . DB_SCHEMA . ".uzykownik(email, haslo, imie, nazwisko, status) ";
		$sql .= "VALUES(:EMAIL, :HASLO, :IMIE, :NAZWISKO, :STATUS) ";
		$db->setParam("EMAIL",$this->getEmail());
		$db->setParam("HASLO",$this->getHaslo());
		$db->setParam("IMIE",$this->getImie());
		$db->setParam("NAZWISKO",$this->getNazwisko());
		$db->setParam("STATUS",$this->getStatus());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			$this->setIdUzytkownik($db->getLastInsertID());
			self::updateFactoryIndex($this);
			$this->setReaded();
			return true;
		}
		else
		{
			AddAlert("FW:10202 Insert record into table uzykownik fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method change object of class Uzykownik
	 * update record in table uzykownik
	 * @return boolean
	 */
	protected function update()
	{
		$db = new DB();
		$sql  = "UPDATE " . DB_SCHEMA . ".uzykownik ";
		$sql .= "SET email = :EMAIL ";
		$sql .= " , haslo = :HASLO ";
		$sql .= " , imie = :IMIE ";
		$sql .= " , nazwisko = :NAZWISKO ";
		$sql .= " , status = :STATUS ";
		$sql .= "WHERE iduzytkownik = :IDUZYTKOWNIK ";
		$db->setParam("IDUZYTKOWNIK",$this->getIdUzytkownik());
		$db->setParam("EMAIL",$this->getEmail());
		$db->setParam("HASLO",$this->getHaslo());
		$db->setParam("IMIE",$this->getImie());
		$db->setParam("NAZWISKO",$this->getNazwisko());
		$db->setParam("STATUS",$this->getStatus());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10203 Update record in table uzykownik fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method removes object of class Uzykownik
	 * removed are record from table uzykownik
	 * @return boolean
	 */
	protected function destroy()
	{
		$db = new DB();
		$sql  = "DELETE FROM " . DB_SCHEMA . ".uzykownik ";
		$sql .= "WHERE iduzytkownik = :IDUZYTKOWNIK ";
		$db->setParam("IDUZYTKOWNIK", $this->getIdUzytkownik());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10204 Delete record from table uzykownik fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods set all atributes in object of class Uzykownik from object class DB
	 * @return void
	 */
	protected function setAllFromDB(DataSource $db)
	{
		$this->setIdUzytkownik($db->f("iduzytkownik"));
		$this->setEmail($db->f("email"));
		$this->setHaslo($db->f("haslo"));
		$this->setImie($db->f("imie"));
		$this->setNazwisko($db->f("nazwisko"));
		$this->setStatus($db->f("status"));
		$this->setReaded();
	}
	// -------------------------------------------------------------------------
}
?>