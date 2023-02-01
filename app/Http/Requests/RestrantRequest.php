<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestrantRequest extends FormRequest
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
            'area_id' => ['required'],
            'genre_id' => ['required'],
            'overview' => ['required', 'max:191'],
            'image' => ['required', 'max:191'],
            'period' => ['required', 'integer', 'min:0', 'max:30'],
            'limit' => ['required', 'integer', 'min:1', 'max:90'],
            'holiday' => ['required'],
            'rsv_start' => ['required', 'date_format:H:i'],
            'rsv_end' => ['required', 'date_format:H:i', 'after:rsv_start'],
            'timespan' => ['required'],
            'rsv_min' => ['required', 'integer', 'min:1', 'max:'.$this['rsv_max']],
            'rsv_max' => ['required', 'integer', 'min:'.$this['rsv_min'], 'max:999'],
            'upfile' => ['file'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名を必ず設定してください。',
            'name.max' => '191文字まで入力できます。',
            'area_id.required' => '地域は必ず設定してください。',
            'genre_id.required' => 'ジャンルは必ず設定してください。',
            'overview.required' => '概要は必ず設定してください。',
            'image.required' => 'イメージは必ず指定してください。',
            'period.required' => '予約日は必ず指定してください。',
            'period.integer' => '予約日は整数を入力してください。',
            'period.min' => '予約日は0以上の値が入力可能です。',
            'period.max' => '予約日は90日まで設定可能です。',
            'limit.required' => '受付可能予約期間は必ず入力してください。',
            'limit.integer' => '受付可能予約期間は整数で指定してください',
            'limit.min' => '受付可能予約期間は1以上を入力してください。',
            'limit.max' => '受付可能予約期間は５年分まで可能です。',
            'holiday.required' => '定休日は必ず指定してください。',
            'rsv_start.required' => '予約開始時刻は必ず指定して下さい。',
            'rsv_start.time' => '予約開始時刻は正常にして下さい。',
            'rsv_end.required' => '予約終了時刻は必ず指定して下さい。',
            'rsv_end.time' => '予約終了時刻は正常にして下さい。',
            'rsv_end.after' => '予約終了時刻は予約開始時刻以後を指定して下さい。',
            'timespan.required' => '受付時間単位は必ず指定してください。',
            'rsv_min.required' => '予約可能人数（最小）は必ず指定して下さい。',
            'rsv_min.integer' => '予約可能人数（最小）は整数値で指定して下さい。',
            'rsv_min.min' => '予約可能人数（最小）は1以上を入力してください。',
            'rsv_min.max' => '予約可能人数（最小）は予約可能人数（最大）以下の値を入力してください。',
            'rsv_max.required' => '予約可能人数（最大）は必ず指定して下さい。',
            'rsv_max.integer' => '予約可能人数（最大）は整数値で指定して下さい。',
            'rsv_max.min' => '予約可能人数（最大）は予約可能人数（最小）以上の値を入力して下さい。',
            'rsv_max.max' => '予約可能人数（最大）は30人まで入力可能です。',
        ];
    }
}
