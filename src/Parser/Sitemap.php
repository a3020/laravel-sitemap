<?php

namespace A3020\Sitemap\Parser;

class Sitemap
{
    /**
     * Returns an array with URLs, found in the sitemap.xml.
     *
     * @param string $contents
     * @return array
     */
    public function urls(string $contents): array
    {
        preg_match_all('|<loc>(.*?)<\/loc>|', $contents, $matches);

        return $matches[1] ?? [];
    }

    /**
     * @param array $urls
     * @param array $regexInclude
     * @param array $regexExclude
     *
     * @return array
     */
    public function filterUrlsByRegexes(array $urls, array $regexInclude = [], array $regexExclude = []): array
    {
        $matches = [];
        foreach ($regexInclude as $regex) {
            $matches = array_merge($matches, preg_grep('|' . $regex . '|', $urls));
        }

        foreach ($regexExclude as $regex) {
            $matches = preg_grep('|' . $regex . '|', $matches, PREG_GREP_INVERT);
        }

        return $matches;
    }
}
