<?php

namespace braga\wordgame\frontoffice\views;

use braga\tools\html\HtmlComponent;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\frontoffice\utils\BootstrapTags;
use braga\wordgame\frontoffice\utils\Page;
use braga\wordgame\common\obj\User;

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
		$retval .= $this->getMessageArea();
		$retval .= $this->getMainArea();
		$retval .= $this->getFooterArea();
		Page::make($retval);
	}
	// -------------------------------------------------------------------------
	private function getTitle()
	{
		$retval = Tags::div($this->getTitleLogo(),"class='TitleLogo'");
		$retval .= Tags::div($this->getTitleMenu(), "class='TitleMenu'");
		$retval .= Tags::div($this->getTitleZalogujWyloguj(), "class='TitleZalogujWyloguj'");
		$retval = BootstrapTags::container($retval);
		$retval = BootstrapTags::containerFluid($retval, "TitleBox");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getTitleMenu()
	{
		$retval = "Zakładka 1";
		$retval .= "&nbsp;Zakładka 2";
		$retval .= "&nbsp;Zakładka 3";
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getTitleZalogujWyloguj()
	{
		$retval = "Zaloguj/Wyloguj";
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getTitleLogo()
	{
		$retval = Tags::div("","id='Logo'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getTitle1()
	{
		$logout = Tags::span("FizWeb.pl");
		$retval = "FizWeb.pl";
		if(User::getCurrent() instanceof User)
		{
			$logout = Tags::span("", "class='glyphicon glyphicon-log-out'") . " Wyloguj";
			$retval .= Tags::a(Tags::button($logout, "class='btn btn-lg btn-primmary zPrawej ButtonWG'"), "href='?action=LogOut'");

			$userInfo = "Witaj:&nbsp" . User::getCurrent()->getUser() . "&nbsp:)";
			$retval .= Tags::span($userInfo, "class='btn btn-lg btn-primmary zPrawej ButtonLogout' style='margin-right:20px;' id='placowka_span'");

			$retval .= $this->getModuleButtons();
		}
		else
		{
			$logout = Tags::span("", "class='glyphicon glyphicon-log-in'") . " Zaloguj sie";
			$retval .= Tags::a(Tags::button($logout, "class='btn btn-lg btn-primmary zPrawej ButtonWG'"), "href='?action=Login'");
		}

		$retval = BootstrapTags::container($retval);
		$retval = BootstrapTags::containerFluid($retval, "TitleBox");

		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getModuleButtons()
	{
		$gameListButton = $this->getButton("Dodaj wpis", "button_game_list", "?action=GetGameRoomList");
		$newRoomButton = $this->getButton("Dodaj kategorię", "button_new_game", "?action=GetNewRoomForm");
// 		$statisticBut	ton = $this->getButton("Statystyki", "button_statistic", "?action=GetStatisticForm");
		$retval = "";
		$retval .= BootstrapTags::col($gameListButton, "col-xs-12 col-sm-6 col-md-6 col-lg-3");
		$retval .= BootstrapTags::col($newRoomButton, "col-xs-12 col-sm-6 col-md-6 col-lg-3");
// 		$retval .= BootstrapTags::col($statisticButton, "col-xs-12 col-sm-6 col-md-6 col-lg-3");
		return BootstrapTags::row($retval);
	}
	// -------------------------------------------------------------------------
	protected function getButton($txt, $idbutton, $href)
	{
		$retval = Tags::button($txt, "class='btn btn-lg btn-block SelectModuleButton'  id='" . $idbutton . "' onclick='return ajax.get(\"" . $href . "\",false)'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getButtonOffline($txt, $idbutton)
	{
		$retval = Tags::button($txt, "class='btn btn-default btn-lg btn-block SelectModuleButton'  id='" . $idbutton . "'");
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
		$retval = "FizWeb.pl &copy; Konrad.Bednarek21@gmail.com";
		$retval = BootstrapTags::container($retval);
		return $retval;
	}
	// -------------------------------------------------------------------------
	
}
?>