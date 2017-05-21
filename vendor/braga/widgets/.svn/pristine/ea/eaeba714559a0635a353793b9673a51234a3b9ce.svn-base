<?php
use braga\widgets\jqueryui\FloatField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 17:29:42
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQFloatFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new FloatField();

		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' class=' r widgetSizeMedium' maxlength='22' onchange='CzyReal(this,null,null,2);' onfocus='$(this).select();'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new FloatField();
		$f->setName("StrageName");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' id='StrageName' name='StrageName' class=' r widgetSizeMedium' maxlength='22' onchange='CzyReal(this,null,null,2);' onfocus='$(this).select();'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testValue()
	{
		$f = new FloatField();
		$f->setSelected("1234.45");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' class=' r widgetSizeMedium' value='1234.45' maxlength='22' onchange='CzyReal(this,null,null,2);' onfocus='$(this).select();'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>