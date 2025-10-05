<?php
/**
 * Created by PhpStorm.
 * User: Musa
 * Date: 26.03.2019
 * Time: 15:01
 */

namespace MTGofa\PerfectlyCache\Tests\Models;


use MTGofa\PerfectlyCache\Traits\PerfectlyCachable;
use Illuminate\Database\Eloquent\Model;

class PostWithCache extends Model
{
    use PerfectlyCachable;

    protected $table = "posts";
    public $timestamps = false;
}
