<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Client;

use Ikh\ApiTogetherBundle\DTO\Request as RequestDTO;
use Ikh\ApiTogetherBundle\Request\RequesterInterface;
use Ikh\ApiTogetherBundle\Transformer\ResponseTransformerInterface;

class DefaultApiTogetherClient implements ApiTogetherClientInterface
{
    public function __construct(
        private string $model,
        private string $apiKey,
        private RequesterInterface $requester,
        private ResponseTransformerInterface $transformer,
    ) {
    }

    public function ask(RequestDTO $request): mixed
    {
        $content = $this->requester->sendRequest($request);

        return $this->transformer->transform($content);
    }
}
