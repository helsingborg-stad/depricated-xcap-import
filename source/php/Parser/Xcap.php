<?php

namespace HbgEventImporter\Parser;

class Xcap extends \HbgEventImporter\Parser
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
            if (!isset($event->uid) || empty($event->uid)) {
                continue;
            }

            $date_start = isset($event->dtstart) && !empty($event->dtstart) ? $event->dtstart : null;
            $date_end = isset($event->dtend) && !empty($event->dtend) ? $event->dtend : null;
            $title = isset($event->summary) && !empty($event->summary) ? $event->summary : null;
            $description = isset($event->description) && !empty($event->description) ? $event->description : null;
            $categories = isset($event->categories) && !empty($event->categories) ? explode(',', $event->categories) : null;
            $location = isset($event->location) && !empty($event->location) ? $event->location : null;
            $address = isset($event->{'x-xcap-address'}) && !empty($event->{'x-xcap-address'}) ? $event->{'x-xcap-address'} : null;
            $image_url = isset($event->{'x-xcap-imageid'}) && !empty($event->{'x-xcap-imageid'}) ? $event->{'x-xcap-imageid'} : null;

            if ($title === null || is_object($title)) {
                continue;
            }

            // Check if the event passes the filter
            if (!$this->filter($categories)) {
                continue;
            }

            \HbgEventImporter\Event::add(array(
                'id'          => $event->uid,
                'date_start'  => strtotime($date_start),
                'date_end'    => strtotime($date_end),
                'title'       => $event->summary,
                'description' => $description,
                'categories'  => $categories,
                'location'    => $location,
                'address'     => $address,
                'image_url'   => $image_url
            ));
        }
    }

    /**
     * Filter, if add or not to add
     * @param  array $categories All categories
     * @return bool
     */
    public function filter($categories)
    {
        $passes = true;

        if (get_field('filter_categories', 'options')) {
            $filters = array_map('trim', explode(',', get_field('filter_categories', 'options')));
            $categoriesLower = array_map('strtolower', $categories);
            $passes = false;

            foreach ($filters as $filter) {
                if (in_array(strtolower($filter), $categoriesLower)) {
                    $passes = true;
                }
            }
        }

        return $passes;
    }
}
