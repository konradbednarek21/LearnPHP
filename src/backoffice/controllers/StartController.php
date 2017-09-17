<?php

namespace braga\wordgame\backoffice\controllers;

use braga\tools\html\Controler;
use braga\wordgame\backoffice\views\Layout;

/**
 * create date 17 wrz 2017
 *
 * @author Artur
 */
class StartController extends Controler {
	use RetvalReturner;
	// ---------------------------------------------------------------------
	public function doAction() {
		$this->setLayOut ( new Layout () );
		$this->page ();
	}
	// ---------------------------------------------------------------------
}