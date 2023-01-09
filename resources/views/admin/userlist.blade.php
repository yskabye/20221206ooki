@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/user_list.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css')}}">
@endsection

@section('content')
<div class="header">

  @include('layouts.menu')

  <div class="header__corp">
    <div class="symbol" id="symbol">
      <span class="symbol__line--top"></span>
      <span class="symbol__line--middle"></span>
      <span class="symbol__line--bottom"></span>
    </div>
    <h1 class="header__mark-corp">Rese</h1>
  </div>
</div>

<div class="main">
  <div class="main__newbtn">
    <form method="get" action="./user_edit">
      <input type="hidden" name="id" value=0>
      @csrf
      <button type="method"></button>
    </form>
  </div>

  <div class="main__table">
    <div class="main__table-header">
      <p>名前</p>
      <p>メールアドレス</p>
      <p>担当店舗</p>
    </div>
    <hr>
    <div class="main__table-lists">
      <div class="main__table-lists-area">
        @foreach($users as $one => $data)
        <form method="get" class="main__table-lists-area-line">
          @csrf
          <button type="submit" formaction="./user_edit" class="main__table-lists-area-line-editbtn"></button>
          <input type="hidden" name="id" value={{$data->id}}>
          <p>{{$data->name}}</p>
          <P>{{$data->email}}</p>
          <p>{{$data->restrant->name}}</p>
          <button type="button" formaction="./user_del" class="main__table-lists-area-line-delbtn"></button>
        </form>
        @endforeach
      <div>
    </div>
  </div>
</div>
<div class="dialog">
  <p>削除します。よろしいですか？</p>
  <div class="dialog_btn">
    <button type="button" class="dialog_OK">OK</button>
    <button type="button" class="dialog_Cancel">ｷｬﾝｾﾙ</button>
  </div>
</div>
@endsection
@section('js2')
<script src="../../js/user_list.js"></script>
<script src="../../js/navi.js"></script>
@endsection