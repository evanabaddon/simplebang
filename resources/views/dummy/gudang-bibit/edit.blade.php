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
<form class="" action="{{ route('gudang-bibit.update') }}" method="post" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{ $gudang_bibit->id }}">
  <h1>Informasi Gudang Bibit</h1>
  <br>
  <label for="">Nama Gudang</label>
  <input type="text" name="nama" value="{{ $gudang_bibit->nama }}">
  <br>
  <label for="">Alamat Gudang</label>
  <textarea name="alamat" rows="8" cols="80">{{ $gudang_bibit->alamat }}</textarea>
  <br>
  <label for="">Nomor Telepon</label>
  <input type="text" name="no_telepon" value="{{ $gudang_bibit->no_telepon }}">
  <br>
  <label for="">Lokasi Gudang</label>
  <br>
  <label for="">latitude</label>
    <input type="text" name="latitude" value="{{ explode("," , $gudang_bibit->lokasi)[0] }}">
    <br>
    <label for="">longitude</label>
    <input type="text" name="longitude" value="{{ explode("," , $gudang_bibit->lokasi)[1] }}">
    <br>
  <br>
  <input type="submit" name="" value="Save">
  </form>
