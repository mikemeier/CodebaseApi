<?php

namespace mikemeier\CodebaseApi\Result\Commit;

use mikemeier\CodebaseApi\Result\AbstractResult;

class CommitBag extends AbstractResult implements \Countable
{
    /**
     * @var Commit[]
     */
    protected $commits = array();

    /**
     * @param array $json
     */
    protected function process(array $json)
    {
        foreach($json as $commit){
            $commit = $commit['commit'];
            $this->commits[] = new Commit(
                $commit['ref'],
                $commit['author_email'],
                $commit['author_name'],
                new \DateTime($commit['authored_at']),
                new \DateTime($commit['committed_at']),
                $commit['committer_email'],
                $commit['committer_name'],
                $commit['message'],
                $commit['parent_ref'],
                $commit['tree_ref'],
                $commit['author_user'],
                $commit['committer_user']
            );
        }
    }

    /**
     * @return Commit[]
     */
    public function getCommits()
    {
        return $this->commits;
    }

    /**
     * @param \DateTime $date
     * @return Commit[]
     */
    public function getCommitsByDate(\DateTime $date)
    {
        $dateString = $date->format('Y-m-d');
        $commits = array();
        foreach($this->commits as $commit){
            if(
                $commit->getAuthoredAt()->format('Y-m-d') == $dateString
                ||
                $commit->getCommittedAt()->format('Y-m-d') == $dateString
            ){
                $commits[] = $commit;
            }
        }
        return $commits;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getCommits());
    }
}