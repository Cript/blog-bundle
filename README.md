## Usage

Default descending ordering by date
```php
$query = new GetAllPosts();
$posts = $queryBus->ask($query);
```

Ascending ordering by date
```php
$query = new GetAllPosts('date_asc');
$posts = $queryBus->ask($query);
```

## Tests

`docker-compose run app ./vendor/bin/behat`
