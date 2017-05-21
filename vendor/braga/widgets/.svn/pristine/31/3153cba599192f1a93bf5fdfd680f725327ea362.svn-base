<?php
use braga\widgets\jqueryui\TextField;
use braga\widgets\jqueryui\FloatField;
use braga\widgets\jqueryui\MemoField;
use braga\tools\html\BaseTags;
use braga\widgets\jqueryui\TimeField;
use braga\widgets\jqueryui\DateField;
use braga\widgets\jqueryui\IntegerField;
use braga\widgets\jqueryui\CheckBoxField;

/**
 * Created on 05.09.2016 21:59:17
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */

// =============================================================================
function icon($icon = "", $float = "left")
{
	return BaseTags::span("", "class='ui-icon " . $icon . "' style='float:" . $float . "'");
}
// =============================================================================
function ListGroupItemExtended($title = "Tytuł", $content = "")
{
	$rnd = "LGE" . getRandomStringLetterOnly(8);
	$retval = "<p class='ui-corner-all ui-state-default ui-helper-clearfix' style='padding:0px 2px;' >";
	$retval .= "<span class='hand' OnClick='\$(\"#" . $rnd . "\").slideToggle(\"fast\");";
	$retval .= "\$(this).parent().toggleClass(\"ui-state-active\");";
	$retval .= "\$(\$(this).children(\"span:first-child\")).toggleClass(\"ui-icon-triangle-1-e\");";
	$retval .= "\$(\$(this).children(\"span:first-child\")).toggleClass(\"ui-icon-triangle-1-se\") ' >";
	$retval .= icon("ui-icon-triangle-1-e", "left");
	$retval .= "</span>";
	$retval .= $title;
	$retval .= "</p>";
	$retval .= "<div class='h' id='" . $rnd . "' style='padding-left:4px;'>" . $content . "</div>";

	return $retval;
}
// =============================================================================
function ListGroupItem($title = "Tytuł", $content = "")
{
	$rnd = "LGI" . getRandomStringLetterOnly(8);
	$atrib = "onclick='\$(\"#" . $rnd . "\").slideToggle(\"fast\");\$(this).toggleClass(\"ui-state-active\");\$(\$(this).children(\"span:first-child\")).toggleClass(\"ui-icon-triangle-1-e\");\$(\$(this).children(\"span:first-child\")).toggleClass(\"ui-icon-triangle-1-se\");' ";
	$atrib .= "class='ui-corner-all ui-state-default ui-helper-clearfix hand' ";
	$atrib .= "style='padding:0px 2px;'";
	$retval = BaseTags::p(icon("ui-icon-triangle-1-e") . $title, $atrib);
	$retval .= BaseTags::div($content, "class='h' id='" . $rnd . "' style='padding-left:4px;'");
	return $retval;
}
// =============================================================================
function ListGroupItemAjaxExtended($title, $href, $contentId)
{
	$retval = BaseTags::p(BaseTags::a(icon("ui-icon-triangle-1-e"), "href='" . $href . "' onclick='" . "if(\$(\"#" . $contentId . "\").is(\":visible\")) {\$(\"#" . $contentId . "\").slideToggle(\"fast\");}\$(this).parent().toggleClass(\"ui-state-active\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-e\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-se\");if(\$(this).children(\"span:first-child\").hasClass(\"ui-icon-triangle-1-se\")){return fieldAjax.go(this);}else{return false;}'") . $title, "class='ui-corner-all ui-state-default ui-helper-clearfix' style='padding:0px 2px;'");
	$retval .= BaseTags::div("", "class='h' id='" . $contentId . "' style='padding-left:4px;'");
	return $retval;
}
// =============================================================================
function ListGroupItemAjax($title, $href, $contentId)
{
	$retval = BaseTags::p(BaseTags::a(icon("ui-icon-triangle-1-e") . $title, "href='" . $href . "' onclick='" . "if(\$(\"#" . $contentId . "\").is(\":visible\")) " . "{\$(\"#" . $contentId . "\").slideToggle(\"fast\");}" . "\$(this).parent().toggleClass(\"ui-state-active\");" . "\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-e\");" . "\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-se\"); " . "if(\$(this).children(\"span:first-child\").hasClass(\"ui-icon-triangle-1-se\")) " . "{return fieldAjax.go(this);}" . "else" . "{return false;}'"), "class='ui-corner-all ui-state-default ui-helper-clearfix' style='padding:0px 2px;'") . BaseTags::div("", "class='h' id='" . $contentId . "' style='padding-left:4px;'");
	return $retval;
}
// =============================================================================
function ListItem($content = "", $defaultClass = "ui-state-default")
{
	return BaseTags::p($content, "class='" . $defaultClass . " ui-corner-all ListItem' style='margin:1px 0px;padding:1px' onclick='\$(\"p.ListItem\").removeClass(\"ui-state-highlight\") ;\$(this).addClass(\"ui-state-highlight\");' onmouseover='\$(this).addClass(\"ui-state-focus\")' onmouseout='\$(this).removeClass(\"ui-state-focus\")'");
}
// =============================================================================
function Fieldset($title = "", $content = "", $display = true, $wyroznienie = false)
{
	$rnd = getRandomStringLetterOnly(8);
	if($title != "")
	{
		$attrib = "class='hand' onclick='\$(\"#" . $rnd . "\").slideToggle(\"fast\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-e\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-s\") '";
		if($display)
		{
			$legend = BaseTags::span(icon("ui-icon-triangle-1-s"), $attrib) . $title;
			$hidden = "";
		}
		else
		{
			$legend = BaseTags::span(icon("ui-icon-triangle-1-e"), $attrib) . $title;
			$hidden = "style='display:none'";
		}

		if($wyroznienie)
		{
			$addClassFieldSet = "ui-state-active";
			$addClassLegend = "ui-state-highlight";
		}
		else
		{

			$addClassFieldSet = "";
			$addClassLegend = "";
		}

		$retval = BaseTags::div($content, "id='" . $rnd . "' " . $hidden . "");
		$retval .= BaseTags::legend($legend, "class='ui-widget-header ui-corner-all " . $addClassLegend . "' style='padding:2px 8px;'");
		$retval = BaseTags::fieldset($retval, "class='ui-widget-content ui-corner-all " . $addClassFieldSet . "' style='margin:4px;'");
	}
	else
	{

		$retval = BaseTags::div($content, "id='" . $rnd . "'");
		$retval = BaseTags::fieldset($retval, "class='ui-widget-content ui-corner-all " . $addClassFieldSet . "' style='margin:4px;'");
	}
	return $retval;
}
// =============================================================================
function Box($title = "NoTitle", $content = "", $display = true)
{
	$rnd = getRandomStringLetterOnly(8);
	if($display)
	{
		$retval = BaseTags::span(icon("ui-icon-triangle-1-s"), "class='hand' onclick='\$(\"#" . $rnd . "\").slideToggle(\"fast\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-e\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-s\") '");
		$retval .= $title;
		$retval = BaseTags::div($retval, "class='ui-widget-header ui-corner-all' style='padding:2px'");
		$retval .= BaseTags::div($content, "id='" . $rnd . "' style='padding:2px;'");
	}
	else
	{
		$retval = BaseTags::span(icon("ui-icon-triangle-1-e"), "class='hand' onclick='\$(\"#" . $rnd . "\").slideToggle(\"fast\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-e\");\$(this).children(\"span:first-child\").toggleClass(\"ui-icon-triangle-1-s\") '");
		$retval .= $title;
		$retval = BaseTags::div($retval, "class='ui-widget-header ui-corner-all' style='padding:2px'");
		$retval .= BaseTags::div($content, "id='" . $rnd . "' class='h' style='padding:2px;'");
	}
	$retval = BaseTags::div($retval, "style='width:auto;margin-bottom:4px;padding:2px' class='ui-widget-content ui-corner-all'");
	return $retval;
}
// =============================================================================
function LongDesc($text = "")
{
	return BaseTags::p($text, "class='ui-widget-content ui-corner-all ui-state-highlight j' style='padding:4px;margin-bottom:4px;margin-top:2px;'");
}
// =============================================================================
function LongDescError($text = "")
{
	return BaseTags::p(icon("ui-icon-alert") . $text, "class='ui-widget-content ui-corner-all ui-state-error j b' style='padding:4px;margin-bottom:4px;margin-top:2px;'");
}
// =============================================================================
function CommandButton($caption = "NoTitle", $onClick = "")
{
	return BaseTags::button($caption, "onclick='" . $onClick . "' style='margin:4px;padding:2px' onmouseover='\$(this).addClass(\"ui-state-hover\")' onmouseout='\$(this).removeClass(\"ui-state-hover\")' class='hand ui-button ui-state-default ui-corner-all'");
}
// =============================================================================
function SubmitButton($label = "Wyślij")
{
	return BaseTags::input("type='submit' style='margin:4px;padding:2px' onmouseover='\$(this).addClass(\"ui-state-hover\")' onmouseout='\$(this).removeClass(\"ui-state-hover\")' class='ui-button ui-state-default ui-corner-all hand' value='" . $label . "'");
}
// =============================================================================
function PasswordField($name = "no_name", $value = "", $required = false)
{
	$txt = new TextField();
	$txt->setName($name);
	$txt->setRequired($required);
	$txt->setSelected($value);
	$txt->setType("password");
	$retval = $txt->out();

	return $retval;
}
// =============================================================================
function FormRow($desc = "", $real = "")
{
	$retval = BaseTags::div($desc, "class='FormCellDesc'");
	$retval .= BaseTags::div($real, "class='FormCellReal'");
	return $retval;
}
// =============================================================================
function FormSubmitRow($real = "")
{
	return BaseTags::p($real, "class='FormCellReal c '");
}
// =============================================================================
function FileField($name = "no_name")
{
	return BaseTags::input("type='file' id='" . $name . "' name='" . $name . "'");
}
// =============================================================================
function HiddenField($name = "no_name", $value = "")
{
	return BaseTags::input("type='hidden' id='" . $name . "' name='" . $name . "' value='" . $value . "'");
}
// =============================================================================
function CheckBoxField($name = "no_name", $checked = false)
{
	$f = new CheckBoxField();
	$f->setName($name);
	$f->setSelected($checked);
	return $f->out();
}
// =============================================================================
function IntegerField($name = "no_name", $value = "", $required = true)
{
	$f = new IntegerField();
	$f->setName($name);
	$f->setSelected($value);
	$f->setRequired($required);

	return $f->out();
}
// =============================================================================
function DateField($name = "no_name", $value = "", $required = false)
{
	$d = new DateField();
	$d->setName($name);
	$d->setRequired($required);
	$d->setSelected($value);
	return $d->out();
}
// =============================================================================
function TimeField($name = "no_name", $value = "", $required = false)
{
	$t = new TimeField();
	$t->setName($name);
	$t->setRequired($required);
	$t->setSelected($value);
	return $t->out();
}
// =============================================================================
function FloatField($name = "no_name", $value = "", $required = true)
{
	$f = new FloatField();
	$f->setName($name);
	$f->setSelected($value);
	$f->setRequired($required);
	return $f->out();
}
// =============================================================================
function EmailField($name = "no_name", $value = "", $required = false, $tabOrder = null)
{
	$txt = new TextField();
	$txt->setName($name);
	$txt->setRequired($required);
	$txt->setSelected($value);
	$txt->setOnBlur("CheckEmail(this," . ($required ? "true" : "false") . ");");
	$txt->setTabOrder($tabOrder);
	$retval = $txt->out();
	return $retval;
}
// =============================================================================
function TextField($name = "no_name", $value = "", $required = false, $multiline = false, $maxLenght = 255, $tabOrder = 0)
{
	if($multiline)
	{
		$txt = new MemoField();
		$txt->setName($name);
		$txt->setTabOrder($tabOrder);
		$txt->setMaxLength($maxLenght);
		$txt->setRequired($required);
		$txt->setSelected($value);
		$retval = $txt->out();
	}
	else
	{
		$txt = new TextField();
		$txt->setName($name);
		$txt->setTabOrder($tabOrder);
		$txt->setMaxLength($maxLenght);
		$txt->setRequired($required);
		$txt->setSelected($value);
		$retval = $txt->out();
	}
	return $retval;
}
// =============================================================================
function enableTinyMCE()
{
	return BaseTags::script("initTinyMCE();");
}
// =============================================================================
function getToolTip($text)
{
	return "title='" . $text . "' data-toggle='tooltip' data-placement='top'";
}
// =============================================================================
?>