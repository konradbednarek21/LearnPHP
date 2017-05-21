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
			case "GetWord":
				$this->getWord();
				break;
			case "GetGame":
				$this->getGame();
				break;
			case "CreateNewRoom":
				$this->createNewRoom();
				break;
			case "GetNewRoomForm":
				$this->getNewRoomForm();
				break;
			case "SaveWord":
				$this->checkWord();
				break;
			case "GetGameRoomList":
				$this->getGameRoomListAddChange();
				break;
			case "":
				$this->getGameRoomList();
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
	private function saveWord()
	{
		$game = Game::get();
		$game->setIdGameRoom(PostChecker::get('idgameroom'));
		$game->setIdWord(PostChecker::get("idword"));
		$game->setIdUser(User::getCurrent()->getIdUser());
		$game->setCreateDate(date(PHP_DATETIME_FORMAT));
		if($game->save())
		{
			return true;
		}
		return false;
		$this->checkWord();
	}
	// -------------------------------------------------------------------------
	private function getWord()
	{
		$slowo = PostChecker::get("word"); // return //string //null //polska
		if(Slowko::checkWord($slowo))
		{
			echo json_encode(array(
									'exist' => true,
									'errorNumber' => '0' )); // tablica asocjacyjna
			die();
		}
		elseif(mb_strlen($slowo) != 5)
		{
			echo json_encode(array(
									'exist' => false,
									'errorNumber' => '1',
									'error' => 'Slowo nie posiada 5 znaków' ));
			die();
		}
		else
		{
			echo json_encode(false);
			die();
		}
	}
	// -------------------------------------------------------------------------
	private function checkWord()
	{
		try
		{
			$checkWord = new Word(PostChecker::get("word"));
			$checkWord->setArrayWordsGame(Game::getWordsAndUserByIdGameRoom(PostChecker::get('idgameroom')));
			if($checkWord->check() && $this->saveWord())
			{
				$wordsScrableDiv = new WordsScrableForm(GameRoom::get(PostChecker::get('idgameroom')));
				$this->r->addChange($wordsScrableDiv->out(), "#GameBox");
				$this->r->addChange("", "#InfoBox");
			}
			else
			{
				$this->r->addChange($checkWord->getError(), '#InfoBox');
			}
		}
		catch(\Exception $e)
		{
			addAlert("Coś sie nie powiodło");
		}
	}
	// -------------------------------------------------------------------------
	private function createNewRoom()
	{
		/** @var $gameRoom GameRoom */
		$gameRoom = GameRoom::get();
		$gameRoom->setName(PostChecker::get("room_name"));
		$gameRoom->setCreateDate(date(PHP_DATETIME_FORMAT));
		if($gameRoom->save() && $this->addUserToRoomGame(User::getCurrent(), $gameRoom))
		{
			addMsg("Pokój '" . $gameRoom->getName() . "' został utworzony");
			$this->createNewGame($gameRoom);
		}
		$this->getNewRoomForm();
	}
	// -------------------------------------------------------------------------
	private function addUserToRoomGame(User $user, GameRoom $gameRoom)
	{
		/* @var $usersGame UserGame */
		$usersGame = UserGame::get();
		$usersGame->setIdGameRoom($gameRoom->getIdGameRoom());
		$usersGame->setIdUser($user->getIdUser());
		$usersGame->setCreateDate(date(PHP_DATETIME_FORMAT));
		if($usersGame->save())
		{
			return true;
		}
		return false;
	}
	// -------------------------------------------------------------------------
	private function createNewGame(GameRoom $gameRoom)
	{
		/* @var $game Game */
		$game = Game::get();
		$word = Slowko::getRandomWord();
		$game->setIdGameRoom($gameRoom->getIdGameRoom());
		$game->setIdUser(User::getCurrent()->getIdUser());
		$game->setIdWord($word->getId());
		$game->setCreateDate(date(PHP_DATETIME_FORMAT));
		if($game->save())
		{
			addMsg("Wylosowane słówko to: " . $word->getSlowko());
			PostChecker::set("idgameroom", $game->getGameRoom());
			$this->getGame();
		}
	}
	// -------------------------------------------------------------------------
	private function getNewRoomForm()
	{
		$newRoomForm = new NewRoomForm();
		$retval = $newRoomForm->out();
		$this->r->addChange($retval, '#GameBox');
		$this->r->addChange("", '#InfoBox');
		$this->r->addChange("", '#MenuBox');
		$this->r->addChange("", '#GameRoomList');
	}

	// -------------------------------------------------------------------------
	private function getGame()
	{
		try
		{
			$game = GameRoom::get(PostChecker::get('idgameroom'));
			$gameForm = new GameForm($game);
			$wordsScrableDiv = new WordsScrableForm($game);
			$this->r->addPage(Tags::div(Tags::div("", 'id="InfoBox" class="bg-warning"'), "class='col-xs-12 col-sm-6 col-md-6 col-lg-3'"));
			$this->r->addPage($wordsScrableDiv->out());
			$this->r->addPage($gameForm->out());
		}
		catch(\Exception $e)
		{
			addAlert("Pokój nie został znaleziony");
		}
	}
	// -------------------------------------------------------------------------
	private function getGameRoomListAddChange()
	{
		$gameRoomList = new GameRoomList();
		$retval = Tags::div($gameRoomList->out(true), "id='GameRoomList'");
		$this->r->addChange($retval, '#GameRoomList');
		$this->r->addChange("", '#InfoBox');
		$this->r->addChange("", '#GameBox');
		$this->r->addChange("", '#MenuBox');
	}
	// -------------------------------------------------------------------------
	private function getGameRoomList()
	{
		$gameRoomList = new GameRoomList();
		$retval = Tags::div($gameRoomList->out(true), "id='GameRoomList'");
		$this->r->addPage($retval);
	}
	// -------------------------------------------------------------------------
}
?>