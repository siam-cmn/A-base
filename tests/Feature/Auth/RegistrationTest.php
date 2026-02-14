<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_new_users_can_register(): void
    {
        $response = $this->post('/register', [
            'organization_name' => '株式会社テスト',
            'organization_slug' => 'test',
            'last_name' => 'Test',
            'first_name' => 'User',
            'last_name_kana' => 'テスト',
            'first_name_kana' => 'ユーザー',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertAuthenticated();

        $response->assertRedirect(route('dashboard', absolute: false));
    }
}
