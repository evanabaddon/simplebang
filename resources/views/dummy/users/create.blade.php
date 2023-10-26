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
<form class="" action="{{ route('users.store') }}" method="post">
  @csrf
  <label for="">Nik</label>
  <input type="text" name="nik" value="">
  <br>
  <label for="">Nama</label>
  <input type="text" name="nama" value="">
  <br>
  <label for="">alamat</label>
  <textarea name="alamat" rows="8" cols="80"></textarea>
  <br>
  <label for="">email</label>
  <input type="email" name="email" value="">
  <br>
  <label for="">telepon</label>
  <input type="text" name="no_telepon" value="">
  <br>
  <label for="">Hak akses</label>
  <select class="" name="role_id">
    @foreach($roles as $each)
    <option value="{{ $each->id }}">{{ $each->role }}</option>
    @endforeach
  </select>
  <br>
  <label for="">username</label>
  <input type="text" name="username" value="">
  <br>
  <label for="">Password</label>
  <input type="password" name="password" value="">
  <br>
  <input type="password" name="password_confirmation" value="">
  <br>
  <input type="submit" name="" value="save">

</form>
