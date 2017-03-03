<?php

namespace Tc\FrontMatter\Adapter;

/**
 * AdapterInterface
 *
 * @author Carl Craig <carlcraig.threeceestudios@gmail.com>
 */
interface AdapterInterface
{
    /**
     * @param $frontMatterString
     * @param array $arguments
     * @return array
     */
    public function parse($frontMatterString, $arguments = []);

    /**
     * @param $frontMatterData
     * @param array $arguments
     * @return mixed
     */
    public function dump($frontMatterData, $arguments = []);
}
