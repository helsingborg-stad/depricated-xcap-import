<?php

namespace HbgEventImporter\Parser;

class Xcap extends \HbgEventImporter\Parser
{
    public function __construct($url)
    {
        parent::__construct($url);
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
            $ticket_link = isset($event->{'x-xcap-externalticketlink'}) && !empty($event->{'x-xcap-externalticketlink'}) ? $event->{'x-xcap-externalticketlink'} : null;

            if (empty($ticket_link) || $ticket_link === "null") {
                $ticket_link = isset($event->{'x-xcap-ticketlink'}) && !empty($event->{'x-xcap-ticketlink'}) ? $event->{'x-xcap-ticketlink'} : null;
            }

            if ($title === null || is_object($title)) {
                continue;
            }

            // Check if the event passes the filter
            if (!$this->filter($categories)) {
                continue;
            }

            \HbgEventImporter\Event::add(array(
                'id'          => $event->uid,
                'date_start'  => $this->formatDate($date_start),
                'date_end'    => $this->formatDate($date_end),
                'title'       => $event->summary,
                'description' => $description,
                'categories'  => $categories,
                'location'    => $location,
                'address'     => $address,
                'image_url'   => $image_url,
                'ticket_link' => $ticket_link
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

        if (get_field('xcap_filter_categories', 'options')) {
            $filters = array_map('trim', explode(',', get_field('xcap_filter_categories', 'options')));
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

    public function formatDate($date)
    {
        // Format the date string corretly
        $dateParts = explode("T", $date);
        $dateString = substr($dateParts[0], 0, 4) . '-' . substr($dateParts[0], 4, 2) . '-' . substr($dateParts[0], 6, 2);
        $timeString = substr($dateParts[1], 0, 4);
        $timeString = substr($timeString, 0, 2) . ':' . substr($timeString, 2, 2);
        $dateString = $dateString . ' ' . $timeString;

        // Create UTC date object
        $date = new \DateTime(date('Y-m-d H:i', strtotime($dateString)));
        $timeZone = new \DateTimeZone('Europe/Stockholm');
        $date->setTimezone($timeZone);

        return $date->format('Y-m-d H:i:s');
    }
}
