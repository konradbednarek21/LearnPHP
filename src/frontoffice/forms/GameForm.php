<?php

namespace braga\wordgame\frontoffice\forms;

use braga\widgets\bootstrap\TextField;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\frontoffice\utils\BootstrapTags;
use braga\wordgame\common\obj\GameRoom;

/**
 * Created on 5 Feb 2017 19:08:41
 * error prefix
 * @author gromula
 */
class GameForm
{
	/*
	 * @var $gameRoom GameRoom
	 */
	protected $gameRoom = null;
	// -----------------------------------------------------------------
	use BootstapForm;
	// -----------------------------------------------------------------
	public function __construct(GameRoom $gameRoom)
	{
		$this->gameRoom = $gameRoom;
	}
	// -----------------------------------------------------------------
	public function out()
	{
		$retval = $this->getInputs();
		$retval .= $this->getButtons();
		$retval = Tags::formularz($retval);
		$retval = Tags::div($retval, 'id="MenuBox"');
		return $retval;
	}
	// -----------------------------------------------------------------
	protected function getButtons()
	{
		$buttons = HiddenField("idgameroom", $this->gameRoom->getIdGameRoom());
		$buttons .= BootstrapTags::input("type='submit' value='Save' style='margin: 2px;' class='btn btn-primary btn-lg col-xs-2'") . HiddenField("action", "SaveWord");
// 		$buttons .= Tags::ajaxLink(BootstrapTags::input("type='submit' value='Reset' style='margin: 2px;' class='btn btn-primary btn-lg col-xs-2'"), "?action=ResetGame");
// 		$buttons .= Tags::ajaxLink(BootstrapTags::input("type='submit' value='Zakończ gre' style='margin: 2px;' class='btn btn-primary btn-lg col-xs-2'"), "?action=SetEndGameRoom");
// 		$buttons .= Tags::ajaxLink(BootstrapTags::input("type='submit' value='Usun gre' style='margin: 2px;' class='btn btn-primary btn-lg col-xs-2'"), "?action=DeleteGameRoom");
		// $buttons .= Tags::ajaxLink(BootstrapTags::input("type='submit' value='Zmien nazwe' style='margin: 2px;' class='btn btn-primary btn-lg col-xs-2'"), "?action=RenameGameRoom");
		return $this->getFormRow($buttons);
	}
	// -----------------------------------------------------------------
	public function getInputs()
	{
		$t = new TextField();
		$t->setName("word");
		$t->setMaxLength(5);
		$t->setWatermark("Wprowadz slowo");
		$t->setClassString($t->getFullSizeClass());
		$col = Tags::label("Slowo :", "for='word'");
		$retval = $col . $t->out();
		return $this->getFormRow($retval);
	}
	// -----------------------------------------------------------------
	protected function getGameRoom()
	{
		return $this->gameRoom;
	}
	// -----------------------------------------------------------------
}

?>