@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/mailing.css') }}">
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

<div class="dialog" id="dialog">
  <p>{{$report}}</p>
  <div class="dialog_btn">
    <button type="button" class="dialog_OK">OK</button>
    <button type="button" class="dialog_Cancel">Cancel</button>
  </div>
  <div class="dialog_btn2">
    <button type="button" class="dialog_OK">OK</button>
  </div>
</div>  

<h2 class="store">
  <p>販促メール送信</p>
  <p>(店 舗 : {{$restrant->name}})</p>
</h2>

<form method="post" class="main">
  @csrf
  <input type="hidden" name="id" value={{empty($ebody->id)?null:$ebody->id}}>
  <input type="hidden" name="restrant_id" value={{empty($ebody->restrant_id)?$restrant->id:$ebody->restrant_id}}>

  <div class="main__btn">
    <button type="submit" formaction="/admin/mailsave" class="main__btn-savebtn"></button>
    <button type="button" formaction="/admin/mailsend" class="main__btn-sendbtn"></button>
    <!--button type="submit" formaction="/admin/mailsend" class="main__btn-sendbtn"></button-->
    
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

  <div class="main__input">
      <div class="main__input-line">
        <label>件&nbsp;&nbsp;名</label>
        <input type="text" name="subject" value="{{empty($ebody->subject)?old('subject'):$ebody->subject}}">
      </div>

      <div class="main__input-line">
        <label>本&nbsp;&nbsp;文</label>
        <textarea name="message">{{empty($ebody->message)?old("message"):$ebody->message}}</textarea>
      </div>

      <div class="main__input-line">
        <label>送信日時 : </label>
        <p>{{empty($ebody->send_at)?"未送信":$ebody->send_at->format('Y/M/D H:i'). ' 送信'}}</p>
      </div>
  </div>
</form>

@endsection
@section('js2')
<script src="../../js/mailing.js"></script>
<script src="../../js/navi.js"></script>
@endsection