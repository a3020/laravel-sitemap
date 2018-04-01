# Retrieves, validates, and parses remote sitemap documents

[![Build Status](https://travis-ci.org/a3020/laravel-sitemap.svg?branch=master)](https://travis-ci.org/a3020/laravel-sitemap)

## Installation

```bash
composer require a3020/laravel-sitemap
```

## Usage

Retrieve urls from a single sitemap

```php
$client = $app->make('sitemap.client');
$urls = $client->get(['https://somedomain.com/sitemap.xml']);
```

Retrieve urls from sitemaps + sitemaps from robots.txt

```php
$client = $app->make('sitemap.client');
$urls = $client->get(['https://somedomain.com/sitemap.xml'], 'https://somedomain.com/robots.txt');
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
