<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle\DependencyInjection\Compiler;

use Ikh\ApiTogetherBundle\Client\CustomApiTogetherClient;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class SetupCustomApiTogetherClientPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(CustomApiTogetherClient::class)) {
            return;
        }

        $serviceId = $container->getParameter('ikh.api_together.client.custom_client');

        $definition = $container->findDefinition(CustomApiTogetherClient::class);

        $definition->setArgument(0, new Reference($serviceId));
    }
}
