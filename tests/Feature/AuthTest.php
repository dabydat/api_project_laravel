<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login()
    {
        $user = User::factory()->create(['password' => bcrypt('password')]);

        $response = $this->postJson('/api/auth', ['username' => $user->username, 'password' => 'password']);

        $response->assertStatus(200)
            ->assertJsonStructure(['meta', 'data' => ['token', 'minutes_to_expire']]);
    }
}
