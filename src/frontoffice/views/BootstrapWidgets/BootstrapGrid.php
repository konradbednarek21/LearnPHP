<?php
/**
 * Created on 19 gru 2015 22:07:36
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
namespace braga\wordgame\frontoffice\views\BootstrapWidgets;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\common\view\BragaGrid;
class BootstrapGrid extends BragaGrid
{
	// -------------------------------------------------------------------------
	protected $tableClass = "table table-condensed";
	protected $headerRowClass = "warning";
	protected $headerCellClass = "";
	protected $contentRowClass = "";
	protected $contentNumericCellClass = "";
	protected $contentStringCellClass = "";
	protected $contentDateCellClass = "";
	protected $rowClass = array(
			"active",
			"warning");
	// -------------------------------------------------------------------------
	protected function getAjaxLink($content, $href)
	{
		return Tags::ajaxLink($content, $href);
	}
	// -------------------------------------------------------------------------
}
?>