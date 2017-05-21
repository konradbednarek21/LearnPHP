<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
use braga\widgets\base\Field;

/**
 *
 * @package enmarket
 * @author Tomasz.Gajewski
 * Created on 2008-07-14 12:27:37
 * klasa odpowiedzialna za wygenerowanie formatki wyboru daty
 */
class DateField extends Field
{
	use ClassFactory;
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
		$this->classString = $this->getBaseClass();
		$this->classString .= " " . $this->getMediumSizeClass();
		$this->attrib = null;
		$this->onBlur .= "CheckDate(this," . var_export($this->required, true) . ",\"" . $this->minValue . "\",\"" . $this->maxValue . "\");";
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
		$this->addEvents();
		$this->addCustomAttrib();
		$retval = BaseTags::input($this->attrib);
		$retval .= BaseTags::script("\$(\"#" . $this->id . "\").watermark(\"RRRR-MM-DD\");\$(\"#" . $this->id . "\").datepicker({" . $this->minValueString . $this->maxValueString . " onClose: function(date, req, minDate, maxDate) {CheckDate(\$(this)," . var_export($this->required, true) . ",\"" . $this->minValue . "\",\"" . $this->maxValue . "\")}});");
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>