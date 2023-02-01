@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/checkin.css')}}">
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
  <p>チェックイン確認結果</p>
  <p>(店 舗 : {{$reserve->restrant->name}})</p>
</h2>

<div class="detail">
  @if($error)
  <div class="detail__err">
  @else
  <div class="detail__msg">
  @endif
    <p>{{$message}}</p>
  </div>
  <div class="detail__line">
    <div class="detail__line-flex">
      <label>Shop</label>
      <p>{{ $reserve->restrant->name }}</p>
    </div>
    @if($reserve->restrant_id != $user->restrant_id)
    <p class="detail__line_error">--- 他店の予約です! ---</p>
    @endif
  </div>
  <div class="detail__line">
    <div class="detail__line-flex">
      <label>Date</label>
      <p>{{ $reserve->reserve_date->format('Y-m-d') }}</p>
    </div>
    @if($reserve->reserve_date != \Carbon\Carbon::today())
    <p class="detail__line_error">--- 予約日が違います! ---</p>
    @endif
  </div>
  <div class="detail__line">
    <div class="detail__line-flex">
      <label>Time</label>
      <p>{{ $reserve->reserve_time->format('H:i') }}</p>
    </div>
  </div>
  <div class="detail__line">
    <div class="detail__line-flex">
      <label>Number</label>
      <p>{{ $reserve->people_num }}人</p>
    </div>
  </div>

  <div class="detail__btn">
    <a href="javascript:history.back()">戻る</a>
  </div>
</div>

@endsection
@section('js2')
<script src="../../js/navi.js"></script>
@endsection
