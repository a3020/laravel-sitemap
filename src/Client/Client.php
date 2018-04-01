<?php

namespace A3020\Sitemap\Client;

use A3020\Sitemap\Parser\Collector;
use A3020\Sitemap\Exception\RobotsTxtForbiddenException;
use A3020\Sitemap\Exception\RobotsTxtNotFoundException;
use A3020\Sitemap\Exception\RobotsTxtRetrievalException;
use A3020\Sitemap\Parser\RobotsTxt as RobotsTxtParser;
use A3020\Sitemap\Client\RobotsTxt as RobotsTxtDownloader;

class Client
{
    /** @var \A3020\Sitemap\Parser\Collector */
    private $collector;

    /** @var RobotsTxtDownloader */
    private $robotsTxtDownloader;

    /** @var RobotsTxtParser */
    protected $robotsTxtParser;

    public function __construct(Collector $collector, RobotsTxtDownloader $robotsTxtDownloader, RobotsTxtParser $robotsTxtParser)
    {
        $this->collector = $collector;
        $this->robotsTxtDownloader = $robotsTxtDownloader;
        $this->robotsTxtParser = $robotsTxtParser;
    }

    /**
     * @param array $sitemapUrls A list of sitemap urls
     * @param string $robotsTxt Url to robots.txt file
     *
     * @throws \A3020\Sitemap\Exception\NoValidSitemapFoundException
     *
     * @return array
     */
    public function get(array $sitemapUrls, $robotsTxt = null): array
    {
        if ($robotsTxt) {
            $sitemapUrls = array_merge($sitemapUrls, $this->fromRobotsTxt($robotsTxt));
        }

        return $this->collector->get(array_unique($sitemapUrls));
    }

    /**
     * Get sitemap urls from robots.txt file
     *
     * @param string $robotsTxt
     *
     * @return array
     */
    protected function fromRobotsTxt(string $robotsTxt): array
    {
        return $this->robotsTxtParser->get($this->getRobotsTxtDownloader($robotsTxt));
    }

    /**
     * Get contents of robots.txt file
     *
     * @param string $robotsTxt
     *
     * @return string
     */
    protected function getRobotsTxtDownloader(string $robotsTxt): string
    {
        try {
            return $this->robotsTxtDownloader->get($robotsTxt);
        } catch (RobotsTxtForbiddenException $e) {
        } catch (RobotsTxtNotFoundException $e) {
        } catch (RobotsTxtRetrievalException $e) {
        }

        return '';
    }
}
