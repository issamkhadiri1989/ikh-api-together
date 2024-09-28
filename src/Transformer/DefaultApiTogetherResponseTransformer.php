<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Transformer;

use Ikh\ApiTogetherBundle\DTO\Response;
use Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor;
use Symfony\Component\PropertyInfo\PropertyInfoExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

final class DefaultApiTogetherResponseTransformer implements ResponseTransformerInterface
{
    public function transform(string $responseRawContent): mixed
    {
        $propertyInfo = new PropertyInfoExtractor(
            typeExtractors: [new PhpDocExtractor()],
        );

        $serializer = new Serializer(
            [
                new ArrayDenormalizer(),
                new GetSetMethodNormalizer(propertyTypeExtractor: $propertyInfo),
            ],
            [new JsonEncoder()]
        );

        return $serializer->deserialize($responseRawContent, Response::class, 'json');
    }
}
