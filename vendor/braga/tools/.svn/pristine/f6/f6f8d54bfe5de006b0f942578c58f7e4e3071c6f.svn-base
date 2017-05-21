<?php
namespace braga\tools\html;

/**
 *
 * @package common
 * @author Tomasz.Gajewski
 * @abstract Created on 2009-04-06 10:40:13
 * klasa odpowiedzialna za pętle komunikatów oraz wstępne sprawdzenie
 * przychodzących danych
 */
abstract class Controler extends BaseControler
{
	// -------------------------------------------------------------------------
	/**
	 *
	 * @var HtmlComponent
	 */
	protected $layOut;
	// -------------------------------------------------------------------------
	public function __construct()
	{
		$this->r = $this->getRetvalObject();
	}
	// -------------------------------------------------------------------------
	/**
	 *
	 * @return Retval
	 */
	abstract protected function getRetvalObject();
	// -------------------------------------------------------------------------
	public function __destruct()
	{
		if(class_exists("BenchmarkTimer", true))
		{
			BenchmarkTimer::saveStatistic();
		}
	}
	// -------------------------------------------------------------------------
	protected function setLayOut(HtmlComponent $layOut)
	{
		$this->layOut = $layOut;
	}
	// -------------------------------------------------------------------------
	final protected function page()
	{
		if($this->isXhr())
		{
			if(!headers_sent())
			{
				header("Content-type: text/xml; charset-utf-8");
				echo $this->r->getAjax();
			}
			exit();
		}
		else
		{
			$this->layOut->setContent($this->r->getPage());
			$this->layOut->out();
		}
	}
	// -------------------------------------------------------------------------
	final protected function isXhr()
	{
		if(isset($_SERVER['HTTP_X_REQUESTED_WITH']))
		{
			return $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
		}
		return false;
	}
	// -------------------------------------------------------------------------
}
?>