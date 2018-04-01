<?php

namespace A3020\Sitemap\Client;

use A3020\Sitemap\Exception\SitemapNotAccessibleException;
use A3020\Sitemap\Exception\SitemapNotFoundException;
use A3020\Sitemap\Exception\SitemapRetrievalException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Sitemap
{
    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     * @return string
     * @throws Exception
     */
    public function get($uri)
    {
        if (!$this->client instanceof Client) {
            throw new Exception('Invalid client');
        }

        try {
            $response = $this->client->get($uri);
        } catch (Exception $e) {
            if ($e instanceof ClientException) {
                $response = $e->getResponse();

                if ($response->getStatusCode() === 403) {
                    throw new SitemapNotAccessibleException();
                } elseif ($response->getStatusCode() === 404) {
                    throw new SitemapNotFoundException();
                }
            }

            throw new SitemapRetrievalException($e->getMessage());
        }

        return (string) $response->getBody();
    }

    /**
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }
}
