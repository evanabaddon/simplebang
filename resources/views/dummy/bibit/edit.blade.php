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
<form class="" action="{{ route('bibit.update') }}" enctype="multipart/form-data" method="post">
  @csrf
  <input type="hidden" name="id" value="{{ $bibit->id }}">
  <label for="">Jenis Bibit</label>
  <input type="text" name="jenis" value="{{ $bibit->jenis }}">
  <br>
  <label for="">Logo</label>
  <input type="file" name="logo" value="">
  @if($bibit->logo != NULL)
    <img src="{{ $bibit->logo }}" alt="">
    <br>
    <a href="{{ route('bibit.delete.logo' , ['id' => $bibit->id]) }}">Hapus logo</a>
  @endif
  <br>
  <input type="submit" name="" value="save">
</form>
