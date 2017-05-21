<?php
use braga\widgets\jqueryui\DateField;

/**
 * Created on 11.11.2016 22:07:51
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQDateFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new DateField();

		$actual = $f->out();

		$expected = "<input maxlength='10' onblur='CheckDate(this,false,\"\",\"\");'>";
		// $expected .= "<a class='hand' onclick='$(\"#\").datepicker(\"show\");' onmouseover='ToolTip(\"Kliknij aby wybrać datę\",event,this)'><span class='ui-icon ui-icon-calendar' style='float:right'></span></a>";
		$expected .= "<script type='text/javascript'>$(\"#\").watermark(\"RRRR-MM-DD\");$(\"#\").datepicker({ onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"\",\"\")}});</script>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new DateField();
		$f->setName("StrangeName");

		$actual = $f->out();
		$expected = "<input id='StrangeName' name='StrangeName' maxlength='10' onblur='CheckDate(this,false,\"\",\"\");'>";
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({ onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"\",\"\")}});</script>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testNameWitSelected()
	{
		$f = new DateField();
		$f->setName("StrangeName");
		$f->setSelected("2012-01-02");

		$actual = $f->out();
		$expected = "<input id='StrangeName' name='StrangeName' maxlength='10' value='2012-01-02' onblur='CheckDate(this,false,\"\",\"\");'>";
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({ onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"\",\"\")}});</script>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
	function testNameWitSelectedMinMaxValue()
	{
		$f = new DateField();
		$f->setName("StrangeName");
		$f->setSelected("2012-01-02");
		$f->setMaxValue("2016-01-01");
		$f->setMinValue("2010-01-01");

		$actual = $f->out();
		$expected = "<input id='StrangeName' name='StrangeName' maxlength='10' value='2012-01-02' onblur='CheckDate(this,false,\"2010-01-01\",\"2016-01-01\");'>";
		$expected .= "<script type='text/javascript'>$(\"#StrangeName\").watermark(\"RRRR-MM-DD\");$(\"#StrangeName\").datepicker({minDate: new Date(2010, 0,01), maxDate: new Date(2016, 0,01),  onClose: function(date, req, minDate, maxDate) {CheckDate($(this),false,\"2010-01-01\",\"2016-01-01\")}});</script>";

		$this->assertEquals($expected, $actual);

	}
	// -------------------------------------------------------------------------
}
?>