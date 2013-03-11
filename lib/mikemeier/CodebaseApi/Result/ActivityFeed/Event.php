<?php

namespace mikemeier\CodebaseApi\Result\ActivityFeed;

use DateTime;

class Event
{
    /**
     * when a user published a comment to a commit or discussion topic (dark blue)
     */
    const EVENT_TYPE_COMMENT = 'comment';

    /**
     * when a commit is added to a repository without a push (via. sync, mercurial or manual scans) (light blue)
     */
    const EVENT_TYPE_COMMIT = 'commit';

    /**
     * when you deploy your repositories (brown/orange)
     */
    const EVENT_TYPE_DEPLOYMENT = 'deployment';

    /**
     * when a branch or tag is added, edited or deleted (light blue)
     */
    const EVENT_TYPE_NAMED_TREE = 'named_tree';

    /**
     *  when a project is created or deleted (yellow)
     */
    const EVENT_TYPE_PROJECT = 'project';

    /**
     * when you push to your repository (html-text includes a list of commits within the push) (light blue)
     */
    const EVENT_TYPE_PUSH = 'push';

    /**
     * when a milestone is added or status changed (purple)
     */
    const EVENT_TYPE_TICKETING_MILESTONE = 'ticketing_milestone';

    /**
     * when a new note is added to a ticket. Includes attachments and commit ticket updates (green)
     */
    const EVENT_TYPE_TICKETING_NOTE = 'ticketing_note';

    /**
     *  when a ticket is created (green)
     */
    const EVENT_TYPE_TICKETING_TICKET = 'ticketing_ticket';

    /**
     *  when a user adds or updated their personal status (dark blue)
     */
    const EVENT_TYPE_USER_STATUS = 'user_status';

    /**
     *  when a wiki page is created or updated (excluding all minor edits) (grey)
     */
    const EVENT_TYPE_WIKI_PAGE = 'wiki_page';

    /**
     * @var string
     */
    protected $title;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var DateTime
     */
    protected $timestamp;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $htmlTitle;

    /**
     * @var string
     */
    protected $htmlText;

    /**
     * @var int
     */
    protected $userId;

    /**
     * @var string
     */
    protected $actorEmail;

    /**
     * @var string
     */
    protected $actorName;

    /**
     * @var int
     */
    protected $projectId;

    /**
     * @var string
     */
    protected $deleted;

    /**
     * @var string
     */
    protected $avatarUrl;

    /**
     * @param string $title
     * @param int $id
     * @param DateTime $timestamp
     * @param string $type
     * @param string $htmlTitle
     * @param string $htmlText
     * @param int $userId
     * @param string $actorEmail
     * @param string $actorName
     * @param int $projectId
     * @param string $deleted
     * @param string $avatarUrl
     */
    public function __construct($title, $id, DateTime $timestamp, $type, $htmlTitle, $htmlText, $userId, $actorEmail, $actorName, $projectId, $deleted, $avatarUrl)
    {
        $this->title = $title;
        $this->id = $id;
        $this->timestamp = $timestamp;
        $this->type = $type;
        $this->htmlTitle = $htmlTitle;
        $this->htmlText = $htmlText;
        $this->userId = $userId;
        $this->actorEmail = $actorEmail;
        $this->actorName = $actorName;
        $this->projectId = $projectId;
        $this->deleted = $deleted;
        $this->avatarUrl = $avatarUrl;
    }

    /**
     * @return string
     */
    public function getActorEmail()
    {
        return $this->actorEmail;
    }

    /**
     * @return string
     */
    public function getActorName()
    {
        return $this->actorName;
    }

    /**
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarUrl;
    }

    /**
     * @return string
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * @return string
     */
    public function getHtmlText()
    {
        return $this->htmlText;
    }

    /**
     * @return string
     */
    public function getHtmlTitle()
    {
        return $this->htmlTitle;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        return $this->projectId;
    }

    /**
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }
}