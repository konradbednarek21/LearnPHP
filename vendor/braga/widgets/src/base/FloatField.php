<?php

namespace braga\widgets\base;

use braga\tools\html\BaseTags;
use braga\widgets\base\Field;

/**
 * Created on 17-05-2011 07:55:40
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class FloatField extends Field
{
	// -------------------------------------------------------------------------
	protected $minValue = "null";
	protected $maxValue = "null";
	protected $precision = 2;
	protected $maxLength = 22;
	protected $type = "text";
	protected $readOnly = false;
	// -------------------------------------------------------------------------
	public function setReadOnly($readOnly = true)
	{
		$this->readOnly = $readOnly;
	}
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
	public function setMinValue($minValue)
	{
		$this->minValue = $minValue;
	}
	// -------------------------------------------------------------------------
	public function setMaxValue($maxValue)
	{
		$this->maxValue = $maxValue;
	}
	// -------------------------------------------------------------------------
	public function setPrecision($precision)
	{
		$this->precision = $precision;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->addAttrib("type", $this->type);
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", $this->selected);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addAttrib("maxlength", $this->maxLength);
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