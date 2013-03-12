<?php

namespace mikemeier\CodebaseApi\Request;

use mikemeier\CodebaseApi\Exception\SchemaNotFoundException;

class Schema
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var string
     */
    protected $content;

    /**
     * @param string $file
     * @throws SchemaNotFoundException
     */
    public function __construct($file)
    {
        if(!file_exists($file) || !is_readable($file)){
            throw new SchemaNotFoundException("Schema $file not found");
        }
        $this->file = $file;
    }

    /**
     * @param array $placeholders
     * @return string
     */
    public function render(array $placeholders = array())
    {
        return str_replace(
            $this->getNormalizePlaceholders(array_keys($placeholders)),
            array_values($placeholders),
            $this->getContent()
        );
    }

    /**
     * @param array $placeholders
     * @return array
     */
    protected function getNormalizePlaceholders(array $placeholders)
    {
        $tmpPlaceholders = $placeholders;
        array_walk($tmpPlaceholders, function(&$value){
            $value = '{{'. mb_strtoupper(str_replace(" ", "_", $value)) .'}}';
        });
        return $tmpPlaceholders;
    }

    /**
     * @return string
     */
    protected function getContent()
    {
        return $this->content = $this->content ?: file_get_contents($this->file);
    }
}