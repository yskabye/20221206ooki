@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
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

<main class="main">
  <div class="main__box">
    <p class="main__box-msg">会員登録ありがとうございます</p>
    <div class="main__box-btn">
      @csrf
      <a href="/login">利用開始する</a>
    </div>
  </div>

</main>
@endsection
@section('js2')
<script src="js/navi.js"></script>
@endsection