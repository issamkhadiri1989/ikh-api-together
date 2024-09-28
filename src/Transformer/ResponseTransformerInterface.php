<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Transformer;

interface ResponseTransformerInterface
{
    /**
     * @param string $apiResponse the response received from ApiTogether
     */
    public function transform(string $apiResponse): mixed;
}
