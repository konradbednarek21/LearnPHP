<?php

namespace braga\widgets\base;

/**
 * Created on 14 wrz 2013 18:40:17
 * @author Tomasz Gajewski
 * @package frontoffice
 * error prefix
 */
class DBGridReplacer
{
	// -------------------------------------------------------------------------
	public $stringToReplaceByFieldContent;
	public $idField;
	// -------------------------------------------------------------------------
	public function __construct($string, $idField)
	{
		$this->stringToReplaceByFieldContent = $string;
		$this->idField = $idField;
	}
	// -------------------------------------------------------------------------
}
?>