<?php
/**
 * Created on 2 sty 2016 11:08:28
 * error prefix
 * @author Tomasz Gajewski
 * @package orion
 */
namespace braga\wordgame\frontoffice\forms;
use braga\wordgame\frontoffice\utils\BootstrapTags;
trait BootstapForm
{
	// -------------------------------------------------------------------------
	protected function getFormRow($col, $hasError = false)
	{
		return BootstrapTags::formGroupRow($col, $hasError);
	}
	// -------------------------------------------------------------------------
}
?>