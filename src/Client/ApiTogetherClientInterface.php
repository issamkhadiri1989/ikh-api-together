<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Client;

use Ikh\ApiTogetherBundle\DTO\Request as RequestDTO;

interface ApiTogetherClientInterface
{
    public function ask(RequestDTO $request): mixed;
}
