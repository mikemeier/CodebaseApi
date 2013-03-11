<?php

namespace mikemeier\CodebaseApi\Result\ActivityFeed;

use mikemeier\CodebaseApi\Result\AbstractResult;

use DateTime;

class ActivityFeed extends AbstractResult
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
}