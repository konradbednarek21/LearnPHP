<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\BaseTags;

/**
 * Created on 2009-05-18 10:33:17 klasa generująca pole za zakładkami razem z
 * boxem w środku
 * @author Tomasz.Gajewski
 */
class TabBox
{
	private $boxId;
	private $tabs;
	private $item;
	private $ajax;
	private $minHeight;
	private $defaultTab;
	// -------------------------------------------------------------------------
	public function __construct()
	{
		$this->tabs = array();
		$this->item = 0;
		$this->ajax = "onclick='return ajax.go(this)'";
		$this->boxId = "";
		$this->minHeight = 300;
		$this->defaultTab = 1;
	}
	// -------------------------------------------------------------------------
	public function setDefaultTab($id)
	{
		$this->defaultTab = $id;
	}
	// -------------------------------------------------------------------------
	public function disableAjax()
	{
		$this->ajax = "";
	}
	// -------------------------------------------------------------------------
	public function setMinHeight($height)
	{
		$this->minHeight = intval($height);
	}
	// -------------------------------------------------------------------------
	public function setBoxId($id)
	{
		$this->boxId = "id='" . $id . "'";
	}
	// -------------------------------------------------------------------------
	public function out($activeId = 1, $content = "")
	{
		$tabOk = false;
		foreach($this->tabs as $value)
		{
			if($value["id"] == $activeId)
			{
				$tabOk = true;
			}
		}
		if(!$tabOk)
		{
			$activeId = $this->defaultTab;
		}
		$retval = "";
		if($this->item > 0)
		{
			for($i = 0; $i < $this->item; $i++)
			{
				if($activeId == $this->tabs[$i]["id"])
				{
					$retval .= $this->menuActive($this->tabs[$i]["desc"], $this->tabs[$i]["href"]);
				}
				else
				{
					$retval .= $this->menuPassive($this->tabs[$i]["desc"], $this->tabs[$i]["href"]);
				}
			}
			$retval = BaseTags::ul($retval, "class='ui-tabs-nav ui-corner-top ui-helper-reset ui-helper-clearfix ui-widget-header' style='height:28px;'");
			$retval .= BaseTags::div($content, "class='ui-corner-bottom ui-widget-content' style='padding:4px;min-height:300px' " . $this->boxId . " ");
			$retval = BaseTags::div($retval, "class='ui-tabs ui-corner-all'");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	public function addTab($id, $opis, $href)
	{
		$this->tabs[$this->item]["id"] = $id;
		$this->tabs[$this->item]["desc"] = $opis;
		$this->tabs[$this->item]["href"] = $href;
		$this->item++;
	}
	// -------------------------------------------------------------------------
	private function menuPassive($opis, $href)
	{
		$retval = BaseTags::li(BaseTags::a($opis, $this->ajax . " href='" . $href . "'"), "class='ui-tabs-tab ui-corner-top ui-state-default ui-tab'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function menuActive($opis, $href)
	{
		$retval = BaseTags::li(BaseTags::a($opis, $this->ajax . " href='" . $href . "'"), "class='ui-tabs-tab ui-corner-top ui-state-default ui-tab ui-tabs-active ui-state-active'");
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>