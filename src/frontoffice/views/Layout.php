<?php

/**
 * Created on 13 lip 2013 16:24:56
 * @author Tomasz Gajewski
 * @package frontoffice
 * error prefix
 */
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
		Page::make($retval);
	}
	// -------------------------------------------------------------------------
	protected function getTitle()
	{
		$retval = "FizWeb.pl";
		$retval = Tags::a(Tags::span("", "id='Logo'"), "href='/'");
		if(User::getCurrent() instanceof User)
		{
			$logout = Tags::span("", "class='glyphicon glyphicon-log-out'") . " Wyloguj";
			$retval .= Tags::a(Tags::button($logout, "class='btn btn-lg btn-primmary zPrawej ButtonWG'"), "href='?action=LogOut'");

			$userInfo = "Witaj: " . User::getCurrent()->getUser();
			$retval .= Tags::span($userInfo, "class='btn btn-lg btn-primmary zPrawej ButtonLogout' style='margin-right:20px;' id='placowka_span'");

			$retval .= $this->getModuleButtons();
		}
		else
		{
			$logout = Tags::span("", "class='glyphicon glyphicon-log-out'") . " Zaloguj sie";
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
}
?>