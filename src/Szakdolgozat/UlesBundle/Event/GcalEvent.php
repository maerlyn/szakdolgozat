<?php

namespace Szakdolgozat\UlesBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Szakdolgozat\UlesBundle\Entity\Ules;

class GcalEvent extends Event
{
    /** @var Ules */
    private $ules;

    public function __construct(Ules $ules)
    {
        $this->ules = $ules;
    }

    public function getUles()
    {
        return $this->ules;
    }
}
