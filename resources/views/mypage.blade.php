@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
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
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit">Logout</button>
        </form>
      </li>
      <li><a href="/mypage">Mypage</a></li>
    </ul>
  </nav>

  <div class="header__mark">
    <div class="symbol" id="symbol">
      <span class="symbol__line--top"></span>
      <span class="symbol__line--middle"></span>
      <span class="symbol__line--bottom"></span>
    </div>
    <h1 class="header__mark-corp">Rese</h1>
  <div>
</div>

<h2 class="main__man">{{ $user->name }}さん</h2>

<div class="main__items">

  <div class="main__items-left">
    <h3 class="main__items-left-tle">予約状況</h3>
    <div class="main__items-left-list">
      <input type="hidden" name="reserve_num" value={{ count($reserves) }}>

      @foreach($reserves as $reserve => $data)
      <div class="main__items-left-list-card" id="rsv{{ $loop->index }}">
        <div class="main__items-left-list-card-top">
          <p>予約{{ $loop->index + 1 }}</p>
          <div class="main__items-left-list-card-top-link"><img src="images/close32.png"></div>
          <input type="hidden" name="reserve_id" value={{$data->id}}>
        </div>
        <div class="main__items-left-list-card-line">
          <label>Shop</label>
          <p>{{ $data->restrant->name }}</p>
        </div>
        <div class="main__items-left-list-card-line">
          <label>Date</label>
          <p>{{ $data->reserve_date->format('Y-m-d') }}</p>
        </div>
        <div class="main__items-left-list-card-line">
          <label>Time</label>
          <p>{{ $data->reserve_time->format('H:i') }}</p>
        </div>
        <div class="main__items-left-list-card-line">
          <label>Number</label>
          <p>{{ $data->people_num }}人</p>
        </div>
      </div>
      @endforeach

    </div>
  </div>

  <div class="main__items-right">
    <h3 class="main__items-right-tle">お気に入り店舗</h3>
    <input type="hidden" name="favorite_num" value={{ count($favorites) }}>
    <div class="main__items-right-list">

      @foreach($favorites as $favorite => $data)
      <div class="box">
        <img src="images/{{ $data->image }}">
        <div class="box-card">
          <h4 class="box-card-tle">{{ $data->name }}</h4>
          <div class="box-card-key">
            <span>{{ $data->area_name }}</span>
            <span>{{ $data->genre_name }}</span>
          </div>
          <div class="box-btn">
            <div class="box-btn-lnk">
              <a href="./detail/{{ $data->restrant_id }}">詳しく見る</a>
            </div>
            <input type="hidden" name="favorite_id" value="{{ $data->id }}">
            <input type="hidden" name="user_id" value="{{ $data->user_id }}">
            <input type="hidden" name="restrant_id" value="{{ $data->restrant_id }}">
            <div class="heart heart_on"></div>
          </div>
        </div>
      </div>

      @endforeach

      <div class="dumybox1"></div>
      <div class="dumybox2"></div>

    </div>
  </div>

</div>
@endsection
@section('js2')
<script src="js/mypage.js"></script>
<script src="js/navi.js"></script>
@endsection