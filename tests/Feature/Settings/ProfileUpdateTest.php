<?php

namespace Tests\Feature\Settings;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\WithTestUser;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase, WithTestUser;

    public function test_profile_page_is_displayed()
    {
        $user = $this->createOrganizationUser();

        $response = $this
            ->actingAs($user)
            ->get(route('profile.edit'));

        $response->assertOk();
    }

    public function test_profile_information_can_be_updated()
    {
        $user = $this->createOrganizationUser();

        $response = $this
            ->actingAs($user)
            ->patch(route('profile.update'), [
                'last_name' => 'Updated',
                'first_name' => 'Name',
                'last_name_kana' => 'アップデート',
                'first_name_kana' => 'ネーム',
                'email' => 'test@example.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('profile.update'));

        $user->refresh();

        $this->assertSame('Updated', $user->last_name);
        $this->assertSame('Name', $user->first_name);
        $this->assertSame('アップデート', $user->last_name_kana);
        $this->assertSame('ネーム', $user->first_name_kana);
        $this->assertSame('test@example.com', $user->email);

    }

    public function test_user_can_delete_their_account()
    {
        $user = $this->createOrganizationUser();

        $response = $this
            ->actingAs($user)
            ->delete(route('profile.edit'), [
                'password' => 'password',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/');

        $this->assertGuest();
        $this->assertNull($user->fresh());
    }
}
