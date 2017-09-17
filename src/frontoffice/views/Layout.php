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
		$menu = Tags::li(Tags::a("FizWeb.pl","href='?action=FizWeb.pl'"));
		$menu .= Tags::li(Tags::a("Notatki","href='?action=GetTresc1'"));
		$menu .= Tags::li(Tags::a("Aktualnosci","href='?action=GetTresc2'"));
		$menu .= Tags::li(Tags::a("Pomoc<br>","href='?action=GetTresc3'"));
		$retval = Tags::ul($menu,"class='nav navbar-nav'");
		$retval = BootstrapTags::container($retval);
		$retval = Tags::nav($retval,"class='navbar navbar-default navbar-fixed-top'");
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
		$retval = Tags::h3("FizWeb.pl &copy; Konrad.Bednarek21@gmail.com","class='c'");
		$retval = BootstrapTags::container($retval);
		$retval = Tags::nav($retval,"class='navbar navbar-default navbar-fixed-bottom'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	
}
?>