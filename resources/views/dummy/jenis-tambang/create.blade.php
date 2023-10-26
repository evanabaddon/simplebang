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
<form class="" action="{{ route('jenis-tambang.store') }}" method="post">
  @csrf
  <label for="">Jenis Tambang</label>
  <input type="text" name="jenis" value="">
  <br>
  <input type="submit" name="" value="save">
</form>
