<?php

namespace A3020\Sitemap\Validator;

use A3020\Sitemap\Exception\InvalidSitemapSchemaException;
use A3020\Sitemap\Exception\InvalidSitemapStructure;
use DOMDocument;

class Sitemap
{
    /** @var string */
    protected $schema = 'http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd';

    /** @var string */
    private $xml;

    /**
     * @param string $xml
     */
    public function __construct(string $xml)
    {
        $this->xml = $xml;
    }

    /**
     * @return bool
     * @throws InvalidSitemapStructure
     * @throws InvalidSitemapSchemaException
     */
    public function validate()
    {
        libxml_use_internal_errors(false);

        $xmlDom = new DomDocument('1.0', 'utf-8');
        $xmlDom->validateOnParse = true;

        if (!$xmlDom->loadXML($this->xml)) {
            throw InvalidSitemapStructure::invalidXml();
        }

        $schema = $this->schema;
        if ($schema !== null && !$xmlDom->schemaValidate($schema)) {
            throw InvalidSitemapSchemaException::schemaInvalid();
        }

        return true;
    }

    /**
     * @param $schema string|null
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
    }
}
