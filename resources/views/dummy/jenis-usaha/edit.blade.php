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
<form class="" action="{{ route('jenis-usaha.update') }}" method="post">
  @csrf
  <input type="hidden" name="id" value="{{ $jenis_usaha->id }}">
  <label for="">Jenis Usaha</label>
  <input type="text" name="jenis" value="{{ $jenis_usaha->jenis }}">
  <br>
  <input type="submit" name="" value="save">
</form>
