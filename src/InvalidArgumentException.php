<?php

namespace App\Cache;

use Psr\SimpleCache\InvalidArgumentException as PSRCacheException;

class InvalidArgumentException extends CacheException implements PSRCacheException
{
    
}
