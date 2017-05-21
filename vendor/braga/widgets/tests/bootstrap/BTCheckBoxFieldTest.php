<?php
use braga\tools\html\BaseTags;
use braga\widgets\bootstrap\CheckBoxField;

/**
 * Created on 11.11.2016 18:15:33
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BTCheckBoxFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	public function testSimple()
	{
		$f = new CheckBoxField();
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='checkbox' value='1'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	public function testName()
	{
		$f = new CheckBoxField();
		$f->setName("StrangeName");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='checkbox' id='StrangeName' name='StrangeName' value='1'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>