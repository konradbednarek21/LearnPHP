<?php
namespace braga\widgets\jqueryui;

/**
 * create 18-05-2012 19:47:30
 * @author Tomasz Gajewski
 * @package common
 */
class DBGrid extends \braga\widgets\base\DBGrid
{
	// -------------------------------------------------------------------------
	protected $tableClass = "sto ui-widget-content";
	protected $headerRowClass = "ui-state-highlight";
	protected $headerCellClass = "";
	protected $contentRowClass = "";
	protected $contentNumericCellClass = "r";
	protected $contentStringCellClass = "l";
	protected $contentDateCellClass = "c";
	protected $rowClass = array(
			"ui-state-default",
			"ui-state-focus");
	// -------------------------------------------------------------------------
	private $rowAction;
	private $linkAction;
	// -------------------------------------------------------------------------
	protected function getRowAction()
	{
		if(empty($this->rowAction))
		{
			$this->rowAction = "onmouseover='$(this).addClass(\"ui-state-hover\");' ";
			$this->rowAction .= "onmouseout='$(this).removeClass(\"ui-state-hover\");' ";
		}
		return $this->rowAction;
	}
	// -------------------------------------------------------------------------
	protected function getLinkAction()
	{
		if($this->ajaxEnablad)
		{
			return "onclick='$(this).closest(\"table\").find(\"tr\").removeClass(\"ui-state-active\");$(this).closest(\"tr\").addClass(\"ui-state-active\"); return ajax.go(this);'";
		}
	}
	// -------------------------------------------------------------------------
}
?>