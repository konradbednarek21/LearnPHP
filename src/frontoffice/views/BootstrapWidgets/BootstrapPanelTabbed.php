<?php
/**
 * Created on 4 gru 2015 20:42:47
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
namespace braga\wordgame\frontoffice\views\BootstrapWidgets;


use braga\tools\html\HtmlComponent;
use braga\tools\html\BaseTags;

class BootstrapPanelTabbed extends HtmlComponent
{
	// -------------------------------------------------------------------------
	protected $panels = array();
	protected $defaultIdPanel = null;
	// -------------------------------------------------------------------------
	public function addTab($tabLabel, $id, $content)
	{
		$p = new BootstrapPanelItem();
		$p->tabLabel = $tabLabel;
		$p->id = $id;
		$p->content = $content;
		$this->panels[] = $p;
	}
	// -------------------------------------------------------------------------
	public function setDefaultIdPanel($id)
	{
		$this->defaultIdPanel = $id;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$retval = $this->getNavTabs();
		$retval .= $this->getTabsContent();
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getNavTabs()
	{
		$retval = "";
		foreach($this->panels as $p)/* @var $p BootstrapPanelItem */
		{
			$content = BaseTags::a($p->tabLabel, "href='#" . $p->id . "' role='tab' data-toggle='tab'");
			if($p->id == $this->defaultIdPanel)
			{
				$retval .= BaseTags::li($content, "class='active'");
			}
			else
			{
				$retval .= BaseTags::li($content, "");
			}
		}
		return BaseTags::ul($retval, "class='nav nav-tabs' role='tablist'");
	}
	// -------------------------------------------------------------------------
	protected function getTabsContent()
	{
		$retval = "";
		foreach($this->panels as $p)/* @var $p BootstrapPanelItem */
		{
			
			if($p->id == $this->defaultIdPanel)
			{
				$retval .= BaseTags::div($p->content, "id='" . $p->id . "' class='tab-pane active'");
			}
			else
			{
				$retval .= BaseTags::div($p->content, "id='" . $p->id . "' class='tab-pane'");
			}
		}
		return BaseTags::div($retval, "class='tab-content' style='margin-top:20px'");
	}
	// -------------------------------------------------------------------------
}
?>