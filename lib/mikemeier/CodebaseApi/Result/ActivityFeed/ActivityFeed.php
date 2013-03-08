<?php

namespace mikemeier\CodebaseApi\Result\ActivityFeed;

use mikemeier\CodebaseApi\Result\AbstractXmlResult;

use DateTime;

class ActivityFeed extends AbstractXmlResult
{
    /**
     * @var Event[]
     */
    protected $events = array();

    protected function process()
    {
        $data = $this->getData();
        foreach($data->event as $event) {
            $this->events[] = new Event(
                (string)$event->title,
                (int)$event->id,
                new DateTime((string)$event->timestamp),
                (string)$event->type,
                (string)$event->htmlTitle,
                (string)$event->htmlText,
                (int)$event->userId,
                (string)$event->actorEmail,
                (string)$event->actorName,
                (int)$event->projectId,
                $event->deleted === "false",
                (string)$event->avatarUrl
            );
        }
    }

    /**
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