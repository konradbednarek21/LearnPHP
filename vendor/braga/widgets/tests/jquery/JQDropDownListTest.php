<?php
use braga\widgets\jqueryui\WidgetItem;
use braga\widgets\jqueryui\DropDownListField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 18:31:37
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQDropDownListTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new DropDownListField();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::select($expected, "class='widget ui-widget-content ui-corner-all combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testRequiredValue()
	{
		$f = new DropDownListField();
		$f->setRequired();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("-=Wybierz=-", "value='' class='ui-state-default ui-state-error' selected='selected'");
		$expected .= BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::select($expected, "class='widget ui-widget-content ui-corner-all combo ui-state-error' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testRequiredGroupValue()
	{
		$f = new DropDownListField();
		$f->setRequired();
		$f->enableGrouping();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue", "StrangeGroup"));
		$actual = $f->out();

		$tmp = BaseTags::option("-=Wybierz=-", "value='' class='ui-state-default ui-state-error' selected='selected'");
		$expected = BaseTags::optgroup($tmp, "label='-=Wybierz=-' class='ui-priority-primary widget ui-widget-content ui-state-error'");
		$tmp = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected .= BaseTags::optgroup($tmp, "label='StrangeGroup' class='ui-priority-primary widget ui-widget-content'");
		$expected = BaseTags::select($expected, "class='widget ui-widget-content ui-corner-all combo ui-state-error' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testName()
	{
		$f = new DropDownListField();
		$f->setName("StrangeName");
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::select($expected, "id='StrangeName' name='StrangeName' class='widget ui-widget-content ui-corner-all combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testTreeValue()
	{
		$f = new DropDownListField();
		$f->setName("StrangeName");
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$f->addItem(new WidgetItem("StrageName", "StrangeValue"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected .= BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected .= BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::select($expected, "id='StrangeName' name='StrangeName' class='widget ui-widget-content ui-corner-all combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testGroup()
	{
		$f = new DropDownListField();
		$f->setName("StrangeName");
		$f->enableGrouping();
		$f->addItem(new WidgetItem("StrageName", "StrangeValue", "StrageGroup"));
		$actual = $f->out();

		$expected = BaseTags::option("StrageName", "value='StrangeValue' class='ui-state-default'");
		$expected = BaseTags::optgroup($expected, "label='StrageGroup' class='ui-priority-primary widget ui-widget-content'");
		$expected = BaseTags::select($expected, "id='StrangeName' name='StrangeName' class='widget ui-widget-content ui-corner-all combo' onchange='SprawdzCombo(this);'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
}
?>