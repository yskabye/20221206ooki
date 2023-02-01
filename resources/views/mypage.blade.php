@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/my_page.css') }}">
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

<div class="main">

  <div class="main__left">
    <h3 class="main__left-tle">予約状況</h3>
    <div class="main__left-list">
      <input type="hidden" name="reserve_num" value={{ count($reserves) }}>

      @foreach($reserves as $reserve => $data)
      <form method="get" action="./update" class="main__left-list-card" id="rsv{{ $loop->index }}">
        @csrf
        <div class="main__left-list-card-top">
          <div class="main__left-list-card-top-left">
            <div class="main__left-list-card-top-left-icon">
              <button type="submit"></button>
            </div>
            <p>予約{{ $loop->index + 1 }}</p>
          </div>
          <div class="main__left-list-card-top-link"></div>
          <input type="hidden" name="reserve_id" value={{$data->id}}>
        </div>
        <div class="main__left-list-card-line">
          <label>Shop</label>
          <p>{{ $data->restrant->name }}</p>
        </div>
        <div class="main__left-list-card-line">
          <label>Date</label>
          <p>{{ $data->reserve_date->format('Y-m-d') }}</p>
        </div>
        <div class="main__left-list-card-line">
          <label>Time</label>
          <p>{{ $data->reserve_time->format('H:i') }}</p>
        </div>
        <div class="main__left-list-card-line">
          <label>Number</label>
          <p>{{ $data->people_num }}人</p>
        </div>
        @if(!empty($data->visit_at))
        <div class="main__left-list-card-line">
          <label>Check in</label>
          <p>チェクイン済</p>
        </div>
        @elseif($data->reserve_date == \Carbon\Carbon::today())
        <div class="main__left-list-card-btn">
          <a href="qrcode/{{$data->id}}" >QRコード表示</a>
        </div>
        @endif
      </form>
      @endforeach

    </div>
  </div>

  <div class="main__right">
    <h3 class="main__right-tle">お気に入り店舗</h3>
    <input type="hidden" name="favorite_num" value={{ count($favorites) }}>
    <div class="main__right-list">

      @foreach($favorites as $favorite => $data)
      <div class="box">
        <img src="{{ asset('storage/images/' . $data->image) }}">
        <div class="box__card">
          <h4 class="box__card-tle">{{ $data->name }}</h4>
          <div class="box__card-key">
            <span>{{ $data->area_name }}</span>
            <span>{{ $data->genre_name }}</span>
          </div>
          <div class="box__card-btn">
            <div class="box__card-btn-lnk">
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

    </div>
  </div>

</div>
@endsection
@section('js2')
<script src="js/mypage.js"></script>
<script src="js/navi.js"></script>
@endsection