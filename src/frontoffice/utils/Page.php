<?php

/**
 * Created on 17-10-2011 18:22:59
 * @author Tomasz Gajewski
 * @package orion
 * error prefix
 */
namespace braga\wordgame\frontoffice\utils;
class Page
{
	// -------------------------------------------------------------------------
	protected static function getHead()
	{
		$title = TITLE_WORD_GAME;
		$retval = Tags::meta("http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"");
		$retval .= Tags::title($title);
		$retval .= Tags::link("rel='icon' href='/img/icon.png' type='image/x-icon'");
		$retval .= Tags::link("rel='stylesheet' type='text/css' href='/css/style.css'");
		$retval .= Tags::link("rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'");
		$retval .= self::getScripts();
		return Tags::head($retval);
	}
	// -------------------------------------------------------------------------
	protected static function getScripts()
	{
		$marker = urlencode(VERSION);

		$retval = Tags::script("", "type='text/javascript' src='//code.jquery.com/jquery-1.12.4.min.js'");
		$retval .= Tags::script("", "type='text/javascript' src='//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'");
		$retval .= Tags::script("", "type='text/javascript' src='/js/ajax.js?" . $marker . "'");
		$retval .= Tags::script("", "type='text/javascript' src='/js/utils.js?" . $marker . "'");
		$retval .= Tags::script("", "type='text/javascript' src='/js/bootstrap-datepicker.js?" . $marker . "'");
		$retval .= Tags::script("", "type='text/javascript' src='/js/popUpWindow.js?" . $marker . "'");

		return $retval;
	}
	// -------------------------------------------------------------------------
	protected static function getDocType()
	{
		$retval = "<!DOCTYPE html>\n";
		$retval .= "<!-- generated: " . date("c") . " -->\n";
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected static function sendHttpHeaders()
	{
		header("Expires: " . date("c"));
		header("Cache-Control: no-transform; max-age=0; proxy-revalidate ");
		header("Cache-Control: no-cache; must-revalidate; no-store; post-check=0; pre-check=0 ");
		header("Pragma: no-cache");
		header("Content-Type: text/html; charset=UTF-8");
	}
	// -------------------------------------------------------------------------
	static function make($bodyContent)
	{
		if(!headers_sent())
		{
			self::sendHttpHeaders();
			$page = self::getHead() . Tags::body($bodyContent, "id='Body'");
			$page = Tags::html($page);
			$page = self::getDocType() . $page;
			echo $page;
		}
		else
		{
			exit();
		}
	}
	// -------------------------------------------------------------------------
}
?>