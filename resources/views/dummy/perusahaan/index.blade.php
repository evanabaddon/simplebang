<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Server Side Datatables Tutorial</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
    @endif
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
            <table class="table table-bordered user_datatable">
                <thead>
                    <tr>
                      <th>Logo</th>
                      <th>Nama</th>
                      <th>Jenis Perusahaan</th>
                      <th>Nama Pemilik</th>
                      <th>Alamat</th>
                      <th>Email</th>
                      <th>Telepon</th>
                      <th>Tanggal Input</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
  $(function () {


    var table = $('.user_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url : '{{ route('perusahaan.data') }}',
          type: 'post'
        },
        columns: [
            {data: 'logo' , name: 'logo'},
            {data: 'nama', name: 'nama'},
            {data: 'jenis', name: 'jenis'},
            {data: 'nama_pemilik', name: 'nama_pemilik'},
            {data: 'alamat' , name: 'alamat'},
            {data: 'email' , name: 'email'},
            {data: 'no_telepon' , name: 'no_telepon'},
            {data: 'tanggal' , name: 'tanggal'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
  });
</script>
</html>
