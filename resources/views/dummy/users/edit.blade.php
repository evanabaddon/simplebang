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
<form class="" action="{{ route('users.update') }}" method="post">
  @csrf
  <input type="hidden" name="id" value="{{ $user->id }}">
  <input type="hidden" name="auth_id" value="{{ $user->auth_id }}">
  <label for="">Nik</label>
  <input type="text" name="nik" value="{{ $user->nik }}">
  <br>
  <label for="">Nama</label>
  <input type="text" name="nama" value="{{ $user->nama }}">
  <br>
  <label for="">alamat</label>
  <textarea name="alamat" rows="8" cols="80">{{ $user->alamat }}</textarea>
  <br>
  <label for="">email</label>
  <input type="email" name="email" value="{{ $user->email }}">
  <br>
  <label for="">telepon</label>
  <input type="text" name="no_telepon" value="{{ $user->no_telepon }}">
  <br>
  <label for="">Hak akses</label>
  <select class="" name="role_id">
    @foreach($roles as $each)
    <option value="{{ $each->id }}" @if($user->role_id == $each->id) selected @endif >{{ $each->role }}</option>
    @endforeach
  </select>
  <br>
  <label for="">username</label>
  <input type="text" name="username" value="{{ $user->username }}">
  <br>
  <label for="">Password</label>
  <input type="password" name="password" value="">
  <br>
  <input type="password" name="password_confirmation" value="">
  <br>
  <input type="submit" name="" value="save">

</form>
