<?php
namespace braga\daogenerator\generator;
/**
 * Created on 10-03-2013 17:00:08
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class FilesGenerator
{
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var Project
	 */
	static $project = null;
	/**
	 *
	 * @var DOMDocument
	 */
	protected $xmlDocument = null;
	// -------------------------------------------------------------------------
	public static function GO(Project $p)
	{
		self::$project = $p;
		$f = new self();
		$f->init();
		$f->prepareDAOFile();
		$f->prepareClassFile();
		// $f->prepareMainFile();
		$f->finish();
	}
	// -------------------------------------------------------------------------
	protected function prepareMainFile()
	{
		$d = new MainFileGenerator(self::$project);
		$d->GO();
	}
	// -------------------------------------------------------------------------
	protected function prepareClassFile()
	{
		$d = new ClassFileGenerator(self::$project);
		$d->GO();
	}
	// -------------------------------------------------------------------------
	protected function prepareDAOFile()
	{
		switch(self::$project->getDataBaseStyle())
		{
			case DataBaseStyle::MYSQL:
				$d = new MySQLDAOFileGenerator(self::$project);
				break;
			case DataBaseStyle::PGSQL:
				$d = new PostgreDAOFileGenerator(self::$project);
				break;
			default :
				$d = new DAOFileGenerator(self::$project);
				break;
		}
		$d->GO();
	}
	// -------------------------------------------------------------------------
	protected function init()
	{
		if(file_exists(self::$project->getXmlFile()))
		{
			try
			{
				$this->xmlDocument = new \DOMDocument();
				$this->xmlDocument->load(self::$project->getXmlFile());
				$this->readProject();
				$this->createXmlDoc();
			}
			catch(\Exception $e)
			{
				echo $e->getMessage();
				unlink(self::$project->getXmlFile());
				$this->createXmlDoc();
			}
		}
		else
		{
			$this->createXmlDoc();
		}
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @param Project $p
	 * @return Project
	 */
	public static function loadFromXML(Project $p)
	{
		self::$project = $p;
		if(file_exists(self::$project->getXmlFile()))
		{
			try
			{
				$d = new self();
				$d->xmlDocument = new \DOMDocument();
				$d->xmlDocument->load(self::$project->getXmlFile());
				$d->readProject();
			}
			catch(\Exception $e)
			{
			}
		}
		return self::$project;
	}
	// -------------------------------------------------------------------------
	protected function readProject()
	{
		$p = $this->xmlDocument->getElementsByTagName("project")->item(0);

		if(!is_null($p->getAttribute("name")))
		{
			if(self::$project->getName() == "Project1")
			{
				self::$project->setName($p->getAttribute("name"));
			}
		}
		if(!is_null($p->getAttribute("author")))
		{
			if(is_null(self::$project->getAuthor()))
			{
				self::$project->setAuthor($p->getAttribute("author"));
			}
		}
		if(!is_null($p->getAttribute("errorPrefix")))
		{
			if(is_null(self::$project->getErrorPrefix()))
			{
				self::$project->setErrorPrefix($p->getAttribute("errorPrefix"));
			}
		}
		if(!is_null($p->getAttribute("namespace")))
		{
			if(is_null(self::$project->getNameSpace()))
			{
				self::$project->setNameSpace($p->getAttribute("namespace"));
			}
		}
		if(!is_null($p->getAttribute("dataBaseStyle")))
		{
			if(is_null(self::$project->getDataBaseStyle()))
			{
				self::$project->setDataBaseStyle($p->getAttribute("dataBaseStyle"));
			}
		}
		$tables = $p->getElementsByTagName("table");

		// odczyt tablic
		$tmp = array();
		foreach($tables as $t) /* @var $t DOMElement */
		{
			$table = Table::import($t);
			if(!self::$project->isTableExists($table))
			{
				self::$project->addTable($table);
				$tmp[$table->getKey()] = $table;
			}
		}
		// odczyt column
		foreach($tables as $t) /* @var $t DOMElement */
		{
			$table = Table::import($t);
			if(isset($tmp[$table->getKey()]))
			{
				foreach($t->getElementsByTagName("column") as $c)/*@var $c DOMElement */
				{
					$column = Column::import($c);
					$tmp = self::$project->getTables();
					$tmp[$table->getKey()]->addColumn($column);
				}
				foreach($t->getElementsByTagName("fk") as $c)/*@var $c DOMElement */
				{
					$fk = ForeginKey::import($c);
					$tmp = self::$project->getTables();
					$tmp[$table->getKey()]->addFK($fk);
				}
			}
		}
	}
	// -------------------------------------------------------------------------
	protected function createXmlDoc()
	{
		$this->xmlDocument = new \DOMDocument("1.0", "UTF-8");
		$p = new \DOMElement("project", null);
		$this->xmlDocument->appendChild($p);
		$p->setAttribute("name", self::$project->getName());
		$p->setAttribute("author", self::$project->getAuthor());
		$p->setAttribute("errorPrefix", self::$project->getErrorPrefix());
		$p->setAttribute("namespace", self::$project->getNameSpace());
		$p->setAttribute("dataBaseStyle", self::$project->getDataBaseStyle());

		foreach(self::$project->getTables() as $table)/* @var $table Table */
		{
			$t = new \DOMElement("table");
			$p->appendChild($t);
			$table->export($t);
			foreach($table->getColumny() as $columna)/* @var $columna Column */
			{
				$c = new \DOMElement("column");
				$t->appendChild($c);
				$columna->export($c);
			}

			foreach($table->getFk() as $fk)/* @var $fk ForeginKey */
			{
				$k = new \DOMElement("fk");
				$t->appendChild($k);
				$fk->export($k);
			}
		}
	}
	// -------------------------------------------------------------------------
	protected function finish()
	{
		$dir = dirname(self::$project->getXmlFile());
		@mkdir($dir, 0777, true);
		$this->xmlDocument->formatOutput = true;
		$this->xmlDocument->save(self::$project->getXmlFile());
	}
	// -------------------------------------------------------------------------
}
?>