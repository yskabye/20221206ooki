@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css') }}">
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css')}}">
@endsection

@section('content')
<div class="header">
 @include('layouts.menu')

  <div class="header__left">
    <div class="symbol" id="symbol">
        <span class="symbol__line--top"></span>
        <span class="symbol__line--middle"></span>
        <span class="symbol__line--bottom"></span>
    </div>
    <h1 class="header__corp">Rese</h1>
  </div>
    
  <div class="header__right">
    <div class="header__right-box">
        <select name="area_id" class="header__right-box-select">
          <option value="0" {{ old('aera_id')==null || old('area_id')=='' ? 'selected' : '' }}>All area</option>
        @foreach($areas as $area => $data)
          <option value="{{ $data->id }}" {{ old('area_id')==$data->id ? 'selected' : ''}}>{{ $data->name }}</option>
        @endforeach
        </select>
        <select name="genre_id" class="header__right-box-select on" onchange="">
          <option value="0" {{ old('genre_id')==null || old('genre_id')=='' ? 'selected' : '' }}>All genre</option>
          @foreach($genres as $genre => $data)
          <option value="{{ $data->id }}" {{ old('genre_id')==$data->id ? 'selected' : ''}}>{{ $data->name }}</option>
          @endforeach
        </select>
        <div class="header__right-box-inp">
          <img src="images/loupe.png">
          <input type="text" placeholder="Search ..." name="word" />
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" name="allnum" value={{ count($shops) }}>
  <div class="list">

  @foreach($shops as $shop => $data)
  <div class="box" id="box{{ $loop->index }}">
    <img src="images/store/{{ $data->image }}">
    <div class="box-card">
      <h4 class="box-card-tle">{{ $data->name }}</h4>
      @csrf
      @empty($user->id)
      <input type="hidden" name="user_id" value="">
      @else
      <input type="hidden" name="user_id" value="{{ $user->id }}">
      @endif
      <input type="hidden" name="restrant_id" value="{{ 
    $data->id }}">
      <input type="hidden" name="shop_name" value="{{ $data->name }}">
      <input type="hidden" name="area_id" value="{{ $data->area_id }}">
      <input type="hidden" name="genre_id" value="{{ $data->genre_id }}">
      <div class="box-card-key">
        <span id="box-name">#{{ $data->area->name }}</span>
      <span id="box-area">#{{ $data->genre->name }}</span>
      </div>
      <div class="box-btn">
        <div class="box-btn-lnk">
          <a href="./detail/{{ $data->id }}">詳しく見る</a>
        </div>
        @if($favorites[$loop->index]['flag'])
        <div class="heart heart_on"></div>
        @else
        <div class="heart heart_off"></div>
        @endif
        <input type="hidden" name="favorite_id" value={{$favorites[$loop->index]['id'] }}>
    </div>
  </div>
  </div>
  @endforeach

  <div class="dummybox">
  </div>

  </div>

    </main>
  @endsection
  @section('js2')
  <script src="js/index.js"></script>
  <script src="js/navi.js"></script>
  @endsection