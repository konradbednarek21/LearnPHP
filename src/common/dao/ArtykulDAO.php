<?php
namespace braga\wordgame\common\dao;
use braga\db\DAO;
use braga\db\DataSource;
use braga\db\mysql\DB;
use braga\db\Collection;
/**
 * Created on 11-06-2017 09:54:12
 * @author Konrad Bednarek
 * @package FizWeb
 * error prefix FW:101
 * Genreated by SimplePHPDAOClassGenerator ver 2.2.0
 * https://sourceforge.net/projects/simplephpdaogen/ 
 * Designed by schama CRUD http://wikipedia.org/wiki/CRUD
 * class generated automatically, please do not modify under pain of 
 * OVERWRITTEN WITHOUT WARNING 
 */
class ArtykulDAO implements DAO
{
	// -------------------------------------------------------------------------
	protected static $instance = array();
	// -------------------------------------------------------------------------
	protected $idArtykul = null;
	protected $tytul = null;
	protected $tresc = null;
	protected $ostatniaAktualizacja = null;
	protected $idUzytkownik = null;
	protected $url = null;
	protected $idArtykulRodzic = null;
	protected $readed = false;
	// -------------------------------------------------------------------------
	/**
	 * @param int $idArtykul
	 */
	protected function __construct($idArtykul = null)
	{
		if(!is_null($idArtykul))
		{
			if(!$this->retrieve($idArtykul))
			{
				throw new \Exception("FW:10101 " . DB_SCHEMA . ".artykul(" . $idArtykul . ")  does not exists");
			}
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param int $idArtykul
	 * @return \braga\wordgame\common\obj\Artykul
	 */
	static function get($idArtykul = null)
	{
		if(count(self::$instance) > 100)
		{
			self::$instance = array();
		}
		if(is_numeric($idArtykul))
		{
			if(!isset(self::$instance[$idArtykul]))
			{
				self::$instance[$idArtykul] = new static($idArtykul);
			}
			return self::$instance[$idArtykul];
		}
		else
		{
			return self::$instance["\$".count(self::$instance)] = new static();
		}
	}
	// -------------------------------------------------------------------------
	protected static function updateFactoryIndex(ArtykulDAO $artykul)
	{
		$key = array_search($artykul,self::$instance,true);
		if($key !== false)
		{
			if($key !== $artykul->getIdArtykul())
			{
				unset(self::$instance[$key]);
				self::$instance[$artykul->getIdArtykul()] = $artykul;
			}
		}
		else
		{
			self::$instance[$artykul->getIdArtykul()] = $artykul;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param DataSource $db
	 * @return \braga\wordgame\common\obj\Artykul
	 */
	static function getByDataSource(DataSource $db)
	{
		$key = $db->f("idartykul");
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
	public function setIdArtykul($idArtykul)
	{
		if(is_numeric($idArtykul))
		{
			$this->idArtykul = round($idArtykul,0);
		}
		else
		{
			$this->idArtykul = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setTytul($tytul)
	{
		if(empty($tytul))
		{
			$this->tytul = null;
		}
		else
		{
			$this->tytul = mb_substr($tytul,0,255);
		}
	}
	// -------------------------------------------------------------------------
	public function setTresc($tresc)
	{
		$this->tresc = $tresc;
	}
	// -------------------------------------------------------------------------
	public function setOstatniaAktualizacja($ostatniaAktualizacja)
	{
		if(empty($ostatniaAktualizacja))
		{
			$this->ostatniaAktualizacja = null;
		}
		else
		{
			$this->ostatniaAktualizacja = date(PHP_DATETIME_FORMAT,strtotime($ostatniaAktualizacja));
		}
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
	public function setUrl($url)
	{
		if(empty($url))
		{
			$this->url = null;
		}
		else
		{
			$this->url = mb_substr($url,0,255);
		}
	}
	// -------------------------------------------------------------------------
	public function setIdArtykulRodzic($idArtykulRodzic)
	{
		if(is_numeric($idArtykulRodzic))
		{
			$this->idArtykulRodzic = round($idArtykulRodzic,0);
		}
		else
		{
			$this->idArtykulRodzic = null;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param ArtykulDAO $artykul
	 */
	public function setArtykulRodzic(ArtykulDAO $artykul)
	{
		$this->idArtykulRodzic = $artykul->getIdArtykul();
	}
	// -------------------------------------------------------------------------
	/**
	 * @param UzykownikDAO $uzykownik
	 */
	public function setUzytkownik(UzykownikDAO $uzykownik)
	{
		$this->idUzytkownik = $uzykownik->getIdUzytkownik();
	}
	// -------------------------------------------------------------------------
	public function getIdArtykul()
	{
		return $this->idArtykul;
	}
	// -------------------------------------------------------------------------
	public function getTytul()
	{
		return $this->tytul;
	}
	// -------------------------------------------------------------------------
	public function getTresc()
	{
		return $this->tresc;
	}
	// -------------------------------------------------------------------------
	public function getOstatniaAktualizacja()
	{
		return $this->ostatniaAktualizacja;
	}
	// -------------------------------------------------------------------------
	public function getIdUzytkownik()
	{
		return $this->idUzytkownik;
	}
	// -------------------------------------------------------------------------
	public function getUrl()
	{
		return $this->url;
	}
	// -------------------------------------------------------------------------
	public function getIdArtykulRodzic()
	{
		return $this->idArtykulRodzic;
	}
	// -------------------------------------------------------------------------
	public function getKey()
	{
		return $this->getIdArtykul();
	}
	// -------------------------------------------------------------------------
	/**
	 * @return \braga\wordgame\common\obj\Artykul
	 */
	public function getArtykulRodzic()
	{
		return \braga\wordgame\common\obj\Artykul::get($this->getIdArtykulRodzic());
	}
	// -------------------------------------------------------------------------
	/**
	 * @return \braga\wordgame\common\obj\Uzykownik
	 */
	public function getUzytkownik()
	{
		return \braga\wordgame\common\obj\Uzykownik::get($this->getIdUzytkownik());
	}
	// -------------------------------------------------------------------------
	/**
	 * Method read object of class Artykul you can read all of atrib by get...() function
	 * select record from table artykul
	 * @return boolean
	 */
	protected function retrieve($idArtykul)
	{
		$db = new DB();
		$sql  = "SELECT * FROM " . DB_SCHEMA . ".artykul ";
		$sql .= "WHERE idartykul = :IDARTYKUL ";
		$db->setParam("IDARTYKUL", $idArtykul);
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
	 * Methods add object of class Artykul
	 * insert record into table artykul
	 * @return boolean
	 */
	protected function create()
	{
		$db = new DB();
		$sql  = "INSERT INTO " . DB_SCHEMA . ".artykul(tytul, tresc, ostatnia_aktualizacja, iduzytkownik, url, idartykul_rodzic) ";
		$sql .= "VALUES(:TYTUL, :TRESC, :OSTATNIAAKTUALIZACJA, :IDUZYTKOWNIK, :URL, :IDARTYKULRODZIC) ";
		$db->setParam("TYTUL",$this->getTytul());
		$db->setParam("TRESC",$this->getTresc());
		$db->setParam("OSTATNIAAKTUALIZACJA",$this->getOstatniaAktualizacja());
		$db->setParam("IDUZYTKOWNIK",$this->getIdUzytkownik());
		$db->setParam("URL",$this->getUrl());
		$db->setParam("IDARTYKULRODZIC",$this->getIdArtykulRodzic());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			$this->setIdArtykul($db->getLastInsertID());
			self::updateFactoryIndex($this);
			$this->setReaded();
			return true;
		}
		else
		{
			AddAlert("FW:10102 Insert record into table artykul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method change object of class Artykul
	 * update record in table artykul
	 * @return boolean
	 */
	protected function update()
	{
		$db = new DB();
		$sql  = "UPDATE " . DB_SCHEMA . ".artykul ";
		$sql .= "SET tytul = :TYTUL ";
		$sql .= " , tresc = :TRESC ";
		$sql .= " , ostatnia_aktualizacja = :OSTATNIAAKTUALIZACJA ";
		$sql .= " , iduzytkownik = :IDUZYTKOWNIK ";
		$sql .= " , url = :URL ";
		$sql .= " , idartykul_rodzic = :IDARTYKULRODZIC ";
		$sql .= "WHERE idartykul = :IDARTYKUL ";
		$db->setParam("IDARTYKUL",$this->getIdArtykul());
		$db->setParam("TYTUL",$this->getTytul());
		$db->setParam("TRESC",$this->getTresc());
		$db->setParam("OSTATNIAAKTUALIZACJA",$this->getOstatniaAktualizacja());
		$db->setParam("IDUZYTKOWNIK",$this->getIdUzytkownik());
		$db->setParam("URL",$this->getUrl());
		$db->setParam("IDARTYKULRODZIC",$this->getIdArtykulRodzic());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10103 Update record in table artykul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method removes object of class Artykul
	 * removed are record from table artykul
	 * @return boolean
	 */
	protected function destroy()
	{
		$db = new DB();
		$sql  = "DELETE FROM " . DB_SCHEMA . ".artykul ";
		$sql .= "WHERE idartykul = :IDARTYKUL ";
		$db->setParam("IDARTYKUL", $this->getIdArtykul());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10104 Delete record from table artykul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods set all atributes in object of class Artykul from object class DB
	 * @return void
	 */
	protected function setAllFromDB(DataSource $db)
	{
		$this->setIdArtykul($db->f("idartykul"));
		$this->setTytul($db->f("tytul"));
		$this->setTresc($db->f("tresc"));
		$this->setOstatniaAktualizacja($db->f("ostatnia_aktualizacja"));
		$this->setIdUzytkownik($db->f("iduzytkownik"));
		$this->setUrl($db->f("url"));
		$this->setIdArtykulRodzic($db->f("idartykul_rodzic"));
		$this->setReaded();
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods return colection of  Artykul
	 * @return Collection &lt;Artykul&gt; 
	 */
	public static function getAllByArtykulRodzic(ArtykulDAO $artykul)
	{
		$db = new DB();
		$sql  = "SELECT * ";
		$sql .= "FROM " . DB_SCHEMA . ".artykul ";
		$sql .= "WHERE idartykul_rodzic = :IDARTYKUL_RODZIC ";
		$db->setParam("IDARTYKUL_RODZIC", $artykul->getIdArtykul());
		$db->query($sql);
		return new Collection($db, \braga\wordgame\common\obj\Artykul::get());
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods return colection of  Artykul
	 * @return Collection &lt;Artykul&gt; 
	 */
	public static function getAllByUzytkownik(UzykownikDAO $uzykownik)
	{
		$db = new DB();
		$sql  = "SELECT * ";
		$sql .= "FROM " . DB_SCHEMA . ".artykul ";
		$sql .= "WHERE iduzytkownik = :IDUZYTKOWNIK ";
		$db->setParam("IDUZYTKOWNIK", $uzykownik->getIdUzytkownik());
		$db->query($sql);
		return new Collection($db, \braga\wordgame\common\obj\Artykul::get());
	}
	// -------------------------------------------------------------------------
}
?>