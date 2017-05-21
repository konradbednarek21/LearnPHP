<?php
use braga\widgets\jqueryui\TextField;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 14:05:37
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class JQTextFieldTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testSimpleTestField()
	{
		$t = new TextField();
		$retval = $t->out();
		$oczekiwane = BaseTags::input("type='text' maxlength='255' class='widget ui-widget-content ui-corner-all widgetSizeMedium' onblur='$(this).removeClass(\"widgetHighLight a ui-state-highlight\");' onfocus='$(this).select();$(this).addClass(\"widgetHighLight a ui-state-highlight\");'");
		$oczekiwane = BaseTags::p($oczekiwane, "style='min-height:25px;'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testNameTestField()
	{
		$t = new TextField();
		$t->setName("textfield");
		$retval = $t->out();
		$oczekiwane = BaseTags::input("type='text' id='textfield' name='textfield' maxlength='255' class='widget ui-widget-content ui-corner-all widgetSizeMedium' onblur='$(this).removeClass(\"widgetHighLight a ui-state-highlight\");' onfocus='$(this).select();$(this).addClass(\"widgetHighLight a ui-state-highlight\");'");
		$oczekiwane = BaseTags::p($oczekiwane, "style='min-height:25px;'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
	function testNameAndPreselectedTestField()
	{
		$t = new TextField();
		$t->setName("textfield");
		$t->setSelected("stragevalue");
		$retval = $t->out();
		$oczekiwane = BaseTags::input("type='text' id='textfield' name='textfield' maxlength='255' class='widget ui-widget-content ui-corner-all widgetSizeMedium' value='stragevalue' onblur='$(this).removeClass(\"widgetHighLight a ui-state-highlight\");' onfocus='$(this).select();$(this).addClass(\"widgetHighLight a ui-state-highlight\");'");
		$oczekiwane = BaseTags::p($oczekiwane, "style='min-height:25px;'");

		$this->assertEquals($oczekiwane, $retval);
	}
	// -------------------------------------------------------------------------
}
?>