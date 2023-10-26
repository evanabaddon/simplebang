@extends('template.layout')
@section('title' , 'Daftar Tambang')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('tambang.index') }}" class="breadcrumb--active"> Data Tambang</a> </div>
                    <!-- END: Breadcrumb -->
                    @include('template.search')
                    @include('template.notification')
                    @include('template.account')
                </div>
                <!-- END: Top Bar -->
                @if (session('success'))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-18 text-theme-9"> <i data-feather="terminal" class="w-6 h-6 mr-2"></i> {{ session('success') }} </div>
                @endif
                @if (session('error'))
                <div class="rounded-md flex items-center px-5 py-4 mb-2 bg-theme-31 text-theme-6"> <i data-feather="alert-octagon" class="w-6 h-6 mr-2"></i> {{ session('error') }} </div>
                @endif
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">

                    <h2 class="text-lg font-medium mr-auto">
                        Data Tambang
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="{{ route('tambang.create') }}"><button class="button text-white bg-theme-1 shadow-md mr-2">Tambah Baru</button></a>
                    </div>
                </div>
                <div class="col-span-12 lg:col-span-6 mt-8">

                    <div class="intro-y box p-5 mt-12 sm:mt-5">
                        <div class="" id="map" style="width: 100%; height: 500px;"></div>
                    </div>
                </div>
                <!-- BEGIN: Datatable -->
                <div class="overflow-x-auto">
                  <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 ">

                    <table class="table" id="table-tambang">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">#</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">NAMA TAMBANG</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">JENIS TAMBANG</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">NAMA PEMILIK</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">STATUS LAHAN</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($tambang as $each)
                            <tr>

                              <td class="w-40">
                                      <div class="flex">
                                        @if(empty($each->foto))
                                          <div class="w-10 h-10 image-fit zoom-in">
                                              <img alt="Midone Tailwind HTML Admin Template" class="tooltip rounded-full" src="/dist/images/preview-4.jpg" title="Uploaded at 17 July 2021">
                                          </div>
                                        @else
                                          @foreach($each->foto as $key => $foto)
                                          @if($key <= 4 )
                                          <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                              <img alt="{{ $each->nama }}" class="tooltip rounded-full" src="{{ $foto->foto }}" title="{{ $each->nama }}">
                                          </div>
                                          @endif
                                          @endforeach
                                        @endif
                                      </div>
                                  </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->nama }}</div>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->nama }}</div>
                                </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->jenis }}</div>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->jenis }}</div>
                                </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->nama_pemilik }}</div>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->nama_pemilik }}</div>
                                </td>
                                <td class="border-b">
                                    <div class="font-medium whitespace-no-wrap">{{ $each->status_lahan }}</div>
                                    <div class="text-gray-600 text-xs whitespace-no-wrap">{{ $each->status_lahan }}</div>
                                </td>
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                      <a class="flex items-center mr-3" href="{{ route('tambang.edit' , $each->id) }}"> <i data-feather="eye" class="w-4 h-4 mr-1"></i> Detail </a>
                                        <a class="flex items-center mr-3" href="{{ route('tambang.edit' , $each->id) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" href="{{ route('tambang.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
                </div>
                <!-- END: Datatable -->
            </div>
            <!-- END: Content -->
@endsection
@section('js')
  <script type="text/javascript">
      $(document).ready(function(){
        $("#table-tambang").dataTable({
          dom: 'Bfrtip',
         buttons: [
          'copy','pdf','excel' , 'csv'
        ],

        });


          mapboxgl.accessToken = 'pk.eyJ1IjoicmFjaG1hdGFiZHVsIiwiYSI6ImNsYjh6djJ2cTBwc20zcnA0eDZxd2lndjUifQ.rldZj3DRaGatn9ymgDU31g';
          var  map = new mapboxgl.Map({
                      container: 'map', // container ID
                      style: 'mapbox://styles/mapbox/streets-v11', // style URL
                      center: ["112.621391", "-7.983908"], // starting position [lng, lat]
                      zoom: 10 // starting zoom
                      });

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
                @foreach($tambang as $each)
                  map_it("{{ explode(',' , $each->lokasi)[1] }}" , "{{ explode(',' , $each->lokasi)[0] }}" , "{{ $each->nama }}" , "{{ $each->id }}");
                @endforeach

      });
  </script>
@endsection
