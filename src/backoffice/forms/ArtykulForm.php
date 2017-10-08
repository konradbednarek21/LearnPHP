<?php
namespace braga\wordgame\backoffice\forms;
use braga\tools\html\HtmlComponent;
use braga\wordgame\common\obj\Artykul;
use braga\widgets\bootstrap\BS;

class ArtykulForm extends HtmlComponent
{
    protected $artykul;
    
    function __construct(Artykul $a)
    {
        $this->artykul = $a;
    }
    public function out()
    {
        $retval = BS::textField("Tytuł", "tytul",$this->artykul->getTytul());
        $retval .= BS::memoField("Tresc", "tresc",$this->artykul->getTresc());
        $retval .= enableTinyMCE();
        return $retval;
    }

    
}