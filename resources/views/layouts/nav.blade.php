@section('nav')
<nav class="nav" id="nav">
  <ul>
    <li><a href="/">Home</a></li>
    @empty($userid)
    <li><a href="/logout">Logout</a></li>
    <li><a href="/mypage">Mypage</a></li>
    @else
    <li><a href="/Register">Registration</a></li>
    <li><a href="/login">Login</a></li>
    @endif
  </ul>
</nav>
@endsection