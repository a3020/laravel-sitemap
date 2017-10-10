# Retrieves, validates, and parses remote sitemap documents

[![Build Status](https://travis-ci.org/a3020/laravel-sitemap.svg?branch=master)](https://travis-ci.org/a3020/laravel-sitemap)


Retrieve a sitemap
```php
$client = $app->make('sitemap.client');
$contents = $client->get('https://somedomain.com/sitemap.xml');
``` 

Validate a sitemap
```php
$validator = $app->make('sitemap.validator');
$validator->validate($contents);
```

Parse a sitemap
```php
$parser = $app->make('sitemap.parser');

// Return URLs found in sitemap document
$parser->urls($contents);

// Filter to only get portfolio URLs.
$parser->filterUrlsByRegexes($contents, ['/portfolio']);
```
