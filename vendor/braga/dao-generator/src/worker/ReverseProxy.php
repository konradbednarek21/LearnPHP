<?php
namespace braga\daogenerator\worker;
/**
 * Created on 07-04-2013 13:34:03
 * author Tomasz Gajewski
 * package frontoffice
 * error prefix
 */
interface ReverseProxy
{
	// -------------------------------------------------------------------------
	/**
	 *
	 * @return Array
	 */
	public function getTables();
	/**
	 *
	 * @return Array
	 */
	public function getColumn($tableName);
	/**
	 *
	 * @return Array
	 */
	public function getPrimaryKeys($tableName);
	/**
	 *
	 * @return Array
	 */
	public function getForeginKeys($tableName);
	// -------------------------------------------------------------------------
}
?>