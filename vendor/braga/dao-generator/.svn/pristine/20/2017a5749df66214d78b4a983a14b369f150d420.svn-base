<?php
use braga\daogenerator\generator\Column;
use braga\daogenerator\generator\ColumnType;

/**
 * Created on 10-03-2013 17:00:53
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class ColumnTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSetGet()
	{
		$c = new Column();
		$this->assertNull($c->setName("idcol"));
		$this->assertNull($c->setClassFieldName("idColumn"));
		$this->assertNull($c->setType(ColumnType::CHAR));
		$this->assertNull($c->setSize(9));
		$this->assertNull($c->setScale(2));
		$this->assertNull($c->setPK(true));

		$this->assertEquals("idcol", $c->getName());
		$this->assertEquals("idColumn", $c->getClassFieldName());
		$this->assertEquals(ColumnType::CHAR, $c->getType());
		$this->assertEquals(9, $c->getSize());
		$this->assertEquals(2, $c->getScale());
	}
	// -------------------------------------------------------------------------
	function testColumnDefault()
	{
		$c = new Column();
		$this->assertEquals(ColumnType::VARCHAR, $c->getType());
		$this->assertEquals(255, $c->getSize());
	}
	// -------------------------------------------------------------------------
	function testColumnDefault2()
	{
		$c = new Column();
		$c->setType(ColumnType::NUMBER);
		$this->assertEquals(ColumnType::NUMBER, $c->getType());
		$this->assertEquals(22, $c->getSize());
	}
	// -------------------------------------------------------------------------
}
?>