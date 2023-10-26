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
<form class="" action="{{ route('perusahaan.update') }}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{ $perusahaan->id }}">
  <h1>Informasi Perusahaan</h1>
  <br>
  <label for="">Nama Perusahaan</label>
  <input type="text" name="nama" value="{{ $perusahaan->nama }}">
  <br>
  <label for="">Jenis Usaha</label>
  <select class="" name="jenis_usaha_id">
    @foreach($jenis_usaha as $each)
      <option value="{{ $each->id }}" @if($perusahaan->jenis_usaha_id == $each->id) selected @endif>{{ $each->jenis }}</option>
    @endforeach
  </select>
  <br>
  <label for="">Alamat Usaha</label>
  <textarea name="alamat" rows="8" cols="80">{{ $perusahaan->alamat }}</textarea>
  <br>
  <label for="">Email Usaha</label>
  <input type="text" name="email" value="{{ $perusahaan->email }}">
  <br>
  <label for="">Telepon Usaha</label>
  <br>
  <input type="text" name="no_telepon" value="{{ $perusahaan->no_telepon }}">
  <br>
  <label for="">Logo</label>
  <input type="file" name="logo" value="">
  @if($perusahaan->logo != NULL)
  <br>
  <img src="{{ $perusahaan->logo }}" />
  <br>
  <a href="{{ route("perusahaan.delete.logo" , ["id" => $perusahaan->id]) }}">Hapus Logo</a>
  <br>
  @endif
  <h1>Informasi Pemilik</h1>
  <br>
  <label for="">Nama Pemilik</label>
  <input type="text" name="nama_pemilik" value="{{ $pemilik_usaha->nama }}">
  <br>
  <label for="">Alamat Pemilik</label>
  <textarea name="alamat_pemilik" rows="8" cols="80">{{ $pemilik_usaha->alamat }}</textarea>
  <br>
  <label for="">Email Pemilik</label>
  <input type="email" name="email_pemilik" value="{{ $pemilik_usaha->email }}">
  <br>
  <label for="">Telepon</label>
  <input type="text" name="telepon_pemilik" value="{{ $pemilik_usaha->no_telepon }}">
  <br>
  <input type="submit" name="" value="save">
</form>
