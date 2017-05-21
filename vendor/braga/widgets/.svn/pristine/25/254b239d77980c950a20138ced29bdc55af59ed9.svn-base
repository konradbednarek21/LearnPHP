<?php

namespace braga\widgets\bootstrap;

use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 13:50:16
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class CheckBoxField extends \braga\widgets\base\CheckBoxField
{
	// -------------------------------------------------------------------------
	use AddLabels;
	public function out()
	{
		$input = parent::out();
		$label = $this->getLabel();
		return BaseTags::div($label . $input, "class='form-group'");
	}
	// -------------------------------------------------------------------------
}
?>