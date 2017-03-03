<?php

namespace Tc\FrontMatter;

use Tc\FrontMatter\Adapter\AdapterInterface;
use Tc\FrontMatter\Adapter\YamlAdapter;
use Tc\FrontMatter\Model\FrontMatterDocument;

/**
 * FrontMatter
 *
 * @author Carl Craig <carlcraig.threeceestudios@gmail.com>
 */
class FrontMatter
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    /**
     * @var string
     */
    protected $startSeparator = '---';

    /**
     * @var string
     */
    protected $endSeparator = '---';

    /**
     * FrontMatter Constructor
     *
     * @param AdapterInterface $adapter
     * @param string $startSeparator
     * @param string $endSeparator
     */
    public function __construct(AdapterInterface $adapter = null, $startSeparator = '---', $endSeparator = '---')
    {
        $this->adapter = $adapter ? $adapter : new YamlAdapter();
        $this->startSeparator = $startSeparator;
        $this->endSeparator = $endSeparator;
    }

    /**
     * @param $content
     * @param array $arguments
     * @return FrontMatterDocument
     */
    public function parse($content, $arguments = [])
    {
        if (!is_string($content)) {
            throw new \InvalidArgumentException('Content must be a string');
        }

        $startSeparator = preg_quote($this->startSeparator, '~');
        $endSeparator = preg_quote($this->endSeparator, '~');
        $regex = '~^('.$startSeparator."){1}[\r\n|\n]*(.*?)[\r\n|\n]+(".$endSeparator."){1}[\r\n|\n]*(.*)$~s";

        $frontMatter = [];

        if (preg_match($regex, $content, $matches) === 1) {
            $frontMatter = $this->adapter->parse($matches[2], $arguments);
            $content = ltrim($matches[4]);
        }

        return new FrontMatterDocument($frontMatter, $content);
    }

    /**
     * @param $data
     * @param $content
     * @param array $arguments
     * @return string
     */
    public function dump($data, $content, $arguments = [])
    {
        $dataString = $this->adapter->dump($data, $arguments);
        return sprintf(
            "%s\n%s\n%s\n%s",
            $this->startSeparator,
            $dataString,
            $this->endSeparator,
            $content
        );
    }


    /**
     * @param FrontMatterDocument $document
     * @param array $arguments
     * @return string
     */
    public function dumpDocument(FrontMatterDocument $document, $arguments = [])
    {
        return $this->dump($document->getData(), $document->getContent(), $arguments);
    }
}
