<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Request;

class ApiTogetherRequester extends AbstractApiRequester
{
    public function getBaseUrl(): string
    {
        return 'https://fake-json-api.mock.beeceptor.com/users/1';
    }
}
