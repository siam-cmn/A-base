<?php
namespace Tests;

use App\Models\Organization;
use App\Models\User;

trait WithTestUser
{
    protected function createOrganizationUser(array $attributes = []): User
    {
        // 先に組織を1つ作る
        $organization = Organization::factory()->create();

        // その組織IDを強制的にセットしてユーザーを作る
        return User::factory()->create(array_merge([
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
        ], $attributes));
    }
}
