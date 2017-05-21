<?php

namespace braga\widgets\base;

/**
 * Created on 14 wrz 2013 18:40:38
 * @author Tomasz Gajewski
 * @package frontoffice
 * error prefix
 */
class DBGridColumn
{
	// -------------------------------------------------------------------------
	public $columnName = null;
	public $columnContent = null;
	// -------------------------------------------------------------------------
	public function __construct($columnName, $columnContent)
	{
		$this->columnName = $columnName;
		$this->columnContent = $columnContent;
	}
	// -------------------------------------------------------------------------
}
?>