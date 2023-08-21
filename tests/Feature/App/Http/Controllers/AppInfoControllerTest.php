<?php

namespace Tests\Feature\App\Http\Controllers;

use Tests\TestCase;

class AppInfoControllerTest extends TestCase
{
    protected const BASE_URL = 'api/app-info';

    /**
     * @test
     */
    public function app_info_controller()
    {
        $response = $this->getJson(static::BASE_URL);

        $response->assertOk();
        $response->assertSee(phpversion());
        $response->assertJsonStructure($this->getExpectedAppInfoJsonStructure());
    }

    private function getExpectedAppInfoJsonStructure()
    {
        return [
            'remote_ip',
            'host_ip',
            'hostname',
            'versions' => [
                '*' => [
                    'type',
                    'name',
                    'version',
                ],
            ],
        ];
    }
}
