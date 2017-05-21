<?php
use braga\widgets\bootstrap\DropDownListField;
use braga\widgets\base\WidgetItem;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 20:11:21
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BTDropDownListTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new DropDownListField();
		$f->addItem(new WidgetItem("StrangeName", "StrangeValue"));

		$actual = $f->out();

		$expected = BaseTags::option("StrangeName", "value='StrangeValue'");
		$expected = BaseTags::select($expected, "class='form-control' onchange='checkDropDownList(this);'");
		$expected = BaseTags::div($expected, "class='form-group'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testGroup()
	{
		$f = new DropDownListField();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue", "StrageGroup"));
		$f->enableGrouping();
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue'");
		$expected = BaseTags::optgroup($expected, "label='StrageGroup'");
		$expected = BaseTags::select($expected, "class='form-control' onchange='checkDropDownList(this);'");
		$expected = BaseTags::div($expected, "class='form-group'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testSimpleRequired()
	{
		$f = new DropDownListField();
		$f->setRequired();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue", "StrageGroup"));
		$f->enableGrouping();
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue'");
		$expected = BaseTags::optgroup($expected, "label='StrageGroup'");
		$expected = BaseTags::select($expected, "class='form-control' onchange='checkDropDownList(this);'");
		$expected = BaseTags::div($expected, "class='form-group has-error'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testSimpleRequiredWithSelected()
	{
		$f = new DropDownListField();
		$f->setRequired();
		$f->setSelected("StrangeValue");
		$f->addItem(new WidgetItem("StrageName", "StrangeValue", "StrageGroup"));
		$f->enableGrouping();
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue'");
		$expected = BaseTags::optgroup($expected, "label='StrageGroup'");
		$expected = BaseTags::select($expected, "class='form-control' onchange='checkDropDownList(this);'");
		$expected = BaseTags::div($expected, "class='form-group'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
}
?>