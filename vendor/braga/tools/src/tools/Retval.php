<?php
namespace braga\tools\tools;
use braga\tools\html\BaseTags;

/**
 *
 * @package common
 * @author Tomasz.Gajewski
 * error prefix EM:105
 * Created on 2009-06-12 07:26:27
 * klasa opisująca dane zwracane do przeglądarki
 * zarówno w formie Ajax jak i w normalnym trybie
 */
abstract class Retval
{
	protected $page = "";
	protected $ajax = "";
	// -------------------------------------------------------------------------
	public function Clear()
	{
		$this->page = "";
		$this->ajax = "";
	}
	// -------------------------------------------------------------------------
	public function addPage($retval)
	{
		$this->page .= $retval;
	}
	// -------------------------------------------------------------------------
	public function reload($url)
	{
		$this->ajax .= BaseTags::customShortXML("reload", "url='" . $url . "'");
	}
	// -------------------------------------------------------------------------
	public function sustain($idContener = "#InputBox")
	{
		$id = str_replace("#", "", $idContener);
		$this->ajax .= BaseTags::customShortXML("sustain", "id='" . $id . "'");
	}
	// -------------------------------------------------------------------------
	public function remove($idContener = "#InputBox")
	{
		$this->ajax .= BaseTags::customShortXML("remove", "id='" . $idContener . "'");
	}
	// -------------------------------------------------------------------------
	public function closePopUp($idContener = "#InputBox")
	{
		$id = str_replace("#", "", $idContener);
		$this->ajax .= BaseTags::customShortXML("closePopUp", "id='" . $id . "'");
	}
	// -------------------------------------------------------------------------
	public function popUpWin($title, $retval, $idContener = "#InputBox")
	{
		$id = str_replace("#", "", $idContener);
		$this->ajax .= BaseTags::customShortXML("popup", "id='" . $id . "' title='" . $title . "'");
		$this->addChange($retval, $idContener);
	}
	// -------------------------------------------------------------------------
	public function changeAttrib($idContener, $Name, $Value)
	{
		$this->ajax .= BaseTags::customShortXML("atrybut", "id='" . $idContener . "' name='" . $Name . "' value='" . $Value . "'");
	}
	// -------------------------------------------------------------------------
	public function centerContener($idContener)
	{
		$this->changeAttrib($idContener, "ajax_centered", "0");
	}
	// -------------------------------------------------------------------------
	public function appendChange($retval, $idContener = "#MainBox")
	{
		$this->ajax .= BaseTags::custom("append", "<![CDATA[" . $retval . "]]>", "id='" . $idContener . "'");
	}
	// -------------------------------------------------------------------------
	public function addChange($retval, $idContener = "#MainBox")
	{
		$this->ajax .= BaseTags::custom("change", "<![CDATA[" . $retval . "]]>", "id='" . $idContener . "'", "");
		if($idContener == "MainBody")
		{
			$this->page = $retval;
		}
	}
	// -------------------------------------------------------------------------
	public function getPage()
	{
		return $this->page;
	}
	// -------------------------------------------------------------------------
	public function getAjax()
	{
		$msg = $this->getFormatedMessage();
		$this->addChange($msg, "#MsgBox");

		$retval = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
		$retval .= BaseTags::custom("changes", $this->ajax, "date='" . date(PHP_DATETIME_FORMAT) . "'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	abstract protected function getFormatedMessage();
	// -------------------------------------------------------------------------
}
?>