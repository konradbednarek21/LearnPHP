<?php
namespace braga\daogenerator\generator;
/**
 * Created on 18 cze 2016 19:38:04
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class PostgreDAOFileGenerator extends DAOFileGenerator
{
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
		$tableName = $t->getName();
		if($tableName != strtolower($tableName))
		{
			$tableName = "\\\"" . $tableName . "\\\"";
		}
		$this->addLine("\$sql  = \"DELETE FROM \" . " . $t->getSchema() . " . \"." . $tableName . " \";", 2);
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
		$this->addLine("\$db->commit();", 3);
		$this->addLine("return true;", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("\$db->rollback();", 3);
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
		$tableName = $t->getName();
		if($tableName != strtolower($tableName))
		{
			$tableName = "\\\"" . $tableName . "\\\"";
		}
		$this->addLine("\$sql  = \"SELECT * FROM \" . " . $t->getSchema() . " . \"." . $tableName . " \";", 2);
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

		$tableName = $t->getName();
		if($tableName != strtolower($tableName))
		{
			$tableName = "\\\"" . $tableName . "\\\"";
		}
		$this->addLine("\$sql  = \"UPDATE \" . " . $t->getSchema() . " . \"." . $tableName . " \";", 2);

		$columns = array();
		$params = array();
		foreach($t->getColumny() as $c)/* @var $c Column */
		{

			if($c->getName() == strtolower($c->getName()))
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
		$this->addLine("\$db->commit();", 3);
		$this->addLine("return true;", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("\$db->rollback();", 3);
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
			if($c->getName() == strtolower($c->getName()))
				$columns[$c->getName()] = $c->getName();
			else
				$columns[$c->getName()] = "\\\"" . $c->getName() . "\\\"";
			$params[$c->getName()] = preg_replace("/[^A-Z1-9]/", "", strtoupper($c->getName()));
			if(strlen($params[$c->getName()]) == 0)
			{
				$params[$c->getName()] = RandomStringLetterOnly(8);
			}
		}
		$tableName = $t->getName();
		if($tableName != strtolower($tableName))
		{
			$tableName = "\\\"" . $tableName . "\\\"";
		}
		$this->addLine("\$sql  = \"INSERT INTO \" . " . $t->getSchema() . " . \"." . $tableName . "(" . implode(", ", $columns) . ") \";", 2);
		$this->addLine("\$sql .= \"VALUES(:" . implode(", :", $params) . ") \";", 2);

		$pkSequenced = false;
		if(count($pk) == 1)
		{
			if(current($pk)->isAutoGenerated())
			{
				$pkSequenced = true;
				$this->addLine("\$sql .= \"RETURNING * \";", 2);
			}
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
			$this->addLine("if(\$db->nextRecord())", 3);
			$this->addLine("{", 3);
			$this->addLine("\$this->setAllFromDB(\$db);", 4);
			$this->addLine("}", 3);
		}
		$this->addLine("\$db->commit();", 3);
		$this->addLine("self::updateFactoryIndex(\$this);", 3);
		$this->addLine("\$this->setReaded();", 3);
		$this->addLine("return true;", 3);
		$this->addLine("}", 2);
		$this->addLine("else", 2);
		$this->addLine("{", 2);
		$this->addLine("\$db->rollback();", 3);
		$this->addLine("AddAlert(\"" . $t->getErrorPrefix() . "02 Insert record into table " . $t->getName() . " fail\");", 3);
		$this->addLine("return false;", 3);
		$this->addLine("}", 2);
		$this->addLine("}", 1);
		$this->addLine("// -------------------------------------------------------------------------", 1);
	}
	// -------------------------------------------------------------------------
}
?>