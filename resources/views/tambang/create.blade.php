@extends('template.layout')
@section('title' , 'Tambah Tambang')
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
                @if ($errors->any())
                <div class="rounded-md px-5 py-4 mb-2 bg-theme-6 text-white">
                   <div class="flex items-center">
                       <div class="font-medium text-lg">Terjadi Kesalahan</div>
                   </div>
                   <ul>
                       @foreach ($errors->all() as $error)
                           <li>{{ $error }}</li>
                       @endforeach
                   </ul>
               </div>
               @endif
               <!-- END: Top Bar -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        Tambah Tambang
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                      <form class="" action="{{ route('tambang.store') }}" method="post" enctype="multipart/form-data">
                        <button type="submit" class="button text-white bg-theme-1 shadow-md flex items-center"> Save </button>

                    </div>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="" id="map" style="width: 100%; height: 200px;"></div>
                </div>
                <div class="pos intro-y grid grid-cols-12 gap-5 mt-5">
                    <!-- BEGIN: Post Content -->

                      @csrf
                    <div class="intro-y col-span-12 lg:col-span-12">
                        <input type="text" id="nama" name="nama" class="intro-y input input--lg w-full box pr-10 placeholder-theme-13" placeholder="Nama Tambang">
                        <div class="post intro-y overflow-hidden box mt-5">
                            <div class="post__tabs nav-tabs flex flex-col sm:flex-row bg-gray-200 text-gray-600">
                                <a title="Informasi data tambang" data-toggle="tab" data-target="#content" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center active"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i> Informasi Tambang </a>
                                <a title="Informasi data pemilik" data-toggle="tab" data-target="#meta-title" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="code" class="w-4 h-4 mr-2"></i> Informasi Pemilik </a>
                                <a title="Lokasi tambang" data-toggle="tab" data-target="#keywords" href="javascript:;" class="tooltip w-full sm:w-40 py-4 text-center flex justify-center items-center"> <i data-feather="align-left" class="w-4 h-4 mr-2"></i> Lokasi Tambang </a>
                            </div>
                            <div class="post__content tab-content">
                                <div class="tab-content__pane p-5 active" id="content">
                                    <div class="border border-gray-200 rounded-md p-5 mt-5">
                                        <div class="mt-5">
                                            <div class="mt-3">
                                                <label>Jenis</label>
                                                <select class="input w-full border mt-2" name="jenis_tambang_id">
                                                  @foreach($jenis_tambang as $each)
                                                    <option value="{{ $each->id }}">{{ $each->jenis }}</option>
                                                  @endforeach
                                                </select>
                                            </div>
                                            <div class="mt-3">
                                              <label for="">Alamat</label>
                                              <textarea name="alamat" class="input w-full border mt-2" placeholder="Alamat Tambang"></textarea>
                                            </div>
                                            <div class="mt-3">
                                              <label for="">Luas</label>
                                              <input type="text" name="luas" class="input w-full border mt-2" value="" placeholder="Luas Tambang m²">
                                            </div>
                                            <div class="mt-3">
                                              <label for="">Status Lahan</label>
                                              <input type="text" name="status_lahan" class="input w-full border mt-2" value="" placeholder="Status lahan">
                                            </div>
                                            <div class="mt-3">
                                                <label>Upload Foto</label>
                                                <div class="border-2 border-dashed rounded-md mt-3 pt-4">
                                                    <div class="flex flex-wrap px-4" id="list">
                                                      <!--
                                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="/dist/images/preview-6.jpg">
                                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                                        </div>
                                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="/dist/images/preview-12.jpg">
                                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                                        </div>
                                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="/dist/images/preview-9.jpg">
                                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                                        </div>
                                                        <div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">
                                                            <img class="rounded-md" alt="Midone Tailwind HTML Admin Template" src="/dist/images/preview-13.jpg">
                                                            <div title="Remove this image?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div>
                                                        </div>
                                                      -->
                                                    </div>
                                                    <div class="px-4 pb-4 flex items-center cursor-pointer relative">
                                                        <i data-feather="image" class="w-4 h-4 mr-2"></i> <span class="text-theme-1 mr-1">Upload a file</span> or drag and drop
                                                        <input type="file" id="foto" name="foto[]" multiple class="w-full h-full top-0 left-0 absolute opacity-0">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content__pane p-5" id="meta-title">
                                    <div class="border border-gray-200 rounded-md p-5 mt-5">
                                        <div class="mt-5">
                                            <div class="mt-3">
                                                <label>Nama</label>
                                                <input type="text" name="nama_pemilik" class="input w-full border mt-2" value="" placeholder="Nama Pemilik">
                                            </div>
                                            <div class="mt-3">
                                              <label for="">Alamat</label>
                                              <textarea name="alamat_pemilik" class="input w-full border mt-2" placeholder="Alamat Pemilik"></textarea>
                                            </div>
                                            <div class="mt-3">
                                              <label for="">Email</label>
                                              <input type="email" name="email_pemilik" class="input w-full border mt-2" value="" placeholder="Email Pemilik">
                                            </div>
                                            <div class="mt-3">
                                                <label>Telepon</label>
                                                <input type="text" name="telepon_pemilik" class="input w-full border mt-2" value="" placeholder="Telepon Pemilik">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="tab-content__pane p-5" id="keywords">

                                    <div class="border border-gray-200 rounded-md p-5 mt-5">
                                        <div class="mt-5">
                                            <div class="mt-3">
                                                <label>Latitude</label>
                                                <input type="text" id="latitude" name="latitude" class="input w-full border mt-2" value="" placeholder="-x.xxxx">
                                            </div>
                                            <div class="mt-3">
                                                <label>Longitude</label>
                                                <input type="text" id="longitude" name="longitude" class="input w-full border mt-2" value="" placeholder="xxx.xxxx">
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                          </form>
                        </div>
                    </div>
                    <!-- END: Post Content -->

                </div>
            </div>
            <!-- END: Content -->
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function(){
  mapboxgl.accessToken = 'pk.eyJ1IjoicmFjaG1hdGFiZHVsIiwiYSI6ImNsYjh6djJ2cTBwc20zcnA0eDZxd2lndjUifQ.rldZj3DRaGatn9ymgDU31g';
  var  map = new mapboxgl.Map({
              container: 'map', // container ID
              style: 'mapbox://styles/mapbox/streets-v11', // style URL
              center: ["112.621391", "-7.983908"], // starting position [lng, lat]
              zoom: 10 // starting zoom
            });
});
function map_it(map , long , lat , judul , id){
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

  $("#latitude, #longitude").on('change',function(){
    var lat   =   $("#latitude").val();
    var long  =   $("#longitude").val();
    if(lat && long){
      var map = new mapboxgl.Map({
                  container: 'map', // container ID
                  style: 'mapbox://styles/mapbox/streets-v11', // style URL
                  center: [long, lat], // starting position [lng, lat]
                  zoom: 10 // starting zoom
                });
      map_it(map , long , lat , $('#nama').val());
    }

  });

  $(function() {
    // Multiple images preview in browser
    var imagesPreview = function(input) {
      $('#list').html('');
        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {

                  var html  = '<div class="w-24 h-24 relative image-fit mb-5 mr-5 cursor-pointer zoom-in">';
                    html += '<img class="rounded-md" src="' + event.target.result +'">';
                    html += '</div>';
                    $("#list").append(html);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('#foto').on('change', function() {
        imagesPreview(this);
    });
});
</script>
@endsection
