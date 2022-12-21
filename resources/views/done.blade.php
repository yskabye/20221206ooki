@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/done.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css')}}">
@endsection

@section('content')
<div class="header">
  <nav class="nav" id="nav">
    <ul>
      <li><a href="/">Home</a></li>
      <li>
        <form method="post" action="/logout">
          @csrf
          <input type="hidden" name="user_id" value="{{ $userid }}">
          <button type="submit">Logout</button>
        </form>
      </li>
      <li><a href="/mypage">Mypage</a></li>
    </ul>
  </nav>

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