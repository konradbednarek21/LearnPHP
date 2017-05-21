<?php
namespace braga\widgets\jqueryui;
use braga\tools\html\HtmlComponent;
use braga\tools\tools\SessManager;
use braga\tools\html\BaseTags;
/**
 * Created on 05.09.2016 22:43:01
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
			$wiadomosci = "";
			foreach(SessManager::get(SessManager::MESSAGE_ALERT) as $m)/* @var $m \Braga\Message */
			{
				$id = "MSG" . getRandomString(5);
				$wiadomosci .= BaseTags::p(BaseTags::span(BaseTags::i($m->getNumer()), "style='padding-left:8px;float:right;font-size:75%;'") . $m->getOpis(), "class='clear' id='" . $id . "'");
				$wiadomosci .= BaseTags::script("$(\"#" . $id . "\").parent().parent().delay(10000).hide(\"slide\",{direction: \"up\"})");
			}
			SessManager::kill(SessManager::MESSAGE_ALERT);
			$title = icon("ui-icon-alert");
			$title .= "Alert";
			$title .= BaseTags::span("", "class='ui-icon ui-icon-close hand' style='float:right;' onclick='\$(this).parent().parent().remove(); return false;' " . getToolTip("Zamknij"));
			$title = BaseTags::div($title, "class='ui-widget-header ui-corner-all ui-helper-clearfix ui-state-highlight' style='padding:2px'");
			$content = BaseTags::div($wiadomosci, "class='ui-corner-bottom ui-priority-primary clear' style='padding:8px'");
			$tmp = $title . $content;
			$retval .= BaseTags::div($tmp, " style='margin-bottom:4px;padding:2px' class='ui-widget-content ui-state-error ui-corner-all'");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getWarning()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_WARNING))
		{
			$wiadomosci = "";
			foreach(SessManager::get(SessManager::MESSAGE_WARNING) as $m)/* @var $m \Braga\Message */
			{
				$id = "MSG" . getRandomString(5);
				$wiadomosci .= BaseTags::p(BaseTags::span(BaseTags::i($m->getNumer()), "style='padding-left:8px;float:right;font-size:75%;'") . $m->getOpis(), "class='clear' id='" . $id . "'");
				$wiadomosci .= BaseTags::script("$(\"#" . $id . "\").parent().parent().delay(5000).hide(\"slide\",{direction: \"up\"})");
			}
			SessManager::kill(SessManager::MESSAGE_WARNING);
			$title = icon("ui-icon-info");
			$title .= "Ostrzeżenie";
			$title .= BaseTags::span("", "class='ui-icon ui-icon-close hand' style='float:right;' onclick='\$(this).parent().parent().remove();  return false;' " . getToolTip("Zamknij"));
			$title = BaseTags::div($title, "class='ui-widget-header ui-corner-all ui-helper-clearfix ui-state-error' style='padding:2px'");
			$content = BaseTags::div($wiadomosci, "class='ui-corner-bottom ui-priority-primary clear' style='padding:8px'");
			$tmp = $title . $content;
			$retval .= BaseTags::div($tmp, " style='width:auto;margin-bottom:4px;padding:2px' class='ui-widget-content ui-state-highlight ui-corner-all'");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getInfo()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_INFO))
		{
			$wiadomosci = "";
			foreach(SessManager::get(SessManager::MESSAGE_INFO) as $m)/* @var $m \Braga\Message */
			{
				$id = "MSG" . getRandomString(5);
				$wiadomosci .= BaseTags::p($m->getOpis(), "class='clear' id='" . $id . "'");
				$wiadomosci .= BaseTags::script("$(\"#" . $id . "\").parent().parent().delay(5000).hide(\"slide\",{direction: \"up\"})");
			}
			SessManager::kill(SessManager::MESSAGE_INFO);
			$title = icon("ui-icon-notice");
			$title .= "Info";
			$title .= BaseTags::span("", "class='ui-icon ui-icon-close hand' style='float:right;' onclick='\$(this).parent().parent().remove(); return false;' " . getToolTip("Zamknij"));
			$title = BaseTags::div($title, "class='ui-widget-header ui-corner-all ui-helper-clearfix' style='padding:2px'");
			$content = BaseTags::div($wiadomosci, "class='ui-corner-bottom ui-priority-primary clear' style='padding:8px'");
			$tmp = $title . $content;
			$retval .= BaseTags::div($tmp, " style='width:auto;margin-bottom:4px;padding:2px' class='ui-widget-content ui-state-highlight ui-corner-all'");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected function getSqlError()
	{
		$retval = "";
		if(SessManager::isExist(SessManager::MESSAGE_SQL))
		{
			$wiadomosci = "";
			foreach(SessManager::get(SessManager::MESSAGE_SQL) as $m)/* @var $m \Braga\Message */
			{
				$id = "MSG" . getRandomString(5);
				$wiadomosci .= BaseTags::p($m->getOpis(), "class='clear' id='" . $id . "'");
			}
			SessManager::kill(SessManager::MESSAGE_SQL);
			$title = icon("ui-icon-alert");
			$title .= "Info";
			$title .= BaseTags::span("", "class='ui-icon ui-icon-close hand' style='float:right;' onclick='\$(this).parent().parent().remove(); return false;' " . getToolTip("Zamknij"));
			$title = BaseTags::div($title, "class='ui-widget-header ui-corner-all ui-helper-clearfix' style='padding:2px'");
			$content = BaseTags::div($wiadomosci, "class='ui-corner-bottom ui-priority-primary clear' style='padding:8px'");
			$tmp = $title . $content;
			$retval .= BaseTags::div($tmp, " style='width:auto;margin-bottom:4px;padding:2px' class='ui-widget-content ui-state-highlight ui-corner-all'");
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>