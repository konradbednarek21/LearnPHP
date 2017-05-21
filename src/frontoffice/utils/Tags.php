<?php

/**
 * Created on 2010-06-16 14:24:41
 * klasa gromadząca statyczne metody tworzące tragi HTML
 * @package orion
 * @author Tomasz.Gajewski
 * error prefix
 */
namespace braga\wordgame\frontoffice\utils;

use braga\tools\html\BaseTags;

class Tags extends BaseTags
{
	// -------------------------------------------------------------------------
	static function formNonAjax($innerHTML, $attributes = "action='./' method='post' onsubmit='return beforeSubmit(this)'")
	{
		return self::form($innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function formularz($retval)
	{
		return self::form($retval, "action='./' method='post' onsubmit='return ajax.go(this)'");
	}
	// -------------------------------------------------------------------------
	static function fileFormularz($innerHTML)
	{
		return self::form($innerHTML . self::iframe("", "name='FileFrame' src='about:blank' onload='AfterUploadFile(this)' class='h'"), "action='./' target='FileFrame' method='post' onsubmit='if(BeforeSubmit(this)){ajax.showLoading(\"FileFrame\");}else{return false;}' enctype='multipart/form-data'");
	}
	// -------------------------------------------------------------------------
	static function downloadFormularz($innerHTML)
	{
		return self::form($innerHTML . self::iframe("", "id='downloadFileFrame' name='downloadFileFrame' src='about:blank' onload='AfterUploadFile(this)' class='h'"), "action='./' target='downloadFileFrame' method='post' onsubmit='return BeforeSubmit(this)'");
	}
	// -------------------------------------------------------------------------
	static function formularzNonAjax($innerHTML)
	{
		return self::formNonAjax($innerHTML);
	}
	// -------------------------------------------------------------------------
	static function BoxIconRight($href, $atributes)
	{
		return Tags::ajaxLink(Tags::span("", 'style="color: white" class="glyphicon pull-right ' . $atributes . '"'), $href);
	}
	// -------------------------------------------------------------------------
	static function BoxBody($boxTitle, $retval)
	{
		return Tags::div(Tags::div($boxTitle, "class='panel-heading'") . Tags::div($retval, "class='panel-body'"), "class='panel panel-primary'");
	}
	// -------------------------------------------------------------------------
	static function ajaxLink($content, $href, $tooltip = null)
	{
		if(null != $tooltip)
		{
			return self::a($content, "onclick='return ajax.go(this)' href='" . $href . "' " . getToolTip($tooltip));
		}
		else
		{
			return self::a($content, "onclick='return ajax.go(this)' href='" . $href . "'");
		}
	}
	// -------------------------------------------------------------------------
}
?>