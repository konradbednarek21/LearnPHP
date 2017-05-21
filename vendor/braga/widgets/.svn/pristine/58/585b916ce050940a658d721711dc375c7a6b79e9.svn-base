<?php
namespace braga\widgets\base;
use braga\tools\html\BaseTags;
use braga\widgets\base\Field;

/**
 * Created on 10-06-2011 10:45:23
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
class DropDownListField extends Field
{
	// -------------------------------------------------------------------------
	protected $dane = array();
	protected $group = false;
	protected $requiredText = "-=Wybierz=-";
	// -------------------------------------------------------------------------
	protected $optionAtrib = null;
	protected $optionGroupAtrib = null;

	// -------------------------------------------------------------------------
	public function addOptionAtrib($atr)
	{
		$this->optionAtrib = trim($this->optionAtrib . " " . trim($atr));
	}
	// -------------------------------------------------------------------------
	public function addOptionGroupAtrib($atr)
	{
		$this->optionGroupAtrib = trim($this->optionGroupAtrib . " " . trim($atr));
	}
	// -------------------------------------------------------------------------
	public function addItem(WidgetItem $item)
	{
		$this->dane[] = $item;
	}
	// -------------------------------------------------------------------------
	public function enableGrouping()
	{
		$this->group = true;
	}
	// -------------------------------------------------------------------------
	protected function getOption($label, $value)
	{
		if($this->selected == $value)
		{
			return BaseTags::option($label, "value='" . $value . "' " . $this->optionAtrib . " selected='selected'");
		}
		else
		{
			return BaseTags::option($label, "value='" . $value . "' " . $this->optionAtrib);
		}
	}
	// -------------------------------------------------------------------------
	protected function getOptionGroup($label, $options)
	{
		return BaseTags::optgroup($options, "label='" . $label . "' " . $this->optionGroupAtrib);
	}
	// -------------------------------------------------------------------------
	protected function prepareGroup()
	{
		$tmp = array();
		foreach($this->dane as $d ) /* @var $d WidgetItem */
		{
			$tmp[$d->getGroupDesc()][] = $d;
		}
		return $tmp;
	}
	// -------------------------------------------------------------------------
	protected function getGroupOptions()
	{
		$options = "";
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
		foreach($this->dane as $d ) /* @var $d WidgetItem */
		{
			$options .= $this->getOption($d->getDesc(), $d->getVal());
		}
		return $options;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		if($this->group)
		{
			$options = $this->getGroupOptions();
		}
		else
		{
			$options = $this->getSimpleOptions();
		}

		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::select($options, $this->attrib);
	}
	// -------------------------------------------------------------------------
}
?>