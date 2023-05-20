<?php

declare(strict_types=1);

namespace Core\Cache;

use Core\Cache\Adapters\CacheMemoryAdapter;
use Core\Cache\Adapters\CacheSessionAdapter;
use Core\Cache\Adapters\CacheFileAdapter;
use Core\Interfaces\SCFactoryInterface;
use Psr\SimpleCache\CacheInterface;

class SCFactoryGeneric implements SCFactoryInterface
{

    public function getFileCache(string $folder): CacheInterface
    {
        $adapter = new CacheFileAdapter($folder);
        return new SimpleCache($adapter);
    }

    Public function getMemory(): CacheInterface
    {
        $adapter = new CacheMemoryAdapter();
        return new SimpleCache($adapter);
    }

    public function getSession(): CacheInterface
    {
        $adapter = new CacheSessionAdapter();
        return new SimpleCache($adapter);
    }

}
