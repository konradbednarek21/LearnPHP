<?php

namespace braga\wordgame\backoffice\views;

use braga\tools\html\HtmlComponent;
use braga\wordgame\backoffice\utils\Page;
use braga\wordgame\backoffice\utils\Tags;
use braga\wordgame\common\obj\Modul;
use braga\wordgame\common\obj\PrawaModul;
use braga\wordgame\common\obj\Uzytkownik;

class Layout extends HtmlComponent {
	// -------------------------------------------------------------------------
	public function out() {
		$msg = new MessageView ();
		$retval = "";
		$retval .= Tags::div ( "", "id='LeftMenu'  class='col-xs-6 col-sm-4 col-md-4 col-lg-3'" );
		$retval .= Tags::div ( $this->content, "id='MainBox'  class='col-xs-6 col-sm-8 col-md-8 col-lg-9'" );
		$retval = Tags::div ( $retval, "class='row'" );
		$retval = Tags::div ( $retval, "class='container-fluid'" );

		$retval .= Tags::div ( $msg->out (), "id='MsgBox' class='container-fluid'" );
		$retval .= $this->addMenu ();
		Page::make ( $retval );
	}
	// -------------------------------------------------------------------------
	protected function addMenu() {
		$retval = "";
		if (Modul::getCurrent ()->getIdModul () != Modul::START) {
			$retval .= $this->addStartTab ();
		} else {
			$retval .= $this->addStartTabActive ();
		}
		$menu = "";
		foreach ( Uzytkownik::getCurrent ()->getWaznePrawa () as $p)/* @var $p PrawaModul */
		{
			$menu .= $this->addMenuTab ( $p );
		}
		$retval .= Tags::ul ( $menu, "class='nav navbar-nav'" );
		$retval .= $this->addLogoutTab ();
		$retval = Tags::div ( $retval, "class='container-fluid'" );
		$retval = Tags::nav ( $retval, "class='navbar navbar-default navbar-fixed-top' id='Menu'" );
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function addMenuTab(PrawaModul $p) {
		if (Modul::getCurrent ()->getIdModul () == $p->getModul ()->getIdModul ()) {
			$retval = Tags::li ( Tags::a ( Tags::span ( $p->getModul ()->getNazwa (), "class=''" ), "href='/" . $p->getModul ()->getFolder () . "/'" ), "class='active'" );
		} else {
			$retval = Tags::li ( Tags::a ( Tags::span ( $p->getModul ()->getNazwa (), "class=''" ), "href='/" . $p->getModul ()->getFolder () . "/'" ), "class=''" );
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function addLogoutTab() {
		$buttonMenu = faIcon ( "fa-fw fa-lg fa-user-circle-o" ) . "Witaj " . Uzytkownik::getCurrent ()->getFullName ();
		$buttonMenu .= Tags::span ( "", "class='caret'" );
		$buttonMenu = Tags::a ( $buttonMenu, 'href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"' );

		$menu = Tags::li ( Tags::ajaxLink ( "/?action=ChangePassForm", faIcon ( "fa-fw fa-lg fa-key" ) . "Zmień hasło" ) );
		$menu .= Tags::li ( Tags::a ( faIcon ( "fa-fw fa-lg fa-sign-out" ) . "Wyloguj", "href='/?action=Logout'" ) );
		$menu = Tags::ul ( $menu, "class='dropdown-menu'" );

		$retval = Tags::li ( $buttonMenu . $menu, "class='dropdown'" );
		$retval = Tags::ul ( $retval, "class='nav navbar-nav navbar-right'" );
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function addStartTab() {
		$retval = Tags::div ( Tags::a ( "Start", "href='/' class='navbar-brand'" ), "class='navbar-header'" );
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function addStartTabActive() {
		$retval = Tags::div ( Tags::a ( "Start", "href='/' class='navbar-brand'" ), "class='navbar-header active'" );
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>