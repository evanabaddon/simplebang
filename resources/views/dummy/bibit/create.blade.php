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
<form class="" action="{{ route('bibit.store') }}" enctype="multipart/form-data" method="post">
  @csrf
  <label for="">Jenis Bibit</label>
  <input type="text" name="jenis" value="">
  <br>
  <label for="">Logo</label>
  <input type="file" name="logo" value="">
  <br>
  <input type="submit" name="" value="save">
</form>
