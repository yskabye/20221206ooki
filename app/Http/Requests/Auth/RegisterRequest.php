<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rules;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:191'],
            'email' => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password' => ['required', 'min:8', 'max:191', Rules\Password::defaults()],
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'ユーザー名を必ず設定してください。',
          'name.min' => 'ユーザー名は3文字以上を設定してください。',      
          'name.max' => 'ユーザー名は191文字まで入力できます。',
          'email.required' => 'メールアドレスは必ず設定してください。',
          'email.email' => '正常なメールアドレスを設定してください。',      
          'email.max' => 'メールアドレスは191文字まで入力できます。',
          'email.unique' => '入力したメールアドレスは既に登録済みです。',
          'password.required' => 'パスワードは必ず設定してください。',
          'password.min' => 'パスワードは8文字以上設定してください。',      
          'password.max' => 'パスワードは191文字まで入力できます。',
        ];
    }

}