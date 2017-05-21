<?php
/**
 * Created on 23 mar 2015 20:17:57
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class ToolsTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function setUp()
	{
		if(!defined("PHP_DATE_FORMAT"))
		{
			define("PHP_DATE_FORMAT", "Y-m-d");
		}
	}
	// -------------------------------------------------------------------------
	function testDodajMiesiac()
	{
		$date = mktime(0, 0, 0, 1, 1, 2010);
		$zaMiesiac = "2010-02-01";
		$this->assertEquals($zaMiesiac, addMonth($date, 1));
	}
	// -------------------------------------------------------------------------
	function testDodajMiesiacOstatniDzien()
	{
		$date = mktime(0, 0, 0, 1, 31, 2010);
		$zaMiesiac = "2010-02-28";
		$this->assertEquals($zaMiesiac, addMonth($date, 1));

		$date = mktime(0, 0, 0, 1, 31, 2010);
		$zaMiesiac = "2010-03-31";
		$this->assertEquals($zaMiesiac, addMonth($date, 2));

		$date = mktime(0, 0, 0, 2, 28, 2010);
		$zaMiesiac = "2010-03-28";
		$this->assertEquals($zaMiesiac, addMonth($date, 1));

		$date = mktime(0, 0, 0, 3, 31, 2010);
		$zaMiesiac = "2010-04-30";
		$this->assertEquals($zaMiesiac, addMonth($date, 1));
	}
	// -------------------------------------------------------------------------
	function testPrzelomRoku()
	{
		$date = mktime(0, 0, 0, 12, 31, 2010);
		$zaMiesiac = "2011-01-31";
		$this->assertEquals($zaMiesiac, addMonth($date, 1));

		$zaMiesiac = "2011-02-28";
		$this->assertEquals($zaMiesiac, addMonth($date, 2));
	}
	// -------------------------------------------------------------------------
	function test13Miesiecy()
	{
		$date = mktime(0, 0, 0, 1, 31, 2010);
		$zaMiesiac = "2011-02-28";
		$this->assertEquals($zaMiesiac, addMonth($date, 13));

		$date = mktime(0, 0, 0, 3, 31, 2010);
		$zaMiesiac = "2011-04-30";
		$this->assertEquals($zaMiesiac, addMonth($date, 13));
	}
	// -------------------------------------------------------------------------
	function testRokPrzestepny()
	{
		$date = mktime(0, 0, 0, 1, 31, 2011);
		$zaMiesiac = "2012-02-29";
		$this->assertEquals($zaMiesiac, addMonth($date, 13));
	}
	// -------------------------------------------------------------------------
	function testOstatnichDniCalegoRoku()
	{
		$date = mktime(0, 0, 0, 1, 31, 2015);
		$this->assertEquals("2015-02-28", addMonth($date, 1));
		$this->assertEquals("2015-03-31", addMonth($date, 2));
		$this->assertEquals("2015-04-30", addMonth($date, 3));
		$this->assertEquals("2015-05-31", addMonth($date, 4));
		$this->assertEquals("2015-06-30", addMonth($date, 5));
		$this->assertEquals("2015-07-31", addMonth($date, 6));
		$this->assertEquals("2015-08-31", addMonth($date, 7));
		$this->assertEquals("2015-09-30", addMonth($date, 8));
		$this->assertEquals("2015-10-31", addMonth($date, 9));
		$this->assertEquals("2015-11-30", addMonth($date, 10));
		$this->assertEquals("2015-12-31", addMonth($date, 11));
		$this->assertEquals("2016-01-31", addMonth($date, 12));
	}
	// -------------------------------------------------------------------------
	function testPrzelomuRoku()
	{
		$date = mktime(0, 0, 0, 1, 15, 2015);
		$this->assertEquals("2015-02-15", addMonth($date, 1));
		$this->assertEquals("2016-03-15", addMonth($date, 14));
	}
	// -------------------------------------------------------------------------
	function testErr001()
	{
		$date = strtotime("2015-12-09");
		$this->assertEquals("2016-12-09", addMonth($date, 12));
	}
	// -------------------------------------------------------------------------
}
?>