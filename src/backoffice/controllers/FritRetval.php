<?php

namespace braga\wordgame\backoffice\controllers;

use braga\tools\tools\Retval;
use braga\wordgame\frontoffice\views\MessageView;

class FritRetval extends Retval {
	// -------------------------------------------------------------------------
	protected function getFormatedMessage() {
		$m = new MessageView ();
		return $m->out ();
	}
	// -------------------------------------------------------------------------
}
?>