@extends('template.layout')
@section('title' , 'Daftar Perusahaan')
@section('content')
<!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar">
                    <!-- BEGIN: Breadcrumb -->
                    <div class="-intro-x breadcrumb mr-auto hidden sm:flex"> <a href="/" class="">Dashboard</a> <i data-feather="chevron-right" class="breadcrumb__icon"></i> <a href="{{ route('perusahaan.index') }}" class="breadcrumb--active"> Perusahaan</a> </div>
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
                        Data Perusahaan
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <a href="{{ route('perusahaan.create') }}"><button class="button text-white bg-theme-1 shadow-md mr-2">Tambah Baru</button></a>
                    </div>
                </div>
                <!-- BEGIN: Datatable -->
                <div class="overflow-x-auto">
                <div class="overflow-x-auto intro-y datatable-wrapper  box p-5 mt-5 ">

                    <table class="table" id="table-perusahaan">
                        <thead>
                            <tr>
                                <th class="border-b-2 whitespace-no-wrap">#</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">NAMA PERUSAHAAN</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">JENIS PERUSAHAAN</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">NAMA PEMILIK</th>
                                <th class="border-b-2 text-center whitespace-no-wrap">ACTIONS</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($perusahaan as $each)
                            <tr>

                                <td class="text-center border-b">
                                    <div class="flex sm:justify-center">
                                        <div class="intro-x w-10 h-10 image-fit">
                                            <img alt="" class="rounded-full" src="@if($each->logo != NULL) {{ $each->logo }} @else /dist/images/preview-9.jpg @endif">
                                        </div>
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
                                <td class="border-b w-5">
                                    <div class="flex sm:justify-center items-center">
                                      <a class="flex items-center mr-3" href="{{ route('perusahaan.detail' , $each->id) }}"> <i data-feather="eye" class="w-4 h-4 mr-1"></i> Detail </a>
                                        <a class="flex items-center mr-3" href="{{ route('perusahaan.edit' , $each->id) }}"> <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit </a>
                                        <a class="flex items-center text-theme-6" href="{{ route('perusahaan.delete' , $each->id) }}"> <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete </a>
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
        $("#table-perusahaan").dataTable({

        });
      });
  </script>
@endsection
