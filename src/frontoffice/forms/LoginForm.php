<?php
namespace braga\wordgame\frontoffice\forms;

use braga\widgets\bootstrap\TextField;
use braga\wordgame\frontoffice\utils\Tags;
use braga\wordgame\frontoffice\utils\BootstrapTags;
use braga\tools\html\HtmlComponent;

/**
 * Created on 8 lip 2016 10:32:42
 * error prefix
 * @author GromowskiBartosz
 * @package orion
 */
class LoginForm extends HtmlComponent
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
		$retval = BootstrapTags::panel("Zaloguj...", $this->loginField());
		$retval = BootstrapTags::col($retval, "col-xs-12 col-sm-offset-2 col-sm-8 col-md-offset-3 col-md-6 col-lg-offset-3 col-lg-6");
		$retval = BootstrapTags::row($retval);
		$retval = Tags::formNonAjax($retval);
		$retval .= Tags::script("\$(\"#u\").focus();");
		return $retval;
	}
	// -----------------------------------------------------------------
	private function loginField()
	{
		$form = Tags::div(Tags::input("type='text' id='u' name='u'  placeholder='email' class='form-control input-lg'"), "class='form-group'");
		$form .= Tags::div(Tags::input("type='password' id='p' name='p'  placeholder='hasło' class='form-control input-lg'"), "class='form-group'");
		$form .= Tags::div(Tags::input("type='submit' value='Zaloguj' class='btn btn-primary btn-lg zPrawej'"), "class='form-group'");
		return $form;
	}
	// -----------------------------------------------------------------
}

?>