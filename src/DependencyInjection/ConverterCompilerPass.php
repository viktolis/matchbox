<?php

namespace App\DependencyInjection;

use App\Services\Collector\ConverterCollector;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class ConverterCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has(ConverterCollector::class)) {
            return;
        }

        $definition = $container->findDefinition(ConverterCollector::class);
        $taggedServices = $container->findTaggedServiceIds('app.converter');

        foreach ($taggedServices as $id => $tags) {
            $definition->addMethodCall('addConverter', [new Reference($id)]);
        }
    }
}