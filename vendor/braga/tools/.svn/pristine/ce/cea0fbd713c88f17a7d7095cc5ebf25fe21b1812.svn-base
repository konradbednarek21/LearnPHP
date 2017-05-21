<?php

namespace braga\tools\html;

/**
 *
 * @package common
 * @author Tomasz.Gajewski
 * Created on 2010-06-16 14:24:41
 * klasa gromadząca statyczne metody tworzące tragi HTML
 */
class BaseTags
{
	// -------------------------------------------------------------------------
	static function custom($tag, $innerHTML, $attributes)
	{
		$pre = trim(preg_replace("/\s+/", " ", $tag . " " . $attributes));
		$retval = "<" . $pre . ">" . $innerHTML . "</" . $tag . ">";
		return $retval;
	}
	// -------------------------------------------------------------------------
	static function customShort($tag, $attributes)
	{
		$attributes = trim(preg_replace("/\s+/", " ", $attributes));
		$retval = "<" . $tag . " " . $attributes . ">";
		return $retval;
	}
	// -------------------------------------------------------------------------
	static function customShortXML($tag, $attributes)
	{
		$attributes = trim(preg_replace("/\s+/", " ", $attributes));
		$retval = "<" . $tag . " " . $attributes . " />";
		return $retval;
	}
	// -------------------------------------------------------------------------
	static function form($innerHTML, $attributes = "method='post' action=''")
	{
		return self::custom("form", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function nav($innerHTML, $attributes = "")
	{
		return self::custom("nav", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function td($innerHTML, $attributes = "")
	{
		return self::custom("td", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function th($innerHTML, $attributes = "")
	{
		return self::custom("th", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function thead($innerHTML, $attributes = "")
	{
		return self::custom("thead", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function tbody($innerHTML, $attributes = "")
	{
		return self::custom("tbody", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function tr($innerHTML, $attributes = "")
	{
		return self::custom("tr", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function table($innerHTML, $attributes = "")
	{
		return self::custom("table", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function span($innerHTML, $attributes = "")
	{
		return self::custom("span", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function i($innerHTML, $attributes = "")
	{
		return self::custom("i", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function p($innerHTML, $attributes = "")
	{
		return self::custom("p", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function div($innerHTML, $attributes = "")
	{
		return self::custom("div", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function hr($attributes = "")
	{
		return self::customShort("hr", $attributes);
	}
	// -------------------------------------------------------------------------
	static function iframe($innerHTML, $attributes = "")
	{
		return self::custom("iframe", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function script($innerHTML, $attributes = "type='text/javascript'")
	{
		return self::custom("script", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function img($src, $attributes = "alt=''")
	{
		return self::customShort("img", "src='" . $src . "' " . $attributes);
	}
	// -------------------------------------------------------------------------
	static function fieldset($innerHTML, $attributes = "")
	{
		return self::custom("fieldset", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function option($innerHTML, $attributes = "")
	{
		return self::custom("option", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function legend($innerHTML, $attributes = "")
	{
		return self::custom("legend", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function select($innerHTML, $attributes = "")
	{
		return self::custom("select", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function textarea($innerHTML, $attributes = "")
	{
		return self::custom("textarea", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function input($attributes = "")
	{
		return self::customShort("input", $attributes);
	}
	// -------------------------------------------------------------------------
	static function sup($innerHTML, $attributes = "")
	{
		return self::custom("sup", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function sub($innerHTML, $attributes = "")
	{
		return self::custom("sub", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function optgroup($innerHTML, $attributes = "")
	{
		return self::custom("optgroup", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function a($innerHTML, $attributes = "")
	{
		return self::custom("a", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function b($innerHTML, $attributes = "")
	{
		return self::custom("b", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function button($innerHTML, $attributes = "")
	{
		return self::custom("button", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function br()
	{
		return self::customShort("br", "");
	}
	// -------------------------------------------------------------------------
	static function applet($innerHTML, $attributes = "")
	{
		return self::custom("applet", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function pre($innerHTML, $attributes = "")
	{
		return self::custom("pre", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function html($innerHTML, $attributes = "")
	{
		return self::custom("html", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function head($innerHTML, $attributes = "")
	{
		return self::custom("head", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function link($attributes)
	{
		return self::customShort("link", $attributes);
	}
	// -------------------------------------------------------------------------
	static function label($innerHTML, $attributes = "")
	{
		return self::custom("label", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function li($innerHTML, $attributes = "")
	{
		return self::custom("li", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function ul($innerHTML, $attributes = "")
	{
		return self::custom("ul", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function title($innerHTML, $attributes = "")
	{
		return self::custom("title", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h1($innerHTML, $attributes = "")
	{
		return self::custom("h1", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h2($innerHTML, $attributes = "")
	{
		return self::custom("h2", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h3($innerHTML, $attributes = "")
	{
		return self::custom("h3", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h4($innerHTML, $attributes = "")
	{
		return self::custom("h4", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h5($innerHTML, $attributes = "")
	{
		return self::custom("h5", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h6($innerHTML, $attributes = "")
	{
		return self::custom("h6", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h7($innerHTML, $attributes = "")
	{
		return self::custom("h7", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function h8($innerHTML, $attributes = "")
	{
		return self::custom("h8", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function body($innerHTML, $attributes = "")
	{
		return self::custom("body", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function code($innerHTML, $attributes = "")
	{
		return self::custom("code", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function strong($innerHTML, $attributes = "")
	{
		return self::custom("strong", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function meta($attributes)
	{
		return self::customShort("meta", $attributes);
	}
	// -------------------------------------------------------------------------
	static function object($innerHTML, $attributes)
	{
		return self::custom("object", $innerHTML, $attributes);
	}
	// -------------------------------------------------------------------------
	static function param($attributes)
	{
		return self::customShort("param", $attributes);
	}
	// -------------------------------------------------------------------------
}
?>