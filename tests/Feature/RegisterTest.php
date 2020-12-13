<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function testRegisterReturnsErrorWithNoProperties()
    {
        $this->postJson('/register')->assertStatus(422);
    }

    public function testRegisterReturnsSuccess()
    {
        $this->postJson('/register', [
            'name' => 'test',
            'email' => 'email@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertStatus(204);
    }

    public function testRegisterReturnsErrorWithSameEmail()
    {
        User::factory()->create([
            'name' => 'test',
            'email' => 'email@email.com',
            'password' => Hash::make('password'),
        ]);

        $this->postJson('/register', [
            'name' => 'test',
            'email' => 'email@email.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertStatus(422);
    }
}
