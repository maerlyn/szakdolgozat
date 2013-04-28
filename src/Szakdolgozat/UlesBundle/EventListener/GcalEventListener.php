<?php

namespace Szakdolgozat\UlesBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Szakdolgozat\UlesBundle\Event\GcalEvent;

class GcalEventListener implements EventSubscriberInterface
{
    /** @var Session */
    private $session;
    private $client_id;
    private $client_secret;
    private $refresh_token;

    public function __construct(Session $session, $client_id, $client_secret, $refresh_token)
    {
        $this->session          =   $session;
        $this->client_id        =   $client_id;
        $this->client_secret    =   $client_secret;
        $this->refresh_token    =   $refresh_token;

        var_dump(func_get_args());
        die();
    }

    public function ulesNew(GcalEvent $event)
    {}

    public function ulesEdit(GcalEvent $event)
    {}

    public function ulesDelete(GcalEvent $event)
    {}

    public static function getSubscribedEvents()
    {
        return array(
            "ules.new"      =>  "ulesNew",
            "ules.edit"     =>  "ulesEdit",
            "ules.delete"   =>  "ulesDelete",
        );
    }
}
