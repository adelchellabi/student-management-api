<?php

namespace Tests\Feature\App\Http\Controllers;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class HealthCheckControllerTest extends TestCase
{
    protected const BASE_URL = '/api/health-check';

    /**
     * @test
     */
    public function health_check_success()
    {
        $response = $this->getJson(static::BASE_URL);

        $response->assertOk();
        $response->assertJson($this->getExpectedSuccessMessages());
    }

    /**
     * @test
     */
    public function health_check_failure()
    {
        $this->mockFailingServiceChecks();

        $response = $this->get(static::BASE_URL);

        $response->assertOk();
        $response->assertJson($this->getExpectedFailureMessages());
    }

    private function getExpectedSuccessMessages()
    {
        return [
            'database' => 'Database connection established successfully.',
            'redis' => 'Redis connection established successfully.',
        ];
    }

    private function mockFailingServiceChecks()
    {
        DB::shouldReceive('connection->getPdo')->andThrow(new Exception('Database connection failed.'));
        Redis::shouldReceive('ping')->andThrow(new Exception('Redis connection failed.'));
    }

    private function getExpectedFailureMessages()
    {
        return [
            'database' => 'Database connection failed: Database connection failed.',
            'redis' => 'Redis connection failed: Redis connection failed.',
        ];
    }
}
