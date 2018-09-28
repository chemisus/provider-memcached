<?php

namespace Chemisus\Storage;

use Chemisus\Serialization\Serializer;
use Memcached;

class MemcachedStorage implements Storage
{
    /**
     * @var Memcached
     */
    private $memcached;

    public function __construct(Memcached $memcached)
    {
        $this->memcached = $memcached;
    }

    public function get($key)
    {
        $value = $this->memcached->get($key);

        if ($value === false) {
            throw new InvalidKeyException();
        }

        return $value;
    }

    public function put($key, $value)
    {
        $this->memcached->set($key, $value);
    }

    public function remove($key)
    {
        $this->memcached->delete($key);
    }
}