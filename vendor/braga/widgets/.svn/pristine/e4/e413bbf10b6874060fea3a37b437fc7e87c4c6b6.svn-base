<?php
use braga\widgets\bootstrap\TextField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 17:38:10
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BTTextFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new TextField();
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' class='form-control'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new TextField();
		$f->setName("StrageName");
		$actual = $f->out();

		$expected = BaseTags::input("type='text' id='StrageName' name='StrageName' class='form-control'");
		$expected = BaseTags::div($expected, "class='form-group'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testWartemark()
	{
		$f = new TextField();
		$f->setWatermark("StrangeName");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("placeholder='StrangeName' type='text' class='form-control'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testLabel()
	{
		$f = new TextField();
		$f->setLabel("StrangeLabel");
		$retval = $f->out();
		$oczekiwane = BaseTags::label("StrangeLabel", "for=''");
		$oczekiwane .= BaseTags::input("type='text' class='form-control'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testSelected()
	{
		$f = new TextField();
		$f->setSelected("StrangeValue");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' class='form-control' value='StrangeValue'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testRequired()
	{
		$f = new TextField();
		$f->setRequired();
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' class='form-control'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group has-error'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testRequiredWithValue()
	{
		$f = new TextField();
		$f->setRequired();
		$f->setSelected("StrangeValue");
		$retval = $f->out();
		$oczekiwane = BaseTags::input("type='text' class='form-control' value='StrangeValue'");
		$oczekiwane = BaseTags::div($oczekiwane, "class='form-group'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>