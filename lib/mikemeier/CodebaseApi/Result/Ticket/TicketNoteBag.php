<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

use mikemeier\CodebaseApi\Result\AbstractResult;

class TicketNoteBag extends AbstractResult
{
    /**
     * @var TicketNote[]
     */
    protected $ticketNotes = array();

    /**
     * @param array $json
     */
    protected function process(array $json)
    {
        foreach($json as $ticketNote){
            $ticketNote = $ticketNote['ticket_note'];

            $attachments = array();
            foreach($ticketNote['attachments'] as $attachment){
                $attachments[] = new TicketAttachment(
                    (int)$attachment['id'],
                    $attachment['file-name'],
                    $attachment['content-type'],
                    (int)$attachment['file-size'],
                    $attachment['url']
                );
            }

            $updates = array();
            foreach(json_decode($ticketNote['updates'], true) as $field => $values){
                $updates[] = new TicketUpdate($field, $values[0], $values[1]);
            }

            $this->ticketNotes[] = new TicketNote(
                $ticketNote['id'],
                $ticketNote['user_id'],
                $ticketNote['content'],
                $updates,
                $attachments,
                new \DateTime($ticketNote['created_at']),
                new \DateTime($ticketNote['updated_at'])
            );
        }
    }

    /**
     * @return TicketNote[]
     */
    public function getTicketNotes()
    {
        return $this->ticketNotes;
    }
}