<?php

declare(strict_types=1);

namespace Ikh\ApiTogetherBundle;

use Ikh\ApiTogetherBundle\Client\DefaultApiTogetherClient;
use Ikh\ApiTogetherBundle\DependencyInjection\Compiler\SetupCustomApiTogetherClientPass;
use Ikh\ApiTogetherBundle\Transformer\DefaultApiTogetherResponseTransformer;
use Ikh\ApiTogetherBundle\Transformer\ResponseTransformerInterface;
use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

class IkhApiTogetherBundle extends AbstractBundle
{
    /**
     * Load service definitions from file.
     */
    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.yaml');

        $container->services()
            ->get(DefaultApiTogetherClient::class)
            ->arg('$model', $config['model'])
            ->arg('$apiKey', $config['api_key']);

        $container->services()
            ->alias(
                'ikh.api_together.default_client',
                DefaultApiTogetherClient::class
            );

        $container->services()->alias(
            referencedId: DefaultApiTogetherResponseTransformer::class,
            id: ResponseTransformerInterface::class,
        );

        $container->services()->get(DefaultApiTogetherResponseTransformer::class);

        if (null !== $config['service_id']) {
            // @TODO allow users to use their custom ApiTogether Client services
            $builder->setParameter('ikh.api_together.client.custom_client', $config['service_id']);
            //            $container->parameters()
            //                ->set('custom_service_id', $container['service_id']);
        }

        dump(__METHOD__);
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition->rootNode()
            ->children()
                ->scalarNode('model')
                    ->isRequired()
                ->end()
                 ->scalarNode('api_key')
                    ->isRequired()
                ->end()
                ->scalarNode('service_id')
                    ->defaultValue('ikh.api_together.default_client')
                ->end()
            ->end();
    }

    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $container
            ->registerForAutoconfiguration(ResponseTransformerInterface::class)
            ->addTag('ikh.api_together.transformer');

        $container->addCompilerPass(new SetupCustomApiTogetherClientPass());
    }
}
