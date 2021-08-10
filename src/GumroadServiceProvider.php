<?php

namespace Flowframe\Gumroad;

use Flowframe\Gumroad\Commands\MakeActionCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class GumroadServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-gumroad')
            ->hasConfigFile()
            ->hasRoute('web')
            ->hasCommands([
                MakeActionCommand::class,
            ]);
    }
}
