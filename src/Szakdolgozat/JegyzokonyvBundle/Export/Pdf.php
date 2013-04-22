<?php

namespace Szakdolgozat\JegyzokonyvBundle\Export;

use \mPDF;
use Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv;

class Pdf
{
    protected $templating;

    public function __construct($templating)
    {
        $this->templating = $templating;
    }

    public function jegyzokonyv(Jegyzokonyv $jegyzokonv)
    {
        $mpdf = new mPDF("utf-8");
        $mpdf->useOddEven = false;

        $mpdf->SetHTMLHeader($this->templating->render("SzakdolgozatJegyzokonyvBundle:Pdf:_header.html.twig"));
        $mpdf->SetHTMLFooter($this->templating->render("SzakdolgozatJegyzokonyvBundle:Pdf:_footer.html.twig"));

        $mpdf->Output($jegyzokonv->getNev() . ".pdf", "I");
    }
}
