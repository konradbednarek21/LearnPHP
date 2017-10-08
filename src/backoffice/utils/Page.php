<?php

namespace braga\wordgame\backoffice\utils;

use braga\wordgame\common\obj\Modul;

/**
 * Created on 17-10-2011 18:22:59
 *
 * @author Tomasz Gajewski
 * @package system
 *          error prefix EM:902
 */
class Page {
	// -------------------------------------------------------------------------
	protected static function getHead() {
		$modulInstance = Modul::getCurrent ();
		$title = "FizWeb  - " . $modulInstance->getNazwa (); // . $modulInstance->getNazwa();
		$title .= " ver: ";
		$retval = Tags::meta ( "http-equiv=\"X-UA-Compatible\" content=\"IE=edge\"" );
		$retval .= Tags::title ( $title );
		$retval .= Tags::link ( "rel='shortcut icon' href='/favicon.ico'" );
		$retval .= Tags::link ( "rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' integrity='sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u' crossorigin='anonymous'" );
		$retval .= Tags::link ( "rel='stylesheet' type='text/css' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css' integrity='sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp' crossorigin='anonymous'" );
		$retval .= Tags::link ( "rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css'" );
		$retval .= Tags::link ( "rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.min.css'" );
		$retval .= Tags::link ( "rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css'" );
		$retval .= Tags::link ( "rel='stylesheet' type='text/css' href='/css/style.css'" );
		$retval .= self::getScripts ();
		return Tags::head ( $retval );
	}
	// -------------------------------------------------------------------------
	protected static function getScripts() {
		$marker = urlencode ( 2);

		$retval = Tags::script ( "", "type='text/javascript' src='https://code.jquery.com/jquery-1.10.2.min.js'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js' integrity='sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa' crossorigin='anonymous'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='https://tinymce.cachefly.net/4.3/tinymce.min.js'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/js/bootstrap-datepicker.min.js'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/locales/bootstrap-datepicker.pl.min.js'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='/js/system.js?" . $marker . "'" );
		$retval .= Tags::script ( "", "type='text/javascript' src='/js/ajax.js?" . $marker . "'" );
		// $retval .= Tags::script ( "", "type='text/javascript' src='/js/deyn.js?" . $marker . "'" );

		return $retval;
	}
	// -------------------------------------------------------------------------
	protected static function getDocType() {
		$retval = "<!DOCTYPE html>\n";
		$retval .= "<!-- generated: " . date ( "D, d M Y H:i:s" ) . " -->\n";
		return $retval;
	}
	// -------------------------------------------------------------------------
	protected static function sendHttpHeaders() {
		header ( "Expires:" . date ( "D, d M Y H:i:s" ) . "" );
		header ( "Cache-Control: no-transform; max-age=0; proxy-revalidate " );
		header ( "Cache-Control: no-cache; must-revalidate; no-store; post-check=0; pre-check=0 " );
		header ( "Pragma: no-cache" );
		header ( "Content-Type: text/html; charset=UTF-8" );
	}
	// -------------------------------------------------------------------------
	static function make($bodyContent) {
		if (! headers_sent ()) {
			self::sendHttpHeaders ();
			$page = self::getHead () . Tags::body ( $bodyContent, "id='Body'" );
			$page = Tags::html ( $page );
			$page = self::getDocType () . $page;
			echo $page;
		} else {
			exit ();
		}
	}
	// -------------------------------------------------------------------------
}
?>