@component('mail::message')
{{$name}} 様

いつもお引き立ていただきありがとうございます。
本日、以下の予約をいただいております。

  {{$time->format('H:i')}} : {{$men_num}}名様

ご来店、お待ち申し上げております。

{{$shop_name}}店長 {{$staff_name}}

{{ config('app.name') }}
@endcomponent
