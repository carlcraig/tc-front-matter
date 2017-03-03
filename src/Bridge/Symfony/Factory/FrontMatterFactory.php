<?php

namespace Tc\FrontMatter\Bridge\Symfony\Factory;

use Tc\FrontMatter\Adapter\AdapterInterface;
use Tc\FrontMatter\FrontMatter;

/**
 * FrontMatterFactory
 *
 * @author Carl Craig <carlcraig.threeceestudios@gmail.com>
 */
class FrontMatterFactory
{
    /**
     * @param AdapterInterface $adapter
     * @param string $startSeparator
     * @param string $endSeparator
     * @return FrontMatter
     */
    public static function createFrontMatter(
        AdapterInterface $adapter,
        $startSeparator = '---',
        $endSeparator = '---'
    ) {
        return new FrontMatter($adapter, $startSeparator, $endSeparator);
    }
}
