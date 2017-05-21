<?php
namespace braga\widgets\jqueryui;
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
	// -------------------------------------------------------------------------
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->addOptionAtrib("class='ui-state-default'");
		$this->addOptionGroupAtrib("class='ui-priority-primary widget ui-widget-content'");
		$this->setClassString($this->getBaseClass() . " combo");
		$this->setOnChange("SprawdzCombo(this);");
	}
	// -------------------------------------------------------------------------
	protected function getGroupOptions()
	{
		$options = "";
		if($this->required)
		{
			$this->setClassString($this->getBaseClass() . " combo ui-state-error");
			$tmp = BaseTags::option($this->requiredText, "value='' class='ui-state-default ui-state-error' selected='selected'");
			$options .= BaseTags::optgroup($tmp, "label='" . $this->requiredText . "' class='ui-priority-primary widget ui-widget-content ui-state-error'");
		}
		$tmp = $this->prepareGroup();
		foreach($tmp as $key => $value)
		{
			$opt = "";
			foreach($value as $d)/* @var $d WidgetItem */
			{
				$opt .= $this->getOption($d->getDesc(), $d->getVal());
			}
			$options .= $this->getOptionGroup($key, $opt);
		}
		return $options; // kasia kocha tomka :))
	}
	// -------------------------------------------------------------------------
	protected function getSimpleOptions()
	{
		$options = "";
		if(empty($this->selected))
		{
			$options .= BaseTags::option($this->requiredText, "value='' class='ui-state-default " . ($this->required ? "ui-state-error" : "") . "' selected='selected'");
			if($this->required)
			{
				$this->setClassString($this->getBaseClass() . " combo ui-state-error");
			}
		}
		$options .= parent::getSimpleOptions();
		return $options;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefault();

		return parent::out();
	}
	// -------------------------------------------------------------------------
}
?>