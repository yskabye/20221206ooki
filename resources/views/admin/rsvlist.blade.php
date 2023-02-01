@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/rsvlist.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css')}}">
@endsection

@section('content')
<div class="header">

  @include('layouts.menu')

  <div class="header__mark">
    <div class="symbol" id="symbol">
      <span class="symbol__line--top"></span>
      <span class="symbol__line--middle"></span>
      <span class="symbol__line--bottom"></span>
    </div>
    <h1 class="header__mark-corp">Rese</h1>
  </div>
</div>

<h2 class="store">
  <p>予約状況 </p>
  <p>(店舗名：{{ $restrant->name }})</p>
</h2>

<div class="main">
  <div class="main__counter">予約は{{count($reserves)}}件あります。</div>

  <form method="get" action="./rsv_list" class="main__search">
    @csrf
    <div class="main__search-input">
      <div class="main__search-input-date">
        <div class="main__search-input-date-str">
          <label>予 約 日:</label>
          <input type="date" name="str_date" value="{{empty($key['str_date'])?old('str_date'):$key['str_date']}}">
        </div>
        <div class="main__search-input-date-end">
          <p>〜</p>
          <input type="date" name="end_date" value="{{empty($key['end_date'])?old('end_date'):$key['end_date']}}">
        </div>
      </div>

      <div class="main__search-input-time">
        <div class="main__search-input-time-str">
          <label>予約時間:</label>
          <input type="time" name="str_time" value="{{empty($key['str_time'])?old('str_time'):$key['str_time']}}" step="{{$timespan}}">
        </div>
        <div class="main__search-input-time-end">
          <p>〜</p>
          <input type="time" name="end_time" value="{{empty($key['end_time'])?old('end_time'):$key['end_time']}}" step="{{$timespan}}">
        </div>
      </div>
    </div>

    <div class="main__search-btn">
      <button type="submit"></button>
    </div>
  </form>

  <div class="main__table">
    <div class="main__table-header">
      <p>予 約 日</p>
      <p>予約時間</p>
      <p>予約者名</p>
      <p>予約人数</p>
    </div>
    <hr>
    <div class="main__table-lists">
      <div class="main__table-lists-area">
        @foreach($reserves as $reserve => $data)
        <div class="main__table-lists-area-list">
          <p>{{$data->reserve_date->format('Y年m月d日')}}</p>
          <p>{{$data->reserve_time->format('H:i')}}</p>
          <p>{{$data->user->name}}</p>
          <p>{{$data->people_num}}人</p>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection
@section('js2')
<script src="../../js/navi.js"></script>
@endsection