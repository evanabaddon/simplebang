<body>
  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<br>
<form class="" action="{{ route('auth.process') }}" method="post">
  @csrf
  <label for="">Username</label>
  <input type="text" name="username" value="">
  <br>
  <label for="">Password</label>
  <input type="password" name="password" value="">
  <br>
  <input type="checkbox" name="remember" id="remember" value="1"> <label for="remember"> Ingat Saya</label>
  <br>
  <input type="submit" name="" value="Login">
</form>
</body>
