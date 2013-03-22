<?php

namespace mikemeier\CodebaseApi\Result\Ticket;

class TicketWatcher
{
    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $user;

    /**
     * @param int $userId
     * @param string $user
     */
    public function __construct($userId, $user){
        $this->userId = $userId;
        $this->user = $user;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }
}