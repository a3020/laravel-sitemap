<?php

namespace A3020\Sitemap\Exception;

use Exception;

class InvalidSitemapSchemaException extends Exception
{
    /**
     * @return static
     */
    public static function schemaInvalid()
    {
        return new static(
            'Invalid sitemap schema'
        );
    }
}
