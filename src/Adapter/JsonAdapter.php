<?php

namespace Tc\FrontMatter\Adapter;

use Tc\Json\JsonException;

/**
 * JsonAdapter
 *
 * @author Carl Craig <carlcraig.threeceestudios@gmail.com>
 */
class JsonAdapter implements AdapterInterface
{
    /**
     * @param $frontMatterString
     * @param array $arguments
     * @return array
     */
    public function parse($frontMatterString, $arguments = [])
    {
        $frontMatterString = trim($frontMatterString);
        if ($frontMatterString) {
            try {
                $frontMatter = call_user_func_array(['Tc\Json\Json', 'decode'], array_merge([$frontMatterString], $arguments));
            } catch (JsonException $e) {
                $frontMatter = [];
            }
            return $frontMatter;
        } else {
            return [];
        }
    }

    /**
     * @param $frontMatterData
     * @param array $arguments
     * @return mixed
     */
    public function dump($frontMatterData, $arguments = [])
    {
        return call_user_func_array(['Tc\Json\Json', 'encode'], array_merge([$frontMatterData], $arguments));
    }
}
