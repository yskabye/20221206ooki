  <nav class="nav" id="nav">
    <ul>
      <li><a href="/">Home</a></li>
      @if(empty($user->id))
      <li><a href="/register">Registration</a></li>
      <li><a href="/login">Login</a></li>
      @else
      <li>
        <form method="post" action="/logout">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit">Logout</button>
        </form>
      </li>
     <li><a href="/mypage">Mypage</a></li>
     <li><a href="/history">History</a></li>
      @endif
    </ul>
  </nav>