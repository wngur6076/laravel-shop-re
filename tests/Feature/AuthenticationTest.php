<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthenticationTest extends TestCase
{
    public function testRequiredFieldsForRegistration()
    {
        $this->json('POST', 'api/auth/register', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'errors' => [
                    'name' => ['The name field is required.'],
                    'email' => ['The email field is required.'],
                    'password' => ['The password field is required.'],
                ]
            ]);
    }

    public function testSuccessfulRegistration()
    {
        $userData = [
            'name' => 'juhyeok',
            'email' => 'wngur@example.com',
            'password' => 'wngur12345',
        ];

        $this->json('POST', 'api/auth/register', $userData, ['Accept' => 'application/json'])
            ->assertStatus(201)
            ->assertJson([
                'status' => 'success'
            ]);
    }

    public function testMustEnterEmailAndPassword()
    {
        $this->json('POST', 'api/auth/login')
            ->assertStatus(401)
            ->assertJson([
                'error' => 'login_error',
                'message' => '입력을 다시 확인해주세요.'
            ]);
    }

    public function testFailIdentityVerification()
    {
        User::factory()->create([
            'email' => 'sample@test.com',
            'password' => Hash::make('sample123'),
            'activated' => false,
        ]);

        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];

        $this->json('POST', 'api/auth/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(401)
            ->assertJson([
                'error' => 'confirm_error',
                'message' => '메일함을 다시 확인해주세요.'
            ]);
    }

    public function testSuccessfulLogin()
    {
        User::factory()->create([
            'email' => 'sample@test.com',
            'password' => Hash::make('sample123'),
        ]);

        $loginData = ['email' => 'sample@test.com', 'password' => 'sample123'];

        $this->json('POST', 'api/auth/login', $loginData, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
                'status' => 'success',
            ]);

        $this->assertAuthenticated();
    }

    public function testSuccessfulLogout()
    {
        $user = User::factory()->create([
            'email' => 'sample@test.com',
            'password' => Hash::make('sample123'),
        ]);
        $token = \JWTAuth::fromUser($user);

        $this->post('api/auth/logout?token=' . $token)
            ->assertStatus(200)
            ->assertJsonStructure(['message']);

        $this->assertGuest('api');
    }

    public function testAnUserCanVerifyHisEmailAddress()
    {
        $userData = [
            'name' => 'sample',
            'email' => 'sample@example.com',
            'password' => 'sample123',
        ];

        $this->post('api/auth/register', $userData);
        $user = User::whereEmail($userData['email'])->first();
        $this->assertFalse($user->activated);
        $this->post('api/auth/confirm', ['code' => $user->confirm_code]);
        $user = User::whereEmail($userData['email'])->first();
        $this->assertTrue($user->activated);
    }
}
