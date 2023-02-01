@extends('layouts.default')
@section('css')
<link rel="stylesheet" href="{{ asset('css/reset.css')}}">
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
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

<div class="main">

    <div class="main__box">
        <h2 class="main__box-tle">Registration</h2>
        <form method="POST" action="{{ route('register') }}" class="main__box-inp">
            @csrf

            <div class="main__box-inp-name">
                <img src="images/man.jpg">
                <input name="name" type="text" placeholder="Username" value="{{ old('name') }}">
            </div>
            <div class="main__box-inp-email">
                <img src="images/email.svg">
                <input name="email" type="email" placeholder="Email" value="{{ old('email') }}">
            </div>
            <div class="main__box-inp-pwd">
                <img src="images/password.jpg">
                <input name="password" type="password" placeholder="Password">
            </div>

            @if (count($errors) > 0)
            <ul class="main__box-error">
                @foreach ($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
            @endif

            <div class="main__box-btn">
                <button type="submit">登録</button>
            </div>
        </form>
    </div>

</div>
@endsection
@section('js2')
<script src="js/navi.js"></script>
@endsection