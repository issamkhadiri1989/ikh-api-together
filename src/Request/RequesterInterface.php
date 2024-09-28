<?php

namespace Ikh\ApiTogetherBundle\Request;

use Ikh\ApiTogetherBundle\DTO\Request as RequestDTO;

interface RequesterInterface
{
    public function sendRequest(RequestDTO $request): mixed;
}
