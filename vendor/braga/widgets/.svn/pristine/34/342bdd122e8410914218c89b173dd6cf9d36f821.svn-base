<?php

namespace braga\widgets\base;

/**
 * Created on 07-04-2011 17:07:15
 * @author Tomasz.Gajewski
 * @package system
 * error prefix
 */
abstract class Field
{
	// -------------------------------------------------------------------------
	protected $attrib = null;
	// -------------------------------------------------------------------------
	protected $selected = null;
	protected $required = false;
	protected $name = null;
	protected $id = null;
	protected $customAttrib = null;
	protected $tabOrder = null;
	protected $classString = null;
	protected $onChange = null;
	protected $onClick = null;
	protected $onBlur = null;
	protected $onFocus = null;
	protected $onMouseOver = null;
	protected $onMouseOut = null;
	protected $onMouseUp = null;
	protected $onKeyUp = null;
	protected $onKeyDown = null;
	// -------------------------------------------------------------------------
	public function setOnKeyUp($onKeyUp)
	{
		$this->onKeyUp = $onKeyUp;
	}
	// -------------------------------------------------------------------------
	public function setOnKeyDown($onKeyDown)
	{
		$this->onKeyDown = $onKeyDown;
	}
	// -------------------------------------------------------------------------
	public function setOnChange($onChange)
	{
		$this->onChange = $onChange;
	}
	// -------------------------------------------------------------------------
	public function setOnClick($onClick)
	{
		$this->onClick = $onClick;
	}
	// -------------------------------------------------------------------------
	public function setOnBlur($onBlur)
	{
		$this->onBlur = $onBlur;
	}
	// -------------------------------------------------------------------------
	public function setOnFocus($onFocus)
	{
		$this->onFocus = $onFocus;
	}
	// -------------------------------------------------------------------------
	public function setOnMouseOver($onMouseOver)
	{
		$this->onMouseOver = $onMouseOver;
	}
	// -------------------------------------------------------------------------
	public function setOnMouseOut($onMouseOut)
	{
		$this->onMouseOut = $onMouseOut;
	}
	// -------------------------------------------------------------------------
	public function setOnMouseUp($onMouseUp)
	{
		$this->onMouseUp = $onMouseUp;
	}
	// -------------------------------------------------------------------------
	public function setClassString($classString)
	{
		$this->classString = $classString;
	}
	// -------------------------------------------------------------------------
	public function setRequired($required = true)
	{
		$this->required = $required;
	}
	// -------------------------------------------------------------------------
	public function setTabOrder($tabOrder)
	{
		$this->tabOrder = $tabOrder;
	}
	// -------------------------------------------------------------------------
	public function setCustomAttrib($customAtrrtib)
	{
		$this->customAttrib = $customAtrrtib;
	}
	// -------------------------------------------------------------------------
	public function setName($name)
	{
		$this->name = $name;
		$this->id = $name;
	}
	// -------------------------------------------------------------------------
	public function setId($id)
	{
		$this->id = $id;
	}
	// -------------------------------------------------------------------------
	public function setSelected($selected)
	{
		$this->selected = $selected;
	}
	// -------------------------------------------------------------------------
	public function getSelected()
	{
		return $this->selected;
	}
	// -------------------------------------------------------------------------
	abstract function out();
	// -------------------------------------------------------------------------
	protected function addEvents()
	{
		$this->addAttrib("onchange", $this->onChange);
		$this->addAttrib("onclick", $this->onClick);
		$this->addAttrib("onblur", $this->onBlur);
		$this->addAttrib("onfocus", $this->onFocus);
		$this->addAttrib("onmouseover", $this->onMouseOver);
		$this->addAttrib("onmouseout", $this->onMouseOut);
		$this->addAttrib("onmouseup", $this->onMouseUp);
		$this->addAttrib("onkeyup", $this->onKeyUp);
		$this->addAttrib("onkeydown", $this->onKeyDown);
	}
	// -------------------------------------------------------------------------
	protected function addCustomAttrib()
	{
		if($this->customAttrib != null)
		{
			$this->attrib .= $this->customAttrib;
		}
	}
	// -------------------------------------------------------------------------
	protected function addAttrib($name, $value)
	{
		if($value != null)
		{
			$this->attrib .= $name .= "='" . $value . "' ";
		}
	}
	// -------------------------------------------------------------------------
}
?>