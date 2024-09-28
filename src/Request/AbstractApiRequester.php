<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Request;

use Ikh\ApiTogetherBundle\DTO\Request as RequestDTO;
use Symfony\Contracts\HttpClient\HttpClientInterface;

abstract class AbstractApiRequester implements RequesterInterface
{
    public function __construct(protected HttpClientInterface $client)
    {
    }

    abstract public function getBaseUrl(): string;

    public function sendRequest(RequestDTO $request): mixed
    {
        $content = $this->client->request(method: 'GET', url: $this->getBaseUrl(), options: []);

        return $content->getContent();
    }
}
