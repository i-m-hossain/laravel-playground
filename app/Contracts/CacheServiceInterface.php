<?php

namespace App\Contracts;

interface CacheServiceInterface
{
    public function remember(string $key, \Closure $callback, int $ttl = 60): mixed;
    public function forget(string $key): bool;
    public function put(string $key, mixed $value, int $ttl = 60): bool;
    public function get(string $key): mixed;
}
