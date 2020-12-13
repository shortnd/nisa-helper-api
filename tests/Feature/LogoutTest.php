<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        User::factory()->create();
    }

    public function testLogoutReturnsUnauthenticated()
    {
        $this->postJson('/logout')->assertStatus(401);
    }

    public function testLogoutReturnsSuccess()
    {
        $this->actingAs(User::first())
            ->postJson('/logout')
            ->assertStatus(204);
    }
}
