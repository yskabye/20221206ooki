@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/history.css') }}">
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
  <div>
</div>

<h2 class="main__man">{{ $user->name }}さん</h2>

<div class="main__items">

  <h3 class="main__items-tle">予約履歴</h3>
  <div class="main__items-list">
    <input type="hidden" name="reserve_num" value={{ count($reserves) }}>

    @foreach($reserves as $reserve => $data)
    <div class="main__items-list-card" id="rsv{{ $loop->index }}">
      @csrf
      <div class="main__items-list-card-top">
        <div class="main__items-list-card-top-left">
          <div class="main__items-list-card-top-left-icon">
            <img src="images/clock.png">
          </div>
          <p>履歴{{ $loop->index + 1 }}</p>
        </div>
        <input type="hidden" name="reserve_id" value={{$data->id}}>
      </div>
      <div class="main__items-list-card-line">
        <label>Shop</label>
        <p>{{ $data->restrant->name }}</p>
      </div>
      <div class="main__items-list-card-line">
        <label>Date</label>
        <p>{{ $data->reserve_date->format('Y-m-d') }}</p>
      </div>
      <div class="main__items-list-card-line">
        <label>Time</label>
        <p>{{ $data->reserve_time->format('H:i') }}</p>
      </div>
      <div class="main__items-list-card-line">
        <label>Number</label>
        <p>{{ $data->people_num }}人</p>
      </div>

      <div class="main__items-list-card-lne2">
        <p class="main__items-list-card-lne2-lbl">Review</p>
        @empty($data->review)
        <input type="hidden" name="review_id" value="">
        <div class="main__items-list-card-lne2-star">
          <input type="hidden" name="values" value=0>
          @for($i = 0 ; $i < 5 ; $i++)
            <img src="images/staroff.svg" class="main__items-list-card-lne2-star-img" level={{ $i+1 }}>
          @endfor
        @else
        <input type="hidden" name="review_id" value={{$data->review->id}}>
        <div class="main__items-list-card-lne2-star">
          <input type="hidden" name="values" value={{$data->review->values}}>
          @for($i = 0 ; $i < $data->review->values ; $i++)
            <img src="images/staron.svg" class="main__items-list-card-lne2-star-img" level={{ $i+1 }} />
          @endfor
          @for($i = $data->review->values ; $i < 5 ; $i++)
            <img src="images/staroff.svg" class="main__items-list-card-lne2-star-img" level={{ $i+1 }} />
          @endfor
        @endempty
        </div>
      </div>
      <div class="main__items-list-card-lne3">
        <p class="main__items-list-card-lne3-lbl">Comment</p>
        @empty($data->review)
        <textarea name="comment" maxlength="255"></textarea>
      </div>
      <div class="main__items-list-card-btn">
        <button name="main__items-list-card-btn-save">投稿する</button>
        <button name="main__items-list-card-btn-norec">投稿しない</button>
      </div>
        @else
        <p class="main__items-list-card-lne3-comment">{{$data->review->comment}}</p>
      </div>
        @endempty
    </div>
    @endforeach

    <div class="dumybox1"></div>
    <div class="dumybox2"></div>

  </div>

</div>
@endsection
@section('js2')
<script src="js/history.js"></script>
<script src="js/navi.js"></script>
@endsection