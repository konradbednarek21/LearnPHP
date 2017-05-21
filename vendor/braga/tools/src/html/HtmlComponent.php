<?php
namespace braga\tools\html;

/**
 * Created on 7 mar 2015 11:18:19
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
abstract class HtmlComponent
{
	// -------------------------------------------------------------------------
	protected $content = null;
	// -------------------------------------------------------------------------
	abstract function out();
	// -------------------------------------------------------------------------
	public function setContent($content)
	{
		$this->content = $content;
	}
	// -------------------------------------------------------------------------
}
?>