<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(): JsonResponse
    {
        // ログイン機能を追加したら、ログイン者の所属組織にひもづくユーザーのみを取得する。
        $user = User::all();
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


}
