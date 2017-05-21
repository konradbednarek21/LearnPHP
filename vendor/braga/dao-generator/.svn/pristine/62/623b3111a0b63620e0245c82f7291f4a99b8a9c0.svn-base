<?php
namespace braga\daogenerator\generator;
/**
 * Created on 10-03-2013 16:02:19
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class Table
{
	// -------------------------------------------------------------------------
	protected $name = null;
	protected $schema = null;
	protected $className = null;
	protected $tableSpace = null;
	protected $indexTableSpace = null;
	protected $errorPrefix = null;
	// -------------------------------------------------------------------------
	protected $columns = array();
	protected $fk = array();
	protected $pk = null;
	// -------------------------------------------------------------------------
	public function addColumn(Column $c)
	{
		$this->columns[$c->getKey()] = $c;
	}
	// -------------------------------------------------------------------------
	public function addFK(ForeginKey $fk)
	{
		$this->fk[$fk->getName()] = $fk;
	}
	// -------------------------------------------------------------------------
	public function getPk()
	{
		if(is_null($this->pk))
		{
			$this->pk = array();
			foreach($this->getColumny() as $c)/* @var $c Column */
			{
				if($c->isPK())
				{
					$this->pk[] = $c;
				}
			}
		}
		return $this->pk;
	}
	// -------------------------------------------------------------------------
	public function getColumny()
	{
		return $this->columns;
	}
	// -------------------------------------------------------------------------
	public function getFk()
	{
		return $this->fk;
	}
	// -------------------------------------------------------------------------
	public function setName($name)
	{
		$this->name = $name;
	}
	// -------------------------------------------------------------------------
	public function setSchema($schema)
	{
		$this->schema = $schema;
	}
	// -------------------------------------------------------------------------
	public function setClassName($className)
	{
		$this->className = $className;
	}
	// -------------------------------------------------------------------------
	public function setTableSpace($tableSpace)
	{
		$this->tableSpace = $tableSpace;
	}
	// -------------------------------------------------------------------------
	public function setIndexTableSpace($indexTableSpace)
	{
		$this->indexTableSpace = $indexTableSpace;
	}
	// -------------------------------------------------------------------------
	public function setErrorPrefix($errorPrefix)
	{
		$this->errorPrefix = $errorPrefix;
	}
	// -------------------------------------------------------------------------
	public function getName()
	{
		return $this->name;
	}
	// -------------------------------------------------------------------------
	public function getSchema()
	{
		return $this->schema;
	}
	// -------------------------------------------------------------------------
	public function getClassName()
	{
		return $this->className;
	}
	// -------------------------------------------------------------------------
	public function getTableSpace()
	{
		return $this->tableSpace;
	}
	// -------------------------------------------------------------------------
	public function getIndexTableSpace()
	{
		return $this->indexTableSpace;
	}
	// -------------------------------------------------------------------------
	public function getErrorPrefix()
	{
		return $this->errorPrefix;
	}
	// -------------------------------------------------------------------------
	public function getKey()
	{
		if(!is_null($this->getSchema()))
		{
			return $this->getSchema() . "." . $this->getName();
		}
		elseif(!is_null($this->getName()))
		{
			return $this->getName();
		}
		else
		{
			throw new \Exception("Nie można dodać tablicy bez nazwy");
		}
	}
	// -------------------------------------------------------------------------
	public function addAutoPrimaryColumn()
	{
		if(!is_null($this->getName()))
		{
			if(!is_null($this->getClassName()))
			{
				$c = new Column();
				$c->setPK();
				$c->setAutoGenerate();
				$c->setClassFieldName("id" . $this->getClassName());
				$c->setName("ID" . $this->getName());
				$c->setSize(22);
				$c->setType(ColumnType::NUMBER);
				$this->addColumn($c);
			}
			else
			{
				throw new \Exception("Zbyt wczesne wywołanie. Nie okreslono nazwy klasy");
			}
		}
		else
		{
			throw new \Exception("Zbyt wczesne wywołanie. Nie określono nazwy tabeli");
		}
	}
	// -------------------------------------------------------------------------
	static function import(\DOMElement $table)
	{
		$t = new self();

		$name = $table->getAttribute("name");
		$schema = $table->getAttribute("schema");
		$className = $table->getAttribute("className");
		$tableSpace = $table->getAttribute("tableSpace");
		$indexTableSpace = $table->getAttribute("indexTableSpace");
		$errorPrefix = $table->getAttribute("errorPrefix");

		$t->setName($name);
		$t->setSchema($schema);
		$t->setClassName($className);
		$t->setTableSpace($tableSpace);
		$t->setIndexTableSpace($indexTableSpace);
		$t->setErrorPrefix($errorPrefix);

		return $t;
	}
	// -------------------------------------------------------------------------
	public function export(\DOMElement $t)
	{
		$t->setAttribute("name", $this->getName());
		$t->setAttribute("className", $this->getClassName());
		$t->setAttribute("tableSpace", $this->getTableSpace());
		$t->setAttribute("indexTableSpace", $this->getIndexTableSpace());
		$t->setAttribute("errorPrefix", $this->getErrorPrefix());
		$t->setAttribute("schema", $this->getSchema());
	}
	// -------------------------------------------------------------------------
}
?>