<?php

namespace Flowframe\Gumroad\Contracts;

use Flowframe\Gumroad\GumroadPing;

interface Actionable
{
    public function __construct(
        GumroadPing $gumroadPing,
        array $data,
    );
}
