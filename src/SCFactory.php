<?php

declare(strict_types=1);

namespace App\Cache;

use Psr\SimpleCache\CacheInterface;
use App\Cache\Adapters\CacheMemoryAdapter;
use App\Cache\Adapters\CacheSessionAdapter;
use App\Cache\Adapters\CacheFileAdapter;

class SCFactory
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
