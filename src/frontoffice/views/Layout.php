<?php

namespace braga\wordgame\frontoffice\views;

use braga\tools\html\HtmlComponent;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\frontoffice\utils\BootstrapTags;
use braga\wordgame\frontoffice\utils\Page;

class Layout extends HtmlComponent
{
	// -------------------------------------------------------------------------
	protected function getMessageArea()
	{
		$m = new MessageView();
		$retval = $m->out();
		$retval = Tags::div($retval, "id='MsgBox'");
		$retval = BootstrapTags::container($retval);
		return $retval;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$retval = $this->getTitle();
		$retval .= $this->getMainArea();
		$retval .= $this->getFooterArea();
		$retval .= $this->getMessageArea();
		Page::make($retval);
	}
	// -------------------------------------------------------------------------
	private function getTitle()
	{
		$brandLogo = $this->getTitleLogo();
		$menu = Tags::li(Tags::a("Tresc1","href='?action=GetTresc1'"));
		$menu .= Tags::li(Tags::a("Tresc2","href='?action=GetTresc2'"));
		$menu .= Tags::li(Tags::a("Tresc3","href='?action=GetTresc3'"));
		$retval = Tags::div($brandLogo,"class='nav navbar-header'");
		$retval .= Tags::ul($menu,"class='nav navbar-nav'");
		$retval = BootstrapTags::container($retval);
		$retval = Tags::nav($retval,"class='navbar navbar-default'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getTitleLogo()
	{
		$retval = Tags::div("","id='Logo'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getMainArea()
	{
		$retval = BootstrapTags::container(Tags::div($this->content, "id='MainBox'"));
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getFooterArea()
	{
		$retval = Tags::li("FizWeb.pl &copy; Konrad.Bednarek21@gmail.com");

		$retval = Tags::ul($retval,"class='nav navbar-nav'");
		$retval = BootstrapTags::container($retval);
		$retval = Tags::nav($retval,"class='navbar navbar-default navbar-fixed-bottom'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	
}
?>