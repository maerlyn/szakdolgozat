<?php

namespace Szakdolgozat\JegyzokonyvBundle\Export;

use \mPDF;
use Szakdolgozat\JegyzokonyvBundle\Entity\Jegyzokonyv;

class Pdf
{
    public function jegyzokonyv(Jegyzokonyv $jegyzokonv)
    {
        $mpdf = new mPDF("utf-8");

        $mpdf->Output($jegyzokonv->getNev() . ".pdf", "I");
    }
}
