<?php

namespace braga\widgets\base;

use braga\tools\html\BaseTags;

/**
 * Created on 07-04-2011 17:06:56
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class CheckBoxField extends Field
{
	// -------------------------------------------------------------------------
	protected $type = "checkbox";
	protected $value = "1";
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
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", $this->value);
		$this->addAttrib("tabindex", $this->tabOrder);
		if($this->selected)
		{
			$this->addAttrib("checked", "checked");
		}
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::input($this->attrib);
	}
	// -------------------------------------------------------------------------
}
?>