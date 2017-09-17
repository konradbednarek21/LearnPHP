<?php
use braga\wordgame\backoffice\controllers\StartController;

/**
 * Created on 10 październik 2016 23:09:17
 * error prefix
 *
 * @author Gromula
 * @package orion
 */
require_once __DIR__ . '/../../vendor/autoload.php';
// Perms::startSession ();
$c = new StartController ();
$c->doAction ();

?>