<?php

declare(strict_types=1);

namespace Core\Cache;

use \DateInterval;

interface SCAdapterInterface
{

    public function clear(): bool;

    public function delete(string $key): bool;

    public function deleteMultiple(iterable $keys): bool;

    public function get(string $key, mixed $default = null): mixed;

    public function getMultiple(iterable $keys, mixed $default = null): iterable;

    public function has(string $key): bool;

    public function set(string $key, mixed $value, null|int|DateInterval $ttl = null): bool;

    public function setMultiple(iterable $values, null|int|DateInterval $ttl = null): bool;
}
