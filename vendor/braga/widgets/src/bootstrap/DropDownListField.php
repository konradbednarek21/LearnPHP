<?php

namespace braga\widgets\bootstrap;

use braga\tools\html\BaseTags;

/**
 * Created on 10-06-2011 10:45:23
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class DropDownListField extends \braga\widgets\base\DropDownListField
{
	use ClassFactory;
	use AddLabels;
	// -------------------------------------------------------------------------
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->setClassString($this->getBaseClass());
		$this->setOnChange("checkDropDownList(this);");
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefault();
		$input = parent::out();
		$label = $this->getLabel();
		if($this->required && empty($this->selected))
		{
			return BaseTags::div($label . $input, "class='form-group has-error'");
		}
		else
		{
			return BaseTags::div($label . $input, "class='form-group'");
		}
	}
	// -------------------------------------------------------------------------
}
?>