<?php
use braga\tools\tools\PostLogger;
use braga\tools\tools\PostChecker;

/**
 * Created on 24.10.2016 22:25:45
 * error prefix
 * @author Tomasz Gajewski
 * @package
 *
 */
class PostLoggetTest extends PHPUnit_Framework_TestCase
{
	// -------------------------------------------------------------------------
	function testLogger()
	{
		global $superVariable;
		PostChecker::setLogger(new Logger());
		$_POST["a"] = "b";
		PostChecker::get("a");
		$this->assertEquals($_POST, $superVariable);
	}
	// -------------------------------------------------------------------------
}
class Logger implements PostLogger
{
	public function save(array $post)
	{
		global $superVariable;
		$superVariable = $post;
	}
}
?>