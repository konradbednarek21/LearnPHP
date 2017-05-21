<?php

/**
 * Created on 5 mar 2016 21:28:12
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
namespace braga\wordgame\config;

define("VERSION", "1.0.0");
define("WORDGAME", "fizweb");
define("TITLE_WORD_GAME", "Strona poświecona Fizyce");

define("PRODUCTION", true);

/* DATABASE CONNECTION INFO */
define("DB_CONNECTION_STRING", "mysql:host=localhost;dbname=wordgame");
define("ORA_SCHEMA", 'wordgame');
define("DB_USER", 'root');
define("DB_PASS", '');
define("DB_SCHEMA", ORA_SCHEMA);



define("CHECK_WORD_ON_DATA", true);


/* SECURITY */
define("HASH_ALGORYTM", "sha512");

/* FOLDERS */

define("INSTALL_DIRECTORY", __DIR__ . "/../../");
define("LOG_DIRECTORY", INSTALL_DIRECTORY . "log/");
define("TEMP_DIRECTORY", INSTALL_DIRECTORY . "tmp/");

/* LOGGING */
define("LOG_ERRORS_TO_FILE", true);

/* FORMATING */
define("FORMAT_XML", false);

define("PHP_DATE_FORMAT", "Y-m-d");
define("PHP_DATETIME_FORMAT", "Y-m-d H:i:s");

/* APPLICATION SETTINGS */
define("PAGELIMIT", 222);

/* PHP DEFAULT SETTINGS CHANGE */
mb_internal_encoding("utf8");
ini_set("max_execution_time", "0");
date_default_timezone_set("Europe/Warsaw");

