<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class HealthCheckController extends Controller
{
    protected array $services = [];

    public function check()
    {
        $this->initCHeck();

        return response()->json($this->services);
    }

    private function initCheck()
    {
        $this->services['database'] = $this->checkDatabaseConnection();
        $this->services['redis'] = $this->checkRedisConnection();
    }

    private function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();

            return 'Database connection established successfully.';
        } catch (Exception $e) {
            return 'Database connection failed: ' . $e->getMessage();
        }
    }

    private function checkRedisConnection()
    {
        try {
            Redis::ping();

            return 'Redis connection established successfully.';
        } catch (Exception $e) {
            return 'Redis connection failed: ' . $e->getMessage();
        }
    }
}
