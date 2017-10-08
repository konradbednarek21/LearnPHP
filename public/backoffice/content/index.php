<?php
use braga\wordgame\backoffice\utils\Perms;
use braga\wordgame\common\obj\Modul;
use braga\wordgame\backoffice\controllers\content\ContentController;

/**
 * Created on 10 październik 2016 23:09:17
 * error prefix
 *
 * @author Gromula
 * @package orion
 */
require_once __DIR__ . '/../../../vendor/autoload.php';
Perms::pageOpen ( Modul::CONTENT );
$c = new ContentController ();
$c->doAction ();

?>