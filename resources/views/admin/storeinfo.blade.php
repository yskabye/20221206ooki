@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/storeinfo.css') }}">
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

<div class="dialog">
  <p></p>
  <div class="dialog_btn2">
    <button type="button" class="dialog_OK">OK</button>
  </div>
</div>  

<h2 class="store">店舗名 ： {{ $restrant->name }}</h2>

<form method="post" action="/admin/store_upd" class="main" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value={{empty($restrant->id)?:$restrant->id}}>

  <div class="main__btn">
    <button type="submit" class="main__btn-savebtn"></button>
  </div>

  @if ($errors->any())
  <div class="errmsgx">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
  </div>
  @endif

  <div class="main__input1">
    <div class="main__input1-left">

      <div class="main__input1-left-line">
        <label>店舗名</label>
        <input type="text" name="name" value="{{$restrant->name}}">
      </div>

      <div class="main__input1-left-line">
        <label>出店地域</label>
        <select name="area_id">
          @foreach($areas as $area => $data)
          <option value={{$data->id}} {{ $data->id == $restrant->area_id ? 'selected' : ''}}>{{ $data->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="main__input1-left-line">
        <label>ジャンル</label>
        <select name="genre_id">
          @foreach($genres as $genre => $data)
          <option value={{$data->id}} {{ $data->id == $restrant->genre_id ? 'selected' : ''}}>{{ $data->name }}</option>
          @endforeach
        </select>
      </div>

      <div class="main__input1-left-line">
        <label>店舗写真</label>
        <select name="image">
          @foreach($images as $image => $data)
          <option value="{{$data}}" {{$data == $restrant->image ? "selected" : ''}}>{{$data}}</option>
          @endforeach
        </select>
        <div class="main__input1-left-upload">
          <label>
            <input type="file" id="upload" name="upfile">別画像を指定する
          </label>
        </div>
      </div>
    </div>

    <div class="main__input1-right">
      <img src="{{empty($restrant->image) ? '' : asset('/storage/images/' . $restrant->image)}}" >
    </div>
  </div>

  <div class="main__input2">
    <label>店舗説明</label>
    <textarea name="overview">{{ $restrant->overview}}</textarea>
  </div>

  <div class="main__input3">
    <div class="main__input3-left">

      <div class="main__input3-left-line">
        <label>定休日</label>
        <select name="holiday">
          @foreach($holidays as $holiday => $data)
          <option value={{$data['id']}} {{ $data['id'] == $restrant->holiday ? 'selected' : ''}}>{{ $data['name'] }}</option>
          @endforeach
        </select>
      </div>

      <div class="main__input3-left-line">
        <label>受付予約時間</label>
        <input type="time" name="rsv_start" value="{{ empty($restrant->id) ||!empty(old('rsv_start')) ? old('rsv_start') : $restrant->rsv_start->format('H:i')}}" step={{$restrant->timespan * 60}}>
        <p>〜</p>
        <input type="time" name="rsv_end" value="{{ empty($restrant->id)  ||!empty(old('rsv_end')) ? old('rsv_end') : $restrant->rsv_end->format('H:i')}}" step={{$restrant->timespan * 60}}>
      </div>

      <div class="main__input3-left-line">
        <label>受付時間単位</label>
        <select name="timespan">
          @for($i = 15 ; $i <= 60 ; $i *= 2)
          <option value={{$i}} {{ $i == $restrant->timespan ? 'selected' : ''}}>{{$i}}分</option>
          @endfor
        </select>
      </div>
    </div>

    <div class="main__input3-right">

      <div class="main__input3-right-line">
        <label>予約可能日</label>
        <input type="number" name="period" min=0 max=90 value={{ empty($restrant->id) ||!empty(old('period')) ? old('period') : $restrant->period}}><span>日</span>
      </div>

      <div class="main__input3-right-line">
        <label>予約対応期間</label>
        <input type="number" name="limit" min=1 max=60 value={{ empty($restrant->id) ||!empty(old('limit')) ? old('limit') : $restrant->limit}}><span>ヵ月迄</span>
      </div>

      <div class="main__input3-right-line">
        <label>受付可能人数</label>
        <input type="number" name="rsv_min" min=1 max=30 value={{empty($restrant->id) ||!empty(old('rsv_min')) ? old('rsv_min') : $restrant->rsv_min}}>
        <p>〜</p>
        <input type="number" name="rsv_max" min=1 max=30 value={{empty($restrant->id) || !empty(old('rsv_max')) ? old('rsv_max') : $restrant->rsv_max}}>
        <span>人</span>
      </div>
    </div>
  </div>
</form>

@endsection
@section('js2')
<script src="../../js/storeinfo.js"></script>
<script src="../../js/navi.js"></script>
@endsection