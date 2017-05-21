<?php

/**
 * Created on 7 mar 2015 11:12:22
 * error prefix OR:300
 * maxerror prefix OR:30006
 * @author Tomasz Gajewski
 * @package daiglob
 */
namespace braga\wordgame\frontoffice\controles;

use braga\tools\html\Controler;
use braga\tools\tools\PostChecker;
use braga\wordgame\frontoffice\views\Layout;
use braga\wordgame\frontoffice\forms\LoginForm;
use braga\wordgame\frontoffice\utils\BootstrapTags;

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