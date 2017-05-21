<?php

namespace braga\widgets\base;

use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 16:45:56
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class TextField extends Field
{
	// -------------------------------------------------------------------------
	protected $maxLength = null;
	protected $type = "text";
	protected $readOnly = false;
	// -------------------------------------------------------------------------
	public function setMaxLength($maxLength)
	{
		$this->maxLength = $maxLength;
	}
	// -------------------------------------------------------------------------
	public function setType($type)
	{
		$this->type = $type;
	}
	// -------------------------------------------------------------------------
	public function setReadOnly($readOnly = true)
	{
		$this->readOnly = $readOnly;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->addAttrib("type", $this->type);
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("maxlength", $this->maxLength);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", $this->selected);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addAttrib("required", $this->required);
		if($this->readOnly)
		{
			$this->addAttrib("readonly", "readonly");
		}
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::input($this->attrib);
	}
	// -------------------------------------------------------------------------
}
?>