<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Factory;

class CustomApiTogetherClientFactory
{
    public static function createCustomApiTogetherClient(string $model): mixed
    {
        return new class($model) {
            public function __construct(private readonly string $model)
            {
            }
        };
    }
}
