<?php

namespace A3020\Sitemap\Parser;

use A3020\Sitemap\Exception\NoValidSitemapFoundException;
use Exception;

class Collector
{
    /** @var Sitemap */
    protected $sitemapClient;

    /** @var Parser\Sitemap */
    private $sitemapParser;

    public function __construct(\A3020\Sitemap\Client\Sitemap $sitemapClient, Sitemap $sitemapParser)
    {
        $this->sitemapClient = $sitemapClient;
        $this->sitemapParser = $sitemapParser;
    }

    /**
     * Return list of urls based on various sitemap.xml files
     *
     * @param array $locations
     * @throws NoValidSitemapFoundException
     *
     * @return array
     */
    public function get(array $locations): array
    {
        $urls = [];
        $sitemapsFound = 0;

        foreach ($locations as $location) {
            try {
                $urls += $this->fromSitemap($location);
                $sitemapsFound++;
            } catch (Exception $e) {}
        }

        if ($sitemapsFound === 0) {
            throw new NoValidSitemapFoundException();
        }

        return $this->clean($urls);
    }

    /**
     * Get urls from a sitemap file
     *
     * @param string $location
     * @throws Exception
     *
     * @return array
     */
    protected function fromSitemap(string $location): array
    {
        return $this->sitemapParser->urls($this->sitemapClient->get($location));
    }

    protected function clean(array $urls): array
    {
        // Remove spaces
        $urls = array_map('trim', $urls);

        // Prevent duplicates or empty urls
        $urls = array_filter(array_unique($urls));

        // Reindex
        return array_values($urls);
    }
}
