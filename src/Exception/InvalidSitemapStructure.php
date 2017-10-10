<?php

namespace A3020\Sitemap\Exception;

use Exception;

class InvalidSitemapStructure extends Exception
{
    /**
     * @return static
     */
    public static function invalidXml()
    {
        return new static(
            'Invalid sitemap structure.'
        );
    }
}
