<?php
/**
 * Created on 1 lis 2016 18:23:06
 * error prefix OR:300
 * maxerror prefix OR:30002
 * @author Bartosz Gromowski
 * @package
 *
 */
namespace braga\wordgame\frontoffice\controles;
use braga\tools\tools\Retval;
use braga\wordgame\frontoffice\views\MessageView;

class FritRetval extends Retval
{
	// -------------------------------------------------------------------------
	protected function getFormatedMessage()
	{
		$m = new MessageView();
		return $m->out();
	}
	// -------------------------------------------------------------------------
}
?>