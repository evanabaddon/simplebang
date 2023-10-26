@extends('template.front.layout')
@section('content')
<main>
      <div class="container my-5" >
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h3 class="display-7  lh-1 mb-3">Perusahaan Dengan CSR Terbanyak </h3>

            
              <div class="table-responsive">
                <table class="table text-justify" id="history">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">#</th>
                      <th scope="col text-justify">Nama Perusahaan</th>
                      <th scope="col">Jenis Perusahaan</th>
                      <th scope="col">Nama Pemilik</th>
                      <th scope="col">Jumlah Bibit Pohon</th>
                    </tr>
                    @foreach($data as $key => $each)
                    @if($key > 4)
                          @break
                      @endif
                      <tr>
                        <td>
                          	@if($key == "0")
                          	 	<img src="/assets/img/first.png" width="35">
                          	@endif
                          @if($key == "1")
                          	 	<img src="/assets/img/second.png" width="35">
                          	@endif
                          @if($key == "2")
                          	 	<img src="/assets/img/third.png" width="35">
                          	@endif
                          @if($key == "3")
                          	 	<img src="/assets/img/fourth.png" width="35">
                          	@endif
                          @if($key == "4")
                          	 	<img src="/assets/img/fifth.png" width="35">
                          	@endif
                        </td>
                        <td>
                          @if($each->logo)
                          <img src="{{ $each->logo }}" width="150">
                          @else
                          <img src="/dist/images/preview-9.jpg" width="150">
                          @endif
                        </td>
                        <td >{{ $each->nama_perusahaan }}</td>
                        <td>{{ $each->jenis }}</td>
                        <td>{{ $each->nama_pemilik }}</td>
                        <td>{{ $each->total }} bibit pohon</td>
                        
                      </tr>
                      
                    @endforeach
                  </thead>
                  <tbody>
                    
                  </tbody>
                </table>
              </div>
            
          </div>

        </div>
      </div>



</main>
@endsection
@section('js')
<script>
  $(function () {
 
  $("#ke-0").rateYo({
    rating: 5
  });

  $("#ke-1").rateYo({
    rating: 4
  });

  $("#ke-2").rateYo({
    rating: 3
  });

  $("#ke-3").rateYo({
    rating: 2
  });

  $("#ke-4").rateYo({
    rating: 1
  });
 
});
</script>
@endsection