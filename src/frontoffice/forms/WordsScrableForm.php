<?php

namespace braga\wordgame\frontoffice\forms;

use braga\wordgame\common\obj\GameRoom;
use braga\wordgame\common\obj\Slowko;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\common\obj\Game;
use braga\wordgame\common\obj\User;
use braga\tools\html\HtmlComponent;

/**
 * Created on 19 Apr 2017 23:59:54
 * error prefix
 * @author gromula
 */
class WordsScrableForm extends HtmlComponent
{
	/* @var $game GameRoom */
	private $game = null;
	// -----------------------------------------------------------------
	public function __construct(GameRoom $game)
	{
		$this->game = $game;
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$retval = "";
		$retval = $this->getWordsFromGameRoom();
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getWordsFromGameRoom()
	{
		$words = "";
		$wordsArray = Game::getWordsAndUserByIdGameRoom($this->game->getIdGameRoom());
		$lastElement = end($wordsArray);
		foreach($wordsArray as $idWord)
		{
			$slowo = '';
			$idWord = explode(",", $idWord);
			$word = Slowko::get($idWord[0])->getSlowko();
			for($i = 0; $i <= 4; $i++)
			{
				if($idWord[0] != $lastElement)
				{
					$slowo .= Tags::div(mb_strtoupper(mb_substr($word, $i, 1)), 'class="scrable"');
				}
				if($idWord[0] == $lastElement)
				{
					$slowo .= Tags::div(mb_strtoupper(mb_substr($word, $i, 1)) . Tags::sub($i + 1, 'style="padding: 5px;"'), 'class="scrable"');
				}
			}
			$sprawdz = Tags::div(Tags::a("Sprawdź", "target='_blank' style='color: white;' href='http://www.sjp.pl/" . $word . " '"), 'class="badge badge-info" style="color: white; margin: 10px; padding: 5px;"');
			$user = Tags::div("User: " . User::get($idWord[1])->getLogin(), 'class="badge badge-info" style="margin: 10px; padding: 5px;"');
			$words .= Tags::div($slowo . $sprawdz . $user);
			$words .= Tags::div("", 'style="clear: both;"');
		}
		$words = Tags::div($words, 'id="GameBox"');
		return $words;
	}
	// -----------------------------------------------------------------
}

?>