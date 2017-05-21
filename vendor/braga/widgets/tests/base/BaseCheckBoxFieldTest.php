<?php
use braga\widgets\base\CheckBoxField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 18:02:57
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BaseCheckBoxFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new CheckBoxField();
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='checkbox' value='1'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new CheckBoxField();
		$f->setName("StrageName");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='checkbox' id='StrageName' name='StrageName' value='1'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>