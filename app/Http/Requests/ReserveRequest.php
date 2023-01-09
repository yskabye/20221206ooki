<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
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
            'user_id' => ['required'],
            'restrant_id' => ['required'],
            'reserve_date' => ['required', 'date'],
            'reserve_time' => ['required', 'date_format:H:i'],
            'people_num' => ['required', 'integer'],
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'ログインして下さい。',
            'restrant_id.required' => '対象となるレストランを指定してください。',
            'reserve_date.required' => '予約日は必ず指定してください。',
            'reserve_date.date' => '予約日は正常な日付で指定してください。',
            'reserve_time.required' => '予約時間は必ず指定して下さい。',
            'reserve_time.time' => '予約時間は正常にして下さい。',
            'people_num.required' => '人数は必ず指定して下さい。',
            'people_num.integer' => '人数は整数値で指定して下さい。',
        ];
    }
}