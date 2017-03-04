<?php

namespace Tc\FrontMatter\Bridge\Symfony\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;

class FrontMatterCompilerPass implements CompilerPassInterface
{

    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        $services = $container->findTaggedServiceIds('tc.front_matter.adapter');

        foreach ($services as $service => $config) {
            if (!isset($config[0]['adapter_name'])) {
                throw new \Exception('You must specify a front matter adapter_name');
            }
            $defintion = new Definition('Tc\FrontMatter\FrontMatter');
            $defintion->setFactory([new Reference('tc.front_matter.factory'), 'createFrontMatter']);
            $defintion->addArgument(new Reference($service));
            $container->setDefinition(sprintf('tc.front_matter.%s', $config[0]['adapter_name']), $defintion);
        }
    }
}
