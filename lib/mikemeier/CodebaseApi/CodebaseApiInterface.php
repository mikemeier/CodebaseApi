<?php

namespace mikemeier\CodebaseApi;

interface CodebaseApiInterface
{
    const CODEBASE_URL = 'http://api3.codebasehq.com';
    const HTTP_AUTH_BASIC_HEADER = 'Authorization';

    public function getActivityFeed($projectName = null);
}