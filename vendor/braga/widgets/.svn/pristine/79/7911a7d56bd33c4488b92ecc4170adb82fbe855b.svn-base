<?php
use braga\widgets\jqueryui\CheckBoxListField;
use braga\widgets\jqueryui\WidgetItem;
use braga\widgets\jqueryui\CheckBoxField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 20:37:11
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQCheckBoxFieldListTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$field = new CheckBoxListField();
		$field->setName("StrangeName");
		$field->addItem(new WidgetItem("StrangeName", "StrangeValue"));

		$actual = $field->out();

		$checkbox = new CheckBoxField();
		$checkbox->setValue("StrangeValue");
		$checkbox->setName("StrangeName[StrangeValue]");
		$checkbox->setId("StrangeName_StrangeValue");
		$expected = BaseTags::p($checkbox->out() . BaseTags::label("StrangeName"));
		$expected = BaseTags::div($expected, "class='ui-widget-content ui-corner-all'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testMiltipleValue()
	{
		$field = new CheckBoxListField();
		$field->setName("StrangeName");
		$field->addItem(new WidgetItem("StrangeName1", "StrangeValue1"));
		$field->addItem(new WidgetItem("StrangeName2", "StrangeValue2"));

		$actual = $field->out();

		$checkbox1 = new CheckBoxField();
		$checkbox1->setValue("StrangeValue1");
		$checkbox1->setName("StrangeName[StrangeValue1]");
		$checkbox1->setId("StrangeName_StrangeValue1");
		$checkbox2 = new CheckBoxField();
		$checkbox2->setValue("StrangeValue2");
		$checkbox2->setName("StrangeName[StrangeValue2]");
		$checkbox2->setId("StrangeName_StrangeValue2");
		$expected = BaseTags::p($checkbox1->out() . BaseTags::label("StrangeName1"));
		$expected .= BaseTags::p($checkbox2->out() . BaseTags::label("StrangeName2"));
		$expected = BaseTags::div($expected, "class='ui-widget-content ui-corner-all'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testMiltipleValueWithSelected()
	{
		$field = new CheckBoxListField();
		$field->setName("StrangeName");
		$field->addItem(new WidgetItem("StrangeName1", "StrangeValue1"));
		$field->addItem(new WidgetItem("StrangeName2", "StrangeValue2"));
		$field->setSelected(array(
				"StrangeValue1" => "StrangeValue1"
		));

		$actual = $field->out();

		$checkbox1 = new CheckBoxField();
		$checkbox1->setValue("StrangeValue1");
		$checkbox1->setName("StrangeName[StrangeValue1]");
		$checkbox1->setId("StrangeName_StrangeValue1");
		$checkbox1->setSelected(true);

		$checkbox2 = new CheckBoxField();
		$checkbox2->setValue("StrangeValue2");
		$checkbox2->setName("StrangeName[StrangeValue2]");
		$checkbox2->setId("StrangeName_StrangeValue2");
		$expected = BaseTags::p($checkbox1->out() . BaseTags::label("StrangeName1"));
		$expected .= BaseTags::p($checkbox2->out() . BaseTags::label("StrangeName2"));
		$expected = BaseTags::div($expected, "class='ui-widget-content ui-corner-all'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
}
?>