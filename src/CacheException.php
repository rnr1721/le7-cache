<?php

namespace App\Cache;

use Psr\SimpleCache\CacheException as CException;
use \Exception;

class CacheException extends Exception implements CException
{
    
}
