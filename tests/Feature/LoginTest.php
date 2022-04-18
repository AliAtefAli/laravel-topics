<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_has_access_to_dashboard()
    {
        $admin = User::factory()->admin()->create();
        $response = $this->actingAs($admin)->get('/dashboard');

        $response->assertOk();
    }

    public function test_not_have_access_to_dashboard()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/dashboard');

        $response->assertStatus(403);
    }

    public function test_return_404_url()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/fake-url');

        $response->assertNotFound();
    }

}
