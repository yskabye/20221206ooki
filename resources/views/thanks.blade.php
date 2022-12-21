@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/thanks.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css')}}">
@endsection

@section('content')
<div class="header">
  <nav class="nav" id="nav">
    <ul>
      <li><a href="/">Home</a></li>
      @empty($userid)
      <li><a href="/register">Registration</a></li>
      <li><a href="/login">Login</a></li>
      @else
      <li>
        <form method="post" action="/logout">
          @csrf
          <input type="hidden" name="user_id" value="{{ $userid }}">
          <button type="submit">Logout</button>
        </form>
      </li>
      <li><a href="/mypage">Mypage</a></li>
      @endif

  </nav>

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
      <a href="/login">ログインする</a>
    </div>
  </div>

</main>
@endsection
@section('js2')
<script src="js/navi.js"></script>
@endsection