<?php

namespace App\Http\Services\Cache;

use Illuminate\Support\Facades\Cache;

class RedisCacheService implements \App\Contracts\CacheServiceInterface
{
    public function remember(string $key, \Closure $callback, int $ttl = 60): mixed
    {
         return Cache::remember($key, $ttl, $callback);
    }

    public function forget(string $key): bool
    {
        // Implementation for forgetting a cached value
        return Cache::forget($key);
    }

    public function put(string $key, mixed $value, int $ttl = 60): bool
    {
        // Implementation for putting a value in cache
        return Cache::put($key, $value, $ttl);
    }

    public function get(string $key): mixed
    {
        // Implementation for getting a cached value
        return Cache::get($key);
    }

}
