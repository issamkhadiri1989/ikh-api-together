<?php

declare(strict_types=1);

namespace Ikh\ApiTogether;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

class ApiTogetherBundle extends AbstractBundle
{
    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->arrayNode()
                    ->scalarNode('model')->end()
                ->end()
            ->end();
    }
}