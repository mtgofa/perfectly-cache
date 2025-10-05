<?php

namespace MTGofa\PerfectlyCache\Tests\Unit\Commands;

use MTGofa\PerfectlyCache\PerfectlyCache;
use MTGofa\PerfectlyCache\Tests\Models\Post;
use MTGofa\PerfectlyCache\Tests\Models\PostWithCache;
use MTGofa\PerfectlyCache\Tests\Models\User;
use MTGofa\PerfectlyCache\Tests\Models\UserWithCache;
use MTGofa\PerfectlyCache\Tests\TestCase;
use Illuminate\Support\Facades\Cache;

class ListCommandTest extends TestCase
{

    public function test_list_command_works() {

        $response = $this->artisan("perfectly-cache:list")->run();
        $this->assertEquals(0, $response);

        UserWithCache::with('cached_posts')->first();

        $response = $this->artisan("perfectly-cache:list")->run();
        $this->assertEquals(0, $response);
    }
}
