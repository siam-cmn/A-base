<?php

namespace App\Http\Controllers;

use App\Events\UserInvited;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        // ログイン機能を追加したら、ログイン者の所属組織にひもづくユーザーのみを取得する。
        $user = User::with('projects')->get();

        return response()->json($user);
    }

    // 社員詳細画面にて案件参画状況と、案件参画履歴を表示する
    public function show(int $id): JsonResponse
    {
        $user = User::with('projects')->findOrFail($id);

        //　ユーザー情報とアサイン経歴、現状のアサイン状況をかくにんする。稼働率もいれるか！
        // joined_atがnullでなければ履歴として表示する
        return response()->json($user);
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        $usersData = $request->validated()['users'];
        $organizationId = auth()->user()->organization_id;

        DB::transaction(function () use ($usersData, $organizationId) {
            foreach ($usersData as $userData) {
                $plainPassword = Str::random(12);

                $user = User::create([
                    'organization_id' => $organizationId,
                    'last_name' => $userData['last_name'],
                    'first_name' => $userData['first_name'],
                    'last_name_kana' => $userData['last_name_kana'],
                    'first_name_kana' => $userData['first_name_kana'],
                    'email' => $userData['email'],
                    'password' => Hash::make($plainPassword),
                    'authority' => $userData['authority'],
                ]);

                event(new UserInvited($user, $plainPassword));
            }
        });

        return response()->json(['message' => '招待メールを送信しました。']);
    }
}
