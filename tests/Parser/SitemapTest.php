<?php

namespace A3020\Sitemap\Test\Parser;

use A3020\Sitemap\Parser\Sitemap;
use PHPUnit\Framework\TestCase;

class SitemapTest extends TestCase
{
    /** @var Sitemap */
    protected $parser;

    const URLS = [
        'https://foo.com/123',
        'https://foo.de/bar',
        'http://bar.nl/foo',
    ];

    public function setUp()
    {
        $this->parser = new Sitemap;
    }

    public function test_filter_urls_regex_include_all()
    {
        $filtered = $this->parser->filterUrlsByRegexes(self::URLS, ['.*']);
        $this->assertEquals($filtered, self::URLS);
    }

    public function test_filter_urls_regex_exclude_all()
    {
        $filtered = $this->parser->filterUrlsByRegexes(self::URLS, [], ['.*']);
        $this->assertEquals($filtered, []);
    }

    public function test_filter_urls_regex_include_de()
    {
        $filtered = $this->parser->filterUrlsByRegexes(self::URLS, ['\.de']);
        $this->assertEquals($filtered, ['https://foo.de/bar']);
    }
}
