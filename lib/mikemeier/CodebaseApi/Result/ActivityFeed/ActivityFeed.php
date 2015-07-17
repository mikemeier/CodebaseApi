<?php

namespace mikemeier\CodebaseApi\Result\ActivityFeed;

use mikemeier\CodebaseApi\Result\AbstractResult;

use DateTime;

class ActivityFeed extends AbstractResult implements \Countable
{
    /**
     * @var Event[]
     */
    protected $events = array();

    /**
     * @param array $json
     */
    protected function process(array $json)
    {
        foreach($json as $event) {
            $event = $event['event'];
            $this->events[] = new Event(
                $event['title'],
                (int)$event['id'],
                new DateTime($event['timestamp']),
                $event['type'],
                $event['html_title'],
                $event['html_text'],
                (int)$event['user_id'],
                $event['actor_email'],
                $event['actor_name'],
                (int)$event['project_id'],
                $event['deleted'] === "false",
                $event['avatar_url']
            );
        }
    }

    /**
     * @param string $type
     * @return Event[]
     */
    public function getEvents($type = null)
    {
        if(!$type){
            return $this->events;
        }
        $events = $this->events;
        return array_filter($events, function(Event $event)use($type){
            return $type == $event->getType();
        });
    }

    /**
     * @param DateTime $date
     * @return Event[]
     */
    public function getEventsByDate(\DateTime $date)
    {
        $dateString = $date->format('Y-m-d');
        $events = array();
        foreach($this->events as $event){
            if($event->getTimestamp()->format('Y-m-d') == $dateString){
                $events[] = $event;
            }
        }
        return $events;
    }

    /**
     * @param int $id
     * @return Event|null
     */
    public function getEventById($id)
    {
        foreach($this->getEvents() as $event){
            if($event->getId() == $id){
                return $event;
            }
        }
        return null;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getEvents());
    }
}