<?php

namespace MTGofa\PerfectlyCache\Tests\Unit\Traits;

use MTGofa\PerfectlyCache\PerfectlyCache;
use MTGofa\PerfectlyCache\Tests\Models\Post;
use MTGofa\PerfectlyCache\Tests\Models\PostWithCache;
use MTGofa\PerfectlyCache\Tests\Models\User;
use MTGofa\PerfectlyCache\Tests\Models\UserWithCache;
use MTGofa\PerfectlyCache\Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class PerfectlyCachableTest extends TestCase
{

    public function test_reload_cache_method_works() {
        $user = UserWithCache::with('posts')->first();
        $this->assertCount(1, Cache::get("perfectly_cache_keys", []));

        $user->reloadCache();

        $this->assertCount(0, Cache::get("perfectly_cache_keys", []));
    }

    public function test_get_is_cache_enable_method_works() {
        $user = UserWithCache::with('posts')->first();
        $this->assertTrue($user->getIsCacheEnabled());
    }

    public function test_set_is_cache_enable_method_works() {
        $user = UserWithCache::with('posts')->first();

        $this->assertTrue($user->getIsCacheEnabled());

        $user->setIsCacheEnabled(false);

        $this->assertFalse($user->getIsCacheEnabled());
    }
}
