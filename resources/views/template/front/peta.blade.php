@extends('template.front.layout')
@section('content')
<main>
  <div id="map-all" style="height: 500px;">
  </div>
      <div class="container my-5" >
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center rounded-3 border shadow-lg">
          <div class="col-lg-12 p-3 p-lg-5 pt-lg-3">
            <h1 class="display-5 fw-bold lh-1 mb-3">Informasi Lahan Bekas Tambang</h1>

            <div class="d-grid gap-2 d-md-flex justify-content-md-start">
              <form action="" method="POST">
                @csrf
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Pilih Lahan</label>
              <select class="form-control" name="id">
                  @foreach($tambang as $each)
                    <option value="{{ $each->id }}">{{ $each->nama }}</option>
                  @endforeach
              </select>
              <div id="emailHelp" class="form-text">Pilih lahan bekas tambang.</div>
            </div>

            <button type="submit" class="btn dlh">Lihat Informasi</button>
          </form>
            </div>
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


          @foreach($tambang as $each)
                  map_it("{{ explode(',' , $each->lokasi)[1] }}" , "{{ explode(',' , $each->lokasi)[0] }}" , "{{ $each->nama }}" , "{{ $each->id }}");
                @endforeach

    </script>
@endsection