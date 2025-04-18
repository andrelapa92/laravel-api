<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    public function test_homepage_is_accessible(): void
    {
        $response = $this->get('/');

        $response->assertStatus(302); // Redireciona para /users
        $response->assertRedirect('/users');
    }
}
