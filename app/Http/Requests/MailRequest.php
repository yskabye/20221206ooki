<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'restrant_id' => ['required'],
            'subject' => ['required', 'max:191'],
            'message' => ['required'],
        ];
    }

    public function messages()
    {
        return [
            'restrant_id.required' => '対象となるレストランを指定してください。',
            'subject.required' => '件名は必ず入力してください。',
            'subject.max' => '件名は半角で最大190文字まで入力できます。',
            'message.required' => 'メール本文は必ず入力して下さい。',
        ];
    }
}
