<?php

namespace braga\tools\html;

use braga\tools\tools\Retval;

/**
 * Created on 22-09-2010 09:07:11
 * @package common
 */
abstract class BaseControler
{
	/**
	 *
	 * @var boolean
	 */
	public $js = false;
	/**
	 *
	 * @var Retval
	 */
	public $r;
	// -------------------------------------------------------------------------
	/**
	 *
	 * @return Retval;
	 */
	abstract public function doAction();
	// -------------------------------------------------------------------------
	public function import(BaseControler $controlerObject)
	{
		$this->js = $controlerObject->js;
		$this->r = $controlerObject->r;
	}
	// -------------------------------------------------------------------------
}
?>