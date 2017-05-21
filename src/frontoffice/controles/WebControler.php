<?php


namespace braga\wordgame\frontoffice\controles;

use braga\tools\html\Controler;
use braga\tools\tools\PostChecker;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\frontoffice\views\Layout;
use braga\wordgame\common\obj\GameRoom;
use braga\wordgame\common\obj\Game;
use braga\wordgame\common\obj\Word;
use braga\wordgame\frontoffice\forms\GameForm;
use braga\wordgame\common\obj\Slowko;
use braga\wordgame\frontoffice\utils\Perms;
use braga\wordgame\frontoffice\forms\NewRoomForm;
use braga\wordgame\common\obj\User;
use braga\wordgame\frontoffice\views\GameRoomList;
use braga\wordgame\common\obj\UserGame;
use braga\wordgame\frontoffice\forms\WordsScrableForm;

class WebControler extends Controler
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
			case "LogOut":
				$this->logout();
				break;
			case "":
				$this->makeWorkArea();
				break;
			default :
				addAlert("OR:20001 " . PostChecker::get("action") . " nie jest obsługiwane");
				break;
		}
		$this->setLayOut(new Layout());
		$this->page();
	}
	// -------------------------------------------------------------------------
	private function logout()
	{
		Perms::logout();
	}
	// -------------------------------------------------------------------------
	private function makeWorkArea()
	{
		
	}
	// -------------------------------------------------------------------------
}
?>