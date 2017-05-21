<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;
/**
 * Created on 08-04-2011 11:42:29
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class MemoField extends \braga\widgets\base\MemoField
{
	use ClassFactory;
	// -------------------------------------------------------------------------
	protected $class = null;
	// -------------------------------------------------------------------------
	protected function setDefaults()
	{
		$this->class .= $this->getBaseClass();
		$this->class .= " " . $this->getMediumSizeClass();
		$this->onFocus .= "\$(this).select();";
		if(empty($this->maxLength))
		{
			$this->setMaxLength(65535);
		}
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefaults();

		if(!$this->readOnly)
		{
			$this->onFocus .= "\$(this).addClass(\"widgetHighLight a ui-state-highlight\");";
			$this->onBlur .= "\$(this).removeClass(\"widgetHighLight a ui-state-highlight\");";
		}
		if($this->required)
		{
			$this->onKeyUp .= "checkIsNull(this);";
			$this->onBlur .= "checkIsNull(this);";
			if($this->selected == "")
			{
				$this->class .= " " . $this->getErrorClass();
			}
		}

		$this->setClassString($this->class);
		return BaseTags::p(parent::out(), "style='min-height:85px;'");
	}
	// -------------------------------------------------------------------------
}
?>