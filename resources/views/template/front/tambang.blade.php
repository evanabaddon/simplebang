@extends('template.front.layout')
@section('content')
<main>
  <div id="map-all" style="height: 500px;">
  </div>

      <div class="container my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-5 fw-bold lh-1 mb-3">Tambang {{ $tambang->nama }}</h1>
            <nav>
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Informasi Tambang</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Informasi Pemilik</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Penanaman</button>
                <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Galeri</button>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <br>
              <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                <br>
                
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Jenis Tambang</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $tambang->jenis }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Alamat</label>
                    <textarea class="form-control" readonly>{{ $tambang->alamat }}</textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Luas Lahan</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $tambang->luas }} m2" readonly>
                  </div>

                
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <br>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Pemilik</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $pemilik->nama }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label class="form-label">Alamat Pemilik</label>
                    <textarea class="form-control" readonly>{{ $pemilik->alamat }}</textarea>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email Pemilik</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $pemilik->email }}" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Telepon Pemilik</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{ $pemilik->no_telepon }}" readonly>
                  </div>
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                <div class="table-responsive">
                <table class="table" id="penanaman">
                  <thead>
                    <tr>
                      
                      <th scope="col">#</th>
                      <th scope="col">Luas Penanaman</th>
                      <th scope="col">Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($penanaman as $key => $each)
                    <tr>
                      
                      <td>{{ $each['judul'] }}</td>
                      <td>{{ $each['luas'] }} m2</td>
                      <td>{{ $each['tanggal'] }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                <br>
                <table class="table" id="bibit">
                  <thead>
                    <tr>
                      
                      <th scope="col">#</th>
                      <th scope="col">Jenis Bibit</th>
                      <th scope="col">Asal Gudang Bibit</th>
                      <th scope="col">Jumlah Bibit</th>
                      <th scope="col">Tanggal</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($bibit_tanam as $key => $each)
                    <tr>
                      
                      <td>{{ $each['judul'] }}</td>
                      <td>{{ $each['jenis'] }}</td>
                      <td>{{ $each['nama'] }}</td>
                      <td>{{ $each['jumlah'] }} bibit</td>
                      <td>{{ $each['tanggal'] }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              </div>
              <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                  <div class="container">
                    <div class="row row-cols-4">
                      @foreach($foto_tambang as $each)
                      <div class="p-2">
                        <div class="card gx-2" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $each->foto }}" alt="{{ $tambang->nama }}">
                      </div>
                      </div>
                      @endforeach
                      @foreach($dokumentasi as $each)
                      <div class="p-2"><div class="card gx-2" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $each->file }}" alt="{{ $tambang->nama }}">
                      </div></div>
                      @endforeach
                    </div>
                  </div>
            </div>
            <br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-start"><a href="/peta-tambang"><button type="button" class="btn dlh">Kembali </button></a></div>
          </div>
        </div>
      </div>

</main>
@endsection
@section('js')
<script type="text/javascript">

  function map_it(long , lat , judul , id){
                              //const el = document.createElement('div');
                              //el.className = 'marker';
                              const popup = new mapboxgl.Popup({ offset: 25 }).setHTML(
                              judul
                              );
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


          map_it("{{ explode(',' , $tambang->lokasi)[1] }}" , "{{ explode(',' , $tambang->lokasi)[0] }}" , "{{ $tambang->nama }}" , "{{ $tambang->id }}");
        $("#penanaman , #bibit").dataTable();
    </script>
@endsection