<?php



use braga\wordgame\common\wsdl\WordsServer;
use braga\wordgame\common\wsdl\WordsHandler;
/**
 * myWebServices endpoint file
 *
 * Created on 16-01-2017 01:40:17
 * @author gromula
 * @package webservice
 */

include __DIR__. "/../../../vendor/autoload.php";
$server = new WordsServer(__DIR__ . "/../../../src/common/wsdl/wordFiveServices.wsdl", WordsHandler::getOptions());
$server->setObject(new WordsHandler());
$server->handle();


