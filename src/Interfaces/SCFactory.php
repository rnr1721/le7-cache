<?php

namespace Core\Interfaces;

use Psr\SimpleCache\CacheInterface;

interface SCFactory
{

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
}
