<?php
namespace braga\wordgame\common\dao;
use braga\db\DAO;
use braga\db\DataSource;
use braga\db\mysql\DB;
use braga\db\Collection;
/**
 * Created on 17-09-2017 10:33:33
 * @author Konrad Bednarek
 * @package FizWeb
 * error prefix FW:103
 * Genreated by SimplePHPDAOClassGenerator ver 2.2.0
 * https://sourceforge.net/projects/simplephpdaogen/ 
 * Designed by schama CRUD http://wikipedia.org/wiki/CRUD
 * class generated automatically, please do not modify under pain of 
 * OVERWRITTEN WITHOUT WARNING 
 */
class PrawaModulDAO implements DAO
{
	// -------------------------------------------------------------------------
	protected static $instance = array();
	// -------------------------------------------------------------------------
	protected $idPrawaModul = null;
	protected $idUzytkownik = null;
	protected $idModul = null;
	protected $dataNadania = null;
	protected $dataOdebrania = null;
	protected $readed = false;
	// -------------------------------------------------------------------------
	/**
	 * @param int $idPrawaModul
	 */
	protected function __construct($idPrawaModul = null)
	{
		if(!is_null($idPrawaModul))
		{
			if(!$this->retrieve($idPrawaModul))
			{
				throw new \Exception("FW:10301 " . DB_SCHEMA . ".prawa_modul(" . $idPrawaModul . ")  does not exists");
			}
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param int $idPrawaModul
	 * @return \braga\wordgame\common\obj\PrawaModul
	 */
	static function get($idPrawaModul = null)
	{
		if(count(self::$instance) > 100)
		{
			self::$instance = array();
		}
		if(is_numeric($idPrawaModul))
		{
			if(!isset(self::$instance[$idPrawaModul]))
			{
				self::$instance[$idPrawaModul] = new static($idPrawaModul);
			}
			return self::$instance[$idPrawaModul];
		}
		else
		{
			return self::$instance["\$".count(self::$instance)] = new static();
		}
	}
	// -------------------------------------------------------------------------
	protected static function updateFactoryIndex(PrawaModulDAO $prawaModul)
	{
		$key = array_search($prawaModul,self::$instance,true);
		if($key !== false)
		{
			if($key !== $prawaModul->getIdPrawaModul())
			{
				unset(self::$instance[$key]);
				self::$instance[$prawaModul->getIdPrawaModul()] = $prawaModul;
			}
		}
		else
		{
			self::$instance[$prawaModul->getIdPrawaModul()] = $prawaModul;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param DataSource $db
	 * @return \braga\wordgame\common\obj\PrawaModul
	 */
	static function getByDataSource(DataSource $db)
	{
		$key = $db->f("idprawa_modul");
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
	public function setIdPrawaModul($idPrawaModul)
	{
		if(is_numeric($idPrawaModul))
		{
			$this->idPrawaModul = round($idPrawaModul,0);
		}
		else
		{
			$this->idPrawaModul = null;
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
	public function setIdModul($idModul)
	{
		if(is_numeric($idModul))
		{
			$this->idModul = round($idModul,0);
		}
		else
		{
			$this->idModul = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setDataNadania($dataNadania)
	{
		if(empty($dataNadania))
		{
			$this->dataNadania = null;
		}
		else
		{
			$this->dataNadania = date(PHP_DATETIME_FORMAT,strtotime($dataNadania));
		}
	}
	// -------------------------------------------------------------------------
	public function setDataOdebrania($dataOdebrania)
	{
		if(empty($dataOdebrania))
		{
			$this->dataOdebrania = null;
		}
		else
		{
			$this->dataOdebrania = date(PHP_DATETIME_FORMAT,strtotime($dataOdebrania));
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param ModulDAO $modul
	 */
	public function setModul(ModulDAO $modul)
	{
		$this->idModul = $modul->getIdModul();
	}
	// -------------------------------------------------------------------------
	/**
	 * @param UzytkownikDAO $uzytkownik
	 */
	public function setUzytkownik(UzytkownikDAO $uzytkownik)
	{
		$this->idUzytkownik = $uzytkownik->getIdUzytkownik();
	}
	// -------------------------------------------------------------------------
	public function getIdPrawaModul()
	{
		return $this->idPrawaModul;
	}
	// -------------------------------------------------------------------------
	public function getIdUzytkownik()
	{
		return $this->idUzytkownik;
	}
	// -------------------------------------------------------------------------
	public function getIdModul()
	{
		return $this->idModul;
	}
	// -------------------------------------------------------------------------
	public function getDataNadania()
	{
		return $this->dataNadania;
	}
	// -------------------------------------------------------------------------
	public function getDataOdebrania()
	{
		return $this->dataOdebrania;
	}
	// -------------------------------------------------------------------------
	public function getKey()
	{
		return $this->getIdPrawaModul();
	}
	// -------------------------------------------------------------------------
	/**
	 * @return \braga\wordgame\common\obj\Modul
	 */
	public function getModul()
	{
		return \braga\wordgame\common\obj\Modul::get($this->getIdModul());
	}
	// -------------------------------------------------------------------------
	/**
	 * @return \braga\wordgame\common\obj\Uzytkownik
	 */
	public function getUzytkownik()
	{
		return \braga\wordgame\common\obj\Uzytkownik::get($this->getIdUzytkownik());
	}
	// -------------------------------------------------------------------------
	/**
	 * Method read object of class PrawaModul you can read all of atrib by get...() function
	 * select record from table prawa_modul
	 * @return boolean
	 */
	protected function retrieve($idPrawaModul)
	{
		$db = new DB();
		$sql  = "SELECT * FROM " . DB_SCHEMA . ".prawa_modul ";
		$sql .= "WHERE idprawa_modul = :IDPRAWA_MODUL ";
		$db->setParam("IDPRAWA_MODUL", $idPrawaModul);
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
	 * Methods add object of class PrawaModul
	 * insert record into table prawa_modul
	 * @return boolean
	 */
	protected function create()
	{
		$db = new DB();
		$sql  = "INSERT INTO " . DB_SCHEMA . ".prawa_modul(iduzytkownik, idmodul, data_nadania, data_odebrania) ";
		$sql .= "VALUES(:IDUZYTKOWNIK, :IDMODUL, :DATANADANIA, :DATAODEBRANIA) ";
		$db->setParam("IDUZYTKOWNIK",$this->getIdUzytkownik());
		$db->setParam("IDMODUL",$this->getIdModul());
		$db->setParam("DATANADANIA",$this->getDataNadania());
		$db->setParam("DATAODEBRANIA",$this->getDataOdebrania());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			$this->setIdPrawaModul($db->getLastInsertID());
			self::updateFactoryIndex($this);
			$this->setReaded();
			return true;
		}
		else
		{
			AddAlert("FW:10302 Insert record into table prawa_modul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method change object of class PrawaModul
	 * update record in table prawa_modul
	 * @return boolean
	 */
	protected function update()
	{
		$db = new DB();
		$sql  = "UPDATE " . DB_SCHEMA . ".prawa_modul ";
		$sql .= "SET iduzytkownik = :IDUZYTKOWNIK ";
		$sql .= " , idmodul = :IDMODUL ";
		$sql .= " , data_nadania = :DATANADANIA ";
		$sql .= " , data_odebrania = :DATAODEBRANIA ";
		$sql .= "WHERE idprawa_modul = :IDPRAWAMODUL ";
		$db->setParam("IDPRAWAMODUL",$this->getIdPrawaModul());
		$db->setParam("IDUZYTKOWNIK",$this->getIdUzytkownik());
		$db->setParam("IDMODUL",$this->getIdModul());
		$db->setParam("DATANADANIA",$this->getDataNadania());
		$db->setParam("DATAODEBRANIA",$this->getDataOdebrania());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10303 Update record in table prawa_modul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method removes object of class PrawaModul
	 * removed are record from table prawa_modul
	 * @return boolean
	 */
	protected function destroy()
	{
		$db = new DB();
		$sql  = "DELETE FROM " . DB_SCHEMA . ".prawa_modul ";
		$sql .= "WHERE idprawa_modul = :IDPRAWA_MODUL ";
		$db->setParam("IDPRAWA_MODUL", $this->getIdPrawaModul());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10304 Delete record from table prawa_modul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods set all atributes in object of class PrawaModul from object class DB
	 * @return void
	 */
	protected function setAllFromDB(DataSource $db)
	{
		$this->setIdPrawaModul($db->f("idprawa_modul"));
		$this->setIdUzytkownik($db->f("iduzytkownik"));
		$this->setIdModul($db->f("idmodul"));
		$this->setDataNadania($db->f("data_nadania"));
		$this->setDataOdebrania($db->f("data_odebrania"));
		$this->setReaded();
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods return colection of  PrawaModul
	 * @return Collection &lt;PrawaModul&gt; 
	 */
	public static function getAllByModul(ModulDAO $modul)
	{
		$db = new DB();
		$sql  = "SELECT * ";
		$sql .= "FROM " . DB_SCHEMA . ".prawa_modul ";
		$sql .= "WHERE idmodul = :IDMODUL ";
		$db->setParam("IDMODUL", $modul->getIdModul());
		$db->query($sql);
		return new Collection($db, \braga\wordgame\common\obj\PrawaModul::get());
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods return colection of  PrawaModul
	 * @return Collection &lt;PrawaModul&gt; 
	 */
	public static function getAllByUzytkownik(UzytkownikDAO $uzytkownik)
	{
		$db = new DB();
		$sql  = "SELECT * ";
		$sql .= "FROM " . DB_SCHEMA . ".prawa_modul ";
		$sql .= "WHERE iduzytkownik = :IDUZYTKOWNIK ";
		$db->setParam("IDUZYTKOWNIK", $uzytkownik->getIdUzytkownik());
		$db->query($sql);
		return new Collection($db, \braga\wordgame\common\obj\PrawaModul::get());
	}
	// -------------------------------------------------------------------------
}
?>