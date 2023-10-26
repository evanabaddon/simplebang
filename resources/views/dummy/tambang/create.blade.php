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
<form class="" action="{{ route('tambang.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <h1>Informasi Tambang</h1>
  <br>
  <label for="">Nama Tambang</label>
  <input type="text" name="nama" value="">
  <br>
  <label for="">Jenis Tambang</label>
  <select class="" name="jenis_tambang_id">
    @foreach($jenis_tambang as $each)
      <option value="{{ $each->id }}">{{ $each->jenis }}</option>
    @endforeach
  </select>
  <br>
  <label for="">Alamat Tambang</label>
  <textarea name="alamat" rows="8" cols="80"></textarea>
  <br>
  <label for="">Luas Tambang</label>
  <input type="text" name="luas" value="">
  <br>
  <label for="">Lokasi Tambang</label>
  <br>
  <label for="">latitude</label>
    <input type="text" name="latitude" value="">
    <br>
    <label for="">longitude</label>
    <input type="text" name="longitude" value="">
    <br>
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
  <br><br>
    <h1>Foto Lahan</h1>
    <br>
    <label for="">Foto</label>
    <input type="file" name="foto[]" value="" multiple>
    <br>
    <input type="submit" name="" value="save">
  </form>
