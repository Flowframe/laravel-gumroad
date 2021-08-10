<?php

namespace Flowframe\Gumroad\Commands;

use Illuminate\Console\GeneratorCommand;

class MakeActionCommand extends GeneratorCommand
{
    protected $signature = 'gumroad:make-action {name}';

    protected $description = 'Make an action';

    protected $type = 'Action';

    protected function getStub(): string
    {
        return __DIR__.'/../../stubs/action.stub';
    }

    protected function getDefaultNamespace($rootNamespace): string
    {
        return "{$rootNamespace}\Gumroad\Actions";
    }
}
