<?php

namespace Tc\FrontMatter\Bridge\Symfony;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Tc\FrontMatter\Bridge\Symfony\DependencyInjection\Compiler\FrontMatterCompilerPass;

class TcFrontMatterBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new FrontMatterCompilerPass());
    }
}
