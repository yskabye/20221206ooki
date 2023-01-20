@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/verify.css') }}">
<link rel="stylesheet" href="{{ asset('css/common.css')}}">
@endsection

@section('content')
<div class="header">
    <nav class="nav" id="nav">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/register">Registration</a></li>
            <li><a href="/login">Login</a></li>
        </ul>
    </nav>

    <div class="symbol" id="symbol">
        <span class="symbol__line--top"></span>
        <span class="symbol__line--middle"></span>
        <span class="symbol__line--bottom"></span>
    </div>
    <h1 class="header__corp">Rese</h1>
</div>

<main class="main">
    <div class="main__board">
        <div class="main__board-word1">
            ご登録ありがとうございます。メールで送りましたリンクをクリックして、メールアドレスを確認しください。メールが届かない場合は、別のメールアドレスでご確認下さい。
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="main__board-word2">
                登録時に指定したメールアドレスに、確認リンクを送信しました。
            </div>
        @endif

        <div class="main__board-btn">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <button class="main__board-btn-remain">確認メールを再送</button>
                </div>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="main__board-btn-logout">ログアウト</button>
            </form>
        </div>
    </div>
</main>
@endsection
@section('js2')
<script src="js/navi.js"></script>
@endsection