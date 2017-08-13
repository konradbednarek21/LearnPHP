<?php

namespace braga\wordgame\frontoffice\controles;

use braga\tools\html\Controler;
use braga\tools\tools\PostChecker;
use braga\wordgame\frontoffice\forms\LoginForm;
use braga\wordgame\frontoffice\views\Layout;
use braga\wordgame\frontoffice\utils\Tags;

class PublicWebControler extends Controler
{
	// -------------------------------------------------------------------------
	protected function getRetvalObject()
	{
		return new FritRetval();
	}
	// -------------------------------------------------------------------------
	public function doAction()
	{
		switch(PostChecker::get("action"))
		{
			case "Login":
				$this->makeWorkArea();
				break;
			case "":
				$this->getMakeWorkArea();
				break;
			case "LogOut":
				header("Location:/");
				exit();
			default :
				addAlert("WG:10001 " . PostChecker::get("action") . " nie jest obsługiwane");
				break;
		}
		$this->setLayOut(new Layout());
		$this->page();
	}
	// -------------------------------------------------------------------------
	private function getMakeWorkArea()
	{
		$retval = $this->getFirstLine();
		
		$this->r->addPage($retval); 
	}
	// -------------------------------------------------------------------------
	private function getFirstLine()
	{
		$karuzela = $this->getKaruzela();
		$retval = Tags::div($karuzela,"class='col-md-9 col-sm-6'");
		$retval .= Tags::div($this->getKimJestem(),"class='col-md-3 col-sm-6'");
		$retval = Tags::div($retval,"class='row'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getKimJestem()
	{
		$retval = Tags::h1("Kim jestesmy");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function getKaruzela()
	{
		$retval = Tags::h1("Jumbo");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function makeWorkArea()
	{
		$this->r->addPage($this->getLoginForm());
	}
	// -------------------------------------------------------------------------
	private function getLoginForm()
	{
		$loginForm = new LoginForm();
		return $loginForm->out();
	}
	// -------------------------------------------------------------------------
}