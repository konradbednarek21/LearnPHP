<?php
use braga\widgets\bootstrap\CheckBoxListField;
use braga\widgets\base\WidgetItem;
use braga\tools\html\BaseTags;
use braga\widgets\base\CheckBoxField;

/**
 * Created on 11.11.2016 21:04:41
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class BTCheckBoxFieldListTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimple()
	{
		$f = new CheckBoxListField();
		$f->addItem(new WidgetItem("StrangeName", "StrangeValue"));
		$f->setName("StrangeName");

		$actual = $f->out();

		$checkBox = new CheckBoxField();
		$checkBox->setName("StrangeName[]");
		$checkBox->setId("StrangeName_StrangeValue");
		$checkBox->setValue("StrangeValue");

		$expected = BaseTags::label($checkBox->out() . "StrangeName", "class='checkbox-block'");
		$expected = BaseTags::div($expected, "class='form-group'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
	function testSelected()
	{
		$f = new CheckBoxListField();
		$f->addItem(new WidgetItem("StrangeName1", "StrangeValue1"));
		$f->addItem(new WidgetItem("StrangeName2", "StrangeValue2"));
		$f->setName("StrangeName");
		$f->setSelected(array(
				"StrangeValue1" => "StrangeValue1"
		));

		$actual = $f->out();

		$checkBox1 = new CheckBoxField();
		$checkBox1->setName("StrangeName[]");
		$checkBox1->setId("StrangeName_StrangeValue1");
		$checkBox1->setValue("StrangeValue1");
		$checkBox1->setSelected(true);

		$checkBox2 = new CheckBoxField();
		$checkBox2->setName("StrangeName[]");
		$checkBox2->setId("StrangeName_StrangeValue2");
		$checkBox2->setValue("StrangeValue2");

		$expected = BaseTags::label($checkBox1->out() . "StrangeName1", "class='checkbox-block'");
		$expected .= BaseTags::label($checkBox2->out() . "StrangeName2", "class='checkbox-block'");
		$expected = BaseTags::div($expected, "class='form-group'");

		$this->assertEquals($expected, $actual);
	}
	// -------------------------------------------------------------------------
}