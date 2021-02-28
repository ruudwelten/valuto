<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public function test_sanctum_csrf_endpoint()
    {
        $response = $this->get('/sanctum/csrf-cookie');

        $response->assertStatus(204);
    }
}
