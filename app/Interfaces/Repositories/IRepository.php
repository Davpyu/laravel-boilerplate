<?php

namespace App\Interfaces\Repositories;

interface IRepository
{
    public function getCacheKey(string $cache, string $key);
    public function getTTL(int $ttl);
    public function forgetCache(array $cache);
    public function respond($cache);
}