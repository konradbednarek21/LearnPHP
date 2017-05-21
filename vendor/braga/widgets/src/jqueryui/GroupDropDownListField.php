<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;

/**
 * Created on 7 kwi 2014 21:46:21
 * error prefix
 * @author Tomasz Gajewski
 * @package frontoffice
 */
class GroupDropDownListField extends DropDownListField
{
	// -------------------------------------------------------------------------
	const CLASS_OPTION_GROUP = "";
	const CLASS_OPTION = "";
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->init();
		$this->attrib = null;
		$retval = "";

		foreach($this->dane as $desc => $grupa)
		{
			$list = "";
			foreach($grupa as $item)/* @var $item WidgetItem */
			{
				if($item->getVal() == $this->selected)
				{
					$selected = " selected='selected'";
				}
				else
				{
					$selected = "";
				}
				$list .= BaseTags::option($item->getDesc(), "value='" . $item->getVal() . "' class='" . self::CLASS_OPTION . "'" . $selected . " " . $item->getCustomAttrib());
			}
			$retval .= BaseTags::optgroup($list, "label='" . $desc . "' class='" . self::CLASS_OPTION_GROUP . "'");
		}

		$this->addAttrib("id", $this->id);
		$this->addAttrib("name", $this->name);
		$this->addAttrib("class", $this->classString);
		$this->addAttrib("tabindex", $this->tabOrder);
		$this->addEvents();
		$this->addCustomAttrib();
		return BaseTags::select($retval, $this->attrib);
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