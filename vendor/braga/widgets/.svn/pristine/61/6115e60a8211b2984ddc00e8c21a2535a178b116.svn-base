<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
use braga\widgets\base\Field;

/**
 * Created on 15 sie 2013 14:53:51
 * @author Tomasz Gajewski
 * @package frontoffice
 * error prefix
 */
class TimeField extends Field
{
	use ClassFactory;
	// -------------------------------------------------------------------------
	protected function setDefaults()
	{
		$this->class .= $this->getBaseClass();
		$this->class .= " " . $this->getMediumSizeClass();
		$this->onFocus .= "\$(this).select();";
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefaults();
		$this->attrib = null;
		$this->onBlur .= "CheckTime(this," . var_export($this->required, true) . ");";
		if($this->required)
		{
			if(null == $this->selected)
			{
				$this->classString .= " " . $this->getErrorClass();
			}
		}
		$this->onFocus .= "\$(this).addClass(\"ui-state-highlight\");";
		$this->onBlur .= "\$(this).removeClass(\"ui-state-highlight\");";
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("maxlength", 5);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("value", substr($this->selected, 0, 5));
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addEvents();
		$this->addCustomAttrib();
		$retval = BaseTags::script("\$(\"#" . $this->id . "\").watermark(\"GG:MM\");");
		return BaseTags::p(parent::out() . $retval, "style='min-height:25px;'");
	}
	// -------------------------------------------------------------------------
}
?>