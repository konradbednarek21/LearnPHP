<?php
use braga\wordgame\frontoffice\controles\WebControler;
use braga\wordgame\frontoffice\utils\Perms;
/**
 * Created on 10 październik 2016 23:09:17
 * error prefix
 * @author Gromula
 * @package orion
 */
require_once __DIR__ . '/../../vendor/autoload.php';
Perms::startSession();
$c = new WebControler();
$c->doAction();

?>