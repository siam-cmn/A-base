<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRegistrationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'organization_name' => ['required', 'string', 'max:255'],
            'organization_slug' => ['required', 'string', 'max:50', 'unique:organizations,slug'],

            'last_name' => ['required', 'string', 'max:255'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ヶー]+$/u'],
            'first_name_kana' => ['required', 'string', 'max:255', 'regex:/^[ァ-ヶー]+$/u'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'organization_name' => '組織名',
            'last_name' => '姓',
            'first_name' => '名',
            'last_name_kana' => '姓（フリガナ）',
            'first_name_kana' => '名（フリガナ）',
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }
}
