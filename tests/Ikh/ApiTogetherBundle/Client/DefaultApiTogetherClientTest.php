<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Tests\Client;

use Ikh\ApiTogetherBundle\Client\DefaultApiTogetherClient;
use Ikh\ApiTogetherBundle\DTO;
use Ikh\ApiTogetherBundle\Request\ApiTogetherRequester;
use Ikh\ApiTogetherBundle\Transformer\DefaultApiTogetherResponseTransformer;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

class DefaultApiTogetherClientTest extends KernelTestCase
{
    /**
     * @dataProvider apiResponseProvider
     *
     * @return void
     */
    public function testAskResponseFromApi(string $content)
    {
        self::bootKernel();

        $container = static::getContainer();

        $clientMock = $this->getMockBuilder(HttpClientInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response = $this->getMockBuilder(ResponseInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $response->method('getContent')
            ->willReturn($content);

        $clientMock->method('request')
            ->willReturn($response);

        $requester = new ApiTogetherRequester(client: $clientMock);

        $transformer = $container->get(DefaultApiTogetherResponseTransformer::class);

        $defaultConnector = new DefaultApiTogetherClient(
            'meta-llama/Meta-Llama-3.1-8B-Instruct-Turbo',
            'apiKey',
            $requester,
            $transformer,
        );

        $content = $defaultConnector->ask(new DTO\Request(model: 'test', prompt: 'ipsum lorem dolore'));

        dump($content, (string) $content);

        $this->assertInstanceOf(DTO\Response::class, $content);

        $this->assertNotEmpty($content->getChoices());
    }

    public function apiResponseProvider(): array
    {
        $responseContent = \file_get_contents(__DIR__.'/ApiTogetherOK.json');

        return [
            [$responseContent],
        ];
    }
}
