<?php

namespace Flowframe\Gumroad\Actions;

use Flowframe\Gumroad\Contracts\Actionable;
use Flowframe\Gumroad\GumroadPing;
use Github\Client;

class InviteUserToGitHubRepository implements Actionable
{
    public function __construct(GumroadPing $gumroadPing, array $data)
    {
        $github = new Client();

        $github->authenticate(
            tokenOrLogin: config('services.github.token'),
            authMethod: Client::AUTH_ACCESS_TOKEN,
        );

        $github->repo()->collaborators()->add(
            username: $data['github_repository_owner'],
            repository: $data['github_repository_name'],
            collaborator: $gumroadPing->custom_fields['GitHub Username'],
        );
    }
}
