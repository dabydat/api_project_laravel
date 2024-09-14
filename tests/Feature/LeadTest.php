<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

class LeadTest extends TestCase
{
    public function test_create_lead()
    {
        $user = User::factory()->create(['role' => 'manager']);
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/lead', [
                'name' => 'Test Lead',
                'source' => 'Fotocasa',
                'owner' => $user->id,
                'created_by' => $user->id,
            ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['meta', 'data' => ['id', 'name', 'source', 'owner', 'created_by']]);
    }
}
