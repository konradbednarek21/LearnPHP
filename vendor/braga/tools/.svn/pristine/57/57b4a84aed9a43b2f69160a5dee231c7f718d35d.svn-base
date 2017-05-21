<?php
namespace braga\tools\tools;
/**
 * Created on 21-03-2012 18:12:53
 * @author Tomasz Gajewski
 * @package package_name
 * error prefix
 */
class Message
{
	// -------------------------------------------------------------------------
	protected $numer = null;
	protected $opis = null;
	// -------------------------------------------------------------------------
	public function getNumer()
	{
		return $this->numer;
	}
	// -------------------------------------------------------------------------
	public function getOpis()
	{
		return $this->opis;
	}
	// -------------------------------------------------------------------------
	static function import($text)
	{
		$retval = new Message();
		$text = trim($text);
		if($text != "")
		{
			$msgArray = explode(" ", $text, 2);
			$retval->numer = $msgArray[0];
			$retval->opis = $msgArray[1];
			return $retval;
		}
		else
		{
			return null;
		}
	}
	// -------------------------------------------------------------------------
}
?>