<?php

namespace Tc\FrontMatter\Adapter;

use Symfony\Component\Yaml\Dumper;
use Symfony\Component\Yaml\Parser;

/**
 * YamlAdapter
 *
 * @author Carl Craig <carlcraig.threeceestudios@gmail.com>
 */
class YamlAdapter implements AdapterInterface
{
    /**
     * @var Parser
     */
    private $yamlParser;

    /**
     * @var Dumper
     */
    private $yamlDumper;

    /**
     * YamlAdapter Constructor
     *
     * @param Parser $yamlParser
     * @param Dumper $yamlDumper
     */
    public function __construct(Parser $yamlParser = null, Dumper $yamlDumper = null)
    {
        $this->yamlParser = $yamlParser ? $yamlParser : new Parser();
        $this->yamlDumper = $yamlDumper ? $yamlDumper : new Dumper();
    }

    /**
     * @param $frontMatterString
     * @param array $arguments
     * @return array
     */
    public function parse($frontMatterString, $arguments = [])
    {
        $frontMatterString = trim($frontMatterString);
        if ($frontMatterString) {
            return call_user_func_array([$this->yamlParser, 'parse'], array_merge([$frontMatterString], $arguments));
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
        return call_user_func_array([$this->yamlDumper, 'dump'], array_merge([$frontMatterData], $arguments));
    }
}
