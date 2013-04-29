<?php

namespace Szakdolgozat\UlesBundle\EventListener;

use Doctrine\ORM\EntityManager;
use Guzzle\Http\Client;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Szakdolgozat\UlesBundle\Event\GcalEvent;

class GcalEventListener implements EventSubscriberInterface
{
    /** @var Session */
    private $session;
    /** @var EntityManager */
    private $entity_manager;
    private $client_id;
    private $client_secret;
    private $refresh_token;
    private $calendar_id;

    public function __construct(Session $session, EntityManager $entity_manager, $client_id, $client_secret, $refresh_token, $calendar_id)
    {
        $this->session          =   $session;
        $this->entity_manager   =   $entity_manager;
        $this->client_id        =   $client_id;
        $this->client_secret    =   $client_secret;
        $this->refresh_token    =   $refresh_token;
        $this->calendar_id      =   $calendar_id;
    }

    public function getAccessToken()
    {
        if (!$this->session->has("gcal.access_token")) {
            $client = new Client();

            $request = $client->post("https://accounts.google.com/o/oauth2/token");
            $request->addPostFields(array(
                "client_id"     =>  $this->client_id,
                "client_secret" =>  $this->client_secret,
                "refresh_token" =>  $this->refresh_token,
                "grant_type"    =>  "refresh_token",
            ));

            $response = $request->send();
            $data = json_decode($response->getBody(), true);

            $this->session->set("gcal.access_token", $data["access_token"]);
        }

        return $this->session->get("gcal.access_token");
    }

    public function getGoogleCalendarService()
    {
        $client = new \Google_Client();
        $client->setApplicationName("Szakdolgozat");
        $client->setClientId($this->client_id);
        $client->setClientSecret($this->client_secret);

        $at = json_encode(array(
            "access_token"  =>  $this->getAccessToken(),
            "created"       =>  time(),
            "expires_in"    =>  3600,
        ));

        $client->setAccessToken($at);

        require_once __DIR__ . "/../../../google-api-php-client/src/contrib/Google_CalendarService.php";
        $service = new \Google_CalendarService($client);

        return $service;
    }

    public function ulesNew(GcalEvent $event)
    {
        $ules = $event->getUles();

        $event = new \Google_Event();
        $event->setSummary($ules->getNev());
        $event->setDescription($ules->getLeiras());
        $event->setLocation($ules->getHelyszin());

        $start = new \Google_EventDateTime();
        $start->setDateTime($ules->getDatum()->format("c"));
        $end = new \Google_EventDateTime();
        $end->setDateTime($ules->getDatum()->modify("+1 hour")->format("c"));

        $event->setStart($start);
        $event->setEnd($end);

        $attendees = array();
        foreach ($ules->getMeghivottak() as $meghivott) {
            $att = new \Google_EventAttendee();
            $att->setEmail($meghivott->getEmail());
            $attendees[] = $att;
        }
        $event->setAttendees($attendees);

        $service = $this->getGoogleCalendarService(); /** @var \Google_CalendarService */
        $created_event = $service->events->insert($this->calendar_id, $event, array("sendNotifications" => true));

        $ules->setGcalEventId($created_event["id"]);
        $this->entity_manager->flush($ules);
    }

    public function ulesEdit(GcalEvent $event)
    {}

    public function ulesDelete(GcalEvent $event)
    {
        $ules = $event->getUles();

        if (!$ules->getGcalEventId()) {
            return;
        }

        $service = $this->getGoogleCalendarService(); /** @var \Google_CalendarService */

        $service->events->delete($this->calendar_id, $ules->getGcalEventId(), array("sendNotifications" => true));
    }

    public static function getSubscribedEvents()
    {
        return array(
            "ules.new"      =>  "ulesNew",
            "ules.edit"     =>  "ulesEdit",
            "ules.delete"   =>  "ulesDelete",
        );
    }
}
