<?php
namespace braga\widgets\base;
use braga\widgets\base\TextField;
use braga\tools\html\BaseTags;

/**
 * Created on 28.01.2017 17:52:21
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class MemoField extends TextField
{
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addAttrib("rows", "0");
		$this->addAttrib("cols", "0");
		if($this->required)
		{
			$this->addAttrib("required", "true");
		}
		if($this->readOnly)
		{
			$this->addAttrib("readonly", "readonly");
		}
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::textarea($this->getSelected(), $this->attrib);
	}
	// -------------------------------------------------------------------------
}