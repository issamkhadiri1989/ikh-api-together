<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\Tests\Client;

use Ikh\ApiTogetherBundle\Client\CustomApiTogetherClient;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CustomApiTogetherClientTest extends KernelTestCase
{
    public function testSomething(): void
    {
        self::bootKernel();

        $container = static::getContainer();

        $customServiceSetter = $container->get(CustomApiTogetherClient::class);

        dd($customServiceSetter);
    }
}
