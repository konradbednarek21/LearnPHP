<?php
/**
 * Created on 3 maj 2015 14:58:06
 * error prefix OR:399
 * maxerror prefix OR:39901
 * @author Tomasz Gajewski
 * @package
 *
 */
namespace braga\wordgame\frontoffice\controles;
trait RetvalReturner
{
	// -------------------------------------------------------------------------
	protected function getRetvalObject()
	{
		return new FritRetval();
	}
	// -------------------------------------------------------------------------
}
?>