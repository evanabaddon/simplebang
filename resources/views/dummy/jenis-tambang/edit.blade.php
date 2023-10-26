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
<form class="" action="{{ route('jenis-tambang.update') }}" method="post">
  @csrf
  <input type="hidden" name="id" value="{{ $jenis_tambang->id }}">
  <label for="">Jenis Tambang</label>
  <input type="text" name="jenis" value="{{ $jenis_tambang->jenis }}">
  <br>
  <input type="submit" name="" value="save">
</form>
