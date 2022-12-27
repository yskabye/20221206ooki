@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css')}}">
@endsection

@section('content')
<div class="header">
 @include('layouts.menu')

  <div class="symbol" id="symbol">
    <span class="symbol__line--top"></span>
    <span class="symbol__line--middle"></span>
    <span class="symbol__line--bottom"></span>
  </div>
  <h1 class="header__corp">Rese</h1>
</div>

<div class="main">
  <div class="main__box">
    <p class="main__box-msg">ご予約ありがとうございます</p>
    <div class="main__box-btn">
      @csrf
      <a href="javascript:history.back()">戻る</a>
    </div>
  </div>

</div>
@endsection
@section('js2')
<script src="js/navi.js"></script>
@endsection