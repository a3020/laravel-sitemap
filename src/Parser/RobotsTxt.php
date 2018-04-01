<?php

namespace A3020\Sitemap\Parser;

class RobotsTxt
{
    /**
     * Returns an array with sitemap URLs
     *
     * @param string $contents
     *
     * @return array
     */
    public function get(string $contents): array
    {
        preg_match_all('|Sitemap:\s*(.*\.xml)|', $contents, $matches);

        return $matches[1] ?? [];
    }
}
