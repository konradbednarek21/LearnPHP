<?php
namespace braga\daogenerator\generator;
/**
 * Created on 23-03-2013 07:57:30
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class DAOFileGenerator
{
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var Project
	 */
	protected $project = null;
	protected $fileHandle = null;
	// -------------------------------------------------------------------------
	function __construct(Project $p)
	{
		$this->project = $p;
	}
	// -------------------------------------------------------------------------
	public function GO()
	{
		foreach($this->project->getTables() as $t)/* @var	 $t Table */
		{
			$this->open($t);
			$this->generateNameSpace($t);
			$this->prepareClass($t);
			$this->close();
		}
	}
	// -------------------------------------------------------------------------
	protected function addLine($content, $tabLevel, $newLine = true)
	{
		$tmp = str_repeat("\t", $tabLevel);
		if($newLine)
		{
			$tmp .= $content . "\n";
		}
		else
		{
			$tmp .= $content;
		}
		fwrite($this->fileHandle, $tmp);
	}
	// -------------------------------------------------------------------------
	protected function prepareClass(Table $t)
	{
		$this->generateClassDocumentation($t);
		$this->generateClassHead($t);
		$this->generateProperties($t);
		$this->generateConstruktor($t);
		$this->generateStaticGetMethod($t);
		$this->generateUpdateFactoryIndex($t);
		$this->generateStaticGetByDataSourceMethod($t);
		$this->generateIsReaded();
		$this->generateSetters($t);
		$this->generateSetterObject($t);
		$this->generateGetters($t);
		$this->generateGetKey($t);
		$this->generateGetterCollection($t);
		$this->generateGetterObject($t);
		$this->generateRead($t);
		$this->generateCreate($t);
		$this->generateUpdate($t);
		$this->generateDestroy($t);

		$this->generateSetAllFromDB($t);
		$this->generateGetAllForForeginColumn($t);
		$this->generateClassFooter();
	}
	// -------------------------------------------------------------------------
	protected function generateGetKey($t)
	{
		$pkField = array();
		foreach($t->getColumny() as $c) /* @var $c Column */
		{
			if($c->isPK())
			{
				$pkField[] = $c;
			}
		}
		$tmp1 = array();
		foreach($pkField as $c) /* @var $c Column */
		{
			$tmp1[] = "\$this->get" . ucfirst($c->getClassFieldName()) . "()";
		}
		$this->addLine("public function getKey()", 1);
		$this->addLine("{", 1);
		$this->addLine("return " . implode(" . \"_\" . ", $tmp1) . ";", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateStaticGetByDataSourceMethod($t)
	{
		$pkField = array();
		foreach($t->getColumny() as $c) /* @var $c Column */
		{
			if($c->isPK())
			{
				$pkField[] = $c;
			}
		}
		$tmp1 = array();
		foreach($pkField as $c) /* @var $c Column */
		{
			$tmp1[] = "\$db->f(\"" . $c->getName() . "\")";
		}
		$this->addLine("/**", 1);
		$this->addLine(" * @param DataSource \$db", 1);
		$this->addLine(" * @return \\" . $this->project->getNameSpace() . $this->project->getObjFolder() . "\\" . $t->getClassName(), 1);
		$this->addLine(" */", 1);
		$this->addLine("static function getByDataSource(DataSource \$db)", 1);
		$this->addLine("{", 1);
		$this->addLine("\$key = " . implode(" . \"_\" . ", $tmp1) . ";", 2);
		$this->addLine("if(!isset(self::\$instance[\$key]))", 2);
		$this->addLine("{", 2);
		$this->addLine("self::\$instance[\$key] = new static();", 3);
		$this->addLine("self::\$instance[\$key]->setAllFromDB(\$db);", 3);
		$this->addLine("}", 2);
		$this->addLine("return self::\$instance[\$key];", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateUpdateFactoryIndex(Table $t)
	{
		$tmp1 = array();
		foreach($t->getPk() as $c) /* @var $c Column */
		{
			$tmp1[] = "\$" . lcfirst($t->getClassName()) . "->get" . ucfirst($c->getClassFieldName()) . "()";
		}

		$this->addLine("protected static function updateFactoryIndex(" . $t->getClassName() . "DAO \$" . lcfirst($t->getClassName()) . ")", 1);
		$this->addLine("{", 1);
		$this->addLine("\$key = array_search(\$" . lcfirst($t->getClassName()) . ",self::\$instance,true);", 2);
		$this->addLine("if(\$key !== false)", 2);
		$this->addLine("{", 2);
		$this->addLine("if(\$key !== " . implode(" . \"_\" . ", $tmp1) . ")", 3);
		$this->addLine("{", 3);
		$this->addLine("unset(self::\$instance[\$key]);", 4);
		$this->addLine("self::\$instance[" . implode(" . \"_\" . ", $tmp1) . "] = \$" . lcfirst($t->getClassName()) . ";", 4);
		$this->addLine("}", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("self::\$instance[" . implode(" . \"_\" . ", $tmp1) . "] = \$" . lcfirst($t->getClassName()) . ";", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateStaticGetMethod($t)
	{
		$pkField = array();
		foreach($t->getColumny() as $c) /* @var $c Column */
		{
			if($c->isPK())
			{
				$pkField[] = $c;
			}
		}

		$this->addLine("/**", 1);
		$tmp1 = array();
		$tmp2 = array();
		$tmp3 = array();
		foreach($pkField as $c) /* @var $c Column */
		{
			$this->addLine(" * @param int \$" . $c->getClassFieldName() . "", 1);
			$tmp1[] = "\$" . $c->getClassFieldName() . " = null";
			switch($c->getType())
			{
				case ColumnType::FLOAT:
				case ColumnType::NUMBER:
					$tmp2[] = "is_numeric(\$" . $c->getClassFieldName() . ")";
					break;
				default :
					$tmp2[] = "!empty(\$" . $c->getClassFieldName() . ")";
					break;
			}
			$tmp3[] = "\$" . $c->getClassFieldName();
		}

		$this->addLine(" * @return \\" . $this->project->getNameSpace() . $this->project->getObjFolder() . "\\" . $t->getClassName(), 1);
		$this->addLine(" */", 1);
		$this->addLine("static function get(" . implode(", ", $tmp1) . ")", 1);
		$this->addLine("{", 1);
		$this->addLine("if(count(self::\$instance) > 100)", 2);
		$this->addLine("{", 2);
		$this->addLine("self::\$instance = null;", 3);
		$this->addLine("}", 2);
		$this->addLine("if(" . implode(" && ", $tmp2) . ")", 2);
		$this->addLine("{", 2);
		$this->addLine("if(!isset(self::\$instance[" . implode(" . \"_\" . ", $tmp3) . "]))", 3);
		$this->addLine("{", 3);
		$this->addLine("self::\$instance[" . implode(" . \"_\" . ", $tmp3) . "] = new static(" . implode(", ", $tmp3) . ");", 4);
		$this->addLine("}", 3);
		$this->addLine("return self::\$instance[" . implode(" . \"_\" . ", $tmp3) . "];", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("return self::\$instance[\"\\\$\".count(self::\$instance)] = new static();", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateGetAllForForeginColumn($t)
	{
		foreach($t->getFk() as $fk) /* @var $fk ForeginKey */
		{
			$fkTable = $fk->getTable();
			$functioName = "getAllBy";
			foreach($fk->getColumn() as $c) /* @var $c ConnectedColumn */
			{
				$classFieldName = Column::convertFieldNameToClassName($c->fkColumnName);
				if(substr($classFieldName, 0, 2) == "id")
				{
					$functioName .= substr($classFieldName, 2);
				}
				else
				{
					$functioName .= $classFieldName;
				}
			}

			$this->addLine("/**", 1);
			$this->addLine(" * Methods return colection of  " . $t->getClassName(), 1);
			$this->addLine(" * @return Collection &lt;" . $t->getClassName() . "&gt; ", 1);
			$this->addLine(" */", 1);
			$this->addLine("public static function " . $functioName . "(" . $fkTable->getClassName() . "DAO \$" . lcfirst($fkTable->getClassName()) . ")", 1);
			$this->addLine("{", 1);
			$this->addLine("\$db = new DB();", 2);
			$this->addLine("\$sql  = \"SELECT * \";", 2);
			$this->addLine("\$sql .= \"FROM \" . " . $t->getSchema() . " . \"." . $t->getName() . " \";", 2);

			$separator = "WHERE";
			foreach($fk->getColumn() as $c)/* @var $c ConnectedColumn */
			{
				foreach($t->getColumny() as $i)/* @var $i Column */
				{
					if($c->fkColumnName == $i->getName())
					{
						$this->addLine("\$sql .= \"" . $separator . " " . $i->getName() . " = :" . mb_strtoupper($i->getName()) . " \";", 2);
						$separator = "AND";
					}
				}
			}

			foreach($fk->getColumn() as $c)/* @var $c ConnectedColumn */
			{
				foreach($t->getColumny() as $i)/* @var $i Column */
				{
					if($c->fkColumnName == $i->getName())
					{
						foreach($fk->getTable()->getPk() as $pk)/* @var $pk Column */
						{
							if($pk->getName() == $c->pkColumnName)
							{
								$this->addLine("\$db->setParam(\"" . mb_strtoupper($i->getName()) . "\", \$" . lcfirst($fkTable->getClassName()) . "->get" . ucfirst($pk->getClassFieldName()) . "());", 2);
							}
						}
					}
				}
			}

			$this->addLine("\$db->query(\$sql);", 2);
			$this->addLine("return new Collection(\$db, \\" . $this->project->getNameSpace() . $this->project->getObjFolder() . "\\" . $t->getClassName() . "::get());", 2);
			$this->addLine("}", 1);
			$this->addLine("// -------------------------------------------------------------------------", 1);
		}
	}
	// -------------------------------------------------------------------------
	protected function generateDestroy(Table $t)
	{
		$pk = array();
		foreach($t->getColumny() as $c)/* @var $c Column */
		{
			if($c->isPK())
			{
				$pk[$c->getKey()] = $c;
			}
		}

		$this->addLine("/**", 1);
		$this->addLine(" * Method removes object of class " . $t->getClassName(), 1);
		$this->addLine(" * removed are record from table " . $t->getName(), 1);
		$this->addLine(" * @return boolean", 1);
		$this->addLine(" */", 1);
		$this->addLine("protected function destroy()", 1);
		$this->addLine("{", 1);
		$this->addLine("\$db = new DB();", 2);
		$this->addLine("\$sql  = \"DELETE FROM \" . " . $t->getSchema() . " . \"." . $t->getName() . " \";", 2);
		$separator = "WHERE";
		foreach($pk as $c)
		{
			$this->addLine("\$sql .= \"" . $separator . " " . $c->getName() . " = :" . mb_strtoupper($c->getName()) . " \";", 2);
			$separator = "AND";
		}
		foreach($pk as $c)/* @var $c Column */
		{
			$this->addLine("\$db->setParam(\"" . mb_strtoupper($c->getName()) . "\", \$this->get" . ucfirst($c->getClassFieldName()) . "());", 2);
		}
		$this->addLine("\$db->query(\$sql);", 2);
		$this->addLine("if(1 == \$db->getRowAffected())", 2);
		$this->addLine("{", 2);
		$this->addLine("return true;", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("AddAlert(\"" . $t->getErrorPrefix() . "04 Delete record from table " . $t->getName() . " fail\");", 3);
		$this->addLine("return false;", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateRead(Table $t)
	{
		$pk = array();
		foreach($t->getColumny() as $c)/* @var $c Column */
		{
			if($c->isPK())
			{
				$pk[$c->getKey()] = $c;
			}
		}

		$this->addLine("/**", 1);
		$this->addLine(" * Method read object of class " . $t->getClassName() . " you can read all of atrib by get...() function", 1);
		$this->addLine(" * select record from table " . $t->getName(), 1);
		$this->addLine(" * @return boolean", 1);
		$this->addLine(" */", 1);
		$tmp1 = array();
		foreach($pk as $c)/* @var $c Column */
		{
			$tmp1[] = "\$" . $c->getClassFieldName();
		}
		$this->addLine("protected function retrieve(" . implode(", ", $tmp1) . ")", 1);
		$this->addLine("{", 1);
		$this->addLine("\$db = new DB();", 2);
		$this->addLine("\$sql  = \"SELECT * FROM \" . " . $t->getSchema() . " . \"." . $t->getName() . " \";", 2);
		$separator = "WHERE";
		foreach($pk as $c)
		{
			$this->addLine("\$sql .= \"" . $separator . " " . $c->getName() . " = :" . mb_strtoupper($c->getName()) . " \";", 2);
			$separator = "AND";
		}
		foreach($pk as $c)/* @var $c Column */
		{
			$this->addLine("\$db->setParam(\"" . mb_strtoupper($c->getName()) . "\", \$" . $c->getClassFieldName() . ");", 2);
		}
		$this->addLine("\$db->query(\$sql);", 2);
		$this->addLine("if(\$db->nextRecord())", 2);
		$this->addLine("{", 2);
		$this->addLine("\$this->setAllFromDB(\$db);", 3);
		$this->addLine("return true;", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("return false;", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateUpdate(Table $t)
	{
		$data = array();
		$pk = array();
		foreach($t->getColumny() as $c)/* @var $c Column */
		{
			if($c->isPK())
			{
				$pk[$c->getKey()] = $c;
			}
			elseif($c instanceof Column)
			{
				$data[$c->getKey()] = $c;
			}
			elseif($c instanceof ColumnForeginKey)
			{
				foreach($c->getTable()->getColumny() as $z)/* @var $z Column */
				{
					if($z instanceof ColumnPrimaryKey)
					{
						$data[$z->getKey()] = $z;
					}
				}
			}
		}

		$this->addLine("/**", 1);
		$this->addLine(" * Method change object of class " . $t->getClassName(), 1);
		$this->addLine(" * update record in table " . $t->getName(), 1);
		$this->addLine(" * @return boolean", 1);
		$this->addLine(" */", 1);
		$this->addLine("protected function update()", 1);
		$this->addLine("{", 1);
		$this->addLine("\$db = new DB();", 2);

		$this->addLine("\$sql  = \"UPDATE \" . " . $t->getSchema() . " . \"." . $t->getName() . " \";", 2);

		$columns = array();
		$params = array();
		foreach($t->getColumny() as $c)/* @var $c Column */
		{

			if($c->getName() == strtoupper($c->getName()))
				$columns[$c->getName()] = $c->getName();
			else
				$columns[$c->getName()] = "\\\"" . $c->getName() . "\\\"";
			$params[$c->getName()] = preg_replace("/[^A-Z1-9]/", "", strtoupper($c->getName()));
			if(strlen($params[$c->getName()]) == 0)
			{
				$params[$c->getName()] = RandomStringLetterOnly(8);
			}
		}

		$separator = "SET";
		foreach($data as $c)
		{
			$this->addLine("\$sql .= \"" . $separator . " " . $columns[$c->getName()] . " = :" . $params[$c->getName()] . " \";", 2);
			$separator = " ,";
		}
		$separator = "WHERE";
		foreach($pk as $c)
		{
			$this->addLine("\$sql .= \"" . $separator . " " . $columns[$c->getName()] . " = :" . $params[$c->getName()] . " \";", 2);
			$separator = "AND";
		}
		$tmp = $pk + $data;
		foreach($tmp as $c)/* @var $c Column */
		{
			$this->addLine("\$db->setParam(\"" . $params[$c->getName()] . "\",\$this->get" . ucfirst($c->getClassFieldName()) . "());", 2);
		}
		$this->addLine("\$db->query(\$sql);", 2);
		$this->addLine("if(1 == \$db->getRowAffected())", 2);
		$this->addLine("{", 2);
		$this->addLine("return true;", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("AddAlert(\"" . $t->getErrorPrefix() . "03 Update record in table " . $t->getName() . " fail\");", 3);
		$this->addLine("return false;", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateCreate(Table $t)
	{
		$data = array();
		$pk = array();
		foreach($t->getColumny() as $c)/* @var $c Column */
		{
			if($c->isPK())
			{
				$pk[$c->getKey()] = $c;
				if(!$c->isAutoGenerated())
				{
					$data[$c->getKey()] = $c;
				}
			}
			else
			{
				$data[$c->getKey()] = $c;
			}
		}

		$this->addLine("/**", 1);
		$this->addLine(" * Methods add object of class " . $t->getClassName(), 1);
		$this->addLine(" * insert record into table " . $t->getName(), 1);
		$this->addLine(" * @return boolean", 1);
		$this->addLine(" */", 1);
		$this->addLine("protected function create()", 1);
		$this->addLine("{", 1);
		$this->addLine("\$db = new DB();", 2);

		$columns = array();
		$params = array();
		foreach($data as $c)/* @var $c Column */
		{
			if($c->getName() == strtoupper($c->getName()))
				$columns[$c->getName()] = $c->getName();
			else
				$columns[$c->getName()] = "\\\"" . $c->getName() . "\\\"";
			$params[$c->getName()] = preg_replace("/[^A-Z1-9]/", "", strtoupper($c->getName()));
			if(strlen($params[$c->getName()]) == 0)
			{
				$params[$c->getName()] = RandomStringLetterOnly(8);
			}
		}
		$this->addLine("\$sql  = \"INSERT INTO \" . " . $t->getSchema() . " . \"." . $t->getName() . "(" . implode(", ", $columns) . ") \";", 2);
		$this->addLine("\$sql .= \"VALUES(:" . implode(", :", $params) . ") \";", 2);

		$pkSequenced = false;
		if(count($pk) == 1)
		{
			if(current($pk)->isAutoGenerated())
			{
				$pkSequenced = true;
				$this->addLine("\$sql .= \"RETURNING " . current($pk)->getName() . " INTO :" . mb_strtoupper(current($pk)->getName()) . "\";", 2);
			}
		}

		if($pkSequenced)
		{
			if(current($pk)->getType() == ColumnType::NUMBER)
			{
				$size = current($pk)->getSize() + current($pk)->getScale();
			}
			else
			{
				$size = current($pk)->getSize();
			}

			$this->addLine("\$db->setParam(\"" . mb_strtoupper(current($pk)->getName()) . "\",\$this->get" . ucfirst(current($pk)->getClassFieldName()) . "(),false," . $size . ");", 2);
		}
		foreach($data as $c)/* @var $c Column */
		{
			$this->addLine("\$db->setParam(\"" . $params[$c->getName()] . "\",\$this->get" . ucfirst($c->getClassFieldName()) . "());", 2);
		}
		$this->addLine("\$db->query(\$sql);", 2);
		$this->addLine("if(1 == \$db->getRowAffected())", 2);
		$this->addLine("{", 2);
		if($pkSequenced)
		{
			$this->addLine("\$this->set" . ucfirst(current($pk)->getClassFieldName()) . "(\$db->getParam(\"" . mb_strtoupper(current($pk)->getName()) . "\"));", 3);
		}
		$this->addLine("self::updateFactoryIndex(\$this);", 3);
		$this->addLine("\$this->setReaded();", 3);
		$this->addLine("return true;", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("AddAlert(\"" . $t->getErrorPrefix() . "02 Insert record into table " . $t->getName() . " fail\");", 3);
		$this->addLine("return false;", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateGetterObject(Table $table)
	{
		foreach($table->getFk() as $fk)/* @var $fk ForeginKey */
		{
			$tmp1 = array();
			$functionName = "get"; // . $fk->getTable()->getClassName();
			foreach($fk->getTable()->getPk() as $c) /* @var $c Column */
			{
				foreach($fk->getColumn() as $cc)/* @var $cc ConnectedColumn */
				{
					if($c->getName() == $cc->pkColumnName)
					{
						foreach($table->getColumny() as $x)/* @var $x Column */
						{
							if($x->getName() == $cc->fkColumnName)
							{
								$tmp1[] = "\$this->get" . ucfirst($x->getClassFieldName()) . "()";
								if(substr($x->getClassFieldName(), 0, 2) == "id")
								{
									$functionName .= substr($x->getClassFieldName(), 2);
								}
								else
								{
									$functionName .= $x->getClassFieldName();
								}
							}
						}
					}
				}
			}
			$this->addLine("/**", 1);
			$this->addLine(" * @return \\" . $this->project->getNameSpace() . $this->project->getObjFolder() . "\\" . $fk->getTable()->getClassName(), 1);
			$this->addLine(" */", 1);
			$this->addLine("public function " . $functionName . "()", 1);
			$this->addLine("{", 1);
			$this->addLine("return \\" . $this->project->getNameSpace() . $this->project->getObjFolder() . "\\" . $fk->getTable()->getClassName() . "::get(" . implode(", ", $tmp1) . ");", 2);
			$this->addLine("}", 1);
			$this->addLine("// -------------------------------------------------------------------------", 1);
		}
	}
	// -------------------------------------------------------------------------
	protected function generateSetterObject(Table $table)
	{
		foreach($table->getFk() as $fk)/* @var $fk ForeginKey */
		{
			$tmp1 = array();
			$functionName = "set"; // . $fk->getTable()->getClassName();
			foreach($fk->getTable()->getPk() as $c) /* @var $c Column */
			{
				foreach($fk->getColumn() as $cc)/* @var $cc ConnectedColumn */
				{
					if($c->getName() == $cc->pkColumnName)
					{
						foreach($table->getColumny() as $x)/* @var $x Column */
						{
							if($x->getName() == $cc->fkColumnName)
							{
								$tmp1[] = "\$" . lcfirst($fk->getTable()->getClassName()) . "->get" . ucfirst($x->getClassFieldName()) . "()";
								if(substr($x->getClassFieldName(), 0, 2) == "id")
								{
									$functionName .= substr($x->getClassFieldName(), 2);
								}
								else
								{
									$functionName .= $x->getClassFieldName();
								}
							}
						}
					}
				}
			}
			$this->addLine("/**", 1);
			$this->addLine(" * @param " . $fk->getTable()->getClassName() . "DAO \$" . lcfirst($fk->getTable()->getClassName()), 1);
			$this->addLine(" */", 1);
			$this->addLine("public function " . $functionName . "(" . $fk->getTable()->getClassName() . "DAO \$" . lcfirst($fk->getTable()->getClassName()) . ")", 1);
			$this->addLine("{", 1);

			foreach($tmp1 as $t)
			{
				$this->addLine("\$this->id" . ucfirst($fk->getTable()->getClassName()) . " = " . $t . ";", 2);
			}

			$this->addLine("}", 1);
			$this->addLine("// -------------------------------------------------------------------------", 1);
		}
	}
	// -------------------------------------------------------------------------
	protected function generateGetters(Table $t)
	{
		foreach($t->getColumny() as $c)/* @var $c Column */
		{
			$this->generateGetter($c->getClassFieldName());
		}
	}
	// -------------------------------------------------------------------------
	protected function generateGetterCollection(Table $table)
	{
		foreach($this->project->getTables() as $t)
		{
			if($t != $table)
			{
				foreach($t->getFk() as $fk)/* @var $fk ForeginKey */
				{
					if($fk->getTableName() == $table->getName() && $fk->getTableSchema() == $table->getSchema())
					{
						$functionName = "getAllBy";
						$objectName = "";
						foreach($fk->getColumn() as $c) /* @var $c ConnectedColumn */
						{
							$classFieldName = Column::convertFieldNameToClassName($c->fkColumnName);
							if(substr($classFieldName, 0, 2) == "id")
							{
								$objectName .= substr($classFieldName, 2);
								$functionName .= substr($classFieldName, 2);
							}
							else
							{
								$objectName .= $classFieldName;
								$functionName .= $classFieldName;
							}
						}

						$this->addLine("/**", 1);
						$this->addLine(" * Methods returns colection of objects " . $t->getClassName(), 1);
						$this->addLine(" * @return Collection &lt;" . $t->getClassName() . "&gt; ", 1);
						$this->addLine(" */", 1);
						$this->addLine("public function get" . $t->getClassName() . "sFor" . $objectName . "()", 1);
						$this->addLine("{", 1);
						$this->addLine("return \\" . $this->project->getNameSpace() . $this->project->getObjFolder() . "\\" . $t->getClassName() . "::" . $functionName . "(\$this);", 2);
						$this->addLine("}", 1);
						$this->addLine("// -------------------------------------------------------------------------", 1);
					}
				}
			}
		}
	}
	// -------------------------------------------------------------------------
	protected function generateGetter($classFieldName)
	{
		$this->addLine("public function get" . ucfirst($classFieldName) . "()", 1);
		$this->addLine("{", 1);
		$this->addLine("return \$this->" . $classFieldName . ";", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateIsReaded()
	{
		$this->addLine("protected function isReaded()", 1);
		$this->addLine("{", 1);
		$this->addLine("return \$this->readed;", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
		$this->addLine("protected function setReaded()", 1);
		$this->addLine("{", 1);
		$this->addLine("\$this->readed = true;", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateSetter(Column $c)
	{
		$this->addLine("public function set" . ucfirst($c->getClassFieldName()) . "(\$" . $c->getClassFieldName() . ")", 1);
		$this->addLine("{", 1);
		switch($c->getType())
		{
			case ColumnType::CHAR:
			case ColumnType::VARCHAR:
				$this->addLine("if(empty(\$" . $c->getClassFieldName() . "))", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = null;", 3);
				$this->addLine("}", 2);
				$this->addLine("else", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = mb_substr(\$" . $c->getClassFieldName() . ",0," . $c->getSize() . ");", 3);
				$this->addLine("}", 2);
				break;
			case ColumnType::NUMBER:
				$this->addLine("if(is_numeric(\$" . $c->getClassFieldName() . "))", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = round(\$" . $c->getClassFieldName() . "," . intval($c->getScale()) . ");", 3);
				$this->addLine("}", 2);
				$this->addLine("else", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = null;", 3);
				$this->addLine("}", 2);
				break;
			case ColumnType::DATE:
				$this->addLine("if(empty(\$" . $c->getClassFieldName() . "))", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = null;", 3);
				$this->addLine("}", 2);
				$this->addLine("else", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = date(PHP_DATE_FORMAT,strtotime(\$" . $c->getClassFieldName() . "));", 3);
				$this->addLine("}", 2);
				break;
			case ColumnType::TIME:
				$this->addLine("if(empty(\$" . $c->getClassFieldName() . "))", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = null;", 3);
				$this->addLine("}", 2);
				$this->addLine("else", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = date(PHP_TIME_FORMAT,strtotime(\$" . $c->getClassFieldName() . "));", 3);
				$this->addLine("}", 2);
				break;
			case ColumnType::DATETIME:
				$this->addLine("if(empty(\$" . $c->getClassFieldName() . "))", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = null;", 3);
				$this->addLine("}", 2);
				$this->addLine("else", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = date(PHP_DATETIME_FORMAT,strtotime(\$" . $c->getClassFieldName() . "));", 3);
				$this->addLine("}", 2);
				break;
			case ColumnType::FLOAT:
				$this->addLine("if(is_numeric(\$" . $c->getClassFieldName() . "))", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = \$" . $c->getClassFieldName() . ";", 3);
				$this->addLine("}", 2);
				$this->addLine("else", 2);
				$this->addLine("{", 2);
				$this->addLine("\$this->" . $c->getClassFieldName() . " = null;", 3);
				$this->addLine("}", 2);
				break;
			case ColumnType::TEXT:
			case ColumnType::ENUM:
			default :
				$this->addLine("\$this->" . $c->getClassFieldName() . " = \$" . $c->getClassFieldName() . ";", 2);
				break;
		}
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateSetters(Table $t)
	{
		foreach($t->getColumny() as $c)/* @var $c Column */
		{
			$this->generateSetter($c);
		}
	}
	// -------------------------------------------------------------------------
	protected function generateSetAllFromDB(Table $t)
	{
		$this->addLine("/**", 1);
		$this->addLine(" * Methods set all atributes in object of class " . $t->getClassName() . " from object class DB", 1);
		$this->addLine(" * @return void", 1);
		$this->addLine(" */", 1);
		$this->addLine("protected function setAllFromDB(DataSource \$db)", 1);
		$this->addLine("{", 1);
		foreach($t->getColumny() as $c) /* @var $c Column */
		{
			if($c instanceof ColumnForeginKey)
			{
				$columns = $c->getTable()->getColumny();
				foreach($c->getClassFieldName() as $key => $s)
				{
					$this->addLine("\$this->set" . ucfirst($s) . "(\$db->f(\"" . $columns[$key]->getName() . "\"));", 2);
				}
			}
			else
			{
				$this->addLine("\$this->set" . ucfirst($c->getClassFieldName()) . "(\$db->f(\"" . $c->getKey() . "\"));", 2);
			}
		}
		$this->addLine("\$this->setReaded();", 2);

		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateConstruktor(Table $t)
	{
		$this->addLine("/**", 1);
		$tmp1 = array();
		$tmp2 = array();
		$tmp3 = array();
		foreach($t->getPk() as $c) /* @var $c Column */
		{
			$this->addLine(" * @param " . $c->getPHPType() . " \$" . $c->getClassFieldName() . "", 1);
			$tmp1[] = "\$" . $c->getClassFieldName() . " = null";
			$tmp2[] = "!is_null(\$" . $c->getClassFieldName() . ")";
			$tmp3[] = "\$" . $c->getClassFieldName() . "";
		}
		$this->addLine(" */", 1);
		$this->addLine("protected function __construct(" . implode(", ", $tmp1) . ")", 1);
		$this->addLine("{", 1);
		$this->addLine("if(" . implode(" && ", $tmp2) . ")", 2);
		$this->addLine("{", 2);

		$this->addLine("if(!\$this->retrieve(" . implode(", ", $tmp3) . "))", 3);
		$this->addLine("{", 3);
		$this->addLine("throw new \Exception(\"" . $t->getErrorPrefix() . "01 \" . " . $t->getSchema() . " . \"." . $t->getName() . "(\" . " . implode(" . \", \".", $tmp3) . " . \")  does not exists\");", 4);
		$this->addLine("}", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateProperties(Table $table)
	{
		$this->addLine("// -------------------------------------------------------------------------", 1);
		$this->addLine("protected static \$instance = array();", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
		foreach($table->getColumny() as $c) /* @var $c Column */
		{
			$this->addLine("protected \$" . $c->getClassFieldName() . " = null;", 1);
		}
		$this->addLine("protected \$readed = false;", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
	protected function generateClassHead($t)
	{
		$this->addLine("class " . $t->getClassName() . "DAO implements DAO", 0);
		$this->addLine("{", 0);
	}
	// -------------------------------------------------------------------------
	protected function generateClassFooter()
	{
		$this->addLine("}", 0);
	}
	// -------------------------------------------------------------------------
	protected function generateClassDocumentation(Table $t)
	{
		$this->addLine("/**", 0);
		$this->addLine(" * Created on " . date("d-m-Y H:i:s"), 0);
		$this->addLine(" * @author " . $this->project->getAuthor(), 0);
		$this->addLine(" * @package " . $this->project->getName(), 0);
		$this->addLine(" * error prefix " . $t->getErrorPrefix(), 0);
		$this->addLine(" * Genreated by SimplePHPDAOClassGenerator ver " . Project::VERSION, 0);
		$this->addLine(" * https://sourceforge.net/projects/simplephpdaogen/ ", 0);
		$this->addLine(" * Designed by schama CRUD http://wikipedia.org/wiki/CRUD", 0);
		$this->addLine(" * class generated automatically, please do not modify under pain of ", 0);
		$this->addLine(" * OVERWRITTEN WITHOUT WARNING ", 0);
		$this->addLine(" */", 0);
	}
	// -------------------------------------------------------------------------
	protected function generateNameSpace(Table $t)
	{
		if(strlen($this->project->getNameSpace()) > 0)
		{
			$this->addLine("namespace " . $this->project->getNameSpace() . "dao;", 0);
			$this->addLine("use braga\\db\\DAO;", 0);
			$this->addLine("use braga\\db\\DataSource;", 0);
			if($this->project->getDataBaseStyle() == DataBaseStyle::PGSQL)
			{
				$this->addLine("use braga\db\pgsql\DB;", 0);
			}
			elseif($this->project->getDataBaseStyle() == DataBaseStyle::ORACLE)
			{
				$this->addLine("use braga\db\oracle\DB;", 0);
			}
			else
			{
				$this->addLine("use braga\db\mysql\DB;", 0);
			}
			if(count($t->getFk()) > 0)
			{
				$this->addLine("use braga\\db\\Collection;", 0);
			}
		}
	}
	// -------------------------------------------------------------------------
	protected function open(Table $t)
	{
		@mkdir($this->project->getProjectFolder() . "\\" . $this->project->getDaoFolder(), 0777, true);
		$this->fileHandle = fopen($this->project->getProjectFolder() . "\\" . $this->project->getDaoFolder() . "\\" . $t->getClassName() . "DAO.php", "w");
		$this->addLine("<?php", 0);
	}
	// -------------------------------------------------------------------------
	protected function close()
	{
		$this->addLine("?>", 0, false);
		fclose($this->fileHandle);
	}
	// -------------------------------------------------------------------------
}
// =============================================================================
function RandomStringLetterOnly($dlugosc)
{
	$keychars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$randkey = "";
	$max = strlen($keychars) - 1;
	for($i = 0; $i < $dlugosc; $i++)
	{
		$randkey .= substr($keychars, rand(0, $max), 1);
	}
	return $randkey;
}
?>