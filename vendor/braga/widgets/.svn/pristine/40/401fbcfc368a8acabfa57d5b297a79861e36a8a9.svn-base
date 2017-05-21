<?php
use braga\widgets\base\TextField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 17:02:09
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BaseTextFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	public function testSimple()
	{
		$f = new TextField();
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text'");
		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	public function testName()
	{
		$f = new TextField();
		$f->setName("StrangeName");
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text' id='StrangeName' name='StrangeName'");
		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	public function testValue()
	{
		$f = new TextField();
		$f->setSelected("StrangeName");
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text' value='StrangeName'");
		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	public function testMaxLength()
	{
		$f = new TextField();
		$f->setMaxLength(255);
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text' maxlength='255'");
		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	public function testReadOnly()
	{
		$f = new TextField();
		$f->setReadOnly();
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text' readonly='readonly'");
		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	public function testClass()
	{
		$f = new TextField();
		$f->setClassString("StrangeName");
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text' class='StrangeName'");
		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	public function testTabIndex()
	{
		$f = new TextField();
		$f->setTabOrder(123);
		$retval = $f->out();

		$oczekiwane = BaseTags::input("type='text' tabindex='123'");
		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>