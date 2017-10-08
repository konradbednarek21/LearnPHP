<?php
namespace braga\wordgame\common\dao;
use braga\db\DAO;
use braga\db\DataSource;
use braga\db\mysql\DB;
/**
 * Created on 17-09-2017 10:15:43
 * @author Konrad Bednarek
 * @package FizWeb
 * error prefix FW:101
 * Genreated by SimplePHPDAOClassGenerator ver 2.2.0
 * https://sourceforge.net/projects/simplephpdaogen/ 
 * Designed by schama CRUD http://wikipedia.org/wiki/CRUD
 * class generated automatically, please do not modify under pain of 
 * OVERWRITTEN WITHOUT WARNING 
 */
class UserDAO implements DAO
{
	// -------------------------------------------------------------------------
	protected static $instance = array();
	// -------------------------------------------------------------------------
	protected $idUser = null;
	protected $user = null;
	protected $pass = null;
	protected $email = null;
	protected $points = null;
	protected $countAddWord = null;
	protected $countFailWord = null;
	protected $api = null;
	protected $countGetWordApi = null;
	protected $readed = false;
	// -------------------------------------------------------------------------
	/**
	 * @param int $idUser
	 */
	protected function __construct($idUser = null)
	{
		if(!is_null($idUser))
		{
			if(!$this->retrieve($idUser))
			{
				throw new \Exception("FW:10101 " . DB_SCHEMA . ".user(" . $idUser . ")  does not exists");
			}
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param int $idUser
	 * @return \braga\wordgame\common\obj\User
	 */
	static function get($idUser = null)
	{
		if(count(self::$instance) > 100)
		{
			self::$instance = array();
		}
		if(is_numeric($idUser))
		{
			if(!isset(self::$instance[$idUser]))
			{
				self::$instance[$idUser] = new static($idUser);
			}
			return self::$instance[$idUser];
		}
		else
		{
			return self::$instance["\$".count(self::$instance)] = new static();
		}
	}
	// -------------------------------------------------------------------------
	protected static function updateFactoryIndex(UserDAO $user)
	{
		$key = array_search($user,self::$instance,true);
		if($key !== false)
		{
			if($key !== $user->getIdUser())
			{
				unset(self::$instance[$key]);
				self::$instance[$user->getIdUser()] = $user;
			}
		}
		else
		{
			self::$instance[$user->getIdUser()] = $user;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * @param DataSource $db
	 * @return \braga\wordgame\common\obj\User
	 */
	static function getByDataSource(DataSource $db)
	{
		$key = $db->f("iduser");
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
	public function setIdUser($idUser)
	{
		if(is_numeric($idUser))
		{
			$this->idUser = round($idUser,0);
		}
		else
		{
			$this->idUser = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setUser($user)
	{
		$this->user = $user;
	}
	// -------------------------------------------------------------------------
	public function setPass($pass)
	{
		$this->pass = $pass;
	}
	// -------------------------------------------------------------------------
	public function setEmail($email)
	{
		$this->email = $email;
	}
	// -------------------------------------------------------------------------
	public function setPoints($points)
	{
		if(is_numeric($points))
		{
			$this->points = round($points,0);
		}
		else
		{
			$this->points = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setCountAddWord($countAddWord)
	{
		if(is_numeric($countAddWord))
		{
			$this->countAddWord = round($countAddWord,0);
		}
		else
		{
			$this->countAddWord = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setCountFailWord($countFailWord)
	{
		if(is_numeric($countFailWord))
		{
			$this->countFailWord = round($countFailWord,0);
		}
		else
		{
			$this->countFailWord = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setApi($api)
	{
		if(is_numeric($api))
		{
			$this->api = round($api,0);
		}
		else
		{
			$this->api = null;
		}
	}
	// -------------------------------------------------------------------------
	public function setCountGetWordApi($countGetWordApi)
	{
		if(is_numeric($countGetWordApi))
		{
			$this->countGetWordApi = round($countGetWordApi,0);
		}
		else
		{
			$this->countGetWordApi = null;
		}
	}
	// -------------------------------------------------------------------------
	public function getIdUser()
	{
		return $this->idUser;
	}
	// -------------------------------------------------------------------------
	public function getUser()
	{
		return $this->user;
	}
	// -------------------------------------------------------------------------
	public function getPass()
	{
		return $this->pass;
	}
	// -------------------------------------------------------------------------
	public function getEmail()
	{
		return $this->email;
	}
	// -------------------------------------------------------------------------
	public function getPoints()
	{
		return $this->points;
	}
	// -------------------------------------------------------------------------
	public function getCountAddWord()
	{
		return $this->countAddWord;
	}
	// -------------------------------------------------------------------------
	public function getCountFailWord()
	{
		return $this->countFailWord;
	}
	// -------------------------------------------------------------------------
	public function getApi()
	{
		return $this->api;
	}
	// -------------------------------------------------------------------------
	public function getCountGetWordApi()
	{
		return $this->countGetWordApi;
	}
	// -------------------------------------------------------------------------
	public function getKey()
	{
		return $this->getIdUser();
	}
	// -------------------------------------------------------------------------
	/**
	 * Method read object of class User you can read all of atrib by get...() function
	 * select record from table user
	 * @return boolean
	 */
	protected function retrieve($idUser)
	{
		$db = new DB();
		$sql  = "SELECT * FROM " . DB_SCHEMA . ".user ";
		$sql .= "WHERE iduser = :IDUSER ";
		$db->setParam("IDUSER", $idUser);
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
	 * Methods add object of class User
	 * insert record into table user
	 * @return boolean
	 */
	protected function create()
	{
		$db = new DB();
		$sql  = "INSERT INTO " . DB_SCHEMA . ".user(user, pass, email, points, count_add_word, count_fail_word, api, count_get_word_api) ";
		$sql .= "VALUES(:USER, :PASS, :EMAIL, :POINTS, :COUNTADDWORD, :COUNTFAILWORD, :API, :COUNTGETWORDAPI) ";
		$db->setParam("USER",$this->getUser());
		$db->setParam("PASS",$this->getPass());
		$db->setParam("EMAIL",$this->getEmail());
		$db->setParam("POINTS",$this->getPoints());
		$db->setParam("COUNTADDWORD",$this->getCountAddWord());
		$db->setParam("COUNTFAILWORD",$this->getCountFailWord());
		$db->setParam("API",$this->getApi());
		$db->setParam("COUNTGETWORDAPI",$this->getCountGetWordApi());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			$this->setIdUser($db->getLastInsertID());
			self::updateFactoryIndex($this);
			$this->setReaded();
			return true;
		}
		else
		{
			AddAlert("FW:10102 Insert record into table user fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method change object of class User
	 * update record in table user
	 * @return boolean
	 */
	protected function update()
	{
		$db = new DB();
		$sql  = "UPDATE " . DB_SCHEMA . ".user ";
		$sql .= "SET user = :USER ";
		$sql .= " , pass = :PASS ";
		$sql .= " , email = :EMAIL ";
		$sql .= " , points = :POINTS ";
		$sql .= " , count_add_word = :COUNTADDWORD ";
		$sql .= " , count_fail_word = :COUNTFAILWORD ";
		$sql .= " , api = :API ";
		$sql .= " , count_get_word_api = :COUNTGETWORDAPI ";
		$sql .= "WHERE iduser = :IDUSER ";
		$db->setParam("IDUSER",$this->getIdUser());
		$db->setParam("USER",$this->getUser());
		$db->setParam("PASS",$this->getPass());
		$db->setParam("EMAIL",$this->getEmail());
		$db->setParam("POINTS",$this->getPoints());
		$db->setParam("COUNTADDWORD",$this->getCountAddWord());
		$db->setParam("COUNTFAILWORD",$this->getCountFailWord());
		$db->setParam("API",$this->getApi());
		$db->setParam("COUNTGETWORDAPI",$this->getCountGetWordApi());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10103 Update record in table user fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Method removes object of class User
	 * removed are record from table user
	 * @return boolean
	 */
	protected function destroy()
	{
		$db = new DB();
		$sql  = "DELETE FROM " . DB_SCHEMA . ".user ";
		$sql .= "WHERE iduser = :IDUSER ";
		$db->setParam("IDUSER", $this->getIdUser());
		$db->query($sql);
		if(1 == $db->getRowAffected())
		{
			return true;
		}
		else
		{
			AddAlert("FW:10104 Delete record from table user fail");
			return false;
		}
	}
	// -------------------------------------------------------------------------
	/**
	 * Methods set all atributes in object of class User from object class DB
	 * @return void
	 */
	protected function setAllFromDB(DataSource $db)
	{
		$this->setIdUser($db->f("iduser"));
		$this->setUser($db->f("user"));
		$this->setPass($db->f("pass"));
		$this->setEmail($db->f("email"));
		$this->setPoints($db->f("points"));
		$this->setCountAddWord($db->f("count_add_word"));
		$this->setCountFailWord($db->f("count_fail_word"));
		$this->setApi($db->f("api"));
		$this->setCountGetWordApi($db->f("count_get_word_api"));
		$this->setReaded();
	}
	// -------------------------------------------------------------------------
}
?>