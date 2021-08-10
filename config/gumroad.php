<?php

use Flowframe\Gumroad\Actions\InviteUserToGitHubRepository;

return [

    'products' => [
        [
            'short_product_id' => 'xyz',

            'actions' => [
                InviteUserToGitHubRepository::class,
            ],

            'data' => [
                'github_repository_owner' => 'flowframe',
                'github_repository_name' => 'laravel-gumroad',
            ],
        ]
    ]

];
