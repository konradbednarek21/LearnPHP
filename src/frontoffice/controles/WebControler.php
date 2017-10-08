<?php

namespace braga\wordgame\frontoffice\controles;

use braga\tools\html\Controler;
use braga\tools\tools\PostChecker;
use braga\wordgame\frontoffice\utils\Perms;
use braga\wordgame\frontoffice\views\Layout;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\frontoffice\utils\BootstrapTags;

class WebControler extends Controler {
	// -------------------------------------------------------------------------
	protected function getRetvalObject() {
		return new FritRetval ();
	}
	// -------------------------------------------------------------------------
	public function doAction() {
		switch (PostChecker::get ( "action" )) {
			case "LogOut" :
				$this->logout ();
				break;
			case "" :
				$this->makeWorkArea ();
				break;
			default :
				addAlert ( "OR:20001 " . PostChecker::get ( "action" ) . " nie jest obsługiwane" );
				break;
		}
		$this->setLayOut ( new Layout () );
		$this->page ();
	}
	// -------------------------------------------------------------------------
	private function logout() {
		Perms::logout ();
	}
	// -------------------------------------------------------------------------
	private function makeWorkArea() {
		$retval = "Hello";
		
		$this->r->addPage ( $retval );
	}
	// -------------------------------------------------------------------------
	
	// moja próba tworzenia tresci na stronie
	private function getGeneralMenu() {
		$retval = Tags::div ( $this->getBigBox (), "class='BigBox'" );
		$retval .= Tags::div ( $this->getRightBox (), "class='RightBox'" );
		$retval = BootstrapTags::container ( $retval );
		$retval = BootstrapTags::containerFluid ( $retval, "GeneralMenu" );
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getBigBox() {
		$retval = "Tresc";
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function RightBox() {
		$retval = "Prawa tresc";
		return $retval;
	}
}
?>