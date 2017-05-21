<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;

/**
 * Created on 20 lip 2014 15:31:16
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
class GroupCheckBoxListField extends CheckBoxListField
{
	// -------------------------------------------------------------------------
	protected $showOpenFieldset = true;
	// -------------------------------------------------------------------------
	public function closeOpenFieldset()
	{
		$this->showOpenFieldset = false;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->init();
		$this->attrib = null;
		$retval = "";
		foreach($this->dane as $desc => $grupa)
		{
			$groupName = "data-" . getRandomStringLetterOnly(5);
			$list = "";
			foreach($grupa as $value)/* @var $value WidgetItem */
			{
				$a = new CheckBoxField();
				$a->setName($this->name . "[]");
				$a->setId($this->name . "_" . $value->getVal());
				$a->setSelected(isset($this->selected[$value->getVal()]));
				$a->setValue($value->getVal());
				$a->setCustomAttrib($groupName . "='1'");
				$list .= BaseTags::p($a->out() . BaseTags::label($value->getDesc()));
			}

			$multiCheck = BaseTags::input("type='checkbox' class='zLewej' onclick='\$(\"input[" . $groupName . "]\").prop(\"checked\",\$(this).prop(\"checked\"))'");
			$retval .= Fieldset($desc . $multiCheck, $list, $this->showOpenFieldset);
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function init()
	{
		$tmp = array();
		foreach($this->dane as $d)/* @var $d WidgetItem */
		{
			$tmp[$d->getGroupDesc()][] = $d;
		}
		$this->dane = $tmp;
	}
	// -------------------------------------------------------------------------
}
?>