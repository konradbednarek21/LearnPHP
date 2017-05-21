<?php
namespace braga\widgets\bootstrap;
use braga\tools\html\BaseTags;

/**
 * Created on 11.11.2016 17:37:05
 * error prefix
 * @author GajewskiTomasz
 * @package
 *
 */
class FloatField extends \braga\widgets\base\FloatField
{

	use ClassFactory;
	use AddLabels;
	// -------------------------------------------------------------------------
	protected $waterMark;
	// -------------------------------------------------------------------------
	public function setWatermark($w)
	{
		$this->waterMark = $w;
	}
	// -------------------------------------------------------------------------
	protected function setDefault()
	{
		$this->setClassString($this->getBaseClass());
	}
	// -------------------------------------------------------------------------
	public function out()
	{
		$this->setDefault();
		$this->addAttrib("placeholder", $this->waterMark);
		$input = parent::out();
		$label = $this->getLabel();
		if($this->required && empty($this->selected))
		{
			return BaseTags::div($label . $input, "class='form-group has-error'");
		}
		else
		{
			return BaseTags::div($label . $input, "class='form-group'");
		}
		// -------------------------------------------------------------------------
	}
}