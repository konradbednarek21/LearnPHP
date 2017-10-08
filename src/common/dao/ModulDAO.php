<?php
namespace braga\wordgame\common\dao;
use braga\db\DAO;
use braga\db\DataSource;
use braga\db\mysql\DB;
/**
 * Created on 17-09-2017 10:33:32
 * @author Konrad Bednarek
 * @package FizWeb
 * error prefix FW:102
 * Genreated by SimplePHPDAOClassGenerator ver 2.2.0
 * https://sourceforge.net/projects/simplephpdaogen/ 
 * Designed by schama CRUD http://wikipedia.org/wiki/CRUD
 * class generated automatically, please do not modify under pain of 
 * OVERWRITTEN WITHOUT WARNING 
 */
class ModulDAO implements DAO
{
	// -------------------------------------------------------------------------
	protected static $instance = array();
	// -------------------------------------------------------------------------
	protected $idModul = null;
	protected $nazwa = null;
	protected $folder = null;
	protected $readed = false;
	// -------------------------------------------------------------------------
	/**
	 * @param int $idModul
	 */
	protected function __construct($idModul = null)
	{
		if(!is_null($idModul))
		{
			if(!$this->retrieve($idModul))
			{
				throw new \Exception("FW:10201 " . DB_SCHEMA . ".modul(" . $idModul . ")  does not exists");
			}
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param int $idModul
	 * @return \braga\wordgame\common\obj\Modul
	 */
	static function get($idModul = null)
	{
		if(count(self::$instance) > 100)
		{
			self::$instance = array();
		}
		if(is_numeric($idModul))
		{
			if(!isset(self::$instance[$idModul]))
			{
				self::$instance[$idModul] = new static($idModul);
			}
			return self::$instance[$idModul];
		}
		else
		{
			return self::$instance["\$".count(self::$instance)] = new static();
		}
	}
	// -------------------------------------------------------------------------
	protected static function updateFactoryIndex(ModulDAO $modul)
	{
		$key = array_search($modul,self::$instance,true);
		if($key !== false)
		{
			if($key !== $modul->getIdModul())
			{
				unset(self::$instance[$key]);
				self::$instance[$modul->getIdModul()] = $modul;
			}
		}
		else
		{
			self::$instance[$modul->getIdModul()] = $modul;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param DataSource $db
	 * @return \braga\wordgame\common\obj\Modul
	 */
	static function getByDataSource(DataSource $db)
	{
		$key = $db->f("idmodul");
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
	public function setNazwa($nazwa)
	{
		if(empty($nazwa))
		{
			$this->nazwa = null;
		}
		else
		{
			$this->nazwa = mb_substr($nazwa,0,255);
		}
	}
	// -------------------------------------------------------------------------
	public function setFolder($folder)
	{
		if(empty($folder))
		{
			$this->folder = null;
		}
		else
		{
			$this->folder = mb_substr($folder,0,255);
		}
	}
	// -------------------------------------------------------------------------
	public function getIdModul()
	{
		return $this->idModul;
	}
	// -------------------------------------------------------------------------
	public function getNazwa()
	{
		return $this->nazwa;
	}
	// -------------------------------------------------------------------------
	public function getFolder()
	{
		return $this->folder;
	}
	// -------------------------------------------------------------------------
	public function getKey()
	{
		return $this->getIdModul();
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods returns colection of objects PrawaModul
	 * @return Collection &lt;PrawaModul&gt; 
	 */
	public function getPrawaModulsForModul()
	{
		return \braga\wordgame\common\obj\PrawaModul::getAllByModul($this);
	}
	// -------------------------------------------------------------------------
	/**
	 * Method read object of class Modul you can read all of atrib by get...() function
	 * select record from table modul
	 * @return boolean
	 */
	protected function retrieve($idModul)
	{
		$db = new DB();
		$sql  = "SELECT * FROM " . DB_SCHEMA . ".modul ";
		$sql .= "WHERE idmodul = :IDMODUL ";
		$db->setParam("IDMODUL", $idModul);
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
	 * Methods add object of class Modul
	 * insert record into table modul
	 * @return boolean
	 */
	protected function create()
	{
		$db = new DB();
		$sql  = "INSERT INTO " . DB_SCHEMA . ".modul(nazwa, folder) ";
		$sql .= "VALUES(:NAZWA, :FOLDER) ";
		$db->setParam("NAZWA",$this->getNazwa());
		$db->setParam("FOLDER",$this->getFolder());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			$this->setIdModul($db->getLastInsertID());
			self::updateFactoryIndex($this);
			$this->setReaded();
			return true;
		}
		else
		{
			AddAlert("FW:10202 Insert record into table modul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method change object of class Modul
	 * update record in table modul
	 * @return boolean
	 */
	protected function update()
	{
		$db = new DB();
		$sql  = "UPDATE " . DB_SCHEMA . ".modul ";
		$sql .= "SET nazwa = :NAZWA ";
		$sql .= " , folder = :FOLDER ";
		$sql .= "WHERE idmodul = :IDMODUL ";
		$db->setParam("IDMODUL",$this->getIdModul());
		$db->setParam("NAZWA",$this->getNazwa());
		$db->setParam("FOLDER",$this->getFolder());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10203 Update record in table modul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method removes object of class Modul
	 * removed are record from table modul
	 * @return boolean
	 */
	protected function destroy()
	{
		$db = new DB();
		$sql  = "DELETE FROM " . DB_SCHEMA . ".modul ";
		$sql .= "WHERE idmodul = :IDMODUL ";
		$db->setParam("IDMODUL", $this->getIdModul());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10204 Delete record from table modul fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods set all atributes in object of class Modul from object class DB
	 * @return void
	 */
	protected function setAllFromDB(DataSource $db)
	{
		$this->setIdModul($db->f("idmodul"));
		$this->setNazwa($db->f("nazwa"));
		$this->setFolder($db->f("folder"));
		$this->setReaded();
	}
	// -------------------------------------------------------------------------
}
?>