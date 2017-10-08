<?php
namespace braga\wordgame\backoffice\controllers\content;

use braga\tools\html\Controler;
use braga\tools\tools\PostChecker;
use braga\widgets\bootstrap\BS;
use braga\wordgame\backoffice\controllers\RetvalReturner;
use braga\wordgame\backoffice\utils\Tags;
use braga\wordgame\backoffice\views\Layout;
use braga\wordgame\common\obj\Artykul;
use braga\wordgame\backoffice\forms\ArtykulForm;

/**
 * create date 1 paź 2017
 *
 * @author Artur
 */
class ContentController extends Controler
{
    use RetvalReturner;

    // ---------------------------------------------------------------------
    public function doAction()
    {
        $this->setLayOut(new Layout());
        switch (PostChecker::get("action")) {
            case "GetArtykul":
                $this->getArtykulForm();
                break;
            case "UpdArtykul":
                $this->updateArtykul();
                break;
            case "InsArtykul":
                $this->insertArtykul();
                break;
            case "NewArtykul":
                $this->newArtykulForm();
                break;
            case "GetLeftMenu":
                $this->getLeftMenu();
                break;
            case "":
                $this->getWorkSpace();
                break;
            default:
                addAlert("FB:0001 Akcja: " . PostChecker::get("action") . " nie jest obsługiwana");
                break;
        }
        $this->page();
    }
    // ---------------------------------------------------------------------
    protected function updateArtykul()
    {
        try {
            
            $a = Artykul::get(PostChecker::get("idartykul"));
            if ($this->saveArtykul($a)) {
                addMsg("A:0 Dane zapisane poprawnie");
                $this->getArtykulForm();
                $this->getLeftMenu();
            }
        } catch (\Exception $e) {}
    }

    // ---------------------------------------------------------------------
    protected function insertArtykul()
    {
        try {
            
            $a = Artykul::get();
            if ($this->saveArtykul($a)) {
                addMsg("A:0 Dane zapisane poprawnie");
                PostChecker::set("idartykul", $a->getIdArtykul());
                $this->getArtykulForm();
                $this->getLeftMenu();
            }
        } catch (\Exception $e) {}
    }
    
    // ---------------------------------------------------------------------
    private function saveArtykul(Artykul $a)
    {
        $a->setTytul(PostChecker::get("tytul"));
        $a->setTresc(PostChecker::get("tresc"));
        return $a->save();
    }
    // ---------------------------------------------------------------------
    protected function getArtykulForm()
    {
        try {
            $a = Artykul::get(PostChecker::get("idartykul"));
            $form = new ArtykulForm($a);
            $retval = $form->out();
            $retval .= BS::submit("Zmień");
            $retval .= HiddenField("action", "UpdArtykul");
            $retval .= HiddenField("idartykul",$a->getIdArtykul());
            $retval = Tags::formularz($retval);
            $retval = BS::box("Artykul", $retval);
            $this->r->addChange($retval);
        } catch (\Exception $e) {}
    }
    // ---------------------------------------------------------------------
    protected function newArtykulForm()
    {
        try {
            $a = Artykul::get();
            $form = new ArtykulForm($a);
            $retval = $form->out();
            $retval .= BS::submit("Dodaj");
            $retval .= HiddenField("action", "InsArtykul");
            $retval = Tags::formularz($retval);
            $retval = BS::box("Nowy Artykul", $retval);
            $this->r->addChange($retval);
        } catch (\Exception $e) {}
    }

    // ---------------------------------------------------------------------
    protected function getLeftMenu()
    {
        $retval = "";
        foreach (Artykul::getAll() as $a) /* @var $a Artykul */
		{
            $content = faIcon("fa-caret-right fa-lg fa-fw") . $a->getTytul();
            $content = Tags::ajaxLink($content, "?action=GetArtykul&amp;idartykul=" . $a->getIdArtykul());
            $retval .= $content;
        }
        $title = "Artkuły";
        $title .= Tags::ajaxLink(faIcon("fa-plus-circle zPrawej"), "?action=NewArtykul");
        $retval = BS::box($title, $retval);
        $this->r->addChange($retval, "#LeftMenu");
    }

    // ---------------------------------------------------------------------
    protected function getWorkSpace()
    {
        $retval = Tags::script("ajax.get(\"?action=GetLeftMenu\")");
        $this->r->addPage($retval);
    }
    // ---------------------------------------------------------------------
}