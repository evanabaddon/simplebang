@extends('template.front.layout')
@section('content')
<main>
<div id="map-all" style="height: 500px;">
  </div>
      <div class="container my-5" >
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-5 fw-bold lh-1 mb-3">Mitra Bibit Pohon</h1>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
              <form action="">
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Pilih Kebun Bibit</label>
              <select class="form-control" name="gudang">
                  @foreach($gudang as $each)
                    <option value="{{ $each->id }}">{{ $each->nama }}</option>
                  @endforeach
              </select>
              <div id="emailHelp" class="form-text">Pilih kebun bibit.</div>
            </div>

            <button type="submit" class="btn dlh">Lihat Informasi</button>
          </form>
            </div>
          </div>

        </div>
      </div>


      <div class="container my-5" >
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h3 class="display-7  lh-1 mb-3">Daftar bibit</h3>

            @foreach($bibit as $key => $each)
            @if($key == 0 || $key % 5 == 0)
             <div class="d-grid gap-2 d-md-flex justify-content-md-start">
            @endif
              <div class="card">
                 <img src="{{ $each->logo }}" alt="{{ $each->jenis }}" class="card-img-top" />
                    <div class="card-body">
                      <h5 class="card-title">{{ $each->jenis }}</h5>
                      <p class="card-text">Tersedia: {{ $each->tersedia }} bibit </p>
                      
                    </div>
              </div>
            @if($key % 6 == 0 && $key != 0)
            </div>
            @endif
            @endforeach

        </div>
      </div>
  
  


      <div class="container my-5" >
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h3 class="display-7  lh-1 mb-3">Mutasi bibit </h3>

            
              <div class="table-responsive">
                <table class="table" id="history">
                  <thead>
                    <tr>
                      
                      <th scope="col">Asal</th>
                      <th scope="col">Tipe</th>
                      <th scope="col">Jenis Bibit</th>
                      <th scope="col">Gudang</th>
                      <th scope="col">Jumlah</th>
                      <th scope="col">Total Tertanam</th>
                      <th scope="col">Total Tersedia</th>
                      <th scope="col">Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($history as $key => $each)
                    <tr>
                      
                      <td>{{ $each['asal'] }}</td>
                      <td>{{ $each['tipe'] }}</td>
                      <td>{{ $each['bibit'] }}</td>
                      <td>{{ $each['gudang'] }}</td>
                      <td>@if($each['tipe'] == 'Debit') {{ $each['jumlah'] }} @else - {{ $each['jumlah'] }} @endif</td>
                      <td>{{ $totalan[$key]['total_tanam'] }}</td>
                      <td>{{ $totalan[$key]['total_tersedia'] }}</td>
                      <td>{{ date('d-m-Y' , strtotime($each['created_at'])) }}</td>
                    </tr>
                    @endforeach
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

  $(document).ready( function () {
    $('#history').DataTable({
      order: [[5, 'asc']],
    });
    function map_it(long , lat , judul , id){
                              //const el = document.createElement('div');
                              //el.className = 'marker';
                              const popup = new mapboxgl.Popup({ offset: 25 }).setHTML('<a style="text-decoration: none;" class="fw-bold" href="/peta-tambang/'+id+'">' + judul + '</a>');
                                  var marker = new mapboxgl.Marker()
                                  .setLngLat([long, lat])
                                  .setPopup(popup)
                                  .addTo(map);

                                  /**var popup = new mapboxgl.Popup({ closeOnClick: false })
                                      .setLngLat([long, lat])
                                      .setHTML("<a href='pengaduan/view/" + id + "'>"+ judul + "</a>")
                                      .addTo(map);*/
                          }
    
    mapboxgl.accessToken = 'pk.eyJ1IjoicmFjaG1hdGFiZHVsIiwiYSI6ImNsYjh6djJ2cTBwc20zcnA0eDZxd2lndjUifQ.rldZj3DRaGatn9ymgDU31g';
          var  map = new mapboxgl.Map({
                      container: 'map-all', // container ID
                      style: 'mapbox://styles/mapbox/streets-v11', // style URL
                      center: ["112.5716", "-8.1326099999999"], // starting position [lng, lat]
                      zoom: 10 // starting zoom
                      });

 	 @foreach($gudang as $each)
                  map_it("{{ explode(',' , $each->lokasi)[1] }}" , "{{ explode(',' , $each->lokasi)[0] }}" , "{{ $each->nama }}" , "{{ $each->id }}");
                @endforeach
} );
</script>
@endsection