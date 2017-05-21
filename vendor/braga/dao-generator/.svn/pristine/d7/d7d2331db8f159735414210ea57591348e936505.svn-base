<?php
namespace braga\daogenerator\worker\mysql;
use braga\daogenerator\worker\ReverseColumn;
use braga\daogenerator\worker\ReverseProxy;
use braga\daogenerator\worker\ReverseTable;
use braga\daogenerator\generator\ColumnType;
use braga\daogenerator\worker\ReversePrimaryKey;
use braga\daogenerator\worker\ReverseForeginKey;
use braga\daogenerator\generator\ConnectedColumn;
use braga\db\mysql\DB;

/**
 * Created on 9 lip 2013 18:49:34
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class MySQLProxy implements ReverseProxy
{
	// -------------------------------------------------------------------------
	public function getTables()
	{
		$db = new DB();
		$sql = "SELECT table_name, table_schema, auto_increment ";
		$sql .= "FROM INFORMATION_SCHEMA.TABLES ";
		$sql .= "WHERE TABLE_SCHEMA = :TABLE_SCHEMA ";
		$sql .= "ORDER BY TABLE_NAME";
		$db->setParam("TABLE_SCHEMA", DB_SCHEMA);
		echo "selecting tables ....\n";
		$db->query($sql);
		$retval = array();
		while($db->nextRecord())
		{
			$tmp = new ReverseTable();
			$tmp->tableName = $db->f(0);
			$tmp->tableSpace = $db->f(1);
			$tmp->haveAutoNumberPKField = ($db->f(2) > 0);
			$retval[] = $tmp;
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	public function getColumn($tableName)
	{
		$db = new DB();
		$sql = "SELECT column_name, data_type, character_maximum_length, numeric_precision, numeric_scale ";
		$sql .= "FROM INFORMATION_SCHEMA.COLUMNS ";
		$sql .= "WHERE TABLE_SCHEMA = :TABLE_SCHEMA ";
		$sql .= "AND TABLE_NAME = :TABLE_NAME ";
		$sql .= "ORDER BY ORDINAL_POSITION";

		$db->setParam("TABLE_SCHEMA", DB_SCHEMA);
		$db->setParam("TABLE_NAME", $tableName);
		echo "columns for table " . str_pad($tableName, 60, ".", STR_PAD_RIGHT) . " ";
		$db->query($sql);
		$retval = array();
		while($db->nextRecord())
		{
			$tmp = new ReverseColumn();
			$tmp->name = $db->f(0);
			switch($db->f(1))
			{
				case "date":
					$tmp->type = ColumnType::DATE;
					break;
				case "datetime":
				case "timestamp":
					$tmp->type = ColumnType::DATETIME;
					break;
				case "time":
					$tmp->type = ColumnType::TIME;
					break;
				case "int":
				case "tinyint":
				case "bigint":
					$tmp->type = ColumnType::NUMBER;
					break;
				case "decimal":
				case "double":
				case "float":
					$tmp->type = ColumnType::FLOAT;
					break;
				case "mediumtext":
				case "longtext":
				case "text":
					$tmp->type = ColumnType::TEXT;
					break;
				case "enum":
					$tmp->type = ColumnType::ENUM;
					break;
				default :
					$tmp->type = ColumnType::VARCHAR;
					break;
			}
			if(is_null($db->f(3)))
			{
				$tmp->size = $db->f(2);
			}
			else
			{
				$tmp->size = $db->f(3);
				$tmp->size = $db->f(4);
			}
			$retval[$tmp->name] = $tmp;
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	public function getPrimaryKeys($tableName)
	{
		$db = new DB();
		$sql = "SELECT COLUMN_NAME ";
		$sql .= "FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE ";
		$sql .= "WHERE TABLE_SCHEMA = :TABLE_SCHEMA ";
		$sql .= "AND TABLE_NAME = :TABLE_NAME ";
		$sql .= "AND CONSTRAINT_NAME = 'PRIMARY' ";
		$sql .= "ORDER BY ORDINAL_POSITION ";
		$db->setParam("TABLE_SCHEMA", DB_SCHEMA);
		$db->setParam("TABLE_NAME", $tableName);
		echo "selecting pk, ";
		$db->query($sql);
		$retval = array();
		while($db->nextRecord())
		{
			$tmp = new ReversePrimaryKey();
			$tmp->name = $db->f(0);
			$retval[$tmp->name] = $tmp;
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	public function getForeginKeys($tableName)
	{
		$db = new DB();
		$sql = "SELECT CONSTRAINT_NAME, COLUMN_NAME, REFERENCED_COLUMN_NAME, REFERENCED_TABLE_NAME, REFERENCED_TABLE_NAME ";
		$sql .= "FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE ";
		$sql .= "WHERE TABLE_SCHEMA = :TABLE_SCHEMA ";
		$sql .= "AND TABLE_NAME = :TABLE_NAME ";
		$sql .= "AND REFERENCED_COLUMN_NAME IS NOT NULL ";
		$sql .= "ORDER BY ORDINAL_POSITION ";
		$db->setParam("TABLE_SCHEMA", DB_SCHEMA);
		$db->setParam("TABLE_NAME", $tableName);
		echo "fk, ";
		$db->query($sql);
		$retval = array();
		while($db->nextRecord())
		{
			if(!isset($retval[$db->f(0)]))
			{
				$retval[$db->f(0)] = new ReverseForeginKey();
				$retval[$db->f(0)]->refTableName = $db->f(3);
				$retval[$db->f(0)]->refTableSchema = $db->f(4);
			}
			$col = new ConnectedColumn();
			$col->fkColumnName = $db->f(1);
			$col->pkColumnName = $db->f(2);
			$retval[$db->f(0)]->columns[] = $col;
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>