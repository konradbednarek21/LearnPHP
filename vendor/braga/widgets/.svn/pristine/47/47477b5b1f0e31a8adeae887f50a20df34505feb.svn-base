<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
use braga\widgets\base\Field;

/**
 * create 03-06-2012 10:33:21
 * @author Tomasz Gajewski
 * @package
 *
 */
class RadioField extends Field
{
	// -------------------------------------------------------------------------
	protected $type = "radio";
	protected $value = null;
	// -------------------------------------------------------------------------
	public function setValue($value)
	{
		$this->value = $value;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->attrib = null;
		$this->addAttrib("type", $this->type);
		$this->addAttrib("id", $this->name . "_" . $this->value);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("value", $this->value);
		$this->addAttrib("tabindex", $this->tabOrder);
		if($this->selected)
			$this->addAttrib("checked", "checked");
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::input($this->attrib);
	}
	// -------------------------------------------------------------------------
}
?>