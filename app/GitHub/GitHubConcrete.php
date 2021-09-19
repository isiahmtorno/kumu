<?php

declare(strict_types=1);

namespace App\GitHub;

use App\Utils\HttpUtil;
use App\Utils\ResponseObject;

class GitHubConcrete
{
    public function getGitHubInformation($username): ResponseObject
    {
        return HttpUtil::getRequest(config('app.github_url') . '/' . $username);
    }
}
