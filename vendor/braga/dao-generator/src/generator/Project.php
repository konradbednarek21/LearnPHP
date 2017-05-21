<?php
namespace braga\daogenerator\generator;
/**
 * Created on 10-03-2013 16:09:53
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class Project
{
	// -------------------------------------------------------------------------
	const VERSION = "2.2.0";
	// -------------------------------------------------------------------------
	protected $xmlFile = null;
	protected $projectFolder = ".";
	protected $daoFolder = "dao";
	protected $objFolder = "obj";
	protected $author = null;
	protected $dataBaseStyle = DataBaseStyle::ORACLE;
	protected $name = "Project1";
	protected $nameSpace = null;
	protected $errorPrefix = null;
	// -------------------------------------------------------------------------
	protected $tables = array();
	// -------------------------------------------------------------------------
	public function addTable(Table $table)
	{
		if($this->isTableExists($table))
		{
			$this->mergeTable($table);
		}
		else
		{
			$this->tables[$table->getKey()] = $table;
		}
	}
	// -------------------------------------------------------------------------
	protected function mergeTable(Table $table)
	{
		/* @var $orgTable Table */
		$orgTable = $this->tables[$table->getKey()];
		foreach($table->getColumny() as $col)/* @var $col Column */
		{
			$table->setClassName($orgTable->getClassName());
			foreach($orgTable->getColumny() as $orgCol) /* @var $orgCol Column */
			{
				if($col->getName() == $orgCol->getName())
				{
					$col->setClassFieldName($orgCol->getClassFieldName());
				}
			}
		}
		foreach($table->getFk() as $fk) /* @var $fk ForeginKey */
		{
			foreach($orgTable->getFk() as $orgFk) /* @var $orgFk ForeginKey */
			{
				if($fk->getName() == $orgFk->getName())
				{
					$fk->setClassFieldName($orgFk->getClassFieldName());
				}
			}
		}
		$this->tables[$table->getKey()] = $table;
	}
	// -------------------------------------------------------------------------
	public function isTableExists(Table $table)
	{
		return isset($this->tables[$table->getKey()]);
	}
	// -------------------------------------------------------------------------
	public function getTables()
	{
		return $this->tables;
	}
	// -------------------------------------------------------------------------
	public function setXmlFile($xmlFile)
	{
		$this->xmlFile = $xmlFile;
	}
	// -------------------------------------------------------------------------
	public function setProjectFolder($projectFolder)
	{
		$this->projectFolder = $projectFolder;
	}
	// -------------------------------------------------------------------------
	public function setDaoFolder($daoFolder)
	{
		$this->daoFolder = $daoFolder;
	}
	// -------------------------------------------------------------------------
	public function setObjFolder($objFolder)
	{
		$this->objFolder = $objFolder;
	}
	// -------------------------------------------------------------------------
	public function setAuthor($author)
	{
		$this->author = $author;
	}
	public function setDataBaseStyle($dataBaseStyle)
	{
		$this->dataBaseStyle = $dataBaseStyle;
	}
	// -------------------------------------------------------------------------
	public function setName($name)
	{
		$this->name = $name;
	}
	// -------------------------------------------------------------------------
	public function setErrorPrefix($errorPrefix)
	{
		$this->errorPrefix = $errorPrefix;
	}
	// -------------------------------------------------------------------------
	public function setNameSpace($nameSpace)
	{
		$this->nameSpace = $nameSpace;
	}
	// -------------------------------------------------------------------------
	public function getXmlFile()
	{
		if(is_null($this->xmlFile))
		{
			return $this->getProjectFolder() . "\\dao.xml";
		}
		return $this->xmlFile;
	}
	// -------------------------------------------------------------------------
	public function getProjectFolder()
	{
		return $this->projectFolder;
	}
	// -------------------------------------------------------------------------
	public function getDaoFolder()
	{
		return $this->daoFolder;
	}
	// -------------------------------------------------------------------------
	public function getObjFolder()
	{
		return $this->objFolder;
	}
	// -------------------------------------------------------------------------
	public function getAuthor()
	{
		return $this->author;
	}
	// -------------------------------------------------------------------------
	public function getDataBaseStyle()
	{
		return $this->dataBaseStyle;
	}
	// -------------------------------------------------------------------------
	public function getName()
	{
		return $this->name;
	}
	// -------------------------------------------------------------------------
	public function getErrorPrefix()
	{
		return $this->errorPrefix;
	}
	// -------------------------------------------------------------------------
	public function getNameSpace()
	{
		return $this->nameSpace;
	}
	// -------------------------------------------------------------------------
}
?>