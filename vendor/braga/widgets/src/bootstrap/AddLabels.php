<?php

namespace braga\widgets\bootstrap;

use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 18:07:23
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
trait  AddLabels
{
	protected $label;
	// -------------------------------------------------------------------------
	public function setLabel($label)
	{
		$this->label = $label;
	}
	// -------------------------------------------------------------------------
	public function getLabel()
	{

		if(!empty($this->label))
		{
			return BaseTags::label($this->label, "for='" . $this->name . "'");
		}
	}
	// -------------------------------------------------------------------------
}
?>