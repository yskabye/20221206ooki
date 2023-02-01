@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/user_edit.css') }}">
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

<div class="main">
  <form method="post" action="./user_upd" class="main__input">
    @csrf
    <div class="main__input-btn">
      <button type="submit" action="./update" class="main__input-btn-savebtn"></button>
      <a href="javascript:history.back()" class="main__lists-btn-backbtn">&nbsp;</a>
    </div>
    <input type="hidden" name="id" value={{empty($employee->id)?'':$employee->id}}>
    <div class="main__input-line">
      <label>ユーザー名</label>
      <input type="text" name="name" value="{{empty($employee->id)?old('name'):$employee->name}}">
    </div>
    <div class="main__input-line">
      <label>メールアドレス</label>
      <input type="email" name="email" value="{{empty($employee->id)?old('email'):$employee->email}}">
    </div>
    <div class="main__input-line">
      <label>パスワード</label>
      <input type="password" name="password" value="{{empty($employee->id)?old('password'):$employee->password}}">
      <input type="hidden" name="pwd_flg" value=0>
    </div>
    <input type="hidden" name="type_id" value=5>
    <div class="main__input-line">
      <label>担当店舗</label>
      <select name="restrant_id">
        <option value="0">新規店舗</option> 
        @foreach($restrants as $restrant => $data)
        <option value="{{$data->id}}" {{old('restrant_id')==$data->id || (empty($employee->restrant_id)?0:$employee->restrant_id) == $data->id ? 'selected':'' }}>{{$data->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="errmsg">
      @if ($errors->any())
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      @endif
    </div>
  </form>

</main>
@endsection
@section('js2')
<script src="../../js/useredit.js"></script>
<script src="../../js/navi.js"></script>
@endsection