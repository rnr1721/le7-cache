<?php

use Psr\SimpleCache\CacheInterface;
use Core\Interfaces\SCFactoryInterface;
use Core\Cache\SCFactoryGeneric;

require_once 'vendor/autoload.php';
require_once __DIR__ . '/../vendor/autoload.php';

class CacheTest extends PHPUnit\Framework\TestCase
{

    private SCFactoryInterface $factory;

    protected function setUp(): void
    {
        $this->factory = new SCFactoryGeneric();
    }

    public function testFile()
    {

        $ds = DIRECTORY_SEPARATOR;

        $cacheDir = getcwd() . $ds . 'tests' . $ds . 'cache';

        if (!file_exists($cacheDir)) {
            mkdir($cacheDir, 0777, true);
        }

        $cache = $this->factory->getFileCache($cacheDir);

        $this->process($cache);

        //Clear cache folder
        $filesToDelete = glob($cacheDir . $ds . '*.cache');

        foreach ($filesToDelete as $file) {
            if (is_file($file)) {
                unlink($file);
            }
        }

        rmdir($cacheDir);
    }

    public function testMemory()
    {
        $cache = $this->factory->getMemory();
        $this->process($cache);
    }

    public function process(CacheInterface $cache)
    {
        $cache->clear();

        // Try to get empty
        $testEmpty = $cache->get('not_exists');
        $this->assertNull($testEmpty);

        $testEmptyDefault = $cache->get('not_exists', '');
        $this->assertEquals($testEmptyDefault, '');

        // Set to cache
        $cache->set('test_item', '12345');
        $this->assertEquals($cache->get('test_item'), '12345');
        $cache->delete('test_item');
        $this->assertNull($cache->get('test_item'));

        $cache->set('test_item', '1234567', 2);
        $this->assertEquals($cache->get('test_item'), '1234567');
        sleep(2);
        $this->assertNull($cache->get('test_item'));

        //setMultiple
        $data = [
            'one' => 1,
            'two' => 2,
            'three' => 3,
            'four' => '1111'
        ];

        $cache->setMultiple($data);

        $this->assertEquals($cache->get('one'), 1);
        $this->assertEquals($cache->get('two'), 2);
        $this->assertEquals($cache->get('three'), 3);
        $this->assertEquals($cache->get('four'), '1111');

        $titles = ['one', 'two', 'three', 'four'];

        $multiple = $cache->getMultiple($titles);

        $this->assertEquals($multiple['one'], 1);
        $this->assertEquals($multiple['two'], 2);

        $cache->deleteMultiple($titles);

        $this->assertNull($cache->get('one'));
        $this->assertNull($cache->get('two'));
        $this->assertNull($cache->get('three'));
        $this->assertNull($cache->get('four'));

        $cache->setMultiple($data);

        $deleteSomething = ['one', 'two'];
        $cache->deleteMultiple($deleteSomething);

        $this->assertNull($cache->get('one'));
        $this->assertNull($cache->get('two'));
        $this->assertEquals($cache->get('three'), 3);
        $this->assertEquals($cache->get('four'), '1111');

        // Clear all cache items
        $cache->clear();
        $this->assertNull($cache->get('one'));
        $this->assertNull($cache->get('two'));
        $this->assertNull($cache->get('three'));
        $this->assertNull($cache->get('four'));
    }

}
