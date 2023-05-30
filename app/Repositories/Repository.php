<?php

namespace App\Repositories;

use App\Interfaces\Repositories\IRepository;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;

class Repository implements IRepository
{
    public function getCacheKey(string $cache, string $key) : string
    {
        return "$cache." . strtoupper($key);
    }

    public function forgetCache(array $cache)
    {
        for ($i = 0; $i < count($cache); $i++) {
            if (Cache::has($cache[$i])) {
                Cache::forget($cache[$i]);
            }
        }
        return $this;
    }

    public function getTTL(int $ttl) : Carbon
    {
        return Carbon::now()->addMinutes($ttl);
    }

    public function respond($cache)
    {
        $this->forgetCache(Arr::wrap($cache));
        return $this;
    }
}