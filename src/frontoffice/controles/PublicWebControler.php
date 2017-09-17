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
		$retval .= $this->getSecondLine();
		$retval .= $this->getThirdLine();
		$retval .= $this->getFourthLine();
		$this->r->addPage($retval); 
	}
	// -------------------------------------------------------------------------
	private function getFirstLine()
	{
		$karuzela = $this->getKaruzela();
		$retval = Tags::div($karuzela,"class='col-md-9 col-sm-8'");
		$retval .= Tags::div($this->getKimJestem(),"class='col-md-3 col-sm-4'");
		$retval = Tags::div($retval,"class='row'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getKaruzela()
	{
		$retval = Tags::h1("Karuzela", "class='.carousel'");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	
	private function getKimJestem()
	{
		$retval = Tags::h2("Kim jestesmy?");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function getSecondLine()
	{
		$notatki = $this->getNotatki1();
		$retval = Tags::div($notatki,"class='col-md-4 col-sm-4'");
		
		$retval .= Tags::div($this->getNotatki2(),"class='col-md-3 col-sm-4'");
		
		
		
		$retval .= Tags::div($this->getNotatki3(),"class='col-md-5 col-sm-4'");
		
		
		$retval = Tags::div($retval,"class='row'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getNotatki1()
	{
		$retval = Tags::h1("Not1");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function getNotatki2()
	{
		$retval = Tags::h1("Not2");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function getNotatki3()
	{
		$retval = Tags::h1("Not3");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function getThirdLine()
	{
		$tabela = $this->getTabela();
		$retval = Tags::div($tabela,"class='col-md-9 col-sm-8'");
		$retval .= Tags::div($this->getNotatki4(),"class='col-md-3 col-sm-4'");
		$retval = Tags::div($retval,"class='row'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getTabela()
	{
		$retval = Tags::h1("Tabela");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	
	private function getNotatki4()
	{
		$retval = Tags::h1("Not4");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function getFourthLine()
	{
		$prezentacja = $this->getPrezentacja();
		$retval = Tags::div($prezentacja,"class='col-md-9 col-sm-8'");
		$retval .= Tags::div($this->getIloscOdwiedzin(),"class='col-md-3 col-sm-4'");
		$retval = Tags::div($retval,"class='row'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	private function getPrezentacja()
	{
		$retval = Tags::h1("Prezentacja");
		return Tags::div($retval, "class='jumbotron'");
	}
	// -------------------------------------------------------------------------
	private function getIloscOdwiedzin()
	{
		$retval = Tags::h2("Ilosc Odwiedzin");
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