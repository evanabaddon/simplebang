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
<form class="" action="{{ route('tambang.update') }}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{ $tambang->id }}">
  <h1>Informasi Tambang</h1>
  <br>
  <label for="">Nama Tambang</label>
  <input type="text" name="nama" value="{{ $tambang->nama }}">
  <br>
  <label for="">Jenis Tambang</label>
  <select class="" name="jenis_tambang_id">
    @foreach($jenis_tambang as $each)
      <option value="{{ $each->id }}" @if($tambang->jenis_tambang_id == $each->id) selected @endif >{{ $each->jenis }}</option>
    @endforeach
  </select>
  <br>
  <label for="">Alamat Tambang</label>
  <textarea name="alamat" rows="8" cols="80">{{ $tambang->alamat }}</textarea>
  <br>
  <label for="">Luas Tambang</label>
  <input type="text" name="luas" value="{{ $tambang->luas }}">
  <br>
  <label for="">Lokasi Tambang</label>
  <br>
  <label for="">latitude</label>
    <input type="text" name="latitude" value="{{ explode(',' , $tambang->lokasi)[0] }}">
    <br>
    <label for="">longitude</label>
    <input type="text" name="longitude" value="{{ explode(',' , $tambang->lokasi)[1] }}">
    <br>
  <br>
  <h1>Informasi Pemilik</h1>
  <br>
  <label for="">Nama Pemilik</label>
  <input type="text" name="nama_pemilik" value="{{ $pemilik_tambang->nama }}">
  <br>
  <label for="">Alamat Pemilik</label>
  <textarea name="alamat_pemilik" rows="8" cols="80">{{ $pemilik_tambang->alamat }}</textarea>
  <br>
  <label for="">Email Pemilik</label>
  <input type="email" name="email_pemilik" value="{{ $pemilik_tambang->email }}">
  <br>
  <label for="">Telepon</label>
  <input type="text" name="telepon_pemilik" value="{{ $pemilik_tambang->no_telepon }}">
  <br>

<br><br>
  <h1>Foto Lahan</h1>
  <br>
  <label for="">Foto</label>
  <input type="file" name="foto[]" value="" multiple>
  <br>
  <br>
  @foreach($foto_tambang as $each)
  <img src="{{ $each->foto }}" alt="" width="150"><br>
  <a href="{{ route('tambang.delete.foto' , ['id' => $each->id]) }}">Hapus Foto</a>
  <br>
  @endforeach
  <br>
  <input type="submit" name="" value="save">
</form>
