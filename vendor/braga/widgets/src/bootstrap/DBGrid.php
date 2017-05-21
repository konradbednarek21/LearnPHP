<?php
namespace braga\widgets\bootstrap;

/**
 * Created on 11.11.2016 21:54:08
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class DBGrid
{
	// -------------------------------------------------------------------------
	protected $tableClass = "table";
	protected $headerRowClass = "";
	protected $headerCellClass = "";
	protected $contentRowClass = "";
	protected $contentNumericCellClass = "";
	protected $contentStringCellClass = "";
	protected $contentDateCellClass = "";
	protected $rowClass = array(
			"alert alert-warning",
			"");
	// -------------------------------------------------------------------------
	protected function getLinkAction()
	{
		if($this->ajaxEnablad)
		{
			return "onclick='return ajax.go(this);'";
		}
	}
	// -------------------------------------------------------------------------
}
?>