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
<form class="" action="{{ route('perusahaan.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <h1>Informasi Perusahaan</h1>
  <br>
  <label for="">Nama Perusahaan</label>
  <input type="text" name="nama" value="">
  <br>
  <label for="">Jenis Usaha</label>
  <select class="" name="jenis_usaha_id">
    @foreach($jenis_usaha as $each)
      <option value="{{ $each->id }}">{{ $each->jenis }}</option>
    @endforeach
  </select>
  <br>
  <label for="">Alamat Usaha</label>
  <textarea name="alamat" rows="8" cols="80"></textarea>
  <br>
  <label for="">Email Usaha</label>
  <input type="text" name="email" value="">
  <br>
  <label for="">Telepon Usaha</label>
  <br>
  <input type="text" name="no_telepon" value="">
  <br>
  <label for="">Logo</label>
  <input type="file" name="logo" value="">
  <br>
  <h1>Informasi Pemilik</h1>
  <br>
  <label for="">Nama Pemilik</label>
  <input type="text" name="nama_pemilik" value="">
  <br>
  <label for="">Alamat Pemilik</label>
  <textarea name="alamat_pemilik" rows="8" cols="80"></textarea>
  <br>
  <label for="">Email Pemilik</label>
  <input type="email" name="email_pemilik" value="">
  <br>
  <label for="">Telepon</label>
  <input type="text" name="telepon_pemilik" value="">
  <br>
  <input type="submit" name="" value="save">
</form>
