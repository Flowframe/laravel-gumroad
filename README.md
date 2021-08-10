# Gumroad for Laravel

Perform actions on Gumroad sales like inviting customers to GitHub repositories, or creating licenses.

## Support us

[<img src="https://flowfra.me/github-ad.png" width="419px" />](https://flowfra.me/github-ad-click)

Like our work? You can support us by purchasing one of our products.

## Installation

You can install the package via composer:

```bash
composer require flowframe/laravel-gumroad
```

You can easily publish the config like so:

```bash
php artisan vendor:publish --tag=gumroad-config
```

## Usage

Once you've installed the package you'll have to publish the config and exclude the `/gumroad/webhook` path from your `App\Http\Middleware\VerifyCsrfToken` middleware.

When you've published your config you can add products, their actions, and additional data:

```php
<?php

use Flowframe\Gumroad\Actions\InviteUserToGitHubRepository;

return [

    'products' => [
        [
            'short_product_id' => 'xyz', // The ID of your Gumroad product

            'actions' => [
                // The action(s) you want to perform

                InviteUserToGitHubRepository::class,
            ],


            'data' => [
                // Additional data you can pass to your action
                
                'github_repository_owner' => 'flowframe',
                'github_repository_name' => 'laravel-gumroad',
            ],
        ]
    ]

];
```

By default we provide an `InviteUserToGitHubRepository` action, more about that later.

### Actions

You can create an action via the CLI like so: `php artisan gumroad:make-action ActionName`. You'll see that the action implements the `Actionable` interface and has a constructor with 2 parameters:

```
GumroadPing $gumroadPing, array $data
```

The `$gumroadPing` is a fully typed webhook request.

The `$data` array is the data from the product's config.

### `InviteUserToGitHubRepository` Action

We provide an `InviteUserToGitHubRepository` action out of the box. To use this, add a personal access token from GitHub to your `services.github.token` config:

```php
<?php

return [

    // ...

    'mailgun' => [...],

    'postmark' => [...],

    'ses' => [...],

    'github' => [
        'token' => 'your_access_token',
    ],

];
```

Now that's set, you'll have to pass along the `github_repository_owner` and `github_repository_name` inside the product's data array.

When you create a product on Gumroad you'll have to add a custom field named: `GitHub Username`, this field will be used to invite a user to your repository.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

-   [Lars Klopstra](https://github.com/flowframe)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
