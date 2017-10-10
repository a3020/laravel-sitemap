# Downloads, validates, and parsers remote sitemap documents

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

Parses a sitemap
```php
$parser = $app->make('sitemap.parser');

// Return URLs found in sitemap document
$parser->urls($contents);

// Filter to only get portfolio URLs.
$parser->filterUrlsByRegexes($contents, ['/portfolio']);
```
