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
        $mpdf = $this->alapMPDF();

        $mpdf->WriteHTML($this->templating->render("SzakdolgozatJegyzokonyvBundle:Pdf:jegyzokonyv.html.twig", array(
            "jegyzokonyv"   =>  $jegyzokonv,
        )));

        $mpdf->Output($jegyzokonv->getNev() . ".pdf", "I");
    }

    /**
     * @return mPDF
     */
    protected function alapMPDF()
    {
        $mpdf = new mPDF("utf-8", "A4", 14, "", 15, 15, 50, 16, 9, 9, "P");

        $mpdf->useOddEven = false;
        $mpdf->useOnlyCoreFonts = true;

        $mpdf->SetHTMLHeader($this->templating->render("SzakdolgozatJegyzokonyvBundle:Pdf:_header.html.twig"), "OE", true);
        $mpdf->SetHTMLFooter($this->templating->render("SzakdolgozatJegyzokonyvBundle:Pdf:_footer.html.twig"), "OE", true);

        return $mpdf;
    }
}
