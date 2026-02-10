<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'organization_id' => ['required', 'exists:organizations,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'integer'],

            // 中間テーブル用の配列バリデーション
            'users' => ['nullable', 'array'],
            'users.*.id' => ['required', 'exists:users,id'],
            'users.*.assigned_status' => ['required', 'integer'],
            'users.*.assigned_role' => ['required', 'integer'],
            'users.*.allocation_percent' => ['required', 'integer', 'min:0', 'max:100'],
            'users.*.joined_at' => ['required', 'date'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'users.*.id' => 'ユーザーID',
            'users.*.assigned_status' => 'アサイン状況',
            'users.*.assigned_role' => 'ポジション',
            'users.*.allocation_percent' => '稼働率',
            'users.*.joined_at' => '参画日',
        ];
    }
}
