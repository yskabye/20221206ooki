@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/qrreader.css') }}">
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

<h2 class="store">
  <p>チェックイン確認</p>
  <p>(店 舗 : {{$restrant->name}})</p>
</h2>

<h2 class="camera">
  <div id="loadingMessage">カメラが認証できませんでした。Webカメラが有効になっていることを確認してください。</div>
    <canvas id="canvas" hidden></canvas>
    <form method="get" action="/admin/checkin" id="output" hidden>
      @csrf
      <div id="outputMessage">QRコードが検出されていません。</div>
      <div id="outputError"></div>
      <div class="camera__data" hidden><b>Data:</b><span id="outputData"></span></div>
      <input type="hidden" name="id" value="">
    </form>
  </div>
</div>

@endsection
@section('js2')
<script src="../../js/jsQR.js"></script>
<script src="../../js/qrreader.js"></script>
<script src="../../js/navi.js"></script>
@endsection
