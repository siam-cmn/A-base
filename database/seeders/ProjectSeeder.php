<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Enums\UserStatus;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $prefixes = ['次世代', '基幹', 'グローバル', 'AI活用', '顧客管理', '社内', 'フルリモート対応'];
        $targets = ['物流', '人事', '決済', '広報', '在庫', 'マーケティング', '予約'];
        $suffixes = ['システム', 'プラットフォーム', '改善プロジェクト', 'アプリ', 'ポータルサイト'];

        $descriptions = [
            '現行のシステムが老朽化しているため、最新の技術スタックで再構築を行います。',
            '業務効率化を目的として、これまで手動で行っていたプロセスを自動化します。',
            '新規事業の立ち上げに伴い、スピーディな開発とリリースを目指します。',
            '社内の全部署が利用する共通基盤として、拡張性の高い設計を採用します。',
        ];

        $organization = Organization::first() ?? Organization::factory()->create();
        $users = User::all();

        if ($users->isEmpty()) {
            $users = User::factory(10)->create();
        }

        Project::factory(10)->create([
            'organization_id' => $organization->id,
            'name' => function () use ($prefixes, $targets, $suffixes) {
                return $prefixes[array_rand($prefixes)].
                       $targets[array_rand($targets)].
                       $suffixes[array_rand($suffixes)];
            },
            'description' => function () use ($descriptions) {
                return $descriptions[array_rand($descriptions)];
            },

        ])->each(function ($project) use ($users) {
            $project->users()->attach(
                $users->random(rand(3, 8))->pluck('id')->toArray(),
                [
                    'status' => fake()->randomElement(UserStatus::class),
                    'assigned_role' => fake()->randomElement(UserRole::class),
                    'joined_at' => now(),
                ]
            );
        });
    }
}
