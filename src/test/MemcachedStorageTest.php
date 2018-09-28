<?php

namespace Chemisus\Storage;

use Memcached;

class MemcachedStorageTest extends StorageTest
{
    public function factory()
    {
        $mock = $this->getMockBuilder(Memcached::class)
            ->disableOriginalConstructor()
            ->getMock();

        $entries = ['a' => 'A', 'b' => 'B', 'c' => 'C'];

        $mock->method('get')->willReturnCallback(function ($key) use (&$entries) {
            return array_key_exists($key, $entries) ? $entries[$key] : false;
        });

        $mock->method('set')->willReturnCallback(function ($key, $value) use (&$entries) {
            $entries[$key] = $value;
        });

        $mock->method('delete')->willReturnCallback(function ($key) use (&$entries) {
            unset($entries[$key]);
        });

        return new MemcachedStorage($mock);
    }
}
