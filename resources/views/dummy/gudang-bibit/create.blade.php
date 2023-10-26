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
<form class="" action="{{ route('gudang-bibit.store') }}" method="post" enctype="multipart/form-data">
  @csrf
  <h1>Informasi Gudang Bibit</h1>
  <br>
  <label for="">Nama Gudang</label>
  <input type="text" name="nama" value="">
  <br>
  <label for="">Alamat Gudang</label>
  <textarea name="alamat" rows="8" cols="80"></textarea>
  <br>
  <label for="">Nomor Telepon</label>
  <input type="text" name="no_telepon" value="">
  <br>
  <label for="">Lokasi Gudang</label>
  <br>
  <label for="">latitude</label>
    <input type="text" name="latitude" value="">
    <br>
    <label for="">longitude</label>
    <input type="text" name="longitude" value="">
    <br>
  <br>
  <input type="submit" name="" value="Save">
  </form>
