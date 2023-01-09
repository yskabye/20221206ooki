<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\validation\Rule;

class UserRequest extends FormRequest
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
            'name' => ['required', 'max:191'], 
            'email' => ['required', 'email', 'max:191', Rule::unique('users')->ignore($this['id'])], 
            'password' => ['required', 'min:8', 'max:191'], 
            'type_id' => ['required'], 
            'restrant_id' => ['required'], 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'ユーザー名を必ず設定してください。',
            'name.max' => '191文字まで入力できます。',
            'email.required' => 'メールアドレスは必ず設定してください。',
            'email.email' => 'メールアドレスは正常に設定して下さい。',
            'email.max' => 'メールアドレスは191文字まで設定できます。',
            'email.unique' => 'メールアドレスは既に使用されています。',
            'password.required' => 'パスワードは必ず設定してください。',
            'password.min' => 'パスワードは8文字以上入力してください。',
            'password.max' => 'パスワードは191文字まで設定できます。',
            'type_id.required' => 'ユーザータイプは必ず指定してください。',
            'restrant_id.required' => '店舗は必ず指定してください。',
        ];
    }
}
