<?php

declare(strict_types=1);

namespace App\GitHub;

use App\GitHub\GitHubConcrete;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class GitHubProvider extends ServiceProvider implements DeferrableProvider
{
    public function register()
    {
        $this->app->singleton('github', function () {
            return new GitHubConcrete();
        });
    }

    public function provides(): array
    {
        return ['github'];
    }
}
