<?php
namespace braga\wordgame\frontoffice\views;

use braga\tools\html\HtmlComponent;
use braga\wordgame\frontoffice\utils\BootstrapTags;
use braga\wordgame\frontoffice\utils\Tags;
use braga\tools\tools\SessManager;
/**
 * Created on 21 mar 2015 08:28:04
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class MessageView extends HtmlComponent
{
	// -------------------------------------------------------------------------
	public function out()
	{
		$retval = $this->getAlerts();
		$retval .= $this->getWarning();
		$retval .= $this->getInfo();
		$retval .= $this->getSqlError();
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getAlerts()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_ALERT))
		{
			foreach(SessManager::get(SessManager::MESSAGE_ALERT) as $m)/* @var $m \Braga\Message */
			{
				$retval .= Tags::p($m->getNumer() . " " . $m->getOpis(), "class='c'");
			}
			SessManager::kill(SessManager::MESSAGE_ALERT);
			$retval = BootstrapTags::containerFluid(Tags::p("Błąd") . $retval, null, "bg-danger");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getWarning()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_WARNING))
		{
			foreach(SessManager::get(SessManager::MESSAGE_WARNING) as $m)/* @var $m \Braga\Message */
			{
				$retval .= Tags::p($m->getNumer() . " " . $m->getOpis(), "class='c'");
			}
			SessManager::kill(SessManager::MESSAGE_WARNING);
			$retval = BootstrapTags::containerFluid(Tags::p("Ostrzeżenie") . $retval, null, "bg-warning");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getInfo()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_INFO))
		{
			foreach(SessManager::get(SessManager::MESSAGE_INFO) as $m)/* @var $m \Braga\Message */
			{
				$retval .= Tags::p($m->getNumer() . " " . $m->getOpis(), "class='c'");
			}
			$retval = BootstrapTags::containerFluid(Tags::p($retval), null, "bg-success");
			SessManager::kill(SessManager::MESSAGE_INFO);
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getSqlError()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_SQL))
		{
			foreach(SessManager::get(SessManager::MESSAGE_SQL) as $m)/* @var $m \Braga\Message */
			{
				$retval .= Tags::p($m->getNumer() . " " . $m->getOpis(), "class='c'");
			}
			SessManager::kill(SessManager::MESSAGE_SQL);
			$retval = BootstrapTags::containerFluid(Tags::p("SQL Error") . $retval, null, "bg-danger");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>