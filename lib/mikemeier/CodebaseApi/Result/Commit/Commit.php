<?php

namespace mikemeier\CodebaseApi\Result\Commit;

class Commit
{
    /**
     * @var string
     */
    protected $ref;

    /**
     * @var string
     */
    protected $authorEmail;

    /**
     * @var string
     */
    protected $authorName;

    /**
     * @var \DateTime
     */
    protected $authoredAt;

    /**
     * @var \DateTime
     */
    protected $committedAt;

    /**
     * @var string
     */
    protected $committerEmail;

    /**
     * @var string
     */
    protected $commiterName;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $parentRef;

    /**
     * @var string
     */
    protected $treeRef;

    /**
     * @var string
     */
    protected $authorUser;

    /**
     * @var string
     */
    protected $committerUser;

    /**
     * @param string $ref
     * @param string $authorEmail
     * @param string $authorName
     * @param \DateTime $authoredAt
     * @param \DateTime $committedAt
     * @param string $committerEmail
     * @param string $commiterName
     * @param string $message
     * @param string $parentRef
     * @param string $treeRef
     * @param string $authorUser
     * @param string $committerUser
     */
    public function __construct(
        $ref,
        $authorEmail,
        $authorName,
        \DateTime $authoredAt,
        \DateTime $committedAt,
        $committerEmail,
        $commiterName,
        $message,
        $parentRef,
        $treeRef,
        $authorUser,
        $committerUser
    ){
        $this->ref = $ref;
        $this->authorEmail = $authorEmail;
        $this->authorName = $authorName;
        $this->authoredAt = $authoredAt;
        $this->committedAt = $committedAt;
        $this->committerEmail = $committerEmail;
        $this->commiterName = $commiterName;
        $this->message = $message;
        $this->parentRef = $parentRef;
        $this->treeRef = $treeRef;
        $this->authorUser = $authorUser;
        $this->committerUser = $committerUser;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getMessage();
    }

    /**
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * @return string
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * @return string
     */
    public function getAuthorUser()
    {
        return $this->authorUser;
    }

    /**
     * @return \DateTime
     */
    public function getAuthoredAt()
    {
        return $this->authoredAt;
    }

    /**
     * @return string
     */
    public function getCommiterName()
    {
        return $this->commiterName;
    }

    /**
     * @return \DateTime
     */
    public function getCommittedAt()
    {
        return $this->committedAt;
    }

    /**
     * @return string
     */
    public function getCommitterEmail()
    {
        return $this->committerEmail;
    }

    /**
     * @return string
     */
    public function getCommitterUser()
    {
        return $this->committerUser;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return string
     */
    public function getParentRef()
    {
        return $this->parentRef;
    }

    /**
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * @return string
     */
    public function getTreeRef()
    {
        return $this->treeRef;
    }
}