<?php

namespace braga\wordgame\backoffice\views;

use braga\tools\html\HtmlComponent;
use braga\tools\tools\PostChecker;
use braga\wordgame\backoffice\utils\Page;
use braga\wordgame\backoffice\utils\Tags;

/**
 * Created on 13 lip 2013 13:58:25
 *
 * @author Tomasz Gajewski
 * @package frontoffice
 *          error prefix
 */
class PublicLayout extends HtmlComponent {
	// -------------------------------------------------------------------------
	public function out() {
		if (! is_null ( PostChecker::get ( "js" ) )) {
			// $widget = Tags::input ( "name='u' value='' style='position:relative;top:182px;border:0px red solid; width:250px; margin-left:auto;margin-right:auto;display:block;font-size:20px;background-color: transparent;text-align:center;'" );
			// $widget .= Tags::input ( "name='p' type='password' value='' style='position:relative;top:227px;border:0px red solid; width:250px; margin-left:auto;margin-right:auto;display:block;font-size:20px;background-color: transparent;text-align:center;'" );
			// $widget .= Tags::input ( "type='submit' value='' style='position:relative;top:256px;left:-4px;border:0px red solid; width:113px; margin-left:auto;margin-right:auto;display:block;font-size:24px;background-color: transparent;text-align:center;'" );
			// $form = $widget;
			// if (isset ( $_POST )) {
			// $form .= $this->getPost ( $_POST, "" );
			// }
			// $form = Tags::form ( $form, "action='" . $_SERVER ["REQUEST_URI"] . "' method='post' onsubmit='return ajax.go(this)'" );
			// $body = Tags::div ( $form, "style='margin-left:auto; margin-right:auto;width:441px;height:468px;background-position:center center;background-repeat:no-repeat;background-image:url(\"/img/splash.png\");'" );
			// $retval = Tags::div ( $body );

			// $r = new BoomeangRretval ();
			// $r->popUpWin ( "Zaloguj się", $retval, "#LoginBox_" . getRandomString ( 9 ) );
			// header ( "Content-type: text/xml; charset=utf-8" );
			// echo $r->getAjax ();
		} else {

			$widget = Tags::input ( "name='u' value='' style='position:relative;top:182px;border:0px red solid; width:250px; margin-left:auto;margin-right:auto;display:block;font-size:20px;background-color: transparent;text-align:center;'" );
			$widget .= Tags::input ( "name='p' type='password' value='' style='position:relative;top:227px;border:0px red solid; width:250px; margin-left:auto;margin-right:auto;display:block;font-size:20px;background-color: transparent;text-align:center;'" );
			$widget .= Tags::input ( "type='submit' value='' style='position:relative;top:256px;left:-4px;border:0px red solid; width:113px; margin-left:auto;margin-right:auto;display:block;font-size:24px;background-color: transparent;text-align:center;'" );
			$form = $widget;
			$form = Tags::formularzNonAjax ( $form );
			$body = Tags::div ( $form, "style='margin-left:auto; margin-right:auto;width:441px;height:468px;background-position:center center;background-repeat:no-repeat;background-image:url(\"/img/splash.png\");'" );
			$retval = Tags::div ( $body );
			Page::make ( $retval );
		}
	}
	// -------------------------------------------------------------------------
	protected function getPost($post, $name) {
		$retval = "";
		foreach ( $post as $key => $p ) {
			if (is_array ( $p )) {
				$retval .= $this->getPost ( $p, $key . "[]" );
			} else {
				$retval .= HiddenField ( $name, $p );
			}
		}
		return $retval;
	}
	// -------------------------------------------------------------------------
}
?>