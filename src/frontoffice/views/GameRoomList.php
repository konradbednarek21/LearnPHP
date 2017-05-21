<?php

namespace braga\wordgame\frontoffice\views;

use braga\wordgame\frontoffice\views\BootstrapWidgets\BootstrapGrid;
use braga\wordgame\common\obj\GameRoom;
use braga\db\CollectionDB;
use braga\widgets\jqueryui\DBGridReplacer;

/**
 * Created on 9 Apr 2017 14:53:22
 * error prefix
 * @author gromula
 */
class GameRoomList extends BootstrapGrid
{
	// -----------------------------------------------------------------
	public function __construct()
	{
		$this->getAllGameRoom();
	}
	// -----------------------------------------------------------------
	protected function getAllGameRoom()
	{
		$i = 0;

		$db = GameRoom::getAll();
		$db = new CollectionDB($db);
		$db->addTranslate("getName", $i++, "Nazwa");
		$db->addTranslate("getUserForGame", $i++, "Gracze");
		$db->addTranslate("getWordsByGame", $i++, "Ilośc słów");
		$db->addTranslate("getMinToEnd", $i++, "Godzina ostatniego słowa:");
		$db->addTranslate("getIdGameRoom", $i++);
		$this->columnCount = $i - 1;
		$this->setDataSource($db);
		$this->setHrefActionString("?action=GetGame&amp;idgameroom=#@#_0_#@#");
		$this->addHrefReplaceStringByField(new DBGridReplacer("#@#_0_#@#", $this->columnCount));
		$this->ajaxEnablad = false;
	}
	// -----------------------------------------------------------------
	public function out($tagTable = true)
	{
		return parent::out($tagTable);
	}
}

