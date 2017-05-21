<?php

namespace braga\wordgame\frontoffice\forms;

use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\frontoffice\utils\BootstrapTags;
use braga\tools\html\HtmlComponent;

/**
 * Created on 8 lip 2016 10:32:42
 * error prefix
 * @author GromowskiBartosz
 * @package orion
 */
class NewRoomForm extends HtmlComponent
{
	// -----------------------------------------------------------------
	public function out()
	{
		$retval = "";
		$retval .= $this->form();
		return $retval;
	}
	// -----------------------------------------------------------------
	private function form()
	{
		$retval = BootstrapTags::panel("Utwórz nowy pokój...", $this->loginField());
		$retval = BootstrapTags::col($retval, "col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6");
		$retval = BootstrapTags::row($retval);
		$retval = Tags::formNonAjax($retval);
		$retval .= Tags::script("\$(\"#room_name\").focus();");
		return $retval;
	}
	// -----------------------------------------------------------------
	private function loginField()
	{
		$form = Tags::div(Tags::input("type='text' id='room_name' name='room_name'  placeholder='Nazwa pokoju' class='form-control input-lg'"), "class='form-group'");
		$form .= Tags::div(Tags::input("type='submit' value='Utwórz' class='btn btn-primary btn-lg zPrawej'") . HiddenField("action", "CreateNewRoom"), "class='form-group'");
		return $form;
	}
	// -----------------------------------------------------------------
}

?>