@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="../css/reset.css">
<link rel="stylesheet" href="../css/detail.css">
<link rel="stylesheet" href="../css/common.css">
@endsection
@section('js')
@endsection

@section('content')
<div class="main">
  <div class="main__left">

  @include('layouts.menu')

    <div class="main__left-symbol">
      <div class="symbol" id="symbol">
        <span class="symbol__line--top"></span>
        <span class="symbol__line--middle"></span>
        <span class="symbol__line--bottom"></span>
      </div>
      <h1 class="main_corp">Rese</h1>
    </div>

    <div class="main__left-guide">
      <div class="main__left-guide-back"><a href="javascript:history.back()">&lt;</a></div>
      <h2 class="main__left-store">{{ $shop->name }}</h2>
    </div>

    <div class="main__left-detail">
      <img src="{{ asset('storage/images/' . $shop->image) }}" alt="{{ $shop->image }}">
      <div class="main__left-detail-key">
        <span>#{{ $shop->area->name }}</span>
        <span>#{{ $shop->genre->name }}</span>
      </div>
      <p class="main__left-detail-content">
        {{ $shop->overview }}
      </p>
    </div>
  </div>

  <form method="post" action="/redone" class="main__right">
    <div class="main__right-form">
      <h3 class="main__right-form-tle">予約変更</h3>
      @csrf
      <input type="hidden" name="id" value="{{ $reserve->id }}">
      <input type="hidden" name="user_id" value="{{ $reserve->user_id }}">
      <input type="hidden" name="restrant_id" value="{{ $reserve->restrant_id }}">
      <input type="date" name="reserve_date" value="{{ $reserve->reserve_date->format('Y-m-d') }}"
        min="{{$shop->rsv_sdate->format('Y-m-d')}}" max="{{$shop->rsv_limit->format('Y-m-d')}}">
      <input type="hidden" name="holiday" value={{ $shop->holiday }}>

      <select name="reserve_time">
        @for($time = new \Carbon\Carbon($shop->rsv_start) ; $time <= $shop->rsv_end ;
          $time->addMinutes($shop->timespan))
          <option value="{{ $time->format('H:i') }}" {{ $reserve->reserve_time == $time ?
            'selected' : '' }}>{{
            $time->format('H:i') }}</option>
          @endfor
      </select>

      <select name="people_num">
        @for($i = $shop->rsv_min ; $i <= $shop->rsv_max ; $i++)
          <option value={{ $i }} {{ $i==$reserve->people_num ? 'selected' : '' }}>{{ $i }}人</option>
          @endfor
      </select>

      <div class="main__right-form-result">
        <div class="main__right-form-result-box">
          <div class="main__right-form-result-box-line">
            <label>Shop</label>
            <p>{{ $shop->name }}</p>
          </div>
          <div class="main__right-form-result-box-line">
            <label>Date</label>
            <p id="inp_date"></p>
          </div>
          <div class="main__right-form-result-box-line">
            <label>Time</label>
            <p id="inp_time"></p>
          </div>
          <div class="main__right-form-result-box-line">
            <label>Number</label>
            <p id="inp_num"></p>
          </div>
        </div>
      </div>

      <ul class="main__right-form-error">
        @if (count($errors)> 0)
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
        @endif
        <li id="err_holiday">指定日は、定休日のため予約できません。</li>
      </ul>

      <button type="submit">予約変更する</button>
    </div>
  </form>

</div>
@endsection
@section('js2')
<script src="../js/update.js"></script>
<script src="../js/navi.js"></script>
@endsection