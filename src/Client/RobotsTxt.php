<?php

namespace A3020\Sitemap\Client;

use A3020\Sitemap\Exception\RobotsTxtForbiddenException;
use A3020\Sitemap\Exception\RobotsTxtNotFoundException;
use A3020\Sitemap\Exception\RobotsTxtRetrievalException;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class RobotsTxt
{
    /** @var Client */
    private $client;

    /**
     * @param Client $client
     */
    public function __construct(Client $client = null)
    {
        $this->client = $client;
    }

    /**
     * @param string $uri
     *
     * @throws RobotsTxtForbiddenException
     * @throws RobotsTxtNotFoundException
     * @throws RobotsTxtRetrievalException
     *
     * @return string
     */
    public function get($uri)
    {
        try {
            $response = $this->client->get($uri);
        } catch (Exception $e) {
            if ($e instanceof ClientException) {
                $response = $e->getResponse();

                if ($response->getStatusCode() === 403) {
                    throw new RobotsTxtForbiddenException();
                } elseif ($response->getStatusCode() === 404) {
                    throw new RobotsTxtNotFoundException();
                }
            }

            throw new RobotsTxtRetrievalException($e->getMessage());
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
