<?php

namespace Tc\FrontMatter\Model;

/**
 * FrontMatterDocument
 *
 * @author Carl Craig <carlcraig.threeceestudios@gmail.com>
 */
class FrontMatterDocument
{
    /**
     * @var mixed
     */
    private $data;

    /**
     * @var string
     */
    private $content;

    /**
     * FrontMatterDocument Constructor
     *
     * @param mixed $data
     * @param array $content
     */
    public function __construct($data, $content)
    {
        $this->data = $data;
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     * @return FrontMatterDocument
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return FrontMatterDocument
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->content;
    }
}
