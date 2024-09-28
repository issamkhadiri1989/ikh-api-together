<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Client;

class CustomApiTogetherClient
{
    public function __construct(private readonly ApiTogetherClientInterface $strategy)
    {
    }
}
