<?php

namespace Szakdolgozat\FelhasznaloBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SzakdolgozatFelhasznaloBundle extends Bundle
{
    public function getParent()
    {
        return "FpOpenIdBundle";
    }

}
