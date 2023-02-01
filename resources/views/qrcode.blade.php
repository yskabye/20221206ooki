@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/qrcode.css')}}">
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

<h2 class="customer">{{ $user->name }}さん</h2>

<div class="qrcode">
    {!! QrCode::size(250)->generate($code) !!}
</div>

<div class="detail">
  <div class="detail__line">
    <label>Shop</label>
    <p>{{ $reserve->restrant->name }}</p>
  </div>
  <div class="detail__line">
    <label>Date</label>
    <p>{{ $reserve->reserve_date->format('Y-m-d') }}</p>
  </div>
  <div class="detail__line">
    <label>Time</label>
    <p>{{ $reserve->reserve_time->format('H:i') }}</p>
  </div>
  <div class="detail__line">
    <label>Number</label>
    <p>{{ $reserve->people_num }}人</p>
  </div>

  <div class="detail__btn">
    <a href="javascript:history.back()">戻る</a>
  </div>
</div>
@endsection
@section('js2')
<script src="../js/navi.js"></script>
@endsection

