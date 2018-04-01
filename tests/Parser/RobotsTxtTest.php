<?php

namespace A3020\Sitemap\Test\Parser;

use PHPUnit\Framework\TestCase;

class RobotsTxtTest extends TestCase
{
    /** @var \A3020\Sitemap\Parser\RobotsTxt */
    protected $parser;

    public function setUp()
    {
        $this->parser = new \A3020\Sitemap\Parser\RobotsTxt;
    }

    public function test_get_no_sitemaps_from_robots_txt()
    {
        $sitemaps = $this->parser->get('');
        $this->assertInternalType('array', $sitemaps);
        $this->assertEquals(0, count($sitemaps));
    }

    public function test_get_sitemap_from_robots_txt()
    {
        $sitemaps = $this->parser->get(file_get_contents('./tests/fixtures/robots.txt'));
        $this->assertInternalType('array', $sitemaps);
        $this->assertEquals('http://www.example.com/sitemap_index.xml', $sitemaps[0]);
    }

    public function test_get_multiple_sitemaps_from_robots_txt()
    {
        $sitemaps = $this->parser->get(file_get_contents('./tests/fixtures/robots_multiple.txt'));
        $this->assertEquals('http://www.example.com/sitemap_index.xml', $sitemaps[0]);
        $this->assertEquals('http://www.example.com/blog.xml', $sitemaps[1]);
    }

    public function test_weird_robots_txt()
    {
        $sitemaps = $this->parser->get(file_get_contents('./tests/fixtures/robots_weird.txt'));
        $this->assertEquals('http://www.example.com/sitemap_index.xml', $sitemaps[0]);
        $this->assertEquals('http://www.example.com/blog.xml', $sitemaps[1]);
        $this->assertEquals('http://www.example.com/products.xml', $sitemaps[2]);
    }
}
