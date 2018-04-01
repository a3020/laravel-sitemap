<?php

namespace A3020\Sitemap\Test\Collector;

use A3020\Sitemap\Parser\Collector;
use A3020\Sitemap\Parser\Sitemap;
use PHPUnit\Framework\TestCase;

class CollectorTest extends TestCase
{
    public function setUp()
    {
        $this->parser = new Sitemap;
    }

    public function test_clean_urls()
    {
        $urls = [
            'https://foo.bar',
            'https://foo.bar',
            'https://foo.baz ',
        ];

        $sitemapClient = $this->createMock(\A3020\Sitemap\Client\Sitemap::class);
        $sitemapClient->method('get')->willReturn('foo');
        $sitemapParser = $this->createMock(\A3020\Sitemap\Parser\Sitemap::class);
        $sitemapParser->method('urls')->willReturn($urls);

        $client = new Collector($sitemapClient, $sitemapParser);
        $this->assertEquals([
            'https://foo.bar',
            'https://foo.baz',
        ], $client->get(['faz']));
    }

    /**
     * @expectedException \A3020\Sitemap\Exception\NoValidSitemapFoundException
     */
    public function test_no_sitemap_found_exception()
    {
        $sitemapClient = new \A3020\Sitemap\Client\Sitemap();
        $sitemapParser = new \A3020\Sitemap\Parser\Sitemap();

        $client = new Collector($sitemapClient, $sitemapParser);
        $client->get([
            'foo.txt',
        ]);
    }
}
