<?php

/**
 * Created on 7 mar 2015 11:55:20
 * error prefix
 * @author Tomasz Gajewski
 * @package orion
 */
namespace braga\wordgame\frontoffice\utils;
use braga\tools\html\BaseTags;
class BootstrapTags extends BaseTags
{
	// -------------------------------------------------------------------------
	public static function container($innerHTML, $id = null, $class = null)
	{
		$tmp = is_null($id) ? "" : "id='" . $id . "'";
		return self::div($innerHTML, "class='container " . $class . "' " . $tmp);
	}
	// -------------------------------------------------------------------------
	public static function containerFluid($innerHTML, $id = null, $class = null)
	{
		$tmp = is_null($id) ? "" : "id='" . $id . "'";
		return self::div($innerHTML, "class='container-fluid " . $class . "' " . $tmp);
	}
	// -------------------------------------------------------------------------
	public static function col($innerHTML, $classes)
	{
		return self::div($innerHTML, "class='" . $classes . "'");
	}
	// -------------------------------------------------------------------------
	public static function row($innerHTML)
	{
		return self::div($innerHTML, "class='row'");
	}
	// -------------------------------------------------------------------------
	public static function menuBar($innerHTML)
	{
		$retval = self::ul($innerHTML, "class='nav navbar-nav'");
		$retval = self::div($retval, "class='collapse navbar-collapse'");
		return $retval;
	}
	// -------------------------------------------------------------------------
	public static function formGroupRow($innerHTML, $hasError = false)
	{
		$t = $hasError ? "has-error" : "";
		return self::div($innerHTML, "class='form-group " . $t . "'");
	}
	// -------------------------------------------------------------------------
	public static function formLabel($innerHTML, $name)
	{
		return self::label($innerHTML, "class='label label-default widget-input-label' for='" . $name . "'");
	}
	// -------------------------------------------------------------------------
	public static function well($innerHTML, $sizeClass = 'well-lg')
	{
		return self::div($innerHTML, "class='well " . $sizeClass . "'");
	}
	// -------------------------------------------------------------------------
	public static function clear()
	{
		return self::div("", "class='clearfix'");
	}
	// -------------------------------------------------------------------------
	public static function panel($title, $content)
	{
		$retval = self::div(self::h3($title, "class='panel-title'"), "class='panel-heading'");
		$retval .= self::div($content, "class='panel-body'");
		return self::div($retval, "class='panel panel-default'");
	}
	// -------------------------------------------------------------------------
	public static function submitButtonGreen($label)
	{
		return self::input("type='submit' value='" . $label . "' class='btn btn-success btn-lg c block'");
	}
	// -------------------------------------------------------------------------
	public static function submitButtonGray($label)
	{
		return self::input("type='submit' value='" . $label . "' class='btn btn-default btn-lg c block'");
	}
	// -------------------------------------------------------------------------
	public static function icon($iconClass)
	{
		return self::span("", "class='glyphicon " . $iconClass . "'");
	}
	// -------------------------------------------------------------------------
	public static function fontAwesomIcon($iconClass)
	{
		return self::span("", "class='fa " . $iconClass . "'");
	}
	// -------------------------------------------------------------------------
}
?>