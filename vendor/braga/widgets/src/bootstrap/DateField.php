<?php

namespace braga\widgets\bootstrap;

use braga\tools\html\BaseTags;
use braga\widgets\base\Field;

/**
 *
 * @author Tomasz.Gajewski
 * Created on 2016-07-14 12:27:37
 * klasa odpowiedzialna za wygenerowanie formatki wyboru daty
 */
class DateField extends Field
{
	use AddLabels;
	// -------------------------------------------------------------------------
	protected $minValue = null;
	protected $maxValue = null;
	protected $minValueString = null;
	protected $maxValueString = null;
	// -------------------------------------------------------------------------
	public function setMinValue($minValue)
	{
		$this->minValue = $minValue;
		$this->minValueString = "minDate: new Date(" . substr($minValue, 0, 4) . ", " . (intval(substr($minValue, 5, 2)) - 1) . "," . substr($minValue, 8, 2) . "), ";
	}
	// -------------------------------------------------------------------------
	public function setMaxValue($maxValue)
	{
		$this->maxValue = $maxValue;
		$this->maxValueString = "maxDate: new Date(" . substr($maxValue, 0, 4) . ", " . (intval(substr($maxValue, 5, 2)) - 1) . "," . substr($maxValue, 8, 2) . "), ";
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->attrib = null;
		if($this->required)
		{
			if(null == $this->selected)
			{
				$this->setSelected(date(PHP_DATE_FORMAT));
			}
		}
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("maxlength", 10);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", $this->selected);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addAttrib("placeholder", "RRRR-MM-DD");
		$this->addEvents();
		$this->addCustomAttrib();
		$retval = BaseTags::input($this->attrib);
		$retval .= BaseTags::span(BaseTags::button(BootstrapTags::icon("glyphicon-calendar"), "class='btn btn-default' type='button' onclick='\$(\"#" . $this->id . "\").datepicker(\"show\")'"), "class='input-group-btn'");
		$retval = BaseTags::div($retval, "class='input-group'");
		$retval .= BaseTags::script("\$(\"#" . $this->id . "\").datepicker({format:\"yyyy-mm-dd\"});");

		$label = $this->getLabel();
		if($this->required && empty($this->selected))
		{
			return BaseTags::div($label . $retval, "class='form-group has-error'");
		}
		else
		{
			return BaseTags::div($label . $retval, "class='form-group'");
		}
	}
	// -------------------------------------------------------------------------
}
?>