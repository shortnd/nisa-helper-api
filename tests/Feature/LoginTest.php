<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function setup(): void
    {
        parent::setUp();

        User::factory()->create([
            'email' => 'email@email.com',
            'password' => Hash::make('password')
        ]);
    }

    public function testLoginReturnsErrorWithIncorrectCredentials()
    {
        $this->postJson('/login', [
            'email' => 'email@email.com',
            'password' => 'pass'
        ])->assertStatus(422);
    }

    public function testLoginReturnsSuccessWithValidCredentials()
    {
        $this->postJson('/login', [
            'email' => 'email@email.com',
            'password' => 'password'
        ])->assertStatus(204);
    }
}
