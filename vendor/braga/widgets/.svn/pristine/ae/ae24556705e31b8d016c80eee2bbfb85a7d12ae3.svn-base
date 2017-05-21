<?php
use braga\widgets\base\DropDownListField;
use braga\widgets\base\WidgetItem;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 18:38:25
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BaseDropDownListTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new DropDownListField();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue'");
		$expected = BaseTags::select($expected, "");

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
		$expected = BaseTags::select($expected, "");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new DropDownListField();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$f->setName("StrangeName");
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue'");
		$expected = BaseTags::select($expected, "id='StrangeName' name='StrangeName'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
}
?>