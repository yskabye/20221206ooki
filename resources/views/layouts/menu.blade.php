  <nav class="nav" id="nav">
    <ul>
      @if(empty($user->id))
      <li><a href="/">Home</a></li>
      <li><a href="/register">Registration</a></li>
      <li><a href="/login">Login</a></li>
      @elseif($user->type_id == 0)
      <li><a href="/">Home</a></li>
      <li>
        <form method="post" action="/logout">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit">Logout</button>
        </form>
      </li>
      <li><a href="/mypage">Mypage</a></li>
      <li><a href="/history">History</a></li>
      @else
      <li>
        <form method="post" action="/logout">
          @csrf
          <input type="hidden" name="user_id" value="{{ $user->id }}">
          <button type="submit">Logout</button>
        </form>
      </li>
      @if($user->type_id == 5)
      <li><a href="/admin/store_edit">Edit Store</a></li>
      <li><a href="/admin/rsv_list">Reserve List</a></li>
      <li><a href="/admin/mailing">Promotional eMail</a></li>
      @endif
      @endif
    </ul>
  </nav>