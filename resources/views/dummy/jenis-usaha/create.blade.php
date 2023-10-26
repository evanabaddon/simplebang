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
<form class="" action="{{ route('jenis-usaha.store') }}" method="post">
  @csrf
  <label for="">Jenis Usaha</label>
  <input type="text" name="jenis" value="">
  <br>
  <input type="submit" name="" value="save">
</form>
