<?php

namespace KulturkortetImport\Parser;

class Xcap extends \KulturkortetImport\Parser
{
    private $url;

    public function __construct($url)
    {
        $this->url = $url;
        $this->start();
    }

    public function start()
    {
        $xml = simplexml_load_file($this->url);
        $xml = json_decode(json_encode($xml));
        $events = $xml->iCal->vevent;

        foreach ($events as $event) {
            \KulturkortetImport\Event::add(array(
                'id'          => $event->uid,
                'date_start'  => strtotime($event->dtstart),
                'date_end'    => strtotime($event->dtend),
                'title'       => $event->summary,
                'description' => $event->description,
                'categories'  => explode(',', $event->categories),
                'location'    => $event->location,
                'address'     => $event->{'x-xcap-address'},
                'image_url'   => $event->{'x-xcap-imageid'}
            ));
        }
    }
}
