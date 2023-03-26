# PSR-16 implementation of SimplaCache for le7 framework or any PHP project

## Requirements

- PHP 8.1 or higher.
- Composer 2.0 or higher.

## What it can?

- Standard implementation of PSR-16 Simple Cache
- Out of the box can use Filesystem, memory and session adapters
- As another package (rnr1721/le7-cache-memcache) present memcache and memcached

## Installation

```shell
composer require rnr1721/le7-cache
```

## How it works?

```php

use Core\Cache\SCFactoryGeneric;

$cacheFactory = new SCFactoryGeneric();

$cache = $cacheFactory->getFileCache('./cache');

$data = [
    'value1' => 'The 1 value',
    'value2' => 'The 2 value'
    ];

// Put data in cache
// Set cache key, value and time-to-live
$cache->set('mykey', $data, 5000);

// Get value from cache
$result = $cache->get('mykey');

print_r($result);

```

## implemented methods

```php

use Psr\SimpleCache\CacheInterface;

    public function get(string $key, mixed $default = null): mixed;

    public function set(string $key, mixed $value, null|int|DateInterval $ttl = null): bool;

    public function delete(string $key): bool;

    public function clear(): bool;

    public function getMultiple(iterable $keys, mixed $default = null): iterable;

    public function setMultiple(iterable $values, null|int|\DateInterval $ttl = null): bool;

    public function deleteMultiple(iterable $keys): bool;

    public function has(string $key): bool;

```

## factory methods

```php

use Core\Interfaces\SCFactory;

    /**
     * Get filesysyem cache
     * @param string $folder Folder for caache
     * @return CacheInterface
     */
    public function getFileCache(string $folder): CacheInterface;

    /**
     * Get memory cache
     * @return CacheInterface
     */
    Public function getMemory(): CacheInterface;

    /**
     * Get Session cache
     * @return CacheInterface
     */
    public function getSession(): CacheInterface;

```
