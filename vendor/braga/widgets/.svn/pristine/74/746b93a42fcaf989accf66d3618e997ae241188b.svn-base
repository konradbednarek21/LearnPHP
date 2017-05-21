<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
use braga\widgets\base\Field;

/**
 * Created on 29.01.2017 17:30:31
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class RadioListField extends Field
{
	// -------------------------------------------------------------------------
	protected $dane = array();
	// -------------------------------------------------------------------------
	public function addItem(WidgetItem $item)
	{
		$this->dane[] = $item;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$retval = "";
		foreach($this->dane as $value)/* @var $value WidgetItem */
		{
			$a = new RadioField();
			$a->setName($this->name);
			$a->setSelected($this->selected == $value->getVal());
			$a->setValue($value->getVal());
			$retval .= BaseTags::p($a->out() . BaseTags::label($value->getDesc()));
		}
		return BaseTags::div($retval, "class='ui-widget-content ui-corner-all'");
	}
	// -------------------------------------------------------------------------
}