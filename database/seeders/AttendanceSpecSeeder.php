<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Project;
use App\Models\SpecApi;
use App\Models\SpecRole;
use App\Models\SpecScenario;
use Illuminate\Database\Seeder;

class AttendanceSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $org = Organization::first() ?? Organization::create(['name' => 'デフォルト組織']);
        // 1. プロジェクトの作成
        $pj = Project::create([
            'organization_id' => $org->id,
            'name' => 'クラウド勤怠管理システム',
            'description' => '勤怠管理システムの仕様を定義するためのプロジェクトです。',
            'status' => 1,
        ]);

        // 2. 役割(Roles)の作成
        $admin = SpecRole::create(['project_id' => $pj->id, 'name' => '管理者', 'description' => '全機能の操作が可能']);
        $manager = SpecRole::create(['project_id' => $pj->id, 'name' => '店長', 'description' => '自店舗の修正・承認が可能']);
        $staff = SpecRole::create(['project_id' => $pj->id, 'name' => '一般スタッフ', 'description' => '自身の打刻のみ可能']);

        // 3. 状態(Scenarios)の作成
        $sOpen = SpecScenario::create(['project_id' => $pj->id, 'name' => '勤務前', 'sort_order' => 1]);
        $sWork = SpecScenario::create(['project_id' => $pj->id, 'name' => '勤務中', 'sort_order' => 2]);
        $sClosed = SpecScenario::create(['project_id' => $pj->id, 'name' => '月次確定済', 'sort_order' => 3]);

        // 4. 機能(APIs)の作成
        $apiPunchIn = SpecApi::create(['project_id' => $pj->id, 'method' => 'POST', 'endpoint' => '/punch-in',  'summary' => '出勤打刻']);
        $apiPunchOut = SpecApi::create(['project_id' => $pj->id, 'method' => 'POST', 'endpoint' => '/punch-out', 'summary' => '退勤打刻']);
        $apiEdit = SpecApi::create(['project_id' => $pj->id, 'method' => 'PUT',  'endpoint' => '/edit',      'summary' => '実績修正']);

        // --- 5. 権限マトリクス (spec_permissions) ---
        // スタッフは「実績修正」を許可しない
        $staff->allowedApis()->sync([
            $apiPunchIn->id => ['is_allowed' => true],
            $apiPunchOut->id => ['is_allowed' => true],
            $apiEdit->id => ['is_allowed' => false],
        ]);

        // 管理者はすべてOK
        $admin->allowedApis()->sync([
            $apiPunchIn->id => ['is_allowed' => true],
            $apiPunchOut->id => ['is_allowed' => true],
            $apiEdit->id => ['is_allowed' => true],
        ]);

        // --- 6. 状態マトリクス (spec_status_controls) ---
        // 「勤務中」なら、出勤打刻はできない（エラーになるべき）
        $sWork->apis()->sync([
            $apiPunchIn->id => ['is_executable' => false, 'condition_note' => '二重出勤防止'],
            $apiPunchOut->id => ['is_executable' => true],
        ]);

        // 「月次確定済」なら、すべてのAPIを禁止する
        $sClosed->apis()->sync([
            $apiPunchIn->id => ['is_executable' => false, 'condition_note' => '締め処理済み'],
            $apiPunchOut->id => ['is_executable' => false, 'condition_note' => '締め処理済み'],
            $apiEdit->id => ['is_executable' => false, 'condition_note' => '確定後の修正は管理者へ依頼してください'],
        ]);
    }
}
