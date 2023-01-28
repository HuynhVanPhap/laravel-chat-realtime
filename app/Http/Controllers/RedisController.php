<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Queue;

class RedisController extends Controller
{
    public function __construct()
    {

    }

    public function getEvents() {
        dd(Redis::lrange('queues:default', 0, -1));
    }
}
