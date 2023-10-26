@extends('template.layout')
@section('title' , 'SimpelBang Kab. Malang')
@section('content')
<div class="content">
    <!-- BEGIN: Top Bar -->
    <div class="top-bar">
        <!-- BEGIN: Breadcrumb -->
        <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="" class="">Application</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="" class="breadcrumb--active">Dashboard</a> </div>
        <!-- END: Breadcrumb -->

        @include('template.search')
                    @include('template.notification')
                    @include('template.account')
    </div>
    <!-- END: Top Bar -->
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 xxl:col-span-12 grid grid-cols-12 gap-6">

            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        
                    </h2>
                    <a href="" class="ml-auto flex text-theme-1"> <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    
                                    
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totaltambang }}</div>
                                <div class="text-base text-gray-600 mt-1">Tambang</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                   
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totalperusahaan }}</div>
                                <div class="text-base text-gray-600 mt-1">Perusahaan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totalcsr_bibit }}</div>
                                <div class="text-base text-gray-600 mt-1">Total CSR</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    
                                </div>
                                <div class="text-3xl font-bold leading-8 mt-6">{{ $totalbibit_tanam }}</div>
                                <div class="text-base text-gray-600 mt-1">Total Penanaman</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Official Store -->
            <div class="col-span-12 xl:col-span-12 mt-6">
                
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div></div>
                    <div class="" id="map" style="width: 100%; height: 500px;"></div>
                </div>
            </div>
            <!-- END: Official Store -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-7 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Grafik Bibit Pohon Masuk X Bibit Pohon Ditanam {{ date('Y') }}
                    </h2>
                    
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        
                    </div>

                        <canvas id="myChart"  class="mt-6"></canvas>
                    
                </div>
            </div>
            <!-- END: Sales Report -->

            <!-- END: Weekly Top Seller -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-4 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                        Bibit Pohon
                    </h2>
                    
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="bibit" height="280"></canvas>
                    
                </div>
            </div>
            <!-- END: Sales Report -->
            
            
        </div>
        
    </div>
</div>
<!-- END: Content -->
</div>
@endsection
@section('js')
<script type="text/javascript" src="https://www.chartjs.org/samples/2.9.4/utils.js"></script>
<script type="text/javascript">
    function chart_csr(){
        const labels = ["Janurari" , "Februari" , "Maret" , "April" , "Mei" , "Juni" , "Juli" , "Agustus" , "September" , "Oktober" , "November"  , "Desember"];
        const data = {
          labels: labels,
          datasets: [{
            label: 'Total Bibit Masuk',
            data: {!! $bibit_masuk !!},
            fill: false,
            borderColor: 'rgb(76, 175, 80)',
            tension: 0.1
          } , {
            label: 'Total Bibit Ditanam',
            data: {!! $bibit_keluar !!},
            fill: false,
            borderColor: 'rgb(244, 67, 54)',
            tension: 0.1
          }]
        };
        new Chart("myChart", {
          type: "line",
          data: data,
          options: {
            legend: {display: true}
          }
        });
    }

    function random_color(){
        var back = [ "#26a69a" , "#689f38"];
        var rand = back[Math.floor(Math.random() * back.length)];
        return rand;
    }

    function chart_bibit(){
        var xValues = {!! $bibit !!};
        var yValues = {!! $jumlah_bibit !!};
        var barColors = [
          random_color(),
          random_color(),
          random_color(),
          random_color(),
          random_color()
        ];

        new Chart("bibit", {
          type: "doughnut",
          data: {
            labels: xValues,
            datasets: [{
              backgroundColor: barColors,
              data: yValues
            }]
          },
          options: {
            title: {
              display: true,
              text: "Bibit Pohon",
            },
            legend: {display: true},

          }
        });
    }

    $(document).ready(function(){
        chart_csr();
        chart_bibit();
    });

    mapboxgl.accessToken = 'pk.eyJ1IjoicmFjaG1hdGFiZHVsIiwiYSI6ImNsYjh6djJ2cTBwc20zcnA0eDZxd2lndjUifQ.rldZj3DRaGatn9ymgDU31g';
          var  map = new mapboxgl.Map({
                      container: 'map', // container ID
                      style: 'mapbox://styles/mapbox/streets-v11', // style URL
                      center: ["112.5716", "-8.1326099999999"], // starting position [lng, lat]
                      zoom: 10 // starting zoom
                      });

          function map_it(long , lat , judul , id){
                              //const el = document.createElement('div');
                              //el.className = 'marker';
                              const popup = new mapboxgl.Popup({ offset: 25 }).setHTML('<a href="/tambang/edit/'+ id + '">' + judul + '</a>'
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
</script>
@endsection
